<?php
namespace owpElementor\Modules\LinkEffects;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Link_Effects',
		];
	}

	public function get_name() {
		return 'oew-link-effects';
	}
}
