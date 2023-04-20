<?php
/**
 * Integrations page in Theme Panel
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class OEW_Integrations {

	/**
	 * Start things up
	 */
	public function __construct() {
		add_filter( 'ocean_integrations_settings', array( $this, 'settings' ) );
		add_action( 'ocean_integrations_after_content', array( $this, 'content' ) );
	}

	/**
	 * Get settings.
	 *
	 * @since   1.1.0
	 */
	public static function settings( $array ) {

		$array['google_map_api'] 			= get_option( 'owp_google_map_api' );
		$array['recaptcha_site_key'] 		= get_option( 'owp_recaptcha_site_key' );
		$array['recaptcha_secret_key'] 		= get_option( 'owp_recaptcha_secret_key' );

		return $array;
	}

	/**
	 * Integrations content
	 *
	 * @since   1.1.0
	 */
	public static function content() {

		// Return if Ocean Extra is disabled
		if ( ! class_exists( 'Ocean_Extra_Theme_Panel' ) ) {
			return;
		}

		// Get settings
		$settings = OWP_Integrations::get_settings(); ?>

		<hr>

		<h2 id="google"><?php esc_html_e( 'Google Map API Key', 'ocean-elementor-widgets' ); ?></h2>

		<table class="form-table">
			<tbody>
				<tr id="owp_google_map_api_tr">
					<th scope="row">
						<label for="owp_google_map_api"><?php esc_html_e( 'API Key', 'ocean-elementor-widgets' ); ?></label>
					</th>
					<td>
						<input name="owp_integrations[google_map_api]" type="text" id="owp_google_map_api" value="<?php echo esc_attr( $settings['google_map_api'] ); ?>" class="regular-text">
						<p class="description"><?php echo sprintf(
			        		esc_html__( 'To integrate with our google map widget you need an %1$sAPI Key%2$s', 'ocean-elementor-widgets' ),
			        		'<a href="https://docs.oceanwp.org/article/537-get-your-google-map-api-key" target="_blank">', '</a>'
			        		); ?></p>
					</td>
				</tr>
			</tbody>
		</table>

		<hr>

		<h2 id="recaptcha"><?php esc_html_e( 'Google reCAPTCHA', 'ocean-elementor-widgets' ); ?></h2>
		<p class="description"><?php echo
			sprintf(
				esc_html__( '%1$sreCAPTCHA%2$s is a free service by Google that protects your website from spam and abuse. It does this while letting your valid users pass through with ease.', 'ocean-elementor-widgets' ),
				'<a href="https://docs.oceanwp.org/article/536-get-your-google-recaptcha-site-key-and-secret-key" target="_blank">', '</a>'
			); ?></p>

		<table class="form-table">
			<tbody>
				<tr id="owp_google_recaptcha_site_key_tr">
					<th scope="row">
						<label for="owp_recaptcha_site_key"><?php esc_html_e( 'Site Key', 'ocean-elementor-widgets' ); ?></label>
					</th>
					<td>
						<input name="owp_integrations[recaptcha_site_key]" type="text" id="owp_recaptcha_site_key" value="<?php echo esc_attr( $settings['recaptcha_site_key'] ); ?>" class="regular-text">
					</td>
				</tr>
				<tr id="owp_google_recaptcha_secret_key_tr">
					<th scope="row">
						<label for="owp_recaptcha_secret_key"><?php esc_html_e( 'Secret Key', 'ocean-elementor-widgets' ); ?></label>
					</th>
					<td>
						<input name="owp_integrations[recaptcha_secret_key]" type="text" id="owp_recaptcha_secret_key" value="<?php echo esc_attr( $settings['recaptcha_secret_key'] ); ?>" class="regular-text">
					</td>
				</tr>
			</tbody>
		</table>

	<?php
	}

}
new OEW_Integrations();