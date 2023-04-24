<?php
namespace owpElementor\Modules\FormidableForms\Widgets;

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

class Formidable_Forms extends Widget_Base {
	public function get_name() {
		return 'oew-formidable-forms';
	}

	public function get_title() {
		return __( 'NEW Formidable Forms', 'ocean-elementor-widgets' );
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
			'formidable',
			'owp',
		);
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_formidable_forms',
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

		$this->add_control(
			'display_errors',
			array(
				'label'                => __( 'Show Error Messages', 'ocean-elementor-widgets' ),
				'type'                 => Controls_Manager::SELECT,
				'default'              => 'show',
				'options'              => array(
					'show' => __( 'Show', 'ocean-elementor-widgets' ),
					'hide' => __( 'Hide', 'ocean-elementor-widgets' ),
				),
				'selectors_dictionary' => array(
					'show' => 'block',
					'hide' => 'none',
				),
				'selectors'            => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_error_style, {{WRAPPER}} .oew-formidable-forms .frm_error' => 'display: {{VALUE}} !important;',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
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
					'{{WRAPPER}} .oew-formidable-forms .form-field label, {{WRAPPER}} .oew-formidable-forms .vertical_radio .frm_primary_label, {{WRAPPER}} .oew-formidable-forms .form-field .frm_primary_label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'labels_typo',
				'selector' => '{{WRAPPER}} .oew-formidable-forms .form-field label, {{WRAPPER}} .oew-formidable-forms .vertical_radio .frm_primary_label, {{WRAPPER}} .oew-formidable-forms .form-field .frm_primary_label',
			)
		);

		$this->add_responsive_control(
			'labels_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field label, {{WRAPPER}} .oew-formidable-forms .vertical_radio .frm_primary_label, {{WRAPPER}} .oew-formidable-forms .form-field .frm_primary_label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_control(
			'inputs_dackground',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .oew-formidable-forms .form-field textarea, {{WRAPPER}} .oew-formidable-forms .form-field select' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'inputs_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .oew-formidable-forms .form-field textarea, {{WRAPPER}} .oew-formidable-forms .form-field select' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'inputs_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .oew-formidable-forms .form-field textarea, {{WRAPPER}} .oew-formidable-forms .form-field select',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inputs_border',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .oew-formidable-forms .form-field textarea, {{WRAPPER}} .oew-formidable-forms .form-field select',
			)
		);

		$this->add_responsive_control(
			'inputs_width',
			array(
				'label'      => __( 'Input Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .oew-formidable-forms .form-field select' => 'width: {{SIZE}}{{UNIT}} !important',
				),
			)
		);

		$this->add_responsive_control(
			'inputs_height',
			array(
				'label'      => __( 'Input Height', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]), {{WRAPPER}} .oew-formidable-forms .form-field select' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'textarea_width',
			array(
				'label'      => __( 'Textarea Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field textarea' => 'width: {{SIZE}}{{UNIT}} !important',
				),
			)
		);

		$this->add_responsive_control(
			'textarea_height',
			array(
				'label'      => __( 'Textarea Height', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field textarea' => 'height: {{SIZE}}{{UNIT}}',
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

		$this->add_control(
			'inputs_background_focus',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .oew-formidable-forms .form-field textarea:focus, {{WRAPPER}} .oew-formidable-forms .form-field select:focus' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'inputs_color_focus',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .oew-formidable-forms .form-field textarea:focus, {{WRAPPER}} .oew-formidable-forms .form-field select:focus' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'inputs_border_focus',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-formidable-forms .form-field input:not([type=radio]):not([type=checkbox]):not([type=submit]):not([type=button]):not([type=image]):not([type=file]):focus, {{WRAPPER}} .oew-formidable-forms .form-field textarea:focus, {{WRAPPER}} .oew-formidable-forms .form-field select:focus',
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_placeholder_style',
			array(
				'label' => __( 'Placeholder', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'placeholder_color',
			array(
				'label'     => __( ' Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .form-field input::-webkit-input-placeholder, {{WRAPPER}} .oew-formidable-forms .form-field input::placeholder, {{WRAPPER}} .oew-formidable-forms .form-field textarea::-webkit-input-placeholder, {{WRAPPER}} .oew-formidable-forms .form-field textarea::placeholder' => 'color: {{VALUE}} !important',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_submit_button_style',
			array(
				'label' => __( 'Submit Button', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'submit_button_align',
			array(
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit' => 'display:inline-block;',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_submit_button_style' );

		$this->start_controls_tab(
			'tab_submit_button_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'submit_button_text_color_normal',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'submit_button_background_color_normal',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'submit_button_typography',
				'label'     => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit',
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'submit_button_border_normal',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit',
			)
		);

		$this->add_control(
			'submit_button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'submit_button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_submit_button_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'submit_button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'submit_button_background_color_hover',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'submit_button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_submit .frm_button_submit:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_errors_style',
			array(
				'label'     => __( 'Errors', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'display_errors' => 'show',
				),
			)
		);

		$this->add_control(
			'errors_text_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_error_style' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'errors_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_error_style' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'errors_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-formidable-forms .frm_error_style',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_confirmation_style',
			array(
				'label' => __( 'Confirmation', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'confirmation_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-formidable-forms .frm_message',
			)
		);

		$this->add_control(
			'confirmation_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_message p' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'confirmation_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-formidable-forms .frm_message' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function get_available_forms() {

		if ( ! is_formidable_forms_active() ) {
			return array();
		}

		$forms = \FrmForm::get_published_forms( array(), 999, 'exclude' );

		$result = array( __( '-- Select --', 'ocean-elementor-widgets' ) );

		if ( ! empty( $forms ) && ! is_wp_error( $forms ) ) {
			foreach ( $forms as $form ) {
				$result[ $form->id ] = $form->name;
			}
		}
		return $result;
	}

	protected function render() {
		$settings = $this->get_settings();

		$this->add_render_attribute( 'formidable-contact-form', 'class', 'oew-formidable-forms' );

		if ( class_exists( 'FrmForm' ) ) {
			if ( ! empty( $settings['form'] ) ) { ?>
				<div <?php echo $this->get_render_attribute_string( 'formidable-contact-form' ); ?>>
					<?php echo do_shortcode( '[formidable id=' . absint( $settings['form'] ) . ' ajax=true]' ); ?>
				</div>
				<?php
			} else {
				esc_html_e( 'Please choose a contact form from the dropdown list.' );
			}
		}

	}

}
