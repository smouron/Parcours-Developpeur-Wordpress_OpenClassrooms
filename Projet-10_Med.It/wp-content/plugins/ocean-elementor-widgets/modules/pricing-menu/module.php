<?php
namespace owpElementor\Modules\PricingMenu;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {

	public function get_widgets() {
		return array(
			'PricingMenu',
		);
	}

	public function get_name() {
		return 'oew-pricing-menu';
	}
}
