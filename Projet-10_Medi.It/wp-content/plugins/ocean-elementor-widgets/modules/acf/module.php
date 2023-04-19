<?php
/**
 * Ocean Elementor Widgets: ACF Widget Module
 *
 * @package Ocean_Elementor_Widgets
 * @author  OceanWP
 */

namespace owpElementor\Modules\ACF;

use owpElementor\Base\Module_Base;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * OEW ACF Class
 */
class Module extends Module_Base {

	/**
	 * Widget name
	 */
	public function get_widgets() {
		return [
			'ACF',
		];
	}

	/**
	 * OEW Widget name
	 */
	public function get_name() {
		return 'oew-acf';
	}
}
