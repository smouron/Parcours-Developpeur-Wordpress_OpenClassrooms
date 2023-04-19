<?php
namespace owpElementor\Modules\ClickableColumns;

use owpElementor\Base\Module_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Class
 *
 * @package owpElementor\Modules\ClickableColumns
 */
class Module extends Module_Base {

	/**
	 * __consctruct
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();

		$this->add_actions();
	}

	/**
	 * Get Name
	 *
	 * @return string
	 */
	public function get_name() {
		return 'clickable-columns';
	}

	/**
	 * Column Extending.
	 *
	 * @param mixed $element
	 * @param mixed $args
	 * @return void
	 */
	public function column_extending( $element, $args ) {

		$element->add_control(
			'link_column',
			array(
				'label'       => __( 'Link for the Column', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'separator'   => 'before',
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$element->add_control(
			'open_in_new_window',
			array(
				'label'        => __( 'Open in new window', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'yes',

			)
		);

	}

	/**
	 * Rendering.
	 *
	 * @param mixed $element
	 * @return void
	 */
	public function rendering( $element ) {
		$settings = $element->get_settings_for_display();
		if ( 'yes' == $settings['open_in_new_window'] ) {
			$target_blank = '_blank'; 
		} else {
			$target_blank = false;
		}

		if ( isset( $settings['link_column'], $settings['link_column'] ) && ! empty( $settings['link_column'] ) ) {
			wp_enqueue_script( 'clickable-column' );

			$element->add_render_attribute( '_wrapper', 'class', 'link-column' );
			$element->add_render_attribute( '_wrapper', 'style', 'cursor: pointer;' );
			$element->add_render_attribute( '_wrapper', 'data-link-column-options-url', $settings['link_column'] );
			$element->add_render_attribute( '_wrapper', 'data-link-column-options-blank', $target_blank );
		}

	}

	/**
	 * Add Actions.
	 *
	 * @return void
	 */
	protected function add_actions() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_assets' ) );

		add_action( 'elementor/element/column/layout/before_section_end', array( $this, 'column_extending' ), 10, 2 );
		add_action( 'elementor/frontend/column/before_render', array( $this, 'rendering' ), 10 );

	}

	/**
	 * Load Assets.
	 *
	 * @return void
	 */
	public function load_assets() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_register_script(
			'clickable-column',
			plugins_url( '/assets/js/clickable-column' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			OWP_ELEMENTOR_VERSION,
			true
		);
	}
}
