<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>

<?php do_action( 'wpo_wcpdf_before_document', $this->get_type(), $this->order ); ?>

<?php $settings_general = get_option( 'wpo_wcpdf_settings_general' ); ?>

	<table class="no-borders" style="line-height: 1.5; margin-bottom: 20px; position: relative;">
		<tr>
			<td style="vertical-align: middle; text-align: left;">
			<img src="<?php echo get_template_directory_uri(); ?>/woocommerce/pdf/Fleetservice/logo.png" width="115px" height="100px"></td>
			<td style="vertical-align: middle; text-align: right;">
				<div style="margin-bottom: 10px;"><b><?php $this->shop_name(); ?></b></div>
				<?php $this->shop_address(); ?>
			</td>
		</tr>
	</table>

	<table style="margin-bottom: 20px;">
		<tr>
			<td style="border-width: 0;">
				<table>
					<tr>
						<td class="brdBott0"><?php echo $settings_general['bank']['default']; ?></td>
						<td>БИК</td>
						<td class="brdBott0"><?php echo $settings_general['bik']['default']; ?></td>
					</tr>

					<tr>
						<td class="brdTop0 brdBott0"></td>
						<td class="brdBott0">Сч. №</td>
						<td class="brdBott0 brdTop0"><?php echo $settings_general['acc1']['default']; ?></td>
					</tr>

					<tr>
						<td class="brdTop0"></td>
						<td class="brdTop0"></td>
						<td class="brdTop0"></td>
					</tr>

					<tr>
						<td class="padding0">
							<table>
								<tr>
									<td class="brdTop0 brdLeft0 brdBott0">ИНН &nbsp;&nbsp;<span><?php echo $settings_general['inn']['default']; ?></span></td>
									<td class="brdTop0 brdLeft0 brdBott0 brdRight0">КПП &nbsp;&nbsp;<span><?php echo $settings_general['kpp']['default']; ?></span></td>
								</tr>

								<tr>
									<td colspan="4" class="brdBott0 brdLeft0 brdRight0"><?php $this->shop_name(); ?></td>
								</tr>
								<tr>
									<td colspan="4" class="brdTop0 brdBott0 brdLeft0 brdRight0">Получатель</td>
								</tr>
							</table>
						</td>
						<td>Сч. №</td>
						<td><?php echo $settings_general['acc2']['default']; ?></td>
					</tr>
					<caption>
						<span class="small">Образец заполнения платежного поручения</span>
					</caption>
				</table>
			</td>
			<td style="border-width: 0; text-align: center; width: 140px;">
				<?php
				ob_start();
				$this->order_number();
				$order_number = ob_get_clean();
				ob_start();
				$this->order_date();
				$order_date = ob_get_clean();
				$qr_code_shortcode = "[in_qr_payment width='120' height='120' payee='".addslashes($settings_general['shop_name']['default'])."' acc='".$settings_general['acc2']['default']."' bank='".addslashes($settings_general['bank']['default'])."' bic='".$settings_general['bik']['default']."' corr='".$settings_general['acc1']['default']."' inn='".$settings_general['inn']['default']."' kpp='".$settings_general['kpp']['default']."' purpose='Оплата за товар по СЧЕТ-ДОГОВОР№".$order_number." от ".$order_date.". Без налога (НДС)' sum='".$order->get_total()."']";
				echo do_shortcode($qr_code_shortcode); ?>
				<div><small>Отсканируйте для оплаты</small></div>
			</td>
		</tr>
	</table>

	<h1>СЧЕТ-ДОГОВОР № <?php $this->order_number(); ?> от <?php $this->invoice_date(); ?></h1>

	<table class="padBott__td-1 no-borders" style="margin-bottom: 20px;">
		<tr>
			<td>Поставщик:</td>
			<td><b><?php echo $this->get_settings_text( 'extra_2' ); ?></b>
			</td>
		</tr>
		<tr>
			<td>Грузоотправитель:</td>
			<td><b><?php echo $this->get_settings_text( 'extra_3' ); ?>
				</b>
			</td>
		</tr>

		<tr>
			<td>Покупатель:</td>
			<td><b><?php echo receiver($this); ?></b></td>
		</tr>

		<tr>
			<td>Грузополучатель:</td>
			<td><b><?php echo receiver($this); ?></b></td>
		</tr>
	</table>

	<table class="invoice" style="margin-bottom: 32px;">
		<thead>
			<tr>
				<th>№</th>
				<th>Артикул</th>
				<th>Товары (работы, услуги)</th>
				<th>Кол-во</th>
				<th>Ед.</th>
				<th>Цена</th>
				<th>Сумма</th>
			</tr>
		</thead>

		<tbody>
			<?php $items = $this->get_order_items(); if( sizeof( $items ) > 0 ) : $i=1; foreach( $items as $item_id => $item ) : ?>
			<tr>
				<td class="txtCenter"><?php echo $i++; ?></td>
				<td><?php echo $item['sku']; ?></td>
				<td>
				<?php echo $item['name']; ?>
				</td>
				<td class="txtRight"><?php echo $item['quantity']; ?></td>
				<td>шт.</td>
				<td class="nowrap txtRight"><?php echo strip_tags($item['single_line_total']); ?></td>
				<td class="nowrap txtRight"><?php echo strip_tags($item['order_price']); ?></td>
			</tr>
			<?php endforeach; endif; ?>
		</tbody>

		<tfoot class="no-borders">
			<tr class="fwBold txtRight">
				<td colspan="6">Итого:</td>
				<td class="nowrap"><?php echo strip_tags($order->get_subtotal_to_display()); ?></td>
			</tr>

			<tr class="fwBold txtRight">
				<td colspan="6">В том числе НДС:</td>
				<?php $nds=$order->get_total()-$order->get_total()/1.2; 
				$nds=round($nds,2);
				$nds=strip_tags((wc_price($nds)));
				?>
				<td class="nowrap"><?php echo $nds; ?></td>
			</tr>

			<tr class="fwBold txtRight">
				<td colspan="6">Всего к оплате:</td>
				<td class="nowrap"><?php echo strip_tags(wc_price($order->get_total())); ?></td>
			</tr>


			<tr>
				<td colspan="7">Всего наименований <?php echo $i; ?>, на сумму <?php echo strip_tags(wc_price($order->get_total())); ?></td>
			</tr>

			<tr class="fwBold">
				<td colspan="7" class="first-uppercase"><b><?php echo num2str($order->get_total()); ?></b></td>
			</tr>
			<tr class="fwBold">
				<td colspan="7"><b><!-- Масса брутто: 20 кг., Объем: 0,042 м3 --></b></td>
			</tr>
		</tfoot>
	</table>
<?php 
$home_path = get_home_path();
$home_path_length_1 = strlen($home_path)-1;
$sign1_id = $settings_general['sign1'];
$sign1_path_full = get_attached_file( $sign1_id );
$sign1_path = substr($sign1_path_full,$home_path_length_1);
$sign2_id = $settings_general['sign2'];
$sign2_path_full = get_attached_file( $sign2_id );
$sign2_path = substr($sign2_path_full,$home_path_length_1);
$stamp_id = $settings_general['stamp'];
$stamp_path_full = get_attached_file( $stamp_id );
$stamp_path = substr($stamp_path_full,$home_path_length_1);
 ?>
	<div>
		<table class="visa no-borders" style="margin-top: 18px; text-align: center; page-break-inside: avoid;">
			<tr>
				<td style="text-align: left; padding-bottom: 5px; padding-top: 5px;"><b>Руководитель</b></td>
				<td style="border-bottom: 1px solid #000;"><b><?php echo $settings_general['chief_position']['default']; ?></b></td>
				<td></td>
				<td class="sign-1">
					<div class="sign-1__autograph" 
					style="background-image: url(..<?php echo $sign1_path; ?>);"></div>
				</td>
				<td style="border-bottom: 1px solid #000;"><b><?php echo $settings_general['chief']['default']; ?></b></td>
			</tr>

			<tr>
				<td></td>
				<td>должность</td>
				<td></td>
				<td class="stamp">
					<div class="stamp__img"
					style="background-image: url(..<?php echo $stamp_path; ?>);">
					</div>
				</td>
				<td><small>расшифровка подписи</small></td>
			</tr>

			<tr>
				<td style="text-align: left;  padding-bottom: 5px; padding-top: 5px;"><b>Главный (старший) бухгалтер</b></td>
				<td></td>
				<td></td>
				<td class="sign-2">
					<div class="sign-2__autograph" 
					style="background-image: url(..<?php echo $sign2_path; ?>);"></div>
				</td>
				<td style="border-bottom: 1px solid #000;"><b><?php echo $settings_general['chief_accountant']['default']; ?></b></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="padding-top: 0;"><small>расшифровка подписи</small></td>
			</tr>

			<tr>
				<td style="text-align: left; padding-bottom: 5px; padding-top: 5px;"><b>Ответственный</b></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-bottom: 1px solid #000;"><b><?php echo $settings_general['responsible']['default']; ?></b></td>
			</tr>

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="padding-top: 0;"><small>расшифровка подписи</small></td>
			</tr>

		</table>
	</div>

	<div style="padding-top: 20px;"><b>ВНИМАНИЕ! Счет действителен в течение 3 (трех) рабочих дней.</div></b>
	<div>Выдача груза производится только при наличии доверенности и документа, удостоверяющего личность, на
		которую выписана. </div>



