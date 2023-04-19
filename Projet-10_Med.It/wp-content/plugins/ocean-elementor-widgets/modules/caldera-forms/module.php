<?php
namespace owpElementor\Modules\CalderaForms;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Caldera_Forms',
		];
	}

	public function get_name() {
		return 'oew-caldera-forms';
	}
}
