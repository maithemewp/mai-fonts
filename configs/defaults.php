<?php

/* ******** *
 * Defaults *
 * ******** */
Kirki::add_section( 'maifonts_defaults', array(
	'title' => esc_attr__( 'Defaults', 'mai-fonts' ),
	'panel' => $panel_id,
) );

/**
 * Body
 */
// Kirki::add_field( $config_id, array(
// 	'type'      => 'typography',
// 	'settings'  => 'footer_widget_titles',
// 	'label'     => esc_attr__( 'Footer Widget Titles', 'mai-fonts' ),
// 	'section'   => 'maifonts_defaults',
// 	'transport' => 'auto',
// 	'default'   => array(
// 		'font-family'    => '',
// 		'variant'        => '',
// 		'font-size'      => '',
// 		'letter-spacing' => '',
// 		'text-align'     => '',
// 		'text-transform' => '',
// 	),
// 	'output' => array(
// 		array(
// 			'element' => array( '.footer-widgets .widgettitle', '.footer-widgets .widget-title' ),
// 		),
// 	),
// ) );

/**
 * Banner Area
 */
Kirki::add_field( $config_id, array(
	'type'      => 'typography',
	'settings'  => 'banner_title',
	'label'     => esc_attr__( 'Banner Title', 'mai-fonts' ),
	'section'   => 'maifonts_defaults',
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => 'inherit',
		'letter-spacing' => '0',
		'text-align'     => 'left',
		'text-transform' => 'none',
	),
	'output' => array(
		array(
			'element' => array( '.banner-title' ),
		),
	),
	'active_callback' => function() {
		return function_exists( 'mai_is_banner_area_enabled_globally' ) && mai_is_banner_area_enabled_globally();
	}
) );
