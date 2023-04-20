<?php
namespace owpElementor\Modules\Login\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Login extends Widget_Base {

	public function get_name() {
		return 'oew-login';
	}

	public function get_title() {
		return __( 'Login Form', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-lock-user';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_style_depends() {
		return [ 'oew-forms' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_login',
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
				'default'		=> __( 'Username or Email', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_labels' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'pass_label',
			[
				'label' 		=> __( 'Password', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Password', 'ocean-elementor-widgets' ),
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
				'default'		=> __( 'Username or Email Address', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_placeholders' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'pass_placeholder',
			[
				'label' 		=> __( 'Password', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Password', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_placeholders' => 'yes'
				],
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
				'default'		=> __( 'Log In', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'register_heading',
			[
				'label' 		=> __( 'Register Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		if ( get_option( 'users_can_register' ) ) {

			$this->add_control(
				'show_register',
				[
					'label' 	=> __( 'Show Button', 'ocean-elementor-widgets' ),
					'type' 		=> Controls_Manager::SWITCHER,
					'default' 	=> 'yes',
				]
			);

			$this->add_control(
				'register_text',
				[
					'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
					'type'			=> Controls_Manager::TEXT,
					'default'		=> __( 'Register', 'ocean-elementor-widgets' ),
					'condition'		=> [
						'show_register' => 'yes'
					],
					'dynamic' 		=> [ 'active' => true ],
				]
			);

			$this->add_control(
				'register_link',
				[
					'label'   		=> __( 'Link', 'ocean-elementor-widgets' ),
					'type'    		=> Controls_Manager::URL,
					'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
					'condition'		=> [
						'show_register' => 'yes'
					]
				]
			);

		} else {

			$this->add_control(
			'register_disabled',
				[
					'type' 		=> Controls_Manager::RAW_HTML,
					'raw'  		=> sprintf(
						__( 'To display the Register button, you need to enable registration on your site via Settings > General, check the %1$sAnyone can register%2$s field.', 'ocean-elementor-widgets' ),
						'<strong>',
						'</strong>'
					),
				]
			);
			
		}

		$this->add_control(
			'lost_password_heading',
			[
				'label' 		=> __( 'Lost Password Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'show_lost_password',
			[
				'label' 		=> __( 'Show Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'lost_password_text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( 'Forgot your password?', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_lost_password' => 'yes'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'lost_password_link',
			[
				'label'   		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'show_lost_password' => 'yes'
				]
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
			'section_login_content',
			[
				'label' 		=> __( 'Additional Options', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'redirect_after_login',
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
					'redirect_after_login' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_remember_me',
			[
				'label' 		=> __( 'Remember Me', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_off' 	=> __( 'Hide', 'ocean-elementor-widgets' ),
				'label_on' 		=> __( 'Show', 'ocean-elementor-widgets' ),
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
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
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
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
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
			'section_buttons_style',
			[
				'label' 		=> __( 'Buttons', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'buttons_typo',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-buttons .oew-button',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'buttons_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-buttons .oew-button',
			]
		);

		$this->add_responsive_control(
			'buttons_border_radius',
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
			'buttons_padding',
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
				'name' 			=> 'buttons_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-form .oew-buttons .oew-button',
			]
		);

		$this->add_control(
			'login_button_heading',
			[
				'label' 		=> __( 'Login Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_login_button_style' );

		$this->start_controls_tab(
			'tab_login_button_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'login_button_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_login_button_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'login_button_hover_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-submit .oew-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'login_button_hover_border_color',
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

		$this->add_control(
			'register_button_heading',
			[
				'label' 		=> __( 'Register Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_register_button_style' );

		$this->start_controls_tab(
			'tab_register_button_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'register_button_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-register .oew-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-register .oew-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-register .oew-button' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_register_button_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'register_button_hover_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-register .oew-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-register .oew-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'register_button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-form .oew-buttons .oew-register .oew-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_link_style',
			[
				'label' 		=> __( 'Forgot password', 'ocean-elementor-widgets' ),
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
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
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
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 				= $this->get_settings_for_display();
		$current_url 			= remove_query_arg( 'fake_arg' );
		$show_lost_password 	= 'yes' === $settings['show_lost_password'];
		$show_privacy_policy 	= 'yes' === $settings['show_privacy_policy'];
		$show_register 			= get_option( 'users_can_register' ) && 'yes' === $settings['show_register'];

		if ( 'yes' === $settings['redirect_after_login'] && ! empty( $settings['redirect_url']['url'] ) ) {
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

		// Fields
		$this->add_render_attribute( 'user_label', 'for', 'oew_user_login' );
		$this->add_render_attribute( 'user_input', [
			'type'	=> 'text',
			'name'	=> 'log',
			'id'	=> 'oew_user_login',
			'class' => [
				'oew-username',
				'oew-input',
			],
		] );

		$this->add_render_attribute( 'pass_label', 'for', 'oew_user_pass' );
		$this->add_render_attribute( 'pass_input', [
			'type'	=> 'password',
			'name'	=> 'pwd',
			'id'	=> 'oew_user_pass',
			'class' => [
				'oew-password',
				'oew-input',
			],
		] );

		// Placeholders
		if ( $settings['show_placeholders'] ) {
			$this->add_render_attribute( 'user_input', 'placeholder', $settings['user_placeholder'] );
			$this->add_render_attribute( 'pass_input', 'placeholder', $settings['pass_placeholder'] );
		}

		// Lost password link
		if ( ! empty( $settings['lost_password_link']['url'] ) ) {
			$this->add_render_attribute( 'lost_password_link', 'href', $settings['lost_password_link']['url'] );

			if ( $settings['lost_password_link']['is_external'] ) {
				$this->add_render_attribute( 'lost_password_link', 'target', '_blank' );
			}

			if ( $settings['lost_password_link']['nofollow'] ) {
				$this->add_render_attribute( 'lost_password_link', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'lost_password_link', 'href', wp_lostpassword_url( $redirect_url ) );
		}

		// Register link
		$this->add_render_attribute( 'register_link', 'class', 'oew-button' );

		if ( ! empty( $settings['register_link']['url'] ) ) {
			$this->add_render_attribute( 'register_link', 'href', $settings['register_link']['url'] );

			if ( $settings['register_link']['is_external'] ) {
				$this->add_render_attribute( 'register_link', 'target', '_blank' );
			}

			if ( $settings['register_link']['nofollow'] ) {
				$this->add_render_attribute( 'register_link', 'rel', 'nofollow' );
			}
		} else {
			$this->add_render_attribute( 'register_link', 'href', wp_registration_url() );
		}

		// Register/login
		$this->add_render_attribute( 'buttons', [
			'class' => [
				'oew-buttons',
				'clr',
			],
		] );
		
		if ( $show_register ) {
			$this->add_render_attribute( 'buttons', 'class', 'oew-has-register' );
		}

		$this->add_render_attribute( 'submit', 'class', 'oew-submit' );
		$this->add_render_attribute( 'register', 'class', 'oew-register' );

		if ( $show_register ) {
			$this->add_render_attribute( 'submit', 'class', 'oew-left' );
			$this->add_render_attribute( 'register', 'class', 'oew-right' );
		} ?>

		<form class="oew-form" method="post" action="<?php echo esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>">
			<p class="oew-username">
				<?php
				if ( $settings['show_labels'] ) {
					echo '<label ' . $this->get_render_attribute_string( 'user_label' ) . '>' . $settings['user_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string( 'user_input' ) . ' size="1">'; ?>
			</p>

			<p class="oew-password">
				<?php
				if ( $settings['show_labels'] ) {
					echo '<label ' . $this->get_render_attribute_string( 'pass_label' ) . '>' . $settings['pass_label'] . '</label>';
				}

				echo '<input ' . $this->get_render_attribute_string( 'pass_input' ) . ' size="1">'; ?>
			</p>

			<?php
			if ( $settings['show_remember_me'] ) { ?>
				<p class="oew-remember">
					<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember Me', 'ocean-elementor-widgets' ); ?></label>
				</p>
			<?php
			} ?>

			<div <?php echo $this->get_render_attribute_string( 'buttons' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'submit' ); ?>>
					<input type="submit" class="oew-button" value="<?php echo esc_attr( $settings['submit_text'] ); ?>"/>
				</div>

				<?php
				if ( $show_register ) {
					echo '<div ' . $this->get_render_attribute_string( 'register' ) . '>';
						echo '<a ' . $this->get_render_attribute_string( 'register_link' ) . '>'. $settings['register_text'] .'</a>';
					echo '</div>';
				} ?>
			</div>

			<?php do_action( 'login_form' ); ?>

			<?php
			if ( $show_lost_password ) {
				echo '<div class="oew-link">';
					echo '<a ' . $this->get_render_attribute_string( 'lost_password_link' ) . '>'. $settings['lost_password_text'] .'</a>';
				echo '</div>';
			} ?>

			<?php
			if ( $show_privacy_policy && function_exists( 'the_privacy_policy_link' ) ) {
				the_privacy_policy_link( '<div class="oew-privacy">', '</div>' );
			} ?>

			<input type="hidden" name="redirect_to" value="<?php echo esc_url( $redirect_url ); ?>" />
			<input type="hidden" name="action" value="login" />
		</form>

	<?php
	}

	protected function _content_template() { ?>
		<#
		view.addRenderAttribute( 'user_input', {
			'type'	: 'text',
			'name'	: 'log',
			'id'	: 'oew_user_login',
			'class'	: [ 'oew-username', 'oew-input' ]
		} );

		view.addRenderAttribute( 'pass_input', {
			'type'	: 'password',
			'name'	: 'pwd',
			'id'	: 'oew_user_pass',
			'class'	: [ 'oew-password', 'oew-input' ]
		} );

		// Placeholders
		if ( settings.show_placeholders ) {
			view.addRenderAttribute( 'user_input', 'placeholder', settings.user_placeholder );
			view.addRenderAttribute( 'pass_input', 'placeholder', settings.pass_placeholder );
		}

		view.addRenderAttribute( 'buttons', 'class', [ 'oew-buttons', 'clr' ] );

		if ( settings.show_register ) {
			view.addRenderAttribute( 'buttons', 'class', 'oew-has-register' );
		}

		view.addRenderAttribute( 'submit', 'class', 'oew-submit' );
		view.addRenderAttribute( 'register', 'class', 'oew-register' );

		if ( settings.show_register ) {
			view.addRenderAttribute( 'submit', 'class', 'oew-left' );
			view.addRenderAttribute( 'register', 'class', 'oew-right' );
		} #>

		<form class="oew-form" method="post" action="">
			<p class="oew-username">
				<# if ( settings.show_labels ) { #>
					<label for="oew_user_login" >{{{ settings.user_label }}}</label>
				<# } #>
				<input {{{ view.getRenderAttributeString( 'user_input' ) }}} size="1">
			</p>

			<p class="oew-password">
				<# if ( settings.show_labels ) { #>
					<label for="oew_user_pass" >{{{ settings.pass_label }}}</label>
				<# } #>
				<input {{{ view.getRenderAttributeString( 'pass_input' ) }}} size="1">
			</p>

			<# if ( settings.show_remember_me ) { #>
				<p class="oew-remember">
					<label><input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember Me', 'ocean-elementor-widgets' ); ?></label>
				</p>
			<# } #>

			<?php do_action( 'login_form' ); ?>

			<div {{{ view.getRenderAttributeString( 'buttons' ) }}}>
				<div {{{ view.getRenderAttributeString( 'submit' ) }}}>
					<input type="submit" class="oew-button" value="{{{ settings.submit_text }}}"/>
				</div>

				<# if ( settings.show_register ) { #>
					<div {{{ view.getRenderAttributeString( 'register' ) }}}>
						<a class="oew-button" href="<?php echo wp_registration_url(); ?>">{{{ settings.register_text }}}</a>
					</div>
				<# } #>
			</div>

			<# if ( settings.show_lost_password ) { #>
				<div class="oew-link">
					<a href="<?php echo wp_lostpassword_url(); ?>">{{{ settings.lost_password_text }}}</a>
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