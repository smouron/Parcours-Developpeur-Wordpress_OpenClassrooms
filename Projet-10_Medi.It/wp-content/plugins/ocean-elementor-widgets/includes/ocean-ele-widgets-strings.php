<?php
/**
 * Ocean Elementor Widgets plugin translation strings
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'oew_lang_strings' ) ) {

	/**
	 * Ocean Elementor Widgets plugin Strings
	 *
	 *  @author OceanWP
	 *  @since 2.3.3
	 *
	 * @param  string  $value  String key.
	 * @param  boolean $echo   Print string.
	 * @return mixed           Return string or nothing.
	 */
	function oew_lang_strings( $value, $echo = true ) {

		$oew_txt_strings = apply_filters(
			'oew_lang_strings',
			array(

				// Ajax Search Widget Aria.
				'oew-string-ajaxs-label'                  => apply_filters( 'oew_wai_ajaxs_label', __( 'Search the website', 'ocean-elementor-widgets' ) ),
				'oew-string-ajaxs-btn'                    => apply_filters( 'oew_wai_ajaxs_btn', __( 'Submit search query', 'ocean-elementor-widgets' ) ),
				
				// Clipboard Widget Aria.
				'oew-string-copy-label'                   => apply_filters( 'oew_wai_copy_label', __( 'Copy value to clipboard', 'ocean-elementor-widgets' ) ),
				
				// Modal Widget Aria.
				'oew-string-mw-close-btn'                 => apply_filters( 'oew_wai_mw_close', __( 'Close this modal window', 'ocean-elementor-widgets' ) ),
				
				// Newsletter Widget.
				'oew-string-mc-email'                     => apply_filters( 'oew_wai_mc_email', __( 'Enter your email address to subscribe', 'ocean-elementor-widgets' ) ),
				'oew-string-mc-submit'                    => apply_filters( 'oew_wai_mc_submit', __( 'Submit email address', 'ocean-elementor-widgets' ) ),
				'oew-string-mc-email-req-alert'           => apply_filters( 'oew_mc_email_req', __( 'Email is required', 'ocean-elementor-widgets' ) ),
				'oew-string-mc-email-inv-alert'           => apply_filters( 'oew_mc_email_inv', __( 'Email is not valid', 'ocean-elementor-widgets' ) ),
				'oew-string-mc-gdpr-check'                => apply_filters( 'oew_mc_gdpr_check', __( 'This field is required', 'ocean-elementor-widgets' ) ),
				'oew-string-mc-msg-succ'                  => apply_filters( 'oew_mc_msg_succ', __( 'Thanks for your subscription.', 'ocean-elementor-widgets' ) ),
				'oew-string-mc-msg-fail'                  => apply_filters( 'oew_mc_msg_fail', __( 'Failed to subscribe, please contact admin.', 'ocean-elementor-widgets' ) ),

				// Newsletter Widget Aria.
				'oew-string-search-form-label'            => apply_filters( 'oew_wai_search_form_label', __( 'Search this website', 'ocean-elementor-widgets' ) ),
				'oew-string-search-field'                 => apply_filters( 'oew_wai_search_field', __( 'Insert search query', 'ocean-elementor-widgets' ) ),
				'oew_string_search_submit'                => apply_filters( 'oew_wai_search_submit', __( 'Submit your search', 'ocean-elementor-widgets' ) ),

				// Off Canvas Widget Aria.
				'oew-string-offc-close-btn'               => apply_filters( 'oew_wai_offc_close', __( 'Close this window', 'ocean-elementor-widgets' ) ),

				// Toggle Switch Widget Aria.
				'oew-string-togg-btn'                     => apply_filters( 'oew_wai_togg_btn', __( 'Switch between content by toggling the button', 'ocean-elementor-widgets' ) ),

			)
		);

		if ( is_rtl() ) {
			// do your stuff.
		}

		$oewt_string = isset( $oew_txt_strings[ $value ] ) ? $oew_txt_strings[ $value ] : '';

		/**
		 * Print or return strings
		 */
		if ( $echo ) {
			echo $oewt_string; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		} else {
			return $oewt_string;
		}
	}
}
