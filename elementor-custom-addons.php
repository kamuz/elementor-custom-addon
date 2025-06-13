<?php
/**
 * Plugin Name: Addon for custom Elementor widgets
 * Description: Before/after image comparison widget to Elementor and much more...
 * Version: 1.0
 * Author: Volodymyr Kamuz
 * Author URI: https://wpdev.pp.ua/
 *
 * @package BeforeAfterElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Registers the custom widgets with Elementor.
 *
 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager instance.
 */
function kamuz_register_widget( $widgets_manager ) {
	require_once __DIR__ . '/widgets/class-before-after-widget.php';
	require_once __DIR__ . '/widgets/class-slide-up-card-widget.php';
	$widgets_manager->register( new \Before_After_Widget() );
	$widgets_manager->register( new \Slide_Up_Card_Widget() );
}
add_action( 'elementor/widgets/register', 'kamuz_register_widget' );

/**
 * Registers scripts and styles for custom widgets.
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

	wp_enqueue_style(
		'kamuz-slide-up-card',
		plugin_dir_url( __FILE__ ) . 'assets/css/slide-up-card.css',
		array(),
		'1.0.0'
	);
}
add_action( 'wp_enqueue_scripts', 'kamuz_enqueue_scripts' );

/**
 * Register custom Elementor widget category.
 *
 * Adds a new category "RoofEngine" to the Elementor editor
 * so custom widgets can be grouped under it.
 *
 * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager instance.
 *
 * @return void
 */
function kamuz_custom_widget_category( $elements_manager ) {
	$elements_manager->add_category( 'roofengine-category', array( 'title' => __( 'RoofEngine', 'kamuz-addon' ) ) );
}
add_action( 'elementor/elements/categories_registered', 'kamuz_custom_widget_category' );
