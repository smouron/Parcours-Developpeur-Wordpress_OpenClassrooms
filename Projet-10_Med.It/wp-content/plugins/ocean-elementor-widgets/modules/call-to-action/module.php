<?php
namespace owpElementor\Modules\CallToAction;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'CallToAction',
		];
	}

	public function get_name() {
		return 'oew-call-to-action';
	}
}
