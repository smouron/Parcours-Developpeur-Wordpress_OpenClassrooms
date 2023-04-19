<?php
namespace owpElementor\Modules\ContactForm;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Contact_Form',
		];
	}

	public function get_name() {
		return 'oew-contact-form-7';
	}
}
