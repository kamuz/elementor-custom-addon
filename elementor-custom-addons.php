<?php
/**
 * Plugin Name: Addon for custom Elementor widgets
 * Description: Before/after image comparison widget to Elementor and much more...
 * Version: 1.0
 * Author: Volodymyr Kamuz
 *
 * @package BeforeAfterElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the Before/After widget with Elementor.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager instance.
 */
function kamuz_register_widget( $widgets_manager ) {
	require_once __DIR__ . '/widgets/class-before-after-widget.php';
	$widgets_manager->register( new \Before_After_Widget() );
}
add_action( 'elementor/widgets/register', 'kamuz_register_widget' );

/**
 * Registers scripts and styles for the Before/After widget.
 */
function kamuz_enqueue_scripts() {
	wp_enqueue_script(
		'kamuz-twentytwenty',
		plugin_dir_url( __FILE__ ) . 'lib/twentytwenty/twentytwenty.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);

	wp_enqueue_script(
		'kamuz-event-move',
		plugin_dir_url( __FILE__ ) . 'lib/twentytwenty/event-move.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);

	wp_enqueue_style(
		'kamuz-style',
		plugin_dir_url( __FILE__ ) . 'lib/twentytwenty/twentytwenty.css',
		array(),
		'1.0.0'
	);

	wp_enqueue_script(
		'kamuz-script',
		plugin_dir_url( __FILE__ ) . 'assets/js/main.js',
		array( 'jquery', 'kamuz-twentytwenty', 'kamuz-event-move' ),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'kamuz_enqueue_scripts' );
