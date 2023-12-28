<?php
/**
 * Use this file for all your template filters and actions.
 * Requires PDF Invoices & Packing Slips for WooCommerce 1.4.13 or higher
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function receiver($invoice) {
/*    $company = ($invoice->order->data['billing']['company'])?$invoice->order->data['billing']['company'].', ':'';*/
    $name = $invoice->order->data['billing']['first_name']. ' '.$invoice->order->data['billing']['last_name'].', ' ;
    $billing_myfield13 = get_post_meta($invoice->order->get_order_number(),'_billing_myfield13',true);    
    $inn = ($billing_myfield13)?'ИНН '.$billing_myfield13.', ':'';  
    $postcode = ($invoice->order->data['billing']['postcode'])?$invoice->order->data['billing']['postcode'].', ':'';
    $state = ($invoice->order->data['billing']['state'])?$invoice->order->data['billing']['state'].', ':'';
    $city = ($invoice->order->data['billing']['city'])?$invoice->order->data['billing']['city'].', ':'';
    $address_1 = ($invoice->order->data['billing']['address_1'])?$invoice->order->data['billing']['address_1'].', ':'';
    $address_2 = ($invoice->order->data['billing']['address_2'])?$invoice->order->data['billing']['address_2'].', ':'';
    /*$receiver_full = $name.$inn.$state.$city.$address_1.$address_2;*/// Для юр. лица
    $receiver_full = $name; // Для физ. лица
    $receiver_final = substr($receiver_full, 0, strlen($receiver_full)-2);
    return  $receiver_final;
} 

add_filter('wpo_wcpdf_settings_fields_general','custom_additional_settings',99, 4);
function custom_additional_settings($settings_fields, $page, $option_group, $option_name ) {
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'bank',
        'title'     => __( 'Банк', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'bank',
            'description'   => __( 'Банк организации-владельца магазина' ),
            'translatable'  => true,
        )
    );     
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'inn',
        'title'     => __( 'ИНН', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'inn',
            'description'   => __( 'ИНН организации-владельца магазина' ),
            'translatable'  => true,
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'kpp',
        'title'     => __( 'КПП', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'kpp',
            'description'   => __( 'КПП организации-владельца магазина' ),
            'translatable'  => true,
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'bik',
        'title'     => __( 'БИК', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'bik',
            'description'   => __( 'БИК организации-владельца магазина' ),
            'translatable'  => true,
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'acc1',
        'title'     => __( 'Счет 1', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'acc1',
            'translatable'  => true,
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'acc2',
        'title'     => __( 'Счет 2', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'acc2',
            'translatable'  => true,
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'chief_position',
        'title'     => __( 'Должность руководителя', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'chief_position',
            'translatable'  => true,
        )
    );    
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'chief',
        'title'     => __( 'Руководитель', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'chief',
            'translatable'  => true,
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'chief_accountant',
        'title'     => __( 'Главный (старший) бухгалтер', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'chief_accountant',
            'translatable'  => true,
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'responsible',
        'title'     => __( 'Ответственный', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'text_input',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'   => 'wpo_wcpdf_settings_general',
            'id'            => 'responsible',
            'translatable'  => true,
        )
    );

    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'stamp',
        'title'     => __( 'Печать', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'media_upload',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'                   => $option_name,
            'id'                            => 'stamp',
            'uploader_title'                => __( 'Select or upload your invoice header/logo', 'woocommerce-pdf-invoices-packing-slips' ),
            'uploader_button_text'          => __( 'Set image', 'woocommerce-pdf-invoices-packing-slips' ),
            'remove_button_text'            => __( 'Remove image', 'woocommerce-pdf-invoices-packing-slips' ),
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'sign1',
        'title'     => __( 'Подпись 1', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'media_upload',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'                   => $option_name,
            'id'                            => 'sign1',
            'uploader_title'                => __( 'Select or upload your invoice header/logo', 'woocommerce-pdf-invoices-packing-slips' ),
            'uploader_button_text'          => __( 'Set image', 'woocommerce-pdf-invoices-packing-slips' ),
            'remove_button_text'            => __( 'Remove image', 'woocommerce-pdf-invoices-packing-slips' ),
        )
    );
    $settings_fields[] = array(
        'type'      => 'setting',
        'id'        => 'sign2',
        'title'     => __( 'Подпись 2', 'woocommerce-pdf-invoices-packing-slips' ),
        'callback'  => 'media_upload',
        'section'   => 'extra_template_fields',
        'args'      => array(
            'option_name'                   => $option_name,
            'id'                            => 'sign2',
            'uploader_title'                => __( 'Select or upload your invoice header/logo', 'woocommerce-pdf-invoices-packing-slips' ),
            'uploader_button_text'          => __( 'Set image', 'woocommerce-pdf-invoices-packing-slips' ),
            'remove_button_text'            => __( 'Remove image', 'woocommerce-pdf-invoices-packing-slips' ),
        )
    );        
            
    return $settings_fields;
}

/**
 * Возвращает сумму прописью
 * @author runcore
 * @uses morph(...)
 */
function num2str($num)
{
    $nul = 'ноль';
    $ten = array(
        array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
        array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять')
    );
    $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
    $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
    $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
    $unit = array(
        array('копейка' , 'копейки',   'копеек',     1),
        array('рубль',    'рубля',     'рублей',     0),
        array('тысяча',   'тысячи',    'тысяч',      1),
        array('миллион',  'миллиона',  'миллионов',  0),
        array('миллиард', 'миллиарда', 'миллиардов', 0),
    );
 
    list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub) > 0) {
        foreach (str_split($rub, 3) as $uk => $v) {
            if (!intval($v)) continue;
            $uk = sizeof($unit) - $uk - 1;
            $gender = $unit[$uk][3];
            list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
            // mega-logic
            $out[] = $hundred[$i1]; // 1xx-9xx
            if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; // 20-99
            else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; // 10-19 | 1-9
            // units without rub & kop
            if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
        }
    } else {
        $out[] = $nul;
    }
    $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
    $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
}
 
/**
 * Склоняем словоформу
 * @author runcore
 */
function morph($n, $f1, $f2, $f5) 
{
    $n = abs(intval($n)) % 100;
    if ($n > 10 && $n < 20) return $f5;
    $n = $n % 10;
    if ($n > 1 && $n < 5) return $f2;
    if ($n == 1) return $f1;
    return $f5;
}
