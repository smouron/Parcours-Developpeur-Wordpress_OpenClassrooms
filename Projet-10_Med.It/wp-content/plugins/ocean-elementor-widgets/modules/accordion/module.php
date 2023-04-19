<?php
/**
 * Ocean Elementor Widgets: Accordion Widget Module
 *
 * @package Ocean_Elementor_Widgets
 * @author  OceanWP
 */

namespace owpElementor\Modules\Accordion;

use owpElementor\Base\Module_Base;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * OEW Accordion Class
 */
class Module extends Module_Base {

	/**
	 * Widget name
	 */
	public function get_widgets() {
		return [
			'Accordion',
		]; // phpcs:ignore
	}

	/**
	 * OEW Widget name
	 */
	public function get_name() {
		return 'oew-accordion';
	}
}
