<?php
namespace owpElementor\Modules\BlogCarousel;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Blog_Carousel',
		];
	}

	public function get_name() {
		return 'oew-blog-carousel';
	}
}
