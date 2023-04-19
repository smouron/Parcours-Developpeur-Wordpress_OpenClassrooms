<?php
namespace owpElementor\Modules\Newsletter;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Newsletter',
		];
	}

	public function get_name() {
		return 'oew-newsletter';
	}
}
