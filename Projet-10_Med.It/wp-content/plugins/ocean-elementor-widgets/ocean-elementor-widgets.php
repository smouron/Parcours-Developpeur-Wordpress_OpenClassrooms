<?php
/**
 * Plugin Name:         Ocean Elementor Widgets
 * Plugin URI:          https://oceanwp.org/extension/ocean-elementor-widgets/
 * Description:         Add many new powerful and entirely customizable widgets to the popular free page builder - Elementor.
 * Version:             2.3.6
 * Update URI: https://api.freemius.com
 * Author:              OceanWP
 * Author URI:          https://oceanwp.org/
 * Requires at least:   5.6
 * Tested up to:        6.1.1
 * Elementor tested up to: 3.11.5
 * Elementor Pro tested up to: 3.11.7
 *
 * Text Domain: ocean-elementor-widgets
 * Domain Path: /languages
 *
 * @package Ocean_Elementor_Widgets
 * @category Core
 * @author OceanWP
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Returns the main instance of Ocean_Elementor_Widgets to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Ocean_Elementor_Widgets
 */
function Ocean_Elementor_Widgets() {
	return Ocean_Elementor_Widgets::instance();
} // End Ocean_Elementor_Widgets()

Ocean_Elementor_Widgets();

/**
 * Main Ocean_Elementor_Widgets Class
 *
 * @class Ocean_Elementor_Widgets
 * @version 1.0.0
 * @since 1.0.0
 * @package Ocean_Elementor_Widgets
 */
final class Ocean_Elementor_Widgets {
	/**
	 * Ocean_Elementor_Widgets The single instance of Ocean_Elementor_Widgets.
	 *
	 * @var     object
	 * @access  private
	 * @since   1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 *
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 *
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct() {
		$this->token       = 'ocean-elementor-widgets';
		$this->plugin_url  = plugin_dir_url( __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->version     = '2.3.6';

		define( 'OWP_ELEMENTOR__FILE__', __FILE__ );
		define( 'OWP_ELEMENTOR_PATH', $this->plugin_path );
		define( 'OWP_ELEMENTOR_VERSION', $this->version );

		register_activation_hook( __FILE__, array( $this, 'install' ) );

		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
	}

	public function init() {
		if ( 0 == did_action( 'plugins_loaded' ) ) {
			add_action( 'plugins_loaded', array( $this, 'setup' ) );
		} else {
			$this->setup();
		}
	}

	/**
	 * Main Ocean_Elementor_Widgets Instance
	 *
	 * Ensures only one instance of Ocean_Elementor_Widgets is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Ocean_Elementor_Widgets()
	 * @return Ocean_Elementor_Widgets Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	} // End instance()

	/**
	 * Load the localisation file.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'ocean-elementor-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 *
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 *
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	/**
	 * Setup all the things.
	 * Only executes if OceanWP or a child theme using OceanWP as a parent is active and the extension specific filter returns true.
	 *
	 * @return void
	 */
	public function setup() {
		$theme = wp_get_theme();

		if ( 'OceanWP' == $theme->name || 'oceanwp' == $theme->template ) {
			require OWP_ELEMENTOR_PATH . 'includes/plugin.php';
			require_once OWP_ELEMENTOR_PATH . 'includes/helpers.php';
			require_once OWP_ELEMENTOR_PATH . 'includes/class-instagram-api.php';
			require_once OWP_ELEMENTOR_PATH . 'includes/class-integration.php';
			require_once OWP_ELEMENTOR_PATH . 'includes/class-recaptcha.php';
			require_once OWP_ELEMENTOR_PATH . 'includes/ocean-ele-widgets-strings.php';
      		require_once OWP_ELEMENTOR_PATH . 'includes/themepanel/theme-panel.php';
		}
	}

} // End Class

// --------------------------------------------------------------------------------
// region Freemius
// --------------------------------------------------------------------------------

if ( ! function_exists( 'ocean_elementor_widgets_fs' ) ) {
	// Create a helper function for easy SDK access.
	function ocean_elementor_widgets_fs() {
		global $ocean_elementor_widgets_fs;

		if ( ! isset( $ocean_elementor_widgets_fs ) ) {
			$ocean_elementor_widgets_fs = OceanWP_EDD_Addon_Migration::instance( 'ocean_elementor_widgets_fs' )->init_sdk(
				array(
					'id'         => '3757',
					'slug'       => 'ocean-elementor-widgets',
					'public_key' => 'pk_25eeed8cddc1b8bede158756886e8',
				)
			);

			if ( $ocean_elementor_widgets_fs->can_use_premium_code__premium_only() ) {
				Ocean_Elementor_Widgets::instance()->init();
			}
		}

		return $ocean_elementor_widgets_fs;
	}

	function ocean_elementor_widgets_fs_addon_init() {
		if ( class_exists( 'Ocean_Extra' ) ) {
			OceanWP_EDD_Addon_Migration::instance( 'ocean_elementor_widgets_fs' )->init();
		}
	}

	if ( 0 == did_action( 'owp_fs_loaded' ) ) {
		// Init add-on only after parent theme was loaded.
		add_action( 'owp_fs_loaded', 'ocean_elementor_widgets_fs_addon_init', 15 );
	} else {
		if ( class_exists( 'Ocean_Extra' ) ) {
			/**
			 * This makes sure that if the theme was already loaded
			 * before the plugin, it will run Freemius right away.
			 *
			 * This is crucial for the plugin's activation hook.
			 */
			ocean_elementor_widgets_fs_addon_init();
		}
	}

	function ocean_elementor_widgets_fs_try_migrate() {
		OceanWP_EDD_Addon_Migration::instance( 'ocean_elementor_widgets_fs' )->try_migrate_addon(
			'1372',
			'Ocean_Elementor_Widgets',
			'Elementor Widgets'
		);
	}
}

// endregion
