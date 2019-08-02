<?php
add_filter( 'gettext', 'theme_change_translation', 20, 3 );
function theme_change_translation( $translated_text, $text, $domain ) {
	switch ( $translated_text ) {
		case 'Цены: по возрастанию':
			$translated_text = 'Возрастанию цены';
            break;
		case 'Цены: по убыванию':
			$translated_text = 'Убыванию цены';
            break;
		case 'Товаров на странице: ':
			$translated_text = '';
            break;				
	}
	return $translated_text;
}