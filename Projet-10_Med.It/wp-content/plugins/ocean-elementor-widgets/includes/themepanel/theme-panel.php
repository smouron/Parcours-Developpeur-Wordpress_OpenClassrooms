<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class Ocean_Elementor_Widgets_Themepanel {



	/**
	 * Start things up
	 */
	public function __construct() {
		add_filter( 'oceanwp_theme_panel_pane_elementor_widgets_settings', array( $this, 'elementor_widgets_settings' ) );
	}

	function elementor_widgets_settings() {
		return OWP_ELEMENTOR_PATH . 'includes/themepanel/views/panes/elementor-widgets-settings.php';
	}
}

new Ocean_Elementor_Widgets_Themepanel();
