<?php
namespace owpElementor\Modules\FluentForms;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {
	public function get_widgets() {
		return array(
			'Fluent_Forms',
		);
	}

	public function get_name() {
		return 'oew-fluent-forms';
	}
}
