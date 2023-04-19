<?php
namespace owpElementor\Modules\LoggedInOut;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Logged_In_Out',
		];
	}

	public function get_name() {
		return 'oew-logged-in-out';
	}
}
