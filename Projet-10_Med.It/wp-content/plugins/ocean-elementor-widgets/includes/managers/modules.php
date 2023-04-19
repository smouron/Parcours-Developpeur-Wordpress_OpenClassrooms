<?php
namespace owpElementor;

use owpElementor\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Modules_Manager {
	/**
	 * @var Module_Base[]
	 */
	private $modules = array();

	private $modules_list = array();

	/**
	 * @since 1.0.0
	 */
	public function register_modules() {

		$modules = array(
			'query-post',
			'clickable-columns',
			'accordion',
			'advanced-heading',
			'alert',
			'animated-heading',
			'banner',
			'blog-carousel',
			'blog-grid',
			'brands',
			'business-hours',
			'buttons',
			'button-effects',
			'call-to-action',
			'circle-progress',
			'countdown',
			'divider',
			'flip-box',
			'google-map',
			'hotspots',
			'image-comparison',
			'image-gallery',
			'info-box',
			'instagram',
			'link-effects',
			'logged-in-out',
			'logo',
			'member',
			'member-carousel',
			'modal',
			'navbar',
			'navigation',
			'newsletter',
			'off-canvas',
			'price-list',
			'pricing',
			'pricing-table',
			'recipe',
			'scroll-up',
			'search',
			'search-icon',
			'skillbar',
			'table',
			'tabs',
			'testimonial',
			'testimonial-carousel',
			'timeline',
			'toggle',
			'login',
			'lost-password',
			'register',
			'coupon',
			'pricing-menu',
			'news-bar',
			'clipboard',
			'twitter-embed',
			'twitter-timeline',
			'twitter-follow-share-buttons',
			'magazine-hero',
			'magazine-hero-grid',
			'magazine-grid-simple',
			'magazine-grid',
			'magazine-list',
		);

		// If Advanced Custom Fields
		if ( is_acf_active() ) {
			$modules[] = 'acf';
		}

		// If Contact Form 7
		if ( is_contact_form_7_active() ) {
			$modules[] = 'contact-form';
		}

		// If WPForms
		if ( is_wpforms_active() ) {
			$modules[] = 'wpforms';
		}

		// If Gravity Forms
		if ( is_gravity_forms_active() ) {
			$modules[] = 'gravity-forms';
		}

		// If Caldera Forms
		if ( is_caldera_forms_active() ) {
			$modules[] = 'caldera-forms';
		}

		// If Ninja Forms
		if ( is_ninja_forms_active() ) {
			$modules[] = 'ninja-forms';
		}

		// If Fluent Forms
		if ( is_fluent_forms_active() ) {
			$modules[] = 'fluent-forms';
		}

		// If Formidable Forms
		if ( is_formidable_forms_active() ) {
			$modules[] = 'formidable-forms';
		}
		// If WooCommerce
		if ( is_woocommerce_active() ) {
			$modules[] = 'woocommerce';
		}

		$oe_elementor_widgets_settings = get_option('oe_elementor_widgets_settings', 0);
		foreach ( $modules as $module_name ) {
			$class_name = str_replace( '-', ' ', $module_name );
			$class_name = str_replace( ' ', '', ucwords( $class_name ) );
			$class_name = __NAMESPACE__ . '\\Modules\\' . $class_name . '\Module';

			$this->modules_list[] = $module_name;

			if( $oe_elementor_widgets_settings === 0 || ! empty( $oe_elementor_widgets_settings[ $module_name ] ) ) {
				$this->modules[ $module_name ] = $class_name::instance();
			}
		}
	}

	public function get_modules_list() {
		return $this->modules_list;
	}

	private function require_files() {
		require OWP_ELEMENTOR_PATH . 'base/module.php';
	}

	public function __construct() {
		$this->require_files();
		$this->register_modules();
	}
}
