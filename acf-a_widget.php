<?php

/*
  Plugin Name: Advanced Custom Fields: Widget Area
  Plugin URI: PLUGIN_URL
  Description: SHORT_DESCRIPTION
  Version: 1.0.0
  Author: AUTHOR_NAME
  Author URI: AUTHOR_URL
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */




// 1. set text domain
// Reference: https://codex.wordpress.org/Function_Reference/load_plugin_textdomain
load_plugin_textdomain( 'acf-a_widget', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

// 2. Include field type for ACF5
// $version = 5 and can be ignored until ACF6 exists
function include_field_types_a_widget( $version ) {

	include_once('acf-a_widget-v5.php');
}

add_action( 'acf/include_field_types', 'include_field_types_a_widget' );

// 3. Include field type for ACF4
function register_fields_a_widget() {

	include_once('acf-a_widget-v4.php');
}

add_action( 'acf/register_fields', 'register_fields_a_widget' );


/**
 * Helper function to render the actual output of the Widget
 * @param string $field_value The value of the a_widget field. 
 */
function acf_a_widget_the_field( $field_value ) {
		
	if ( empty( $field_value ) || !isset( $field_value['instance'] ) || !isset( $field_value['the_widget'] ) || empty($field_value['the_widget']) ) {
		return;
	}
	
	$acf_widget_id = $field_value['widget_id'];
	$instance = $field_value['instance'];
	$widget = $field_value['the_widget'];
	the_widget( $widget, $instance, array( 'widget_id' => $acf_widget_id ) );
}
