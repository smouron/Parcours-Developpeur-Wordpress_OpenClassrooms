<?php
namespace owpElementor\Compatibility;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * WPML Compatibility
 *
 * Registers translatable widgets
 *
 * @since 1.0.16
 */
class WPML {

	/**
	 * @since 1.0.16
	 * @var Object
	 */
	public static $instance = null;

	/**
	 * Returns the class instance
	 * 
	 * @since 1.0.16
	 *
	 * @return Object
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor for the class
	 *
	 * @since 1.0.16
	 *
	 * @return void
	 */
	public function __construct() {

		// WPML String Translation plugin exist check
		if ( is_wpml_string_translation_active() ) {
			add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'add_translatable_nodes' ] );
		}
	}

	/**
	 * Adds additional translatable nodes to WPML
	 *
	 * @since 1.0.16
	 *
	 * @param  array   $nodes_to_translate WPML nodes to translate
	 * @return array   $nodes_to_translate Updated nodes
	 */
	public function add_translatable_nodes( $nodes_to_translate ) {

		$nodes_to_translate[ 'oew-accordion' ] = array(
			'conditions' => array( 'widgetType' => 'oew-accordion' ),
			'fields'     => array(
				array(
					'field'       => 'tab_title',
					'type'        => __( 'Accordion Title & Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'tab_content',
					'type'        => __( 'Accordion Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-acf' ] = array(
			'conditions' => array( 'widgetType' => 'oew-acf' ),
			'fields'     => array(
				array(
					'field'       => 'field_name',
					'type'        => __( 'ACF Field Name', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'link_text',
					'type'        => __( 'ACF Link Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'field_label',
					'type'        => __( 'ACF Label', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-advanced-heading' ] = array(
			'conditions' => array( 'widgetType' => 'oew-advanced-heading' ),
			'fields'     => array(
				array(
					'field'       => 'main_heading',
					'type'        => __( 'Advanced Heading Heading', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'sub_heading',
					'type'        => __( 'Advanced Heading Sub Heading', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'background_heading',
					'type'        => __( 'Advanced Heading Background Heading', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-alert' ] = array(
			'conditions' => array( 'widgetType' => 'oew-alert' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Alert Message Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __( 'Alert Message Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-animated-heading' ] = array(
			'conditions' => array( 'widgetType' => 'oew-animated-heading' ),
			'fields'     => array(
				array(
					'field'       => 'pre_heading',
					'type'        => __( 'Animated Heading Pre Heading', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'animated_heading',
					'type'        => __( 'Animated Heading Heading', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'post_heading',
					'type'        => __( 'Animated Heading Post Heading', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-banner' ] = array(
			'conditions' => array( 'widgetType' => 'oew-banner' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Banner Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __( 'Banner Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-brands' ] = array(
			'conditions' => array( 'widgetType' => 'oew-brands' ),
			'fields'     => array(
				array(
					'field'       => 'item_name',
					'type'        => __( 'Brands Company Name', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'item_description',
					'type'        => __( 'Brands Company Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-business-hours' ] = array(
			'conditions' => array( 'widgetType' => 'oew-business-hours' ),
			'fields'     => array(
				array(
					'field'       => 'closed_text',
					'type'        => __( 'Business Hours Closed Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-button-effects' ] = array(
			'conditions' => array( 'widgetType' => 'oew-button-effects' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Button Effects Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-buttons' ] = array(
			'conditions' => array( 'widgetType' => 'oew-buttons' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Buttons Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-call-to-action' ] = array(
			'conditions' => array( 'widgetType' => 'oew-call-to-action' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Call To Action Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __( 'Call To Action Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'btn_text',
					'type'        => __( 'Call To Action Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-circle-progress' ] = array(
			'conditions' => array( 'widgetType' => 'oew-circle-progress' ),
			'fields'     => array(
				array(
					'field'       => 'text_before',
					'type'        => __( 'Circle Progress Text Before', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'text_middle',
					'type'        => __( 'Circle Progress Text Middle', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'text_after',
					'type'        => __( 'Circle Progress Text After', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __( 'Circle Progress Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-countdown' ] = array(
			'conditions' => array( 'widgetType' => 'oew-countdown' ),
			'fields'     => array(
				array(
					'field'       => 'label_days',
					'type'        => __( 'Countdown Days', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'label_hours',
					'type'        => __( 'Countdown Hours', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'label_minutes',
					'type'        => __( 'Countdown Minutes', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'label_seconds',
					'type'        => __( 'Countdown Seconds', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-divider' ] = array(
			'conditions' => array( 'widgetType' => 'oew-divider' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Divider Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-flip-box' ] = array(
			'conditions' => array( 'widgetType' => 'oew-flip-box' ),
			'fields'     => array(
				array(
					'field'       => 'front_title_text',
					'type'        => __( 'Flip Box Front Title & Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'front_description_text',
					'type'        => __( 'Flip Box Front Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'back_title_text',
					'type'        => __( 'Flip Box Back Title & Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'back_description_text',
					'type'        => __( 'Flip Box Back Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'button_text',
					'type'        => __( 'Flip Box Back Button Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-hotspots' ] = array(
			'conditions' => array( 'widgetType' => 'oew-hotspots' ),
			'fields'     => array(
				array(
					'field'       => 'hotspot_text',
					'type'        => __( 'Hotspots Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'tooltip_content',
					'type'        => __( 'Hotspots Tooltip Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-image-comparison' ] = array(
			'conditions' => array( 'widgetType' => 'oew-image-comparison' ),
			'fields'     => array(
				array(
					'field'       => 'before_label',
					'type'        => __( 'Image Comparison Before Label', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'after_label',
					'type'        => __( 'Image Comparison After Label', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-info-box' ] = array(
			'conditions' => array( 'widgetType' => 'oew-info-box' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Info Box Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'title',
					'type'        => __( 'Info Box Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __( 'Info Box Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'button_text',
					'type'        => __( 'Info Box Button Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-link-effects' ] = array(
			'conditions' => array( 'widgetType' => 'oew-link-effects' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Link Effects Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'second_text',
					'type'        => __( 'Link Effects Secondary Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-logged-in-out' ] = array(
			'conditions' => array( 'widgetType' => 'oew-logged-in-out' ),
			'fields'     => array(
				array(
					'field'       => 'logged_in_content',
					'type'        => __( 'Logged In Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'logged_out_content',
					'type'        => __( 'Logged Out Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-login' ] = array(
			'conditions' => array( 'widgetType' => 'oew-login' ),
			'fields'     => array(
				array(
					'field'       => 'user_label',
					'type'        => __( 'Login Username', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'pass_label',
					'type'        => __( 'Login Password', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'user_placeholder',
					'type'        => __( 'Login Username Placeholder', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'pass_placeholder',
					'type'        => __( 'Login Password Placeholder', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __( 'Login Submit Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'register_text',
					'type'        => __( 'Login Register Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'lost_password_text',
					'type'        => __( 'Login Lost Password Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-lost-password' ] = array(
			'conditions' => array( 'widgetType' => 'oew-lost-password' ),
			'fields'     => array(
				array(
					'field'       => 'message',
					'type'        => __( 'Lost Password Message', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'user_label',
					'type'        => __( 'Lost Password Username', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'user_placeholder',
					'type'        => __( 'Lost Password Username Placeholder', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __( 'Lost Password Submit Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'login_text',
					'type'        => __( 'Lost Password Login Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-member' ] = array(
			'conditions' => array( 'widgetType' => 'oew-member' ),
			'fields'     => array(
				array(
					'field'       => 'name',
					'type'        => __( 'Member Name', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'role',
					'type'        => __( 'Member Role', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __( 'Member Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'social_link_title',
					'type'        => __( 'Member Social Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-modal' ] = array(
			'conditions' => array( 'widgetType' => 'oew-modal' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Modal Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __( 'Modal Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-navbar' ] = array(
			'conditions' => array( 'widgetType' => 'oew-navbar' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Navbar Button Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'off_canvas_title',
					'type'        => __( 'Navbar Off Canvas Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'mobile_title',
					'type'        => __( 'Navbar Mobile Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'mobile_close_title',
					'type'        => __( 'Navbar Close Mobile Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-newsletter' ] = array(
			'conditions' => array( 'widgetType' => 'oew-newsletter' ),
			'fields'     => array(
				array(
					'field'       => 'placeholder_text',
					'type'        => __( 'Newsletter Placeholder Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __( 'Newsletter Submit Button Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-off-canvas' ] = array(
			'conditions' => array( 'widgetType' => 'oew-off-canvas' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Off Canvas Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-price-list' ] = array(
			'conditions' => array( 'widgetType' => 'oew-price-list' ),
			'fields'     => array(
				array(
					'field'       => 'price',
					'type'        => __( 'Price List Price', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'title',
					'type'        => __( 'Price List Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __( 'Price List Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-pricing' ] = array(
			'conditions' => array( 'widgetType' => 'oew-pricing' ),
			'fields'     => array(
				array(
					'field'       => 'plan',
					'type'        => __( 'Pricing Plan', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'cost',
					'type'        => __( 'Pricing Cost', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'per',
					'type'        => __( 'Pricing Per', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content',
					'type'        => __( 'Pricing Features', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'button_text',
					'type'        => __( 'Pricing Button Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				'link' => array(
					'field'       => 'button_url',
					'type'        => __( 'Pricing Button link', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINK'
				),
			),
		);

		$nodes_to_translate[ 'oew-recipe' ] = array(
			'conditions' => array( 'widgetType' => 'oew-recipe' ),
			'fields'     => array(
				array(
					'field'       => 'name',
					'type'        => __( 'Recipe Name', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'description',
					'type'        => __( 'Recipe Description', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'prep_text',
					'type'        => __( 'Recipe Prep Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'prep_value',
					'type'        => __( 'Recipe Prep Value', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'cook_text',
					'type'        => __( 'Recipe Cook Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'cook_value',
					'type'        => __( 'Recipe Cook Value', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'total_text',
					'type'        => __( 'Recipe Total Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'total_value',
					'type'        => __( 'Recipe Total Value', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'servings_text',
					'type'        => __( 'Recipe Servings Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'servings_value',
					'type'        => __( 'Recipe Servings Value', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'calories_text',
					'type'        => __( 'Recipe Calories Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'calories_value',
					'type'        => __( 'Recipe Calories Value', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'ingredient',
					'type'        => __( 'Recipe Ingredient Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'instruction',
					'type'        => __( 'Recipe Instruction Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'notes',
					'type'        => __( 'Recipe Notes', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-register' ] = array(
			'conditions' => array( 'widgetType' => 'oew-register' ),
			'fields'     => array(
				array(
					'field'       => 'user_label',
					'type'        => __( 'Register Username', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'email_label',
					'type'        => __( 'Register Email', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'user_placeholder',
					'type'        => __( 'Register Username Placeholder', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'email_placeholder',
					'type'        => __( 'Register Email Placeholder', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'form_text',
					'type'        => __( 'Register Form Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'submit_text',
					'type'        => __( 'Register Submit Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'login_text',
					'type'        => __( 'Register Login Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-scroll-up' ] = array(
			'conditions' => array( 'widgetType' => 'oew-scroll-up' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Scroll Up Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-search' ] = array(
			'conditions' => array( 'widgetType' => 'oew-search' ),
			'fields'     => array(
				array(
					'field'       => 'placeholder',
					'type'        => __( 'Search Placeholder', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-skillbar' ] = array(
			'conditions' => array( 'widgetType' => 'oew-skillbar' ),
			'fields'     => array(
				array(
					'field'       => 'title',
					'type'        => __( 'Skillbar Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-table' ] = array(
			'conditions' => array( 'widgetType' => 'oew-table' ),
			'fields'     => array(
				array(
					'field'       => 'cell_text',
					'type'        => __( 'Table Cell Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'content_text',
					'type'        => __( 'Table Content Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-tabs' ] = array(
			'conditions' => array( 'widgetType' => 'oew-tabs' ),
			'fields'     => array(
				array(
					'field'       => 'tab_title',
					'type'        => __( 'Tabs Title & Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'tab_content',
					'type'        => __( 'Tabs Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-timeline' ] = array(
			'conditions' => array( 'widgetType' => 'oew-timeline' ),
			'fields'     => array(
				array(
					'field'       => 'timeline_title',
					'type'        => __( 'Timeline Title', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'timeline_date',
					'type'        => __( 'Timeline Date', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'timeline_text',
					'type'        => __( 'Timeline Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'timeline_link',
					'type'        => __( 'Timeline Item Link', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'readmore_text',
					'type'        => __( 'Timeline Read More Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		$nodes_to_translate[ 'oew-toggle' ] = array(
			'conditions' => array( 'widgetType' => 'oew-toggle' ),
			'fields'     => array(
				array(
					'field'       => 'primary_label',
					'type'        => __( 'Toggle Label', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'primary_content',
					'type'        => __( 'Toggle Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
				array(
					'field'       => 'secondary_label',
					'type'        => __( 'Toggle Secondary Label', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
				array(
					'field'       => 'secondary_content',
					'type'        => __( 'Toggle Secondary Content', 'ocean-elementor-widgets' ),
					'editor_type' => 'VISUAL'
				),
			),
		);

		$nodes_to_translate[ 'oew-woo-add-to-cart' ] = array(
			'conditions' => array( 'widgetType' => 'oew-woo-add-to-cart' ),
			'fields'     => array(
				array(
					'field'       => 'text',
					'type'        => __( 'Woo Add To Cart Text', 'ocean-elementor-widgets' ),
					'editor_type' => 'LINE'
				),
			),
		);

		return $nodes_to_translate;
	}

	/**
	 * Returns the class instance.
	 *
	 * @since 1.0.16
	 *
	 * @return Object
	 */
	public static function get_instance() {
		
		if ( null == self::$instance )
			self::$instance = new self;

		return self::$instance;
	}
}