<?php
/**
 * Compatibility Class
 *
 * @file The Wordfence Model file
 * @package HMWP/Compatibility/Wordfence
 * @since 7.0.0
 */

defined('ABSPATH') || die('Cheatin\' uh?');

class HMWP_Models_Compatibility_Wordfence extends HMWP_Models_Compatibility_Abstract
{

	public function __construct() {
		parent::__construct();

		add_action('init', function () {
			if(is_admin()) {

				//if it's wordfence scan
				if(HMWP_Classes_Tools::getValue('action') == 'wordfence_scan') {
					set_transient('hmwp_disable_hide_urls', 1, (3600 * 6));
				}

				//Add the Wordfence menu when the wp-admin path is changed
				if (is_multisite()) {
					if (class_exists('wfUtils') && !wfUtils::isAdminPageMU()) {
						add_action('network_admin_menu', 'wordfence::admin_menus', 10);
						add_action('network_admin_menu', 'wordfence::admin_menus_20', 20);
						add_action('network_admin_menu', 'wordfence::admin_menus_30', 30);
						add_action('network_admin_menu', 'wordfence::admin_menus_40', 40);
						add_action('network_admin_menu', 'wordfence::admin_menus_50', 50);
						add_action('network_admin_menu', 'wordfence::admin_menus_60', 60);
						add_action('network_admin_menu', 'wordfence::admin_menus_70', 70);
						add_action('network_admin_menu', 'wordfence::admin_menus_80', 80);
						add_action('network_admin_menu', 'wordfence::admin_menus_90', 90);
					} //else don't show menu
				}
			}
		});

		if(HMWP_Classes_Tools::isAjax()) {
			//?action=wordfence_doScan on Wordfence cron scans
			if ((HMWP_Classes_Tools::getValue('action') == 'wordfence_doScan' || HMWP_Classes_Tools::getValue('action') == 'wordfence_testAjax') ) {
				add_filter('hmwp_process_hide_urls', '__return_false');
			}
		}

		//Add fix for the virus scan
		add_action('wordfence_start_scheduled_scan', function () {
			set_transient('hmwp_disable_hide_urls', 1, (3600 * 6));
		});

		//Add compatibility with Wordfence to not load the Bruteforce when 2FA is active
		if( HMWP_Classes_Tools::getOption('hmwp_bruteforce') && HMWP_Classes_Tools::getOption('brute_use_captcha_v3') ) {
			add_filter('hmwp_option_brute_use_captcha_v3', '__return_false');
		}
	}

}
