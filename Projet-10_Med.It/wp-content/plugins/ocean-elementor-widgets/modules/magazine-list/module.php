<?php
namespace owpElementor\Modules\MagazineList;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Magazine_List',
		];
	}

	public function get_name() {
		return 'oew-magazine-list';
	}
}
