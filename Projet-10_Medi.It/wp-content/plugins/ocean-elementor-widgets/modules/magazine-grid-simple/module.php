<?php
namespace owpElementor\Modules\MagazineGridSimple;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Magazine_Grid_Simple',
		];
	}

	public function get_name() {
		return 'oew-magazine-grid-simple';
	}
}
