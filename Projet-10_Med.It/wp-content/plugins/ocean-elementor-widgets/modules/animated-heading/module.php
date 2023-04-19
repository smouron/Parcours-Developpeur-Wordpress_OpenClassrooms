<?php
namespace owpElementor\Modules\AnimatedHeading;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'AnimatedHeading',
		];
	}

	public function get_name() {
		return 'oew-animated-heading';
	}
}
