<?php
namespace owpElementor\Modules\TwitterFollowShareButtons;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Module extends Module_Base {
	public function get_widgets() {
		return array(
			'TwitterFollowShareButtons',
		);
	}

	public function get_name() {
		return 'oew-twitter-follow-share-buttons';
	}
}
