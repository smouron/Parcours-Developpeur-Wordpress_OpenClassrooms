<?php
namespace owpElementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use \Elementor\Plugin;

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
	private $modules = array();

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		spl_autoload_register( array( $this, 'autoload' ) );

		add_action( 'elementor/init', array( $this, 'init' ), 0 );
		add_action( 'elementor/init', array( $this, 'init_panel_section' ), 0 );
		add_action( 'elementor/elements/categories_registered', array( $this, 'init_panel_section' ) );

		// Modules to enqueue styles
		$this->modules = array(
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
			'member-carousel',
			'modal',
			'navbar',
			'newsletter',
			'off-canvas',
			'price-list',
			'pricing',
			'pricing-table',
			'recipe',
			'scroll-up',
			'search',
			'search-icon',
			'skillbar',
			'table',
			'tabs',
			'testimonial',
			'testimonial-carousel',
			'timeline',
			'toggle',
			'woo-addtocart',
			'woo-cart-icon',
			'woo-slider',
			'coupon',
			'pricing-menu',
			'news-bar',
			'clipboard',
			'magazine-hero',
			'magazine-hero-grid',
			'magazine-grid-simple',
			'magazine-grid',
			'magazine-list',
		);
		add_action( 'wp_ajax_nopriv_oewe_lf_process_login', [$this, 'login_widget_callback'] );
	}

	public function login_widget_callback() {
		check_ajax_referer( 'oew_login_nonce', 'oewe-lf-login-nonce' );

		$info = array();
		$info['user_login'] = $_POST['username'];
		$info['user_password'] = $_POST['password'];
		$info['redirect_to'] = $_POST['redirect_to'];
		$info['remember'] = isset( $_POST['remember'] ) ? true : false;

		$user_signon = wp_signon( $info, false );
		if ( is_wp_error( $user_signon ) ){
			wp_send_json_error( __('Incorrect login or password!'));
		} else {
			wp_send_json_success( array( 'loggedin' => true, 'redirect_url' => home_url( $info['redirect_to'] ), 'message' => __('Logged in successfully! Redirecting...' ) ) );
		}
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
					array( '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ),
					array( '', '$1-$2', '-', DIRECTORY_SEPARATOR ),
					$class_to_load
				)
			);
			$filename = OWP_ELEMENTOR_PATH . $filename . '.php';

			if ( is_readable( $filename ) ) {
				include $filename;
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
		add_action( 'elementor/frontend/after_register_scripts', array( $this, 'register_scripts' ) );
		add_action( 'elementor/frontend/after_register_styles', array( $this, 'register_styles' ) );

		// Preview Styles
		add_action( 'elementor/preview/enqueue_styles', array( $this, 'preview_styles' ) );

		// Editor Style
		add_action( 'elementor/editor/after_enqueue_styles', array( $this, 'editor_style' ) );
	}

	/**
	 * Register scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function register_scripts() {

		$ajax_url  = admin_url( 'admin-ajax.php' );
		$oew_nonce = wp_create_nonce( 'oceanwp' );

		$suffix     = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		$key        = get_option( 'owp_google_map_api' );
		$recaptcha_version =  get_option( 'owp_recaptcha_version' );
		$site_key   = ( 'v3' == $recaptcha_version ) ? get_option( 'owp_recaptcha3_site_key' ) : get_option( 'owp_recaptcha_site_key' );
		$secret_key = ( 'v3' == $recaptcha_version ) ? get_option( 'owp_recaptcha3_secret_key' ) : get_option( 'owp_recaptcha_secret_key' );
		// Register Swiper.
		wp_register_script( 'swiper', plugins_url( '/assets/js/vendors/swiper/swiper-bundle.min.js', OWP_ELEMENTOR__FILE__ ), array(), '6.7.1', true );

		// Register vendors scripts.
		wp_register_script(
			'asPieProgress',
			plugins_url( '/assets/js/vendors/asPieProgress.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);

		wp_register_script(
			'axios',
			plugins_url( '/assets/js/vendors/axios.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);

		wp_register_script(
			'event-move',
			plugins_url( '/assets/js/vendors/event.move.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);
		wp_register_script(
			'twentytwenty',
			plugins_url( '/assets/js/vendors/twentytwenty.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);

		wp_register_script(
			'morphext',
			plugins_url( '/assets/js/vendors/morphext.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);
		wp_register_script(
			'typed',
			plugins_url( '/assets/js/vendors/typed.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);

		wp_register_script(
			'oew-photoswipe',
			plugins_url( '/assets/js/vendors/photoswipe.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);
		wp_register_script(
			'oew-photoswipe-ui-default',
			plugins_url( '/assets/js/vendors/photoswipe-ui-default.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);

		wp_register_script(
			'popper',
			plugins_url( '/assets/js/vendors/popper.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);
		wp_register_script(
			'tippy',
			plugins_url( '/assets/js/vendors/tippy-bundle.umd.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);

		wp_register_script(
			'salvattore',
			plugins_url( '/assets/js/vendors/salvattore.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			false,
			true
		);

		wp_register_script(
			'ow-isotop',
			plugins_url( '/assets/js/vendors/isotope.pkgd.min.js', OWP_ELEMENTOR__FILE__ ),
			array(),
			'3.0.6',
			true
		);

		// Register widgets scripts.
		if ( isset( $key ) && ! empty( $key ) ) {
			wp_register_script(
				'oew-google-map-api',
				'https://maps.googleapis.com/maps/api/js?key=' . $key,
				'',
				rand()
			);
		} else {
			wp_register_script(
				'oew-google-map-api',
				'https://maps.googleapis.com/maps/api/js',
				'',
				rand()
			);
		}

		wp_register_script(
			'oew-accordion',
			plugins_url( '/assets/js/accordion' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-alert',
			plugins_url( '/assets/js/alert' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-animated-heading',
			plugins_url( '/assets/js/animated-heading' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'morphext', 'typed' ),
			false,
			true
		);

		wp_register_script(
			'oew-blog-carousel',
			plugins_url( '/assets/js/blog-carousel' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'swiper', 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-blog-grid',
			plugins_url( '/assets/js/blog-grid' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'oceanwp-main', 'salvattore', 'ow-isotop' ),
			false,
			true
		);

		wp_register_script(
			'oew-circle-progress',
			plugins_url( '/assets/js/circle-progress' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'asPieProgress' ),
			false,
			true
		);

		wp_register_script(
			'oew-countdown',
			plugins_url( '/assets/js/countdown' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-google-map',
			plugins_url( '/assets/js/google-map' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-hotspots',
			plugins_url( '/assets/js/hotspots' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'popper', 'tippy' ),
			false,
			true
		);

		wp_register_script(
			'oew-image-comparison',
			plugins_url( '/assets/js/image-comparison' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'event-move', 'twentytwenty' ),
			false,
			true
		);

		wp_register_script(
			'oew-image-gallery',
			plugins_url( '/assets/js/image-gallery.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'oew-photoswipe', 'oew-photoswipe-ui-default', 'salvattore', 'ow-isotop' ),
			false,
			true
		);

		wp_register_script(
			'oew-member',
			plugins_url( '/assets/js/member' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'popper', 'tippy' ),
			false,
			true
		);

		wp_register_script(
			'oew-member-carousel',
			plugins_url( '/assets/js/member-carousel' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-modal',
			plugins_url( '/assets/js/modal' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-navbar',
			plugins_url( '/assets/js/navbar' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-newsletter',
			plugins_url( '/assets/js/newsletter' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'axios' ),
			false,
			true
		);
		wp_localize_script(
			'oew-newsletter',
			'newsletterData',
			array(
				'ajax_url' => $ajax_url,
				'nonce'    => $oew_nonce,
			)
		);

		wp_register_script(
			'oew-off-canvas',
			plugins_url( '/assets/js/off-canvas' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		if ( ! empty( $site_key ) || ! empty( $secret_key ) ) {
			$recaptcha_script_args = array(
				'hl' => str_replace( '_', '-', get_locale() ),
			);
			if ( 'v3' == $recaptcha_version ) {
				wp_enqueue_script( 'recaptcha-v3-init', plugin_dir_url( OWP_ELEMENTOR__FILE__ ) . 'assets/js/recaptcha-v3-init.js', array( 'jquery', 'recaptcha' ), OWP_ELEMENTOR_VERSION, true );
				wp_localize_script( 'recaptcha-v3-init', 'RecaptchaV3InitParam', [ 'key' => $site_key, ] );
				$recaptcha_script_args = array_merge( $recaptcha_script_args, [ 'render' => $site_key, ] );
			}
			wp_register_script( 'recaptcha', add_query_arg( $recaptcha_script_args, 'https://www.google.com/recaptcha/api.js' ) );
		}

		wp_register_script(
			'oew-pricing-table',
			plugins_url( '/assets/js/pricing-table' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'popper', 'tippy' ),
			false,
			true
		);

		wp_register_script(
			'oew-scroll-up',
			plugins_url( '/assets/js/scroll-up' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-search-icon',
			plugins_url( '/assets/js/search-icon' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-search',
			plugins_url( '/assets/js/search' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend', 'axios' ),
			false,
			true
		);
		wp_localize_script(
			'oew-search',
			'searchData',
			array(
				'ajax_url' => $ajax_url,
				'nonce'    => $oew_nonce,
			)
		);

		wp_register_script(
			'oew-skillbar',
			plugins_url( '/assets/js/skillbar' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-tabs',
			plugins_url( '/assets/js/tabs' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-testimonial-carousel',
			plugins_url( '/assets/js/testimonial-carousel' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'swiper', 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-toggle',
			plugins_url( '/assets/js/toggle' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-tooltip',
			plugins_url( '/assets/js/tooltip' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-woo-slider',
			plugins_url( '/assets/js/woo-slider' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-news-bar',
			plugins_url( '/assets/js/news-bar' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'swiper', 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-clipboard',
			plugins_url( '/assets/js/clipboard' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-coupon',
			plugins_url( '/assets/js/coupon' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);
		wp_register_script(
			'oew-twitter',
			plugins_url( '/assets/js/vendors/twitter' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);

		wp_register_script(
			'oew-login',
			plugins_url( '/assets/js/login' . $suffix . '.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
			false,
			true
		);
		wp_localize_script(
			'oew-login',
			'oewLogin',
			array(
				'ajax_url' => $ajax_url,
				'nonce'    => $oew_nonce,
				'empty_username' => 'Username is required',
				'empty_password' => 'Password is required'
			)
		);
		wp_register_script(
			'oew-woo-cart-icon',
			plugins_url( '/assets/js/woo-cart-icon.js', OWP_ELEMENTOR__FILE__ ),
			array( 'elementor-frontend' ),
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

		// Vendors.
		wp_register_style( 'tippy', plugins_url( '/assets/css/vendors/tippy/tippy.css', OWP_ELEMENTOR__FILE__ ), array(), '6.3.1', 'all' );
		wp_register_style( 'oew-photoswipe', plugins_url( '/assets/css/vendors/photo-swipe/photoswipe.css', OWP_ELEMENTOR__FILE__ ), array(), '4.1.3', 'all' );
		wp_register_style( 'swiper', plugins_url( '/assets/js/vendors/swiper/swiper-bundle.min.css', OWP_ELEMENTOR__FILE__ ) );

		// Widgets.
		foreach ( $this->modules as $module_name ) {
			wp_register_style( 'oew-' . $module_name . '', plugins_url( '/assets/css/' . $module_name . '/style' . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
		}

		// Effects for the Button Effects widget
		$button_effects = array(
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
			'effect-30',
		);

		foreach ( $button_effects as $button_effect ) {
			wp_register_style( 'oew-btn-' . $button_effect . '', plugins_url( '/assets/css/button-effects/' . $button_effect . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
		}

		// Effects for the Link Effects widget
		$link_effects = array(
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
		);

		foreach ( $link_effects as $link_effect ) {
			wp_register_style( 'oew-' . $link_effect . '', plugins_url( '/assets/css/link-effects/' . $link_effect . $suffix . '.css', OWP_ELEMENTOR__FILE__ ) );
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
			wp_enqueue_style( 'oew-' . $module_name . '' );
		}

		// Effects for the Button Effects widget
		$button_effects = array(
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
			'effect-30',
		);

		foreach ( $button_effects as $button_effect ) {
			wp_enqueue_style( 'oew-btn-' . $button_effect . '' );
		}

		// Effects for the Link Effects widget
		$link_effects = array(
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
		);

		foreach ( $link_effects as $link_effect ) {
			wp_enqueue_style( 'oew-' . $link_effect . '' );
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
		include_once OWP_ELEMENTOR_PATH . 'includes/compatibility/wpml/compatibility.php';

		// Modules
		include_once OWP_ELEMENTOR_PATH . 'includes/managers/modules.php';

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
		Plugin::instance()->elements_manager->add_category(
			'oceanwp-elements',
			array(
				'title' => $brand . ' ' . __( 'Elements', 'ocean-elementor-widgets' ),
			),
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
		$this->modules_manager    = new Modules_Manager();
		$this->wpml_compatibility = new Compatibility\WPML();
	}
}

if ( ! defined( 'OWP_ELEMENTOR_TESTS' ) ) {
	// In tests we run the instance manually.
	owpElementorPlugin::instance();
}
