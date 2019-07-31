<?php
/**
 * fleetservice Theme Customizer
 *
 * @package fleetservice
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function fleetservice_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'fleetservice_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'fleetservice_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_section(
			'section_header', array(
				'title' => 'Шапка',
				'description' => '',
				'priority' => 3,
			)
		);
		$wp_customize->add_setting('header_phone', 
			array('default' => '')
		);
		$wp_customize->add_control('header_phone', array(
				'label' => 'Телефон',
				'section' => 'section_header',
				'type' => 'textarea',
			)
		);	
		$wp_customize->add_setting('working_hours', 
			array('default' => '')
		);
		$wp_customize->add_control('working_hours', array(
				'label' => 'Часы работы',
				'section' => 'section_header',
				'type' => 'textarea',
			)
		);
		$wp_customize->add_setting('wishist_url', 
			array('default' => '')
		);
		$wp_customize->add_control('wishist_url', array(
				'label' => 'Страница избранного (url)',
				'section' => 'section_header',
				'type' => 'text',
			)
		);
		$wp_customize->add_setting('compare_url', 
			array('default' => '')
		);
		$wp_customize->add_control('compare_url', array(
				'label' => 'Страница сравнения (url)',
				'section' => 'section_header',
				'type' => 'text',
			)
		);		

}
add_action( 'customize_register', 'fleetservice_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function fleetservice_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function fleetservice_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function fleetservice_customize_preview_js() {
	wp_enqueue_script( 'fleetservice-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'fleetservice_customize_preview_js' );

