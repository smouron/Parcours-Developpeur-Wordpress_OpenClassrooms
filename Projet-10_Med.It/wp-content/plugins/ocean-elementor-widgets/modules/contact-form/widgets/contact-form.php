<?php
namespace owpElementor\Modules\ContactForm\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Contact_Form extends Widget_Base {

	public function get_name() {
		return 'oew-contact-form-7';
	}

	public function get_title() {
		return __( 'Contact Form 7', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'form',
            'contact',
            'owp',
        ];
    }

	protected function register_controls() {

		$this->start_controls_section(
			'section_contact_form_7',
			[
				'label' 		=> __( 'Form', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'form',
			[
				'label' 		=> __( 'Select Form', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '0',
				'options' 		=> $this->get_available_forms(),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Labels', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'labels_typo',
				'selector' 		=> '{{WRAPPER}} .wpcf7 label',
			]
		);

		$this->add_responsive_control(
			'labels_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'labels_alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    	=> [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-right',
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 label' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'invalid_label_heading',
			[
				'label' 		=> __( 'Not Valid Notices', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'invalid_label_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 span.wpcf7-not-valid-tip' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'invalid_label_typo',
				'selector' 		=> '{{WRAPPER}} .wpcf7 span.wpcf7-not-valid-tip',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_inputs_style',
			[
				'label' 		=> __( 'Inputs & Textarea', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_inputs_style' );

		$this->start_controls_tab(
			'tab_inputs_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'inputs_background',
				'selector' 		=> '{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)',
			]
		);

		$this->add_control(
			'inputs_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_hover',
			[
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'inputs_hover_background',
				'selector' 		=> '{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):hover',
			]
		);

		$this->add_control(
			'inputs_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_focus',
			[
				'label' => __( 'Focus', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'inputs_focus_background',
				'selector' 		=> '{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):focus',
			]
		);

		$this->add_control(
			'inputs_focus_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_focus_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio):focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'inputs_typo',
				'selector' 		=> '{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'inputs_placeholder_color',
			[
				'label' 		=> __( 'Placeholder Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form .wpcf7-form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpcf7 .wpcf7-form .wpcf7-form-control::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpcf7 .wpcf7-form .wpcf7-form-control:-ms-input-placeholder'      => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'inputs_border',
				'selector' 		=> '{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)',
			]
		);

		$this->add_control(
			'inputs_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'inputs_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)',
			]
		);

		$this->add_responsive_control(
			'inputs_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'inputs_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 .wpcf7-form-control:not(.wpcf7-submit):not(.wpcf7-checkbox):not(.wpcf7-radio)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' 		=> __( 'Submit Button', 'ocean-elementor-widgets' ),
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

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'button_background',
				'selector' 		=> '{{WRAPPER}} .wpcf7 input.wpcf7-submit',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'button_hover_background',
				'selector' 		=> '{{WRAPPER}} .wpcf7 input.wpcf7-submit:hover',
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_focus',
			[
				'label' => __( 'Focus', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     		=> 'button_focus_background',
				'selector' 		=> '{{WRAPPER}} .wpcf7 input.wpcf7-submit:focus',
			]
		);

		$this->add_control(
			'button_focus_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_focus_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typo',
				'selector' 		=> '{{WRAPPER}} .wpcf7 input.wpcf7-submit',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'selector' 		=> '{{WRAPPER}} .wpcf7 input.wpcf7-submit',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} input.wpcf7-submit',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'button_fullwidth',
			[
				'label' 		=> __( 'Fullwidth Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> '',
				'return_value' 	=> 'block',
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 input.wpcf7-submit' => 'display: {{VALUE}}; width: 100%;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_alerts_style',
			[
				'label' 		=> __( 'Alerts', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'alerts_typo',
				'selector' 		=> '{{WRAPPER}} .wpcf7 div.wpcf7-response-output',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'alerts_border',
				'selector' 		=> '{{WRAPPER}} .wpcf7 div.wpcf7-response-output',
			]
		);

		$this->add_control(
			'alerts_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-response-output' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'alerts_box_shadow',
				'selector' 		=> '{{WRAPPER}} div.wpcf7-response-output',
			]
		);

		$this->add_responsive_control(
			'alerts_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-response-output' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'alerts_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-response-output' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'alerts_alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    	=> [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-right',
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-response-output' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sent_heading',
			[
				'label' 		=> __( 'Sent Success', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'sent_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-mail-sent-ok' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sent_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-mail-sent-ok' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sent_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-mail-sent-ok' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'error_heading',
			[
				'label' 		=> __( 'Sent Error', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'error_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-mail-sent-ng' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'error_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-mail-sent-ng' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'error_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-mail-sent-ng' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'invalid_alert_heading',
			[
				'label' 		=> __( 'Not Valid', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'invalid_alert_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-validation-errors' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'invalid_alert_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-validation-errors' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'invalid_alert_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-validation-errors' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'spam_heading',
			[
				'label' 		=> __( 'Spam Blocked', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'spam_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-spam-blocked' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'spam_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-spam-blocked' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'spam_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpcf7 div.wpcf7-spam-blocked' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_forms() {

		if ( ! is_contact_form_7_active() ) {
			return array();
		}

		$forms = \WPCF7_ContactForm::find( array(
			'orderby' => 'title',
			'order'   => 'ASC',
		) );

		if ( empty( $forms ) ) {
			return array();
		}

		$result = array( __( '-- Select --', 'ocean-elementor-widgets' ) );

		foreach ( $forms as $item ) {
			$key            = sprintf( '%1$s::%2$s', $item->id(), $item->title() );
			$result[ $key ] = $item->title();
		}

		return $result;
	}

	protected function render() {
        $settings = $this->get_settings();
        
       	$form 	= $settings['form'];
		$data 	= explode( '::', $form );
        
        if ( '0' != $form && ! empty( $data ) && 2 === count( $data ) ) {
			echo do_shortcode( sprintf( '[contact-form-7 id="%1$d" title="%2$s"]', $data[0], $data[1] ) );
		}
    }

}