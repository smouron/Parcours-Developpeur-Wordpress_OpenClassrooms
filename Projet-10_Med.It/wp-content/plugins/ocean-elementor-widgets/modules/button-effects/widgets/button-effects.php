<?php
namespace owpElementor\Modules\ButtonEffects\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ButtonEffects extends Widget_Base {

	public function get_name() {
		return 'oew-button-effects';
	}

	public function get_title() {
		return __( 'Button Effects', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-button';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'button',
            'effect',
            'owp',
        ];
    }

	public function get_style_depends() {
		global $settings;
        if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() && ! \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
			$settings = $this->get_settings();
		}

		$button_effect = null;
		if(isset($settings['effect'])) {
			$button_effect = $settings['effect'];
		}

		return [ 'oew-button-effects', 'oew-'. $button_effect ];

	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_button_effects',
			[
				'label' 		=> __( 'Button Effects', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Click me', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Click me', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default' 		=> [
					'url' => '#',
				],
			]
		);

        $this->add_control(
            'effect',
            [
                'label' 		=> __( 'Effect', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
                   'btn-effect-1'  => __( 'Radius Effect', 'ocean-elementor-widgets' ),
                   'btn-effect-2'  => __( 'Text Reveal Bottom', 'ocean-elementor-widgets' ),
                   'btn-effect-3'  => __( 'Text Reveal Left', 'ocean-elementor-widgets' ),
                   'btn-effect-4'  => __( 'Text Reveal Corner', 'ocean-elementor-widgets' ),
                   'btn-effect-5'  => __( 'Jello', 'ocean-elementor-widgets' ),
                   'btn-effect-6'  => __( 'Vertical Background Slide', 'ocean-elementor-widgets' ),
                   'btn-effect-7'  => __( 'Horizontal Background Slide', 'ocean-elementor-widgets' ),
                   'btn-effect-8'  => __( 'Left Background Slide', 'ocean-elementor-widgets' ),
                   'btn-effect-9'  => __( 'Rectangle Effect', 'ocean-elementor-widgets' ),
                   'btn-effect-10' => __( 'Cross Effect', 'ocean-elementor-widgets' ),
                   'btn-effect-11' => __( 'Panel Background', 'ocean-elementor-widgets' ),
                   'btn-effect-12' => __( 'Pyramid Background', 'ocean-elementor-widgets' ),
                   'btn-effect-13' => __( 'Scale In Background', 'ocean-elementor-widgets' ),
                   'btn-effect-14' => __( 'Scale Out Background', 'ocean-elementor-widgets' ),
                   'btn-effect-15' => __( 'Slide Up Background', 'ocean-elementor-widgets' ),
                   'btn-effect-16' => __( 'Slide Left Background', 'ocean-elementor-widgets' ),
                   'btn-effect-17' => __( 'Slide Top/Left Corner Background', 'ocean-elementor-widgets' ),
                   'btn-effect-18' => __( 'Slide Bottom/Right Corner Background', 'ocean-elementor-widgets' ),
                   'btn-effect-19' => __( 'Slide Top/Bottom Corner Background', 'ocean-elementor-widgets' ),
                   'btn-effect-20' => __( 'Slide Top Left/Right Corner Background', 'ocean-elementor-widgets' ),
                   'btn-effect-21' => __( 'Lighting Up Background', 'ocean-elementor-widgets' ),
                   'btn-effect-22' => __( 'Lighting Left Background', 'ocean-elementor-widgets' ),
                   'btn-effect-23' => __( 'Lighting Corner Background', 'ocean-elementor-widgets' ),
                   'btn-effect-24' => __( 'Double Lighting Up Background', 'ocean-elementor-widgets' ),
                   'btn-effect-25' => __( 'Double Lighting Left Background', 'ocean-elementor-widgets' ),
                   'btn-effect-26' => __( 'Double Lighting Corner Background', 'ocean-elementor-widgets' ),
                   'btn-effect-27' => __( 'Border Bottom Effect', 'ocean-elementor-widgets' ),
                   'btn-effect-28' => __( 'Border Top/Bottom Effect', 'ocean-elementor-widgets' ),
                   'btn-effect-29' => __( 'Borders Cross Effect', 'ocean-elementor-widgets' ),
                   'btn-effect-30' => __( 'Borders Center Effect', 'ocean-elementor-widgets' ),
                ],
                'default' 		=> 'btn-effect-1',
            ]
        );

		$this->add_responsive_control(
			'align',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-justify',
					],
				],
				'default' 		=> '',
				'prefix_class' => 'oew%s-align-',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICONS,
				'label_block' 	=> true,
				'default'		=> [
					'value'   => '',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' 		=> __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'left',
				'options' 		=> [
					'left' => __( 'Before', 'ocean-elementor-widgets' ),
					'right' => __( 'After', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' 		=> __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-button .oew-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Button', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography',
				'selector' 		=> '{{WRAPPER}} .oew-button a',
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
			'background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button a' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-10 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-10 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-11 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-11 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-13 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-14 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-28 a::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-btn-effect-29 a' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-29 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-29 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-30 a' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-30 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-30 a::after' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'btn-effect-29', 'btn-effect-30' ],
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-6 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-7 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-8 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-10 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-10 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-11 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-11 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-13 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-14 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-28 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'effect!' => [ 'btn-effect-29', 'btn-effect-30' ],
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
			'button_background_hover_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-btn-effect-1 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-2 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-3 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-4 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-5 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-6 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-7 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-8 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-9 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-10 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-10 a:hover::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-11 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-11 a:hover::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-12 a::before' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-12 a::after' => 'border-bottom-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-13 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-14 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-15 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-15 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-16 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-16 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-17 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-17 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-18 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-18 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-19 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-19 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-20 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-20 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-21 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-22 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-23 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-24 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-24 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-25 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-25 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-26 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-26 a::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-27 a:hover' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-28 a::before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button a:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-10 a:hover::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-10 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-11 a:hover::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-11 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-13 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-14 a:hover::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-27 a::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-28 a::before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-29 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-29 a:hover::after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-30 a:hover::before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-btn-effect-30 a:hover::after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-6 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-7 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-8 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-10 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-10 a:hover::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-11 a:hover::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-11 a:hover::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-13 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-14 a::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-27 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-28 a::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'effect!' => [ 'btn-effect-29', 'btn-effect-30' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-button a, {{WRAPPER}} .oew-btn-effect-10 a::before, {{WRAPPER}} .oew-btn-effect-10 a::after, {{WRAPPER}} .oew-btn-effect-11 a::before, {{WRAPPER}} .oew-btn-effect-11 a::after, {{WRAPPER}} .oew-btn-effect-13 a::before, {{WRAPPER}} .oew-btn-effect-13 a::after, {{WRAPPER}} .oew-btn-effect-14 a::before, {{WRAPPER}} .oew-btn-effect-14 a::after',
				'condition' 	=> [
					'effect!' => [ 'btn-effect-28', 'btn-effect-29', 'btn-effect-30' ],
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'hover_border_size',
			[
				'label' 		=> __( 'Hover Border Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 1,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-btn-effect-27 a::before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-28 a::before' => 'border-top-width: {{SIZE}}{{UNIT}}; border-bottom-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-29 a' => 'border-right-width: {{SIZE}}{{UNIT}}; border-left-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-29 a::before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-29 a::after' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-30 a' => 'border-top-width: {{SIZE}}{{UNIT}}; border-bottom-width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-30 a::before' => 'width: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-btn-effect-30 a::after' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'effect' => [ 'btn-effect-27', 'btn-effect-28', 'btn-effect-29', 'btn-effect-30' ],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-button a',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_section();

	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();
		$text 			= $settings['text'];
        $link 			= $settings['link'];
        $effect 		= $settings['effect'];

		$this->add_render_attribute( 'button-wrap', 'class', 'oew-button' );

		if ( ! empty( $effect ) ) {
            $this->add_render_attribute( 'button-wrap', 'class', 'oew-'. $effect );
        }

		if ( ! empty( $link['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $link['url'] );

			if ( $link['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $link['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'icon-align', 'class', [
			'oew-button-icon',
			'elementor-align-icon-' . $settings['icon_align'],
		] );

		$this->add_render_attribute( 'link', 'class', 'oew-link' );

        if ( 'btn-effect-2' == $effect
        	|| 'btn-effect-3' == $effect
        	|| 'btn-effect-4' == $effect ) {
            $this->add_render_attribute( 'link', 'data-text', $text );
        } ?>


		<div <?php echo $this->get_render_attribute_string( 'button-wrap' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
				<?php
				if ( ! empty( $settings['icon'] ) && 'left' == $settings['icon_align'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php
				} ?>

				<span><?php echo esc_attr( $text ); ?></span>

				<?php
				if ( ! empty( $settings['icon'] ) && 'right' == $settings['icon_align'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php
				} ?>
			</a>
		</div>

	<?php
	}

}