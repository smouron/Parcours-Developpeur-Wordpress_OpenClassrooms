<?php
namespace owpElementor\Modules\TwitterEmbed;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {
	public function get_widgets() {
		return array(
			'TwitterEmbed',
		);
	}

	public function get_name() {
		return 'oew-twitter-embed';
	}
}
