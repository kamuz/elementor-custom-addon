<?php
/**
 * Before/After Elementor widget class.
 *
 * This file defines the custom widget used to compare before and after images using the TwentyTwenty library.
 *
 * @package BeforeAfterElementor
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

/**
 * Elementor widget for displaying before/after image comparison.
 *
 * @package BeforeAfterElementor
 */
class Before_After_Widget extends Widget_Base {

	/**
	 * Returns widget name.
	 *
	 * @return string
	 */
	public function get_name() {
		return 'before_after';
	}

	/**
	 * Returns widget title.
	 *
	 * @return string
	 */
	public function get_title() {
		return 'Before/After Image';
	}

	/**
	 * Returns widget icon.
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'eicon-dual-button';
	}

	/**
	 * Returns widget categories.
	 *
	 * @return string[]
	 */
	public function get_categories() {
		return array( 'basic' );
	}

	/**
	 * Returns script dependencies.
	 *
	 * @return string[]
	 */
	public function get_script_depends() {
		return array( 'kamuz-script' );
	}

	/**
	 * Returns style dependencies.
	 *
	 * @return string[]
	 */
	public function get_style_depends() {
		return array( 'kamuz-style' );
	}

	/**
	 * Registers widget controls.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'bae' ),
			)
		);

		$this->add_control(
			'before_image',
			array(
				'label'   => __( 'Before Image', 'bae' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$this->add_control(
			'after_image',
			array(
				'label'   => __( 'After Image', 'bae' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array( 'url' => '' ),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Renders the widget output on the frontend.
	 *
	 * @return void
	 */
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$placeholder = plugin_dir_url( __DIR__ ) . 'assets/img/placeholder.png';
		$before_url  = ! empty( $settings['before_image']['url'] ) ? $settings['before_image']['url'] : $placeholder;
		$after_url   = ! empty( $settings['after_image']['url'] ) ? $settings['after_image']['url'] : $placeholder;
		?>
		<div class="twentytwenty-container">
			<img src="<?php echo esc_url( $before_url ); ?>" alt="Before">
			<img src="<?php echo esc_url( $after_url ); ?>" alt="After">
		</div>
		<?php
	}
}