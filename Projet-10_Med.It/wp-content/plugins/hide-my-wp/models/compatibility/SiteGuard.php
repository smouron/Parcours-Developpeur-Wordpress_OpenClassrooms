<?php
/**
 * Compatibility Class
 *
 * @file The SiteGuard Model file
 * @package HMWP/Compatibility/SiteGuard
 * @since 7.0.0
 */

defined('ABSPATH') || die('Cheatin\' uh?');

class HMWP_Models_Compatibility_SiteGuard extends HMWP_Models_Compatibility_Abstract
{

	public function hookFrontend() {

		//remove custom login if already set in HMWP Ghost to prevent errors
		add_filter("pre_option_siteguard_config", function ($siteguard_config) {

			if (HMWP_Classes_Tools::$default['hmwp_login_url'] <> HMWP_Classes_Tools::getOption('hmwp_login_url') ) {
				$siteguard_config['renamelogin_enable'] = 0;
			}

			return $siteguard_config;
		});

		//remove css and js combination as it gives errors when the paths are changed
		add_filter("option_siteground_optimizer_combine_css", '__return_false');
		add_filter("option_siteground_optimizer_combine_javascript", '__return_false');

	}

}
