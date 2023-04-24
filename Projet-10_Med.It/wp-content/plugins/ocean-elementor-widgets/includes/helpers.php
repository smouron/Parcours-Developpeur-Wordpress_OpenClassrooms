<?php
/**
 * Helpers functions
 *
 * @package OceanWP WordPress theme
 */

// No direct access, please
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get post types
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'oew_get_available_post_types' ) ) {

	function oew_get_available_post_types() {

		$post_type_args = array(
			// Default is the value $public.
			'show_in_nav_menus' => true,
		);

		if ( ! empty( $args['post_type'] ) ) {
			$post_type_args['name'] = $args['post_type'];
		}

		$post_types = get_post_types( $post_type_args, 'objects' );

		$result = array( __( '-- Select --', 'ocean-elementor-widgets' ) );

		foreach ( $post_types as $post_type => $object ) {
			$result[ $post_type ] = $object->label;
		}

		return $result;
	}
}

/**
 * Get image sizes
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'oew_get_img_sizes' ) ) {

	function oew_get_img_sizes() {

		global $_wp_additional_image_sizes;

		$sizes                        = array();
		$get_intermediate_image_sizes = get_intermediate_image_sizes();

		// Create the full array with sizes and crop info
		foreach ( $get_intermediate_image_sizes as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( $_size . '_size_w' );
				$sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
				$sizes[ $_size ]['crop']   = (bool) get_option( $_size . '_crop' );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		$image_sizes = array();

		foreach ( $sizes as $size_key => $size_attributes ) {
			$image_sizes[ $size_key ] = ucwords( str_replace( '_', ' ', $size_key ) ) . sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
		}

		$image_sizes['full'] = _x( 'Full', 'Image Size Control', 'ocean-elementor-widgets' );

		return $image_sizes;
	}
}

/**
 * Get title tags
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'oew_get_available_tags' ) ) {

	function oew_get_available_tags() {

		$tags = array(
			'h1'   => __( 'H1', 'ocean-elementor-widgets' ),
			'h2'   => __( 'H2', 'ocean-elementor-widgets' ),
			'h3'   => __( 'H3', 'ocean-elementor-widgets' ),
			'h4'   => __( 'H4', 'ocean-elementor-widgets' ),
			'h5'   => __( 'H5', 'ocean-elementor-widgets' ),
			'h6'   => __( 'H6', 'ocean-elementor-widgets' ),
			'div'  => __( 'div', 'ocean-elementor-widgets' ),
			'span' => __( 'span', 'ocean-elementor-widgets' ),
			'p'    => __( 'p', 'ocean-elementor-widgets' ),
		);
		$tags = apply_filters( 'oew_title_tags', $tags );

		return $tags;
	}
}

/**
 * Get available sidebars
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'oew_get_available_sidebars' ) ) {

	function oew_get_available_sidebars() {
		global $wp_registered_sidebars;

		$sidebars = array();

		if ( ! $wp_registered_sidebars ) {
			$sidebars['0'] = __( 'No sidebars were found', 'ocean-elementor-widgets' );
		} else {
			$sidebars['0'] = __( '-- Select --', 'ocean-elementor-widgets' );

			foreach ( $wp_registered_sidebars as $id => $sidebar ) {
				$sidebars[ $id ] = $sidebar['name'];
			}
		}

		return $sidebars;
	}
}

/**
 * Get available templates
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'oew_get_available_templates' ) ) {

	function oew_get_available_templates() {
		$templates = get_posts(
			array(
				'post_type'      => 'elementor_library',
				'posts_per_page' => -1,
			)
		);

		$result = array( __( '-- Select --', 'ocean-elementor-widgets' ) );

		if ( ! empty( $templates ) && ! is_wp_error( $templates ) ) {
			foreach ( $templates as $item ) {
				$result[ $item->ID ] = $item->post_title;
			}
		}

		return $result;
	}
}

/**
 * Check if Advanced Custom Fields plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_acf_active' ) ) {

	function is_acf_active() {
		$return = false;

		if ( class_exists( 'acf' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Contact Form 7 plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_contact_form_7_active' ) ) {

	function is_contact_form_7_active() {
		$return = false;

		if ( class_exists( 'WPCF7_ContactForm' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if WPForms plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_wpforms_active' ) ) {

	function is_wpforms_active() {
		$return = false;

		if ( class_exists( '\WPForms\WPForms' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Gravity Forms plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_gravity_forms_active' ) ) {

	function is_gravity_forms_active() {
		$return = false;

		if ( class_exists( 'GFCommon' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Caldera Forms plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_caldera_forms_active' ) ) {

	function is_caldera_forms_active() {
		$return = false;

		if ( class_exists( 'Caldera_Forms' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Ninja Forms plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_ninja_forms_active' ) ) {

	function is_ninja_forms_active() {
		$return = false;

		if ( class_exists( 'Ninja_Forms' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Fluent Forms plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_fluent_forms_active' ) ) {

	function is_fluent_forms_active() {
		$return = false;

		if ( function_exists('wpFluentForm') ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if Formidable Forms plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_formidable_forms_active' ) ) {

	function is_formidable_forms_active() {
		$return = false;

		if ( class_exists('FrmForm') ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if WooCommerce plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {

	function is_woocommerce_active() {
		$return = false;

		if ( class_exists( 'WooCommerce' ) ) {
			$return = true;
		}

		return $return;
	}
}

/**
 * Check if WPML String Translation plugin is active
 *
 * @since 1.1.0
 */
if ( ! function_exists( 'is_wpml_string_translation_active' ) ) {

	function is_wpml_string_translation_active() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		return is_plugin_active( 'wpml-string-translation/plugin.php' );
	}
}

/**
 * Return the correct icon
 *
 * @param string  $icon        Icon class.
 * @param bool    $echo        Print string.
 * @param string  $class       Icon class.
 * @param string  $title       Optional SVG title.
 * @param string  $desc        Optional SVG description.
 * @param string  $aria_hidden Optional SVG description.
 * @param boolean $fallback    Fallback icon.
 *
 * @return string OceanWP Icon.
 */
function oew_svg_icon( $icon, $echo = true, $class = '', $title = '', $desc = '', $aria_hidden = true, $fallback = false ) {

	// Get icon class.
	$theme_icons = oceanwp_theme_icons();

	if ( function_exists( 'oceanwp_icon' ) ) {
		oceanwp_icon( $icon, $echo, $class, $title, $desc, $aria_hidden, $fallback );
	} else {

		if ( true === $echo ) {
			echo '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
		} else {
			return '<i class="' . $class . ' ' . $theme_icons[ $icon ]['fai'] . '"' . $aria_hidden . ' role="img"></i>';
		}

		return;

	}
}

/**
 * Custom excerpts based on wp_trim_words
 *
 * @since   1.0.0
 * @link    http://codex.wordpress.org/Function_Reference/wp_trim_words
 */
if ( ! function_exists( 'oew_excerpt' ) ) {

	function oew_excerpt( $length = 15 ) {

		// Get global post
		global $post;

		// Get post data
		$id      = $post->ID;
		$excerpt = $post->post_excerpt;
		$content = $post->post_content;

		// Display custom excerpt
		if ( $excerpt ) {
			$output = $excerpt;
		}

		// Check for more tag
		elseif ( strpos( $content, '<!--more-->' ) ) {
			$output = get_the_content( $excerpt );
		}

		// Generate auto excerpt
		else {
			$output = wp_trim_words( strip_shortcodes( get_the_content( $id ) ), $length );
		}

		// Echo output
		echo wp_kses_post( $output );

	}
}

/**
 * Get all types of post
 *
 * @since   1.2.7
 */
if ( ! function_exists( 'oew_get_post_list' ) ) {

	function oew_get_post_list( $post_type = 'any', $limit = -1, $search = '' ) {

		global $wpdb;
		$where = '';
		$data  = array();

		if ( -1 == $limit ) {
			$limit = '';
		} elseif ( 0 == $limit ) {
			$limit = 'limit 0,1';
		} else {
			$limit = $wpdb->prepare( ' limit 0,%d', esc_sql( $limit ) );
		}

		if ( 'any' === $post_type ) {
			$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );
			if ( empty( $in_search_post_types ) ) {
				$where .= ' AND 1=0 ';
			} else {
				$where .= " AND {$wpdb->posts}.post_type IN ('" . join(
					"', '",
					array_map( 'esc_sql', $in_search_post_types )
				) . "')";
			}
		} elseif ( ! empty( $post_type ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_type = %s", esc_sql( $post_type ) );
		}

		if ( ! empty( $search ) ) {
			$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql( $search ) . '%' );
		}

		$query   = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
		$results = $wpdb->get_results( $query );
		if ( ! empty( $results ) ) {
			foreach ( $results as $row ) {
				$data[ $row->ID ] = $row->post_title;
			}
		}
		return $data;

	}
}

/**
 * Ajax search
 *
 * @since   1.0.7
 */
if ( ! function_exists( 'oew_ajax_search' ) ) {

	function oew_ajax_search() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'oceanwp' ) ) {
			wp_die();
		}

		$search    = sanitize_text_field( $_POST['search'] );
		$post_type = 'any';
		$args      = array(
			's'              => $search,
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => 5,
		);
		$query     = new WP_Query( $args );
		$output    = '';

		// Icons
		$icon      = '';
		$icon_long = '';

		if ( is_RTL() ) {
			$icon      = oew_svg_icon( 'arrow_left', false, 'icon' );
			$icon_long = oew_svg_icon( 'long_arrow_alt_left', false );
		} else {
			$icon      = oew_svg_icon( 'arrow_right', false, 'icon' );
			$icon_long = oew_svg_icon( 'long_arrow_alt_right', false );
		}

		if ( $query->have_posts() ) {

			$output .= '<ul>';

			while ( $query->have_posts() ) :
				$query->the_post();
				$output     .= '<li>';
					$output .= '<a href="' . get_permalink() . '" class="search-result-link clr">';

				if ( has_post_thumbnail() ) {
					$output .= get_the_post_thumbnail(
						get_the_ID(),
						'thumbnail',
						array(
							'alt'      => get_the_title(),
							'itemprop' => 'image',
						)
					);
				}

						$output .= '<div class="result-title">' . get_the_title() . '</div>';
						$output .= $icon;
					$output     .= '</a>';
					$output     .= '</li>';
				endwhile;

			if ( $query->found_posts > 1 ) {
				$search_link = get_search_link( $search );

				/*
				if ( strpos( $search_link, '?' ) !== false ) {
					$search_link .= '?post_type='. $post_type;
				}*/

					$output .= '<li><a href="' . $search_link . '" class="all-results"><span>' . sprintf( esc_html__( 'View all %d results', 'ocean-elementor-widgets' ), $query->found_posts ) . $icon_long . '</span></a></li>';
			}
		} else {

			$output .= '<div class="oew-no-search-results">';
			$output .= '<h6>' . esc_html__( 'No results', 'ocean-elementor-widgets' ) . '</h6>';
			$output .= '<p>' . esc_html__( 'No search results could be found, please try another search.', 'ocean-elementor-widgets' ) . '</p>';
			$output .= '</div>';

		}

		wp_reset_query();

		echo $output;

		die();

	}

	add_action( 'wp_ajax_oew_ajax_search', 'oew_ajax_search' );
	add_action( 'wp_ajax_nopriv_oew_ajax_search', 'oew_ajax_search' );

}

/**
 * Newsletter Form
 *
 * @since   1.1.0
 */
if ( ! function_exists( 'oew_newsletter_form' ) ) {

	function oew_newsletter_form() {
		if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'oceanwp' ) ) {
			wp_send_json( array( 'status' => false ) );
			wp_die();
		}

		$apikey  = get_option( 'owp_mailchimp_api_key' );
		$list_id = get_option( 'owp_mailchimp_list_id' );
		$email   = ( isset( $_POST['email'] ) ) ? $_POST['email'] : '';
		$status  = false;

		if ( $email && $apikey && $list_id ) {

			$root = 'https://api.mailchimp.com/3.0';

			if ( strstr( $apikey, '-' ) ) {
				list( $key, $dc ) = explode( '-', $apikey, 2 );
			}

			$root = str_replace( 'https://api', 'https://' . $dc . '.api', $root );
			$root = rtrim( $root, '/' ) . '/';

			$params = array(
				'apikey'            => $apikey,
				'id'                => $list_id,
				'email_address'     => $email,
				'status'            => 'subscribed',
				'double_optin'      => false,
				'send_welcome'      => false,
				'replace_interests' => false,
				'update_existing'   => true,
			);

			$ch     = curl_init();
			$params = json_encode( $params );

			curl_setopt( $ch, CURLOPT_URL, $root . '/lists/' . $list_id . '/members/' . $email );
			curl_setopt( $ch, CURLOPT_USERPWD, 'user:' . $apikey );
			curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json' ) );
			curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'PUT' );
			curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
			curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );

			$response_body = curl_exec( $ch );
			$httpCode      = curl_getinfo( $ch, CURLINFO_HTTP_CODE );

			curl_close( $ch );

			if ( $httpCode == 200 ) {
				$status = true;
			}
		}

		wp_send_json( array( 'status' => $status ) );
		wp_die();
	}

	add_action( 'wp_ajax_oew_newsletter_form', 'oew_newsletter_form' );
	add_action( 'wp_ajax_nopriv_oew_newsletter_form', 'oew_newsletter_form' );

}

/**
* Get unique ID
*
* Based on the TwentyTwenty theme unique ID method: inc\template-tags.php
*
* @since 2.3.4
*/
if ( ! function_exists( 'oew_unique_id' ) ) {
   function oew_unique_id( $prefix = '' ) {
	   static $id_counter = 0;
	   if ( function_exists( 'wp_unique_id' ) ) {
		   return wp_unique_id( $prefix );
	   }
	   return $prefix . (string) ++$id_counter;
   }
}
