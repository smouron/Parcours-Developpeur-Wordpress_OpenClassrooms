<?php
namespace owpElementor\Modules\WPForms\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class WPForms extends Widget_Base {

	public function get_name() {
		return 'oew-wpforms';
	}

	public function get_title() {
		return __( 'WPForms', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_wpforms',
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

		$this->add_control(
			'hide_form_title_description',
			[
				'label' 		=> __( 'Hide Title & Description', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
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
					'{{WRAPPER}} .wpforms-field label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'labels_typo',
				'selector' 		=> '{{WRAPPER}} .wpforms-field label',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'labels_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label' 		=> __( 'Description', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-form .wpforms-field-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typo',
				'selector' 		=> '{{WRAPPER}} .wpforms-form .wpforms-field-description',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-form .wpforms-field-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
				'selector' 		=> '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
			]
		);

		$this->add_control(
			'inputs_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'color: {{VALUE}};',
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
				'selector' 		=> '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .wpforms-field textarea:hover, {{WRAPPER}} .wpforms-field select:hover',
			]
		);

		$this->add_control(
			'inputs_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .wpforms-field textarea:hover, {{WRAPPER}} .wpforms-field select:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):hover, {{WRAPPER}} .wpforms-field textarea:hover, {{WRAPPER}} .wpforms-field select:hover' => 'border-color: {{VALUE}};',
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
				'selector' 		=> '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .wpforms-field textarea:focus, {{WRAPPER}} .wpforms-field select:focus',
			]
		);

		$this->add_control(
			'inputs_focus_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .wpforms-field textarea:focus, {{WRAPPER}} .wpforms-field select:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'inputs_focus_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .wpforms-field textarea:focus, {{WRAPPER}} .wpforms-field select:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'inputs_typo',
				'selector' 		=> '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'inputs_placeholder_color',
			[
				'label' 		=> __( 'Placeholder Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpforms-field input::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpforms-field input:-ms-input-placeholder'      => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpforms-field textarea::-webkit-input-placeholder' => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpforms-field textarea::-moz-placeholder'          => 'color: {{VALUE}}',
					'{{WRAPPER}} .wpforms-field textarea:-ms-input-placeholder'      => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'inputs_border',
				'selector' 		=> '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
			]
		);

		$this->add_control(
			'inputs_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'inputs_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select',
			]
		);

		$this->add_responsive_control(
			'inputs_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};height: auto;',
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
					'{{WRAPPER}} .wpforms-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .wpforms-field textarea, {{WRAPPER}} .wpforms-field select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'invalid_inputs_heading',
			[
				'label' 		=> __( 'Not Valid Input', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'wpforms_invalid_inputs_border_color',
			[
				'label' 		=> __( 'Input Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-form .wpforms-field input.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field textarea.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field select.wpforms-error' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'invalid_inputs_border',
				'selector' 		=> '{{WRAPPER}} .wpforms-form .wpforms-field input.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field textarea.wpforms-error, {{WRAPPER}} .wpforms-form .wpforms-field select.wpforms-error',
			]
		);

		$this->add_control(
			'invalid_inputs_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-form label.wpforms-error' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'invalid_inputs_typo',
				'selector' 		=> '{{WRAPPER}} .wpforms-form label.wpforms-error',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
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
				'selector' 		=> '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'color: {{VALUE}};',
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
				'selector' 		=> '{{WRAPPER}} .wpforms-submit-container .wpforms-submit:hover',
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:hover' => 'border-color: {{VALUE}};',
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
				'selector' 		=> '{{WRAPPER}} .wpforms-submit-container .wpforms-submit:focus',
			]
		);

		$this->add_control(
			'button_focus_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_focus_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'button_typo',
				'selector' 		=> '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'selector' 		=> '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .wpforms-submit-container .wpforms-submit',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .wpforms-submit-container .wpforms-submit' => 'display: {{VALUE}}; width: 100%;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_success_message_style',
			[
				'label' 		=> __( 'Success Message', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'sent_typo',
				'selector' 		=> '{{WRAPPER}} .wpforms-confirmation-container-full',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'sent_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-confirmation-container-full' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sent_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-confirmation-container-full' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'sent_border',
				'selector' 		=> '{{WRAPPER}} .wpforms-confirmation-container-full',
			]
		);

		$this->add_control(
			'sent_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-confirmation-container-full' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'sent_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .wpforms-confirmation-container-full' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_forms() {

		if ( ! is_wpforms_active() ) {
			return array();
		}

		$args = array(
            'post_type'         => 'wpforms',
            'posts_per_page'    => -1
        );

        $forms = get_posts( $args );

        $result = array( __( '-- Select --', 'ocean-elementor-widgets' ) );

        if ( ! empty( $forms ) && ! is_wp_error( $forms ) ) {
            foreach ( $forms as $form ) {	
                $result[ $form->ID ] = $form->post_title;
            }
        }

        return $result;
	}

	protected function render() {
        $settings = $this->get_settings();
       	$form = $settings['form'];

    	if ( 'yes' == $settings['hide_form_title_description'] ) {
            $form_title = false;
            $form_description = false;
        } else {
        	$form_title = true;
            $form_description = true;
        }
        
        if ( '0' != $form && ! empty( $form ) ) {
			echo wpforms_display( $form, $form_title, $form_description );
		}
    }

}