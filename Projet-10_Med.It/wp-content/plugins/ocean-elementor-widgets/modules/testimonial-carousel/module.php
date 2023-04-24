<?php
namespace owpElementor\Modules\TestimonialCarousel;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Testimonial_Carousel',
		];
	}

	public function get_name() {
		return 'oew-testimonial-carousel';
	}
}
