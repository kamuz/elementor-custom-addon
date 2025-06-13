<?php
/**
 * Slide Up Card Elementor Widget
 *
 * @package KamuzAddon
 */

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;

/**
 * Class Slide_Up_Card_Widget
 *
 * Elementor widget for a slide-up card.
 */
class Slide_Up_Card_Widget extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * @return string Widget unique name.
	 */
	public function get_name() {
		return 'slide_up_card';
	}

	/**
	 * Get widget title.
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Slide Up Card', 'kamuz-addon' );
	}

	/**
	 * Get widget icon for Elementor editor.
	 *
	 * @return string Icon class name.
	 */
	public function get_icon() {
		return 'eicon-posts-grid'; // Icon shown in Elementor editor.
	}

	/**
	 * Get widget categories.
	 *
	 * @return array Categories array.
	 */
	public function get_categories() {
		return array( 'general' );
	}

	/**
	 * Register widget controls.
	 *
	 * @return void
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'kamuz-addon' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => __( 'Title', 'kamuz-addon' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'My Card', 'kamuz-addon' ),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'   => __( 'Text', 'kamuz-addon' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'This is the text before hover', 'kamuz-addon' ),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'   => __( 'Icon', 'kamuz-addon' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'background_image',
			array(
				'label'   => __( 'Background Image', 'kamuz-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => 'https://picsum.photos/400/300',
				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render widget output on the frontend.
	 *
	 * @return void
	 */
	protected function render() {
		$settings       = $this->get_settings_for_display();
		$background_url = esc_url( $settings['background_image']['url'] );
		$unique_id      = esc_attr( $this->get_id() );
		?>
		<style>
			.custom-card-<?php echo esc_attr( $unique_id ); ?>::before {
				background-image: url('<?php echo esc_url( $background_url ); ?>');
			}
		</style>

		<div class="custom-card custom-card-<?php echo esc_attr( $unique_id ); ?>">
			<div class="card-content">
				<h3 class="card-title"><?php echo esc_html( $settings['title'] ); ?></h3>
				<p class="card-text"><?php echo esc_html( $settings['text'] ); ?></p>
				<div class="icon">
					<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Render widget output in the Elementor editor (JS template).
	 *
	 * @return void
	 */
	protected function content_template() {
		?>
		<div class="custom-card custom-card-{{{ settings._element_id }}}" style="background-image: url('{{ settings.background_image.url }}')">
			<div class="card-content">
				<h3 class="card-title">{{{ settings.title }}}</h3>
				<p class="card-text">{{{ settings.text }}}</p>
				<div class="icon">
					<# if ( settings.icon.value ) { #>
						<i class="{{ settings.icon.value }}" aria-hidden="true"></i>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}
}
