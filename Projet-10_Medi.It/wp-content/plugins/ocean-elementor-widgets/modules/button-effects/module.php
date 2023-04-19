<?php
namespace owpElementor\Modules\ButtonEffects;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'ButtonEffects',
		];
	}

	public function get_name() {
		return 'oew-button-effects';
	}
}
