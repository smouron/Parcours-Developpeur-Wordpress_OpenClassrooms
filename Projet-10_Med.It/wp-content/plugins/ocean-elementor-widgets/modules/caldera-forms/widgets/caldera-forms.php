<?php
namespace owpElementor\Modules\CalderaForms\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Caldera_Forms extends Widget_Base {

	public function get_name() {
		return 'oew-caldera-forms';
	}

	public function get_title() {
		return __( 'Caldera Forms', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-form-horizontal';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'form',
			'contact',
			'caldera',
			'owp',
		);
	}

	public function show_in_panel() {
		return false;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_caldera_forms',
			array(
				'label' => __( 'Form', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'form',
			array(
				'label'   => __( 'Select Form', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '0',
				'options' => $this->get_available_forms(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Labels', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'labels_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'labels_typo',
				'selector' => '{{WRAPPER}} .caldera-grid label',
			)
		);

		$this->add_responsive_control(
			'labels_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'description_heading',
			array(
				'label'     => __( 'Description', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .help-block' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typo',
				'selector' => '{{WRAPPER}} .caldera-grid .help-block',
			)
		);

		$this->add_responsive_control(
			'description_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid .help-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_inputs_style',
			array(
				'label' => __( 'Inputs & Textarea', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_inputs_style' );

		$this->start_controls_tab(
			'tab_inputs_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inputs_background',
				'selector' => '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
			)
		);

		$this->add_control(
			'inputs_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inputs_hover_background',
				'selector' => '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover',
			)
		);

		$this->add_control(
			'inputs_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'inputs_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_inputs_focus',
			array(
				'label' => __( 'Focus', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'inputs_focus_background',
				'selector' => '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus',
			)
		);

		$this->add_control(
			'inputs_focus_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'inputs_focus_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"]):focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'inputs_typo',
				'selector'  => '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'inputs_placeholder_color',
			array(
				'label'     => __( 'Placeholder Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .form-control::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .caldera-grid .form-control::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .caldera-grid .form-control:-ms-input-placeholder'      => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inputs_border',
				'selector' => '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
			)
		);

		$this->add_control(
			'inputs_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'inputs_box_shadow',
				'selector' => '{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])',
			)
		);

		$this->add_responsive_control(
			'inputs_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'inputs_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid .form-control:not([type="button"]):not([type="checkbox"]):not([type="radio"])' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => __( 'Submit Button', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_background',
				'selector' => '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_hover_background',
				'selector' => '{{WRAPPER}} .caldera-grid input[type=reset]:hover, .caldera-grid input[type=submit]:hover',
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid input[type=reset]:hover, .caldera-grid input[type=submit]:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid input[type=reset]:hover, .caldera-grid input[type=submit]:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_focus',
			array(
				'label' => __( 'Focus', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'button_focus_background',
				'selector' => '{{WRAPPER}} .caldera-grid input[type=reset]:focus, .caldera-grid input[type=submit]:focus',
			)
		);

		$this->add_control(
			'button_focus_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid input[type=reset]:focus, .caldera-grid input[type=submit]:focus' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_focus_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid input[type=reset]:focus, .caldera-grid input[type=submit]:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typo',
				'selector'  => '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'button_border',
				'selector' => '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]',
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_fullwidth',
			array(
				'label'        => __( 'Fullwidth Button', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'return_value' => 'block',
				'selectors'    => array(
					'{{WRAPPER}} .caldera-grid input[type=reset], .caldera-grid input[type=submit]' => 'display: {{VALUE}}; width: 100%;',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_alerts_style',
			array(
				'label' => __( 'Alerts', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'alerts_typo',
				'selector' => '{{WRAPPER}} .caldera-grid .alert-success, {{WRAPPER}} .has-error .help-block',
			)
		);

		$this->add_control(
			'sent_heading',
			array(
				'label'     => __( 'Success Message', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'sent_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .alert-success' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'sent_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .caldera-grid .alert-success' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'sent_border',
				'selector' => '{{WRAPPER}} .caldera-grid .alert-success',
			)
		);

		$this->add_control(
			'sent_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid .alert-success' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'sent_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .caldera-grid .alert-success' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'error_alert_heading',
			array(
				'label'     => __( 'Error Messages', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'error_alert_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .has-error .help-block' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function get_available_forms() {

		if ( ! is_caldera_forms_active() ) {
			return array();
		}

		$forms = \Caldera_Forms_Forms::get_forms( true, true );

		$result = array( __( '-- Select --', 'ocean-elementor-widgets' ) );

		if ( ! empty( $forms ) && ! is_wp_error( $forms ) ) {
			foreach ( $forms as $form ) {
				$result[ $form['ID'] ] = $form['name'];
			}
		}

		return $result;
	}

	protected function render() {
		$settings = $this->get_settings();
		$form     = $settings['form'];

		if ( '0' != $form && ! empty( $form ) ) {
			echo do_shortcode( '[caldera_form id="' . $form . '"]' );
		}
	}

}
