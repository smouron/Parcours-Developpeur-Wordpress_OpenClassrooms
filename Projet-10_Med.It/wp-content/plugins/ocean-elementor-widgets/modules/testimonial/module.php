<?php
namespace owpElementor\Modules\Testimonial;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Testimonial',
		];
	}

	public function get_name() {
		return 'oew-testimonial';
	}
}
