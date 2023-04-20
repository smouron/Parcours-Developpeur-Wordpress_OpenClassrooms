<?php
/**
 * reCAPTCHA class
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class OEW_reCAPTCHA {

	/**
	 * Start things up
	 */
	public function __construct() {
		if ( ! get_option( 'owp_recaptcha_site_key' )
			|| ! get_option( 'owp_recaptcha_secret_key' ) ) {
			return;
		}

		add_action( 'login_footer', array( $this, 'script' ) );

		add_action( 'register_form', array( $this, 'recaptcha_display' ) );
		add_filter( 'registration_errors', array( $this, 'registration_errors' ) );

		if ( is_multisite() ) {
			add_action( 'signup_extra_fields', array( $this, 'recaptcha_display' ) );
			add_filter( 'wpmu_validate_user_signup', array( $this, 'wpmu_validate_signup' ) );
			add_filter( 'wpmu_validate_blog_signup', array( $this, 'wpmu_validate_signup' ) );
		}
	}

	/**
	 * Enqueues scripts
	 *
	 * @since 1.1.0
	 */
	function script() {
		wp_enqueue_script( 'recaptcha', add_query_arg( array(
			'hl' => str_replace( '_', '-', get_locale() )
		), 'https://www.google.com/recaptcha/api.js' ) );
	}

	/**
	 * Retrieves reCAPTCHA errors
	 *
	 * @since 1.1.0
	 *
	 * @param WP_Error $errors WP_Error object
	 * @return WP_Error WP_Error object
	 */
	public function registration_errors( $errors ) {
		$response = isset( $_POST['g-recaptcha-response'] ) ? $_POST['g-recaptcha-response'] : '';
		$result   = $this->recaptcha_validate( $response );

		if ( is_wp_error( $result ) ) {

			$error_code = $result->get_error_message();

			switch ( $error_code ) {
				case 'missing-input-secret' :
				case 'invalid-input-secret' :
					$errors->add( 'recaptcha', __( '<strong>ERROR</strong>: Invalid reCAPTCHA secret key.', 'ocean-elementor-widgets' ), $error_code );
					break;
				case 'missing-input-response' :
				case 'invalid-input-response' :
					$errors->add( 'recaptcha', __( '<strong>ERROR</strong>: Please check the box to prove that you are not a robot.', 'ocean-elementor-widgets' ), $error_code );
					break;
				case 'recaptcha-not-reachable' :
				default :
					$errors->add( 'recaptcha', __( '<strong>ERROR</strong>: Unable to reach the reCAPTCHA server.', 'ocean-elementor-widgets' ), $error_code );
					break;
			}
		}
		return $errors;
	}

	/**
	 * Retrieves reCAPTCHA errors for multisite
	 *
	 * @since 1.1.0
	 *
	 * @param array $result Signup parameters
	 * @return array Signup parameters
	 */
	public function wpmu_validate_signup( $result ) {
		// Don't add errors if adding a user from wp-admin or WP-CLI
		if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
			return $result;
		}

		$result['errors'] = $this->registration_errors( $result['errors'] );
		return $result;
	}

	/**
	 * Displays reCAPTCHA
	 *
	 * @since 1.1.0
	 * @access public
	 */
	public function recaptcha_display( $errors = null ) {
		if ( is_multisite() ) {
			if ( $error = $errors->get_error_message( 'recaptcha' ) )
				echo '<p class="error">' . $error . '</p>';
		}

		echo '<div class="g-recaptcha" data-sitekey="' . esc_attr( get_option( 'owp_recaptcha_site_key' ) ) . '"></div>';
	}

	/**
	 * Validates reCAPTCHA
	 *
	 * @since 1.1.0
	 * @access public
	 */
	public function recaptcha_validate( $response, $remote_ip = '' ) {

		if ( empty( $remote_ip ) )
			$remote_ip = $_SERVER['REMOTE_ADDR'];

		$response = wp_remote_post( 'https://www.google.com/recaptcha/api/siteverify', array(
			'body' => array(
				'secret'   => get_option( 'owp_recaptcha_secret_key' ),
				'response' => $response,
				'remoteip' => $remote_ip
			)
		) );

		$response_code    = wp_remote_retrieve_response_code( $response );
		$response_message = wp_remote_retrieve_response_message( $response );
		$response_body    = wp_remote_retrieve_body( $response );

		if ( 200 == $response_code ) {

			$result = json_decode( $response_body, true );

			if ( $result['success'] )
				return true;

			return new WP_Error( 'recaptcha', reset( $result['error-codes'] ) );
		}

		return new WP_Error( 'recaptcha', 'recaptcha-not-reachable' );
	}

}
new OEW_reCAPTCHA();