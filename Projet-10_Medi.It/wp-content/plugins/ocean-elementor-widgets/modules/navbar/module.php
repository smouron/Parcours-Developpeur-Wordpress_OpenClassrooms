<?php
namespace owpElementor\Modules\Navbar;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Navbar',
		];
	}

	public function get_name() {
		return 'oew-navbar';
	}
}
