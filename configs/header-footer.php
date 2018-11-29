<?php

/* *************** *
 * Header & Footer *
 * *************** */
Kirki::add_section( 'maifonts_header_footer', array(
	'title' => esc_attr__( 'Header & Footer', 'mai-fonts' ),
	'panel' => $panel_id,
) );

/**
 * Footer Widget Titles
 */
Kirki::add_field( $config_id, array(
	'type'      => 'typography',
	'settings'  => 'footer_widget_titles',
	'label'     => esc_attr__( 'Footer Widget Titles', 'mai-fonts' ),
	'section'   => 'maifonts_header_footer',
	'transport' => 'auto',
	'default'   => array(
		'font-family'    => '',
		'variant'        => '',
		'font-size'      => '',
		'letter-spacing' => '',
		'text-align'     => '',
		'text-transform' => '',
	),
	'output' => array(
		array(
			'element' => array(
				'.footer-widgets .widgettitle',
				'.footer-widgets .widget-title',
			),
		),
	),
) );
