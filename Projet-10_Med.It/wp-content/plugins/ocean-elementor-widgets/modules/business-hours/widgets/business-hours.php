<?php
namespace owpElementor\Modules\BusinessHours\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class BusinessHours extends Widget_Base {

	public function get_name() {
		return 'oew-business-hours';
	}

	public function get_title() {
		return __( 'Business Hours', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-tel-field';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'business hours',
            'hours',
            'business',
            'owp',
        ];
    }

	public function get_style_depends() {
		return [ 'oew-business-hours' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_business_hours_settings',
			[
				'label' 		=> __( 'Business Hours', 'ocean-elementor-widgets' ),
			]
		);

        $repeater = new Repeater();

        $repeater->add_control(
            'day',
            [
                'name' => 'day',
                'label' => __( 'Day', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => __( 'Monday', 'ocean-elementor-widgets' ),
                'options' => [
                    __( 'Monday', 'ocean-elementor-widgets' )    => __( 'Monday', 'ocean-elementor-widgets' ),
                    __( 'Tuesday', 'ocean-elementor-widgets' )   => __( 'Tuesday', 'ocean-elementor-widgets' ),
                    __( 'Wednesday', 'ocean-elementor-widgets' ) => __( 'Wednesday', 'ocean-elementor-widgets' ),
                    __( 'Thursday', 'ocean-elementor-widgets' )  => __( 'Thursday', 'ocean-elementor-widgets' ),
                    __( 'Friday', 'ocean-elementor-widgets' )    => __( 'Friday', 'ocean-elementor-widgets' ),
                    __( 'Saturday', 'ocean-elementor-widgets' )  => __( 'Saturday', 'ocean-elementor-widgets' ),
                    __( 'Sunday', 'ocean-elementor-widgets' )    => __( 'Sunday', 'ocean-elementor-widgets' ),
                ],
            ]
        );

        $repeater->add_control(
            'closed',
            [
                'name' => 'closed',
                'label' => __( 'Closed?', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __( 'No', 'ocean-elementor-widgets' ),
                'label_off' => __( 'Yes', 'ocean-elementor-widgets' ),
                'return_value' => 'no',
            ]
        );

        $repeater->add_control(
            'opening_hours',
            [
                'name' => 'opening_hours',
                'label' => __( 'Opening Hours', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '08:00',
                'options' => [
                    '00:00'    => '12:00 AM',
                    '00:30'    => '12:30 AM',
                    '01:00'    => '1:00 AM',
                    '01:30'    => '1:30 AM',
                    '02:00'    => '2:00 AM',
                    '02:30'    => '2:30 AM',
                    '03:00'    => '3:00 AM',
                    '03:30'    => '3:30 AM',
                    '04:00'    => '4:00 AM',
                    '04:30'    => '4:30 AM',
                    '05:00'    => '5:00 AM',
                    '05:30'    => '5:30 AM',
                    '06:00'    => '6:00 AM',
                    '06:30'    => '6:30 AM',
                    '07:00'    => '7:00 AM',
                    '07:30'    => '7:30 AM',
                    '08:00'    => '8:00 AM',
                    '08:30'    => '8:30 AM',
                    '09:00'    => '9:00 AM',
                    '09:30'    => '9:30 AM',
                    '10:00'    => '10:00 AM',
                    '10:30'    => '10:30 AM',
                    '11:00'    => '11:00 AM',
                    '11:30'    => '11:30 AM',
                    '12:00'    => '12:00 PM',
                    '12:30'    => '12:30 PM',
                    '13:00'    => '1:00 PM',
                    '13:30'    => '1:30 PM',
                    '14:00'    => '2:00 PM',
                    '14:30'    => '2:30 PM',
                    '15:00'    => '3:00 PM',
                    '15:30'    => '3:30 PM',
                    '16:00'    => '4:00 PM',
                    '16:30'    => '4:30 PM',
                    '17:00'    => '5:00 PM',
                    '17:30'    => '5:30 PM',
                    '18:00'    => '6:00 PM',
                    '18:30'    => '6:30 PM',
                    '19:00'    => '7:00 PM',
                    '19:30'    => '7:30 PM',
                    '20:00'    => '8:00 PM',
                    '20:30'    => '8:30 PM',
                    '21:00'    => '9:00 PM',
                    '21:30'    => '9:30 PM',
                    '22:00'    => '10:00 PM',
                    '22:30'    => '10:30 PM',
                    '23:00'    => '11:00 PM',
                    '23:30'    => '11:30 PM',
                    '24:00'    => '12:00 PM',
                    '24:30'    => '12:30 PM',
                ],
                'condition' => [
                    'closed' => 'no',
                ],
            ]
        );

        $repeater->add_control(
            'closing_hours',
            [
                'name' => 'closing_hours',
                'label' => __( 'Closing Hours', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::SELECT,
                'default' => '19:00',
                'options' => [
                    '00:00'    => '12:00 AM',
                    '00:30'    => '12:30 AM',
                    '01:00'    => '1:00 AM',
                    '01:30'    => '1:30 AM',
                    '02:00'    => '2:00 AM',
                    '02:30'    => '2:30 AM',
                    '03:00'    => '3:00 AM',
                    '03:30'    => '3:30 AM',
                    '04:00'    => '4:00 AM',
                    '04:30'    => '4:30 AM',
                    '05:00'    => '5:00 AM',
                    '05:30'    => '5:30 AM',
                    '06:00'    => '6:00 AM',
                    '06:30'    => '6:30 AM',
                    '07:00'    => '7:00 AM',
                    '07:30'    => '7:30 AM',
                    '08:00'    => '8:00 AM',
                    '08:30'    => '8:30 AM',
                    '09:00'    => '9:00 AM',
                    '09:30'    => '9:30 AM',
                    '10:00'    => '10:00 AM',
                    '10:30'    => '10:30 AM',
                    '11:00'    => '11:00 AM',
                    '11:30'    => '11:30 AM',
                    '12:00'    => '12:00 PM',
                    '12:30'    => '12:30 PM',
                    '13:00'    => '1:00 PM',
                    '13:30'    => '1:30 PM',
                    '14:00'    => '2:00 PM',
                    '14:30'    => '2:30 PM',
                    '15:00'    => '3:00 PM',
                    '15:30'    => '3:30 PM',
                    '16:00'    => '4:00 PM',
                    '16:30'    => '4:30 PM',
                    '17:00'    => '5:00 PM',
                    '17:30'    => '5:30 PM',
                    '18:00'    => '6:00 PM',
                    '18:30'    => '6:30 PM',
                    '19:00'    => '7:00 PM',
                    '19:30'    => '7:30 PM',
                    '20:00'    => '8:00 PM',
                    '20:30'    => '8:30 PM',
                    '21:00'    => '9:00 PM',
                    '21:30'    => '9:30 PM',
                    '22:00'    => '10:00 PM',
                    '22:30'    => '10:30 PM',
                    '23:00'    => '11:00 PM',
                    '23:30'    => '11:30 PM',
                    '24:00'    => '12:00 PM',
                    '24:30'    => '12:30 PM',
                ],
                'condition' => [
                    'closed' => 'no',
                ],
            ]
        );

        $repeater->add_control(
            'closed_text',
            [
                'name' => 'closed_text',
                'label' => __( 'Closed Text', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => __( 'Closed', 'ocean-elementor-widgets' ),
                'default' => __( 'Closed', 'ocean-elementor-widgets' ),
                'condition' => [
                    'closed' => 'yes',
                ],
                'dynamic' => [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'highlight',
            [
                'name' => 'highlight',
                'label' => __( 'Highlight', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'return_value' => 'yes',
            ]
        );

        $repeater->add_control(
            'highlight_bg',
            [
                'name' => 'highlight_bg',
                'label' => __( 'Background Color', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'highlight' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row{{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $repeater->add_control(
            'highlight_color',
            [
                'name' => 'highlight_color',
                'label' => __( 'Text Color', 'ocean-elementor-widgets' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'highlight' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row{{CURRENT_ITEM}} .oew-business-day, {{WRAPPER}} .oew-business-hours .oew-business-hours-row{{CURRENT_ITEM}} .oew-business-timing' => 'color: {{VALUE}}',
                ],
            ]
        );

		$this->add_control(
			'business_hours',
			[
				'label' 		=> '',
				'type' 			=> Controls_Manager::REPEATER,
				'default' 		=> [
					[
						'day' => __( 'Monday', 'ocean-elementor-widgets' ),
					],
					[
						'day' => __( 'Tuesday', 'ocean-elementor-widgets' ),
					],
					[
						'day' => __( 'Wednesday', 'ocean-elementor-widgets' ),
					],
				],
                'fields' => $repeater->get_controls(),
				'title_field' => '{{{ day }}}',
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

        $this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 3,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-business-hours .oew-business-day' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_business_hours',
			[
				'label' 		=> __( 'Business Hours', 'ocean-elementor-widgets' ),
			]
		);

        $this->add_control(
          'hours_format',
            [
                'label' 		=> __( '24 Hours Format?', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'default' 		=> 'no',
                'return_value' 	=> 'yes',
            ]
        );

        $this->add_control(
            'days_format',
            [
                'label' 		=> __( 'Days Format', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'long',
                'options' 		=> [
                    'long' 	=> __( 'Long', 'ocean-elementor-widgets' ),
                    'short' => __( 'Short', 'ocean-elementor-widgets' ),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_rows_style',
            [
                'label' 		=> __( 'Rows', 'ocean-elementor-widgets' ),
                'tab' 			=> Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
          'stripes',
            [
                'label' 		=> __( 'Striped Rows', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'default' 		=> 'no',
                'return_value' 	=> 'yes',
            ]
        );

        $this->start_controls_tabs( 'tabs_alternate_style' );

        $this->start_controls_tab(
            'tab_even',
            [
                'label' 		=> __( 'Even Row', 'ocean-elementor-widgets' ),
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'row_even_bg_color',
            [
                'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' 		=> '#fbfbfb',
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:nth-child(even)' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'row_even_text_color',
            [
                'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:nth-child(even)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_odd',
            [
                'label' 		=> __( 'Odd Row', 'ocean-elementor-widgets' ),
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'row_odd_bg_color',
            [
                'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'default' 		=> '#ffffff',
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:nth-child(odd)' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'row_odd_text_color',
            [
                'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:nth-child(odd)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->start_controls_tabs( 'tabs_rows_style' );

        $this->start_controls_tab(
            'tab_row_normal',
            [
                'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'row_bg_color_normal',
            [
                'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_row_hover',
            [
                'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'row_bg_color_hover',
            [
                'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'stripes!' => 'yes',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_responsive_control(
			'rows_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
                'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-business-hours .oew-business-hours-row' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'rows_margin',
            [
                'label' 		=> __( 'Margin Bottom', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SLIDER,
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 80,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_control(
            'closed_row_heading',
            [
                'label' 		=> __( 'Closed Row', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );

        $this->add_control(
            'closed_row_bg_color',
            [
                'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row.row-closed' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'closed_row_day_color',
            [
                'label' 		=> __( 'Day Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row.row-closed .oew-business-day' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'closed_row_tex_color',
            [
                'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row.row-closed .oew-business-timing' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_control(
            'divider_heading',
            [
                'label' 		=> __( 'Rows Divider', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );
        
        $this->add_control(
            'rows_divider_style',
            [
                'label' 		=> __( 'Divider Style', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'none',
                'options' 		=> [
                    'none'      => __( 'None', 'ocean-elementor-widgets' ),
                    'solid'     => __( 'Solid', 'ocean-elementor-widgets' ),
                    'dashed'    => __( 'Dashed', 'ocean-elementor-widgets' ),
                    'dotted'    => __( 'Dotted', 'ocean-elementor-widgets' ),
                    'groove'    => __( 'Groove', 'ocean-elementor-widgets' ),
                    'ridge'     => __( 'Ridge', 'ocean-elementor-widgets' ),
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:not(:last-child)' => 'border-bottom-style: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'rows_divider_color',
            [
                'label' 		=> __( 'Divider Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'rows_divider_style!' => 'none',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:not(:last-child)' => 'border-bottom-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'rows_divider_weight',
            [
                'label' 		=> __( 'Divider Weight', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [ 'size' => 1 ],
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units' 	=> [ 'px' ],
                'condition' 	=> [
                    'rows_divider_style!' => 'none',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'section_pricing_table_style',
            [
                'label' 		=> __( 'Business Hours', 'ocean-elementor-widgets' ),
                'tab' 			=> Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_hours_style' );

        $this->start_controls_tab(
            'tab_hours_normal',
            [
                'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
            ]
        );
        
        $this->add_control(
            'title_heading',
            [
                'label' 		=> __( 'Day', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );

        $this->add_control(
            'day_color',
            [
                'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-day' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'title_typography',
                'label' 		=> __( 'Typography', 'ocean-elementor-widgets' ),
                'selector' 		=> '{{WRAPPER}} .oew-business-hours .oew-business-day',
            ]
        );
        
        $this->add_control(
            'hours_heading',
            [
                'label' 		=> __( 'Hours', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
            ]
        );

        $this->add_control(
            'hours_color',
            [
                'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-timing' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' 			=> 'hours_typography',
                'label' 		=> __( 'Typography', 'ocean-elementor-widgets' ),
                'selector' 		=> '{{WRAPPER}} .oew-business-hours .oew-business-timing',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_hours_hover',
            [
                'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'day_color_hover',
            [
                'label' 		=> __( 'Day Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:hover .oew-business-day' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hours_color_hover',
            [
                'label' 		=> __( 'Hours Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours .oew-business-hours-row:hover .oew-business-timing' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->add_control(
            'icon_heading',
            [
                'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
                'condition' 	=> [
                    'icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' 		=> __( 'Icon Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'condition' 	=> [
                    'icon!' => '',
                ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-business-hours i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'business-hours', 'class', 'oew-business-hours' );
        $i = 1; ?>

        <div <?php echo $this->get_render_attribute_string( 'business-hours' ); ?>>
            <?php
            foreach ( $settings['business_hours'] as $index => $item ) :

				$this->add_render_attribute( 'row' . $i, 'class', [
					'oew-business-hours-row',
					'clr',
					'elementor-repeater-item-' . esc_attr( $item['_id'] ),
				] );

            	if ( 'no' != $item['closed'] ) {
            		$this->add_render_attribute( 'row' . $i, 'class', 'row-closed' );
                } ?>

                <div <?php echo $this->get_render_attribute_string( 'row' . $i ); ?>>
                    <span class="oew-business-day">
                    	<?php
						if ( '' != $settings['icon'] ) {
							\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
						} ?>

                        <?php
                        if ( 'long' == $settings['days_format'] ) {
                        	echo ucwords( esc_attr( $item['day'] ) );
                        } else {
                        	echo ucwords( esc_attr( substr( $item['day'], 0, 3 ) ) );
                        } ?>
                    </span>

                    <span class="oew-business-timing">
                        <?php
                        if ( 'no' == $item['closed'] ) { ?>
                            <span class="oew-opening-hours">
                                <?php
                                if ( 'yes' == $settings['hours_format'] ) {
                                	echo esc_attr( $item['opening_hours'] );
                                } else {
                                	echo esc_attr( date( "g:i A", strtotime( $item['opening_hours'] ) ) );
                                } ?>
                            </span>
                            -
                            <span class="oew-closing-hours">
                                <?php
                                if ( 'yes' == $settings['hours_format'] ) {
                                	echo esc_attr( $item['closing_hours'] );
                                } else {
                                	echo esc_attr( date( "g:i A", strtotime( $item['closing_hours'] ) ) );
                                } ?>
                            </span>
                        <?php
                    	} else {
                    		esc_attr_e( 'Closed', 'ocean-elementor-widgets' );
                    	} ?>
                    </span>
                </div>

            <?php
            $i++;
        	endforeach; ?>
        </div>

	<?php
	}

	protected function content_template() { ?>
		<#
        function oew_timeTo12HrFormat(time) {
            // Take a time in 24 hour format and format it in 12 hour format
            var time_part_array = time.split(":");
            var ampm = 'AM';

            if ( time_part_array[0] >= 12 ) {
                ampm = 'PM';
            }

            if ( time_part_array[0] > 12 ) {
                time_part_array[0] = time_part_array[0] - 12;
            }

            formatted_time = time_part_array[0] + ':' + time_part_array[1] + ' ' + ampm;

            return formatted_time;
        } #>

        <# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

        <div class="oew-business-hours">
            <# _.each( settings.business_hours, function( item ) {
            	var closed = ( item.closed != 'no' ) ? 'row-closed' : ''; #>

                <div class="oew-business-hours-row clr elementor-repeater-item-{{ item._id }} {{ closed }}">
                    <span class="oew-business-day">
                        <# if ( '' != settings.icon ) { #>
                            {{{ iconHTML.value }}}
                        <# } #>

                        <# if ( 'long' == settings.days_format ) { #>
                            {{ item.day }}
                        <# } else { #>
                            {{ item.day.substring(0,3) }}
                        <# } #>
                    </span>

                    <span class="oew-business-timing">
                        <# if ( 'no' == item.closed ) { #>
                            <span class="oew-opening-hours">
                                <# if ( 'yes' == settings.hours_format ) { #>
                                    {{ item.opening_hours }}
                                <# } else { #>
                                    {{ oew_timeTo12HrFormat( item.opening_hours ) }}
                                <# } #>
                            </span>
                            -
                            <span class="oew-closing-hours">
                                <# if ( 'yes' == settings.hours_format ) { #>
                                    {{ item.closing_hours }}
                                <# } else { #>
                                    {{ oew_timeTo12HrFormat( item.closing_hours ) }}
                                <# } #>
                            </span>
                        <# } else { #>
                            <?php esc_attr_e( 'Closed', 'ocean-elementor-widgets' ); ?>
                        <# } #>
                    </span>
                </div>

            <# } ); #>
        </div>
	<?php
	}

}