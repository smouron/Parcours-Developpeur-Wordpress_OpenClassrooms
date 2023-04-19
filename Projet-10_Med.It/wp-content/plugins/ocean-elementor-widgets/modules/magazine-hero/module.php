<?php
namespace owpElementor\Modules\MagazineHero;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_widgets() {
		return [
			'Magazine_Hero',
		];
	}

	public function get_name() {
		return 'oew-magazine-hero';
	}
}
