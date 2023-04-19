<?php
namespace owpElementor\Modules\Register\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Register extends Widget_Base {

	public function get_name() {
		return 'oew-register';
	}

	public function get_title() {
		return __( 'Register Form', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-lock-user';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'form',
            'register',
            'owp',
        ];
    }

	public function get_script_depends() {
		return [ 'recaptcha' ];
	}

	public function get_style_depends() {
		return [ 'oew-forms' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_register',
			[
				'label' 		=> __( 'Form', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label' 		=> __( 'Show Labels', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'user_label',
			[
				'label' 		=> __( 'Username', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Username', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_labels' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'email_label',
			[
				'label' 		=> __( 'Email', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Email Address', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_labels' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'placeholder_heading',
			[
				'label' 		=> __( 'Placeholders', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_placeholders',
			[
				'label' 		=> __( 'Show Placeholders', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'user_placeholder',
			[
				'label' 		=> __( 'Username', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Username', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_placeholders' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'email_placeholder',
			[
				'label' 		=> __( 'Email', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Email Address', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_placeholders' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'text_heading',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'form_text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Registration confirmation will be emailed to you.', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'submit_heading',
			[
				'label' 		=> __( 'Submit Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'submit_text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Register', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'login_heading',
			[
				'label' 		=> __( 'Login Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_login',
			[
				'label' 		=> __( 'Show Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'login_text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Back to the Login Page', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'login_link',
			[
				'label'   		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'privacy_policy_heading',
			[
				'label' 		=> __( 'Privacy Policy Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'privacy_policy_text',
			[
				'type' 		=> Controls_Manager::RAW_HTML,
				'raw'  		=> sprintf(
					__( 'Select your Privacy Policy page in the %1$sPrivacy Settings%2$s', 'ocean-elementor-widgets' ),
					'<a href="' . esc_url( admin_url( 'privacy.php' ) ) . '" target="_blank">',
					'</a>'
				),
			]
		);

		$this->add_control(
			'show_privacy_policy',
			[
				'label' 		=> __( 'Show Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_register_recaptcha',
			[
				'label' 		=> __( 'reCAPTCHA', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
		'set_key',
			[
				'type' 		=> Controls_Manager::RAW_HTML,
				'raw'  		=> sprintf(
					__( 'To display a Google reCAPTCHA you just need to set your Site & Secret Key on the %1$ssettings page%2$s', 'ocean-elementor-widgets' ),
					'<a href="' . add_query_arg( array( 'page' => 'oceanwp-panel&tab=integrations#recaptcha', ), esc_url( admin_url( 'admin.php' ) ) ) . '" target="_blank">',
					'</a>'
				),
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_register_content',
			[
				'label' 		=> __( 'Additional Options', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'redirect_after_register',
			[
				'label' 		=> __( 'Redirect After Login', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'off',
			]
		);

		$this->add_control(
			'redirect_url',
			[
				'type' 			=> Controls_Manager::URL,
				'show_label' 	=> false,
				'show_external' => false,
				'separator' 	=> false,
				'placeholder' 	=> 'http://your-link.com/',
				'description' 	=> __( 'Note: Because of security reasons, you can ONLY use your current domain here.', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'redirect_after_register' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_logged_in_message',
			[
				'label' 		=> __( 'Logged in Message', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_off' 	=> __( 'Hide', 'ocean-elementor-widgets' ),
				'label_on' 		=> __( 'Show', 'ocean-elementor-widgets' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
			[
				'label' 		=> __( 'Labels', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'labels_typo',
				'selector' 		=> '{{WRAPPER}} .oew-form label',
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'labels_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form label' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'labels_text_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-form label',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_fields_style',
			[
				'label' 		=> __( 'Fields', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_fields_style' );

		$this->start_controls_tab(
			'tab_fields_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'fields_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_fields_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'fields_hover_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_fields_focus',
			[
				'label' 		=> __( 'Focus', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'fields_focus_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input:focus' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_focus_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'fields_focus_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'fields_placeholder_color',
			[
				'label' 		=> __( 'Placeholder Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-form .oew-input::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-form .oew-input:-ms-input-placeholder'      => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'fields_typo',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-input',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'fields_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-input',
			]
		);

		$this->add_responsive_control(
			'fields_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'fields_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'fields_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-input',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_text_style',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} #reg_passmail' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'text_typo',
				'selector' 		=> '{{WRAPPER}} #reg_passmail',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' 		=> __( 'Button', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'button_hover_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typo',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-buttons .oew-button',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-buttons .oew-button',
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-buttons .oew-button',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_style',
			[
				'label' 		=> __( 'Login Link', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_link_style' );

		$this->start_controls_tab(
			'tab_link_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-link a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_link_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-link a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'link_typo',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-link a',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_privacy_link_style',
			[
				'label' 		=> __( 'Privacy Policy', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_privacy_link_style' );

		$this->start_controls_tab(
			'tab_privacy_link_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'privacy_link_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-privacy a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_privacy_link_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'privacy_link_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-privacy a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'privacy_link_typo',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-privacy a',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 				= $this->get_settings_for_display();
		$current_url 			= remove_query_arg( 'fake_arg' );
		$show_login 			= 'yes' === $settings['show_login'];
		$show_privacy_policy 	= 'yes' === $settings['show_privacy_policy'];

		if ( 'yes' === $settings['redirect_after_register'] && ! empty( $settings['redirect_url']['url'] ) ) {
			$redirect_url = $settings['redirect_url']['url'];
		} else {
			$redirect_url = $current_url;
		}

		if ( is_user_logged_in() && ! \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			if ( 'yes' === $settings['show_logged_in_message'] ) {
				$current_user = wp_get_current_user();

				echo '<div class="oew-login">' .
					sprintf( __( 'You are Logged in as %1$s (<a href="%2$s">Logout</a>)', 'ocean-elementor-widgets' ), $current_user->display_name, wp_logout_url( $current_url ) ) .
					'</div>';
			}

			return;
		}

		if ( ! get_option( 'users_can_register' ) && ! \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
			echo '<div class="oew-login">' . __( 'User registration is currently not allowed. Check the "Anyone can register" setting in Settings > General of your WordPress dashboard.', 'ocean-elementor-widgets' ) .
					'</div>';

			return;
		}

		// Fields
		$this->add_render_attribute( 'user_label', 'for', 'oew_user_log' );
		$this->add_render_attribute( 'user_input', [
			'type'	=> 'text',
			'name'	=> 'user_login',
			'id'	=> 'oew_user_log',
			'class' => [
				'oew-username',
				'oew-input',
			],
		] );

		$this->add_render_attribute( 'email_label', 'for', 'oew_user_email' );
		$this->add_render_attribute( 'email_input', [
			'type'	=> 'text',
			'name'	=> 'user_email',
			'id'	=> 'oew_user_email',
			'class' => [
				'oew-email',
				'oew-input',
			],
		] );

		// Placeholders
		if ( $settings['show_placeholders'] ) {
			$this->add_render_attribute( 'user_input', 'placeholder', $settings['user_placeholder'] );
			$this->add_render_attribute( 'email_input', 'placeholder', $settings['email_placeholder'] );
		}

		// Login link
		if ( ! empty( $settings['login_link']['url'] ) ) {
			$this->add_render_attribute( 'login_link', 'href', $settings['login_link']['url'] );

			if ( $settings['login_link']['is_external'] ) {
				$this->add_render_attribute( 'login_link', 'target', '_blank' );
			}

			if ( $settings['login_link']['nofollow'] ) {
				$this->add_render_attribute( 'login_link', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'login_link', 'href', wp_login_url( $redirect_url ) );
		}

		// Register/login
		$this->add_render_attribute( 'buttons', [
			'class' => [
				'oew-buttons',
				'clr',
			],
		] );

		$this->add_render_attribute( 'submit', 'class', 'oew-submit' ); ?>

		<form class="oew-form" method="post" action="<?php echo wp_registration_url(); ?>">
			<p class="oew-username">
				<?php
				if ( $settings['show_labels'] ) {
					echo '<label ' . $this->get_render_attribute_string( 'user_label' ) . '>' . $settings['user_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string( 'user_input' ) . ' size="1">'; ?>
			</p>

			<p class="oew-email">
				<?php
				if ( $settings['show_labels'] ) {
					echo '<label ' . $this->get_render_attribute_string( 'email_label' ) . '>' . $settings['email_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string( 'email_input' ) . ' size="1">'; ?>
			</p>

			<?php do_action( 'register_form' ); ?>

			<p id="reg_passmail"><?php echo $settings['form_text']; ?></p>

			<div <?php echo $this->get_render_attribute_string( 'buttons' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'submit' ); ?>>
					<input type="submit" class="oew-button" value="<?php echo esc_attr( $settings['submit_text'] ); ?>"/>
				</div>
			</div>

			<?php
			if ( $show_login ) {
				echo '<div class="oew-link">';
					echo '<a ' . $this->get_render_attribute_string( 'login_link' ) . '>'. $settings['login_text'] .'</a>';
				echo '</div>';
			} ?>

			<?php
			if ( $show_privacy_policy && function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '<div class="oew-privacy">', '</div>' );
			} ?>

			<input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect_url ); ?>" />
		</form>

	<?php
	}

	protected function content_template() { ?>
		<#
		view.addRenderAttribute( 'user_input', {
			'type'	: 'text',
			'name'	: 'user_login',
			'id'	: 'oew_user_log',
			'class'	: [ 'oew-username', 'oew-input' ]
		} );

		view.addRenderAttribute( 'email_input', {
			'type'	: 'text',
			'name'	: 'user_email',
			'id'	: 'oew_user_email',
			'class'	: [ 'oew-email', 'oew-input' ]
		} );

		// Placeholders
		if ( settings.show_placeholders ) {
			view.addRenderAttribute( 'user_input', 'placeholder', settings.user_placeholder );
			view.addRenderAttribute( 'email_input', 'placeholder', settings.email_placeholder );
		}

		if ( settings.show_message ) { #>
			<p class="oew-form-message">{{{ settings.message }}}</p>
		<# } #>

		<form class="oew-form" method="post" action="">
			<p class="oew-username">
				<# if ( settings.show_labels ) { #>
					<label for="oew_user_log" >{{{ settings.user_label }}}</label>
				<# } #>
				<input {{{ view.getRenderAttributeString( 'user_input' ) }}} size="1">
			</p>

			<p class="oew-email">
				<# if ( settings.show_labels ) { #>
					<label for="oew_user_email" >{{{ settings.user_email }}}</label>
				<# } #>
				<input {{{ view.getRenderAttributeString( 'email_input' ) }}} size="1">
			</p>

			<?php do_action( 'register_form' ); ?>

			<p id="reg_passmail">{{{ settings.form_text }}}</p>

			<div class="oew-buttons clr">
				<div class="oew-submit">
					<input type="submit" class="oew-button" value="{{{ settings.submit_text }}}"/>
				</div>
			</div>

			<# if ( settings.show_login ) { #>
				<div class="oew-link">
					<a href="<?php echo wp_login_url(); ?>">{{{ settings.login_text }}}</a>
				</div>
			<# } #>

			<# if ( settings.show_privacy_policy ) { #>
				<?php
				if ( function_exists( 'the_privacy_policy_link' ) ) {
					the_privacy_policy_link( '<div class="oew-privacy">', '</div>' );
				} ?>
			<# } #>
		</form>
	<?php
	}

}