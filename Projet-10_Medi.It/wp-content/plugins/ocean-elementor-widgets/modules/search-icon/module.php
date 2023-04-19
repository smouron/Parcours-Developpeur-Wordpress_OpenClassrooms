<?php
namespace owpElementor\Modules\SearchIcon;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'SearchIcon',
		];
	}

	public function get_name() {
		return 'oew-search-icon';
	}
}
