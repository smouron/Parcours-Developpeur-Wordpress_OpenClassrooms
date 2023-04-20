<?php
namespace owpElementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register elementor widget.
 *
 * @since 1.0.0
 */
class owpElementorPlugin {

	/**
	 * @var Manager
	 */
	public $modules_manager;

	/**
	 * @var WPML
	 */
	public $wpml_compatibility;

	/**
	 * @var Plugin
	 */
	private static $_instance;
	/**
	 * @var Module_Base[]
	 */
	private $modules = [];

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register( [ $this, 'autoload' ] );

		add_action( 'elementor/init', [ $this, 'init' ], 0 );
		add_action( 'elementor/init', [ $this, 'init_panel_section' ], 0 );
		add_action( 'elementor/elements/categories_registered', [ $this, 'init_panel_section' ] );

		// Modules to enqueue styles
		$this->modules = [
			'accordion',
			'advanced-heading',
			'alert',
			'animated-heading',
			'banner',
			'blog-carousel',
			'blog-grid',
			'brands',
			'business-hours',
			'buttons',
			'button-effects',
			'call-to-action',
			'circle-progress',
			'countdown',
			'divider',
			'flip-box',
			'forms',
			'google-map',
			'hotspots',
			'image-comparison',
			'image-gallery',
			'info-box',
			'instagram',
			'logged-in-out',
			'member',
			'modal',
			'navbar',
			'newsletter',
			'off-canvas',
			'price-list',
			'pricing',
			'recipe',
			'scroll-up',
			'search',
			'search-icon',
			'skillbar',
			'table',
			'tabs',
			'timeline',
			'toggle',
			'tooltip',
			'woo-addtocart',
			'woo-cart-icon',
			'woo-slider',
		];
	}

	/**
	 * Autoload Classes
	 *
	 * @since 1.0.0
	 */
	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$class_to_load = $class;

		if ( ! class_exists( $class_to_load ) ) {
			$filename = strtolower(
				preg_replace(
					[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
					[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
					$class_to_load
				)
			);
			$filename = OWP_ELEMENTOR_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include( $filename );
			}
		}
	}

	/**
	 * Init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init() {

		// Elementor hooks
		$this->add_actions();

		// Include extensions
		$this->includes();

		// Components
		$this->init_components();

		do_action( 'owp_elementor/init' );
	}

	/**
	 * Plugin instance
	 * 
	 * @since 1.0.0
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Add Actions
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function add_actions() {

		// Front-end Scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );

		// Preview Styles
		add_action( 'elementor/preview/enqueue_styles', [ $this, 'preview_styles' ] );

		// Editor Style
		add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'editor_style' ] );
	}

	/**
	 * Register scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_scripts() {

		$suffix 		= defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$key 			= get_option( 'owp_google_map_api' );
		$site_key 		= get_option( 'owp_recaptcha_site_key' );
		$secret_key 	= get_option( 'owp_recaptcha_secret_key' );

		wp_register_script( 'isotope',
			plugins_url( '/assets/js/isotope' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'appear',
			plugins_url( '/assets/js/appear' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-accordion',
			plugins_url( '/assets/js/accordion' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-alert',
			plugins_url( '/assets/js/alert' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-blog-carousel',
			plugins_url( '/assets/js/blog-carousel' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-blog-grid',
			plugins_url( '/assets/js/blog-grid' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery', 'oceanwp-main' ],
			false,
			true
		);

		wp_register_script( 'oew-circle-progress',
			plugins_url( '/assets/js/circle-progress' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'asPieProgress',
			plugins_url( '/assets/js/asPieProgress' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-countdown',
			plugins_url( '/assets/js/countdown' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		if ( isset( $key ) && ! empty( $key ) ) {
            wp_register_script( 'oew-google-map-api',
            	'https://maps.googleapis.com/maps/api/js?key=' . $key,
            	'',
            	rand()
            );
        } else {
            wp_register_script( 'oew-google-map-api',
            	'https://maps.googleapis.com/maps/api/js',
            	'',
            	rand()
            );
        }

		wp_register_script( 'oew-google-map',
			plugins_url( '/assets/js/google-map' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-image-comparison',
			plugins_url( '/assets/js/image-comparison' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-image-gallery',
			plugins_url( '/assets/js/image-gallery' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'twentytwenty',
			plugins_url( '/assets/js/twentytwenty' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'event-move',
			plugins_url( '/assets/js/event.move' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-hotspots',
			plugins_url( '/assets/js/hotspots' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-instagram',
			plugins_url( '/assets/js/instagram' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-member',
			plugins_url( '/assets/js/member' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-modal',
			plugins_url( '/assets/js/modal' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'morphext',
			plugins_url( '/assets/js/morphext' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'typed',
			plugins_url( '/assets/js/typed' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-navbar',
			plugins_url( '/assets/js/navbar' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-newsletter',
			plugins_url( '/assets/js/newsletter' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-off-canvas',
			plugins_url( '/assets/js/off-canvas' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		if ( ! empty( $site_key )
			|| ! empty( $secret_key ) ) {
			wp_register_script( 'recaptcha', add_query_arg( array(
				'hl' => str_replace( '_', '-', get_locale() )
			), 'https://www.google.com/recaptcha/api.js' ) );
		}

		wp_register_script( 'oew-scroll-up',
			plugins_url( '/assets/js/scroll-up' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-search',
			plugins_url( '/assets/js/search' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-search-icon',
			plugins_url( '/assets/js/search-icon' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-skillbar',
			plugins_url( '/assets/js/skillbar' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-tabs',
			plugins_url( '/assets/js/tabs' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-toggle',
			plugins_url( '/assets/js/toggle' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-tooltip',
			plugins_url( '/assets/js/tooltip' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

		wp_register_script( 'oew-woo-slider',
			plugins_url( '/assets/js/woo-slider' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			[ 'jquery' ],
			false,
			true
		);

	}

	/**
	 * Register styles
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_styles() {

		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		foreach ( $this->modules as $module_name ) {
			wp_register_style( 'oew-'. $module_name .'', plugins_url( '/assets/css/'. $module_name .'/style' . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
		}

		// Effects for the Button Effects widget
		$button_effects = [
			'effect-1',
			'effect-2',
			'effect-3',
			'effect-4',
			'effect-5',
			'effect-6',
			'effect-7',
			'effect-8',
			'effect-9',
			'effect-10',
			'effect-11',
			'effect-12',
			'effect-13',
			'effect-14',
			'effect-15',
			'effect-16',
			'effect-17',
			'effect-18',
			'effect-19',
			'effect-20',
			'effect-21',
			'effect-22',
			'effect-23',
			'effect-24',
			'effect-25',
			'effect-26',
			'effect-27',
			'effect-28',
			'effect-29',
			'effect-30'
		];

		foreach ( $button_effects as $button_effect ) {
			wp_register_style( 'oew-btn-'. $button_effect .'', plugins_url( '/assets/css/button-effects/' . $button_effect . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
		}

		// Effects for the Link Effects widget
		$link_effects = [
			'effect-1',
			'effect-2',
			'effect-3',
			'effect-4',
			'effect-5',
			'effect-6',
			'effect-7',
			'effect-8',
			'effect-9',
			'effect-10',
			'effect-11',
			'effect-12',
			'effect-13',
			'effect-14',
			'effect-15',
			'effect-16',
			'effect-17',
			'effect-18',
			'effect-19',
			'effect-20',
			'effect-21'
		];

		foreach ( $link_effects as $link_effect ) {
			wp_register_style( 'oew-'. $link_effect .'', plugins_url( '/assets/css/link-effects/' . $link_effect . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
		}

	}

	/**
	 * Enqueue styles in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function preview_styles() {

		foreach ( $this->modules as $module_name ) {
			wp_enqueue_style( 'oew-'. $module_name .'' );
		}

		// Effects for the Button Effects widget
		$button_effects = [
			'effect-1',
			'effect-2',
			'effect-3',
			'effect-4',
			'effect-5',
			'effect-6',
			'effect-7',
			'effect-8',
			'effect-9',
			'effect-10',
			'effect-11',
			'effect-12',
			'effect-13',
			'effect-14',
			'effect-15',
			'effect-16',
			'effect-17',
			'effect-18',
			'effect-19',
			'effect-20',
			'effect-21',
			'effect-22',
			'effect-23',
			'effect-24',
			'effect-25',
			'effect-26',
			'effect-27',
			'effect-28',
			'effect-29',
			'effect-30'
		];

		foreach ( $button_effects as $button_effect ) {
			wp_enqueue_style( 'oew-btn-'. $button_effect .'' );
		}

		// Effects for the Link Effects widget
		$link_effects = [
			'effect-1',
			'effect-2',
			'effect-3',
			'effect-4',
			'effect-5',
			'effect-6',
			'effect-7',
			'effect-8',
			'effect-9',
			'effect-10',
			'effect-11',
			'effect-12',
			'effect-13',
			'effect-14',
			'effect-15',
			'effect-16',
			'effect-17',
			'effect-18',
			'effect-19',
			'effect-20',
			'effect-21'
		];

		foreach ( $link_effects as $link_effect ) {
			wp_enqueue_style( 'oew-'. $link_effect .'' );
		}

		// Fix the Woo Slider issue in the preview
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'oew-elementor-preview', plugins_url( '/assets/css/elementor/preview' . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
	}

	/**
	 * Enqueue style in the editor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function editor_style() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'oew-elementor-editor', plugins_url( '/assets/css/elementor/editor' . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
	}

	/**
	 * Include components
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function includes() {

		// WPML
		include_once( OWP_ELEMENTOR_PATH .'includes/compatibility/wpml/compatibility.php' );

		// Modules
		include_once( OWP_ELEMENTOR_PATH .'includes/managers/modules.php' );

	}

	/**
	 * Sections init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	public function init_panel_section() {
		// Theme branding
		if ( function_exists( 'oceanwp_theme_branding' ) ) {
			$brand = oceanwp_theme_branding();
		} else {
			$brand = 'OceanWP';
		}

		// Add element category in panel
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'oceanwp-elements',
			array( 'title'  => $brand . ' ' . esc_html__( 'Elements', 'ocean-elementor-widgets' ), ),
			1
		);
	}

	/**
	 * Components init
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 */
	private function init_components() {
		$this->modules_manager 			= new Modules_Manager();
		$this->wpml_compatibility 		= new Compatibility\WPML();
	}
}

if ( ! defined( 'OWP_ELEMENTOR_TESTS' ) ) {
	// In tests we run the instance manually.
	owpElementorPlugin::instance();
}