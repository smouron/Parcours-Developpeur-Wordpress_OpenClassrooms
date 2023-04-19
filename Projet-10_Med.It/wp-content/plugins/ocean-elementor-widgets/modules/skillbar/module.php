<?php
namespace owpElementor\Modules\Skillbar;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Skillbar',
		];
	}

	public function get_name() {
		return 'oew-skillbar';
	}
}
