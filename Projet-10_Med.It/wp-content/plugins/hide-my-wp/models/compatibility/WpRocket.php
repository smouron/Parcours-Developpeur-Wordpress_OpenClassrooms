<?php
/**
 * Compatibility Class
 *
 * @file The WpRocket Model file
 * @package HMWP/Compatibility/WpRocket
 * @since 7.0.0
 */

defined('ABSPATH') || die('Cheatin\' uh?');

class HMWP_Models_Compatibility_WpRocket extends HMWP_Models_Compatibility_Abstract
{

    public function hookAdmin()
    {
	    add_filter('rocket_cache_reject_uri', array($this, 'rocket_reject_url'), PHP_INT_MAX);
    }

	public function hookFrontend() {

		//Remove footer content from cache plugins
		defined('WP_ROCKET_WHITE_LABEL_FOOTPRINT') || define('WP_ROCKET_WHITE_LABEL_FOOTPRINT', true);

		//Load the cache with rocket
		add_filter('rocket_buffer', array($this, 'findReplaceCache'), PHP_INT_MAX);

		add_filter('rocket_cache_busting_filename', array(HMWP_Classes_ObjController::getClass('HMWP_Models_Rewrite'), 'find_replace_url'), PHP_INT_MAX);
		add_filter('rocket_iframe_lazyload_placeholder', array(HMWP_Classes_ObjController::getClass('HMWP_Models_Rewrite'), 'find_replace_url'), PHP_INT_MAX);
	}



	/**
	 * Fix WP Rocket reject URL
	 *
	 * @param $uri
	 *
	 * @return array
	 */
	public function rocket_reject_url( $uri )
	{
		if (HMWP_Classes_Tools::$default['hmwp_login_url'] <> HMWP_Classes_Tools::getOption('hmwp_login_url') ) {
			$path = parse_url(site_url(), PHP_URL_PATH);
			$uri[] = ($path <> '/' ? $path . '/' : $path) . HMWP_Classes_Tools::getOption('hmwp_login_url');
		}

		return $uri;
	}

    /**
     * Create the WP-Rocket Burst Mapping
     *
     * @throws Exception
     */
    public function rocket_burst_mapping()
    {
        //Add the URL mapping for wp-rocket plugin
        if (HMWP_Classes_Tools::isPluginActive('wp-rocket/wp-rocket.php') ) {
            if (HMWP_Classes_Tools::getDefault('hmwp_wp-content_url') <> HMWP_Classes_Tools::getOption('hmwp_wp-content_url')
                || HMWP_Classes_Tools::getDefault('hmwp_wp-includes_url') <> HMWP_Classes_Tools::getOption('hmwp_wp-includes_url')
            ) {
                if (defined('WP_ROCKET_CACHE_BUSTING_URL') && defined('WP_ROCKET_MINIFY_CACHE_URL') ) {
                    $hmwp_url_mapping = json_decode(HMWP_Classes_Tools::getOption('hmwp_url_mapping'), true);

                    //if no mapping is set allready
                    if (!isset($hmwp_url_mapping['from']) ) {
                        $blog_ids = array();
                        if (HMWP_Classes_Tools::isMultisiteWithPath() ) {
                            global $wpdb;
                            $blogs = $wpdb->get_results( "SELECT blog_id FROM " . $wpdb->blogs );
                            foreach ( $blogs as $blog ) {
                                $blog_ids[] = $blog->blog_id;
                            }
                        } else {
                            $blog_ids[] = get_current_blog_id();
                        }

                        $home_root = parse_url(home_url());
                        if (isset($home_root['path']) ) {
                            $home_root = trailingslashit($home_root['path']);
                        } else {
                            $home_root = '/';
                        }

                        $busting_url = HMWP_Classes_ObjController::getClass('HMWP_Models_Rewrite')->find_replace_url(WP_ROCKET_CACHE_BUSTING_URL);
                        if ($busting_url = HMWP_Classes_Tools::getRelativePath($busting_url) ) {
                            foreach ( $blog_ids as $blog_id ) {
                                //mapp the wp-rocket busting wp-content
                                if (HMWP_Classes_Tools::getDefault('hmwp_wp-content_url') <> HMWP_Classes_Tools::getOption('hmwp_wp-content_url') ) {
                                    $hmwp_url_mapping['from'][] = '/' . trim($busting_url,'/') . '/' . $blog_id . $home_root . HMWP_Classes_Tools::getDefault('hmwp_wp-content_url') . '/';
                                    $hmwp_url_mapping['to'][] = '/' . trim($busting_url,'/') . '/' . $blog_id . '/' . HMWP_Classes_Tools::getOption('hmwp_wp-content_url') . '/';
                                }

                                //mapp the wp-rocket busting wp-includes
                                if (HMWP_Classes_Tools::getDefault('hmwp_wp-includes_url') <> HMWP_Classes_Tools::getOption('hmwp_wp-includes_url') ) {
                                    $hmwp_url_mapping['from'][] = '/' . trim($busting_url,'/') . '/' . $blog_id . $home_root . HMWP_Classes_Tools::getDefault('hmwp_wp-includes_url') . '/';
                                    $hmwp_url_mapping['to'][] = '/' . trim($busting_url,'/') . '/' . $blog_id . '/' . HMWP_Classes_Tools::getOption('hmwp_wp-includes_url') . '/';
                                }
                            }
                        }

                        $minify_url = HMWP_Classes_ObjController::getClass('HMWP_Models_Rewrite')->find_replace_url(WP_ROCKET_MINIFY_CACHE_URL);
                        if ($minify_url = HMWP_Classes_Tools::getRelativePath($minify_url) ) {
                            foreach ( $blog_ids as $blog_id ) {
                                //mapp the wp-rocket busting wp-content
                                if (HMWP_Classes_Tools::getDefault('hmwp_wp-content_url') <> HMWP_Classes_Tools::getOption('hmwp_wp-content_url') ) {
                                    $hmwp_url_mapping['from'][] = '/' . trim($minify_url,'/') . '/' . $blog_id . $home_root . HMWP_Classes_Tools::getDefault('hmwp_wp-content_url') . '/';
                                    $hmwp_url_mapping['to'][] = '/' . trim($minify_url,'/') . '/' . $blog_id . '/' . HMWP_Classes_Tools::getOption('hmwp_wp-content_url') . '/';
                                }

                                //mapp the wp-rocket busting wp-includes
                                if (HMWP_Classes_Tools::getDefault('hmwp_wp-includes_url') <> HMWP_Classes_Tools::getOption('hmwp_wp-includes_url') ) {
                                    $hmwp_url_mapping['from'][] = '/' . trim($minify_url,'/') . '/' . $blog_id . $home_root . HMWP_Classes_Tools::getDefault('hmwp_wp-includes_url') . '/';
                                    $hmwp_url_mapping['to'][] = '/' . trim($minify_url,'/') . '/' . $blog_id . '/' . HMWP_Classes_Tools::getOption('hmwp_wp-includes_url') . '/';
                                }
                            }
                        }

                        HMWP_Classes_Tools::saveOptions('hmwp_url_mapping', json_encode($hmwp_url_mapping));
                    }
                }
            }
        }
    }

}
