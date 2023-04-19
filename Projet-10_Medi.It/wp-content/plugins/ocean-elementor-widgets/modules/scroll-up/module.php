<?php
namespace owpElementor\Modules\ScrollUp;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Scroll_Up',
		];
	}

	public function get_name() {
		return 'oew-scroll-up';
	}
}
