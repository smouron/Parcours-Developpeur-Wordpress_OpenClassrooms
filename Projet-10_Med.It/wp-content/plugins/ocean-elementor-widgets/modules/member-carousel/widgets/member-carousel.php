<?php
namespace owpElementor\Modules\MemberCarousel\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Member_Carousel extends Widget_Base {

	public function get_name() {
		return 'oew-member-carousel';
	}

	public function get_title() {
		return __( 'Member Carousel', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-person';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'member',
            'user',
            'team',
            'carousel',
            'slider',
            'owp',
        ];
    }

	public function get_script_depends() {
		return [ 'oew-member-carousel', 'swiper' ];
	}

	public function get_style_depends() {
		return [ 'oew-member-carousel' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_members',
			[
				'label' 		=> __( 'Members', 'ocean-elementor-widgets' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   		=> __( 'Image', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       	=> __( 'Name', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __( 'Member #1', 'ocean-elementor-widgets' ),
				'dynamic'     	=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'role',
			[
				'label'       	=> __( 'Role', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __( 'Co-Founder', 'ocean-elementor-widgets' ),
				'dynamic'     	=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'       	=> __( 'Description', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'ocean-elementor-widgets' ),
				'rows'        	=> 10,
				'dynamic'     	=> [ 'active' => true ],
			]
		);

        $repeater->add_control(
            'mail',
            [
                'label' 		=> __( 'Mail Address', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
				'dynamic'     	=> [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'facebook',
            [
                'label' 		=> __( 'Facebook', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
				'default'     	=> '#',
				'dynamic'     	=> [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'twitter',
            [
                'label' 		=> __( 'Twitter', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
				'default'     	=> '#',
				'dynamic'     	=> [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'instagram',
            [
                'label' 		=> __( 'Instagram', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
				'default'     	=> '#',
				'dynamic'     	=> [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'linkedin',
            [
                'label' 		=> __( 'linkedin', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
				'dynamic'     	=> [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'youtube',
            [
                'label' 		=> __( 'YouTube', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
				'dynamic'     	=> [ 'active' => true ],
            ]
        );

        $repeater->add_control(
            'pinterest',
            [
                'label' 		=> __( 'Pinterest', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
				'dynamic'     	=> [ 'active' => true ],
            ]
        );

		$this->add_control(
			'members',
			[
				'type'    		=> Controls_Manager::REPEATER,
				'fields'  		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'image' 		=> [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'       	=> __( 'Member #1', 'ocean-elementor-widgets' ),
						'role'       	=> __( 'Co-Founder', 'ocean-elementor-widgets' ),
						'description' 	=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'ocean-elementor-widgets' ),
                        'facebook' 		=> '#',
                        'twitter' 		=> '#',
                        'instagram' 	=> '#',
					],
					[
						'image' 		=> [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'       	=> __( 'Member #2', 'ocean-elementor-widgets' ),
						'role'       	=> __( 'Co-Founder', 'ocean-elementor-widgets' ),
						'description' 	=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'ocean-elementor-widgets' ),
                        'facebook' 		=> '#',
                        'twitter' 		=> '#',
                        'instagram' 	=> '#',
					],
					[
						'image' 		=> [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'       	=> __( 'Member #3', 'ocean-elementor-widgets' ),
						'role'       	=> __( 'Co-Founder', 'ocean-elementor-widgets' ),
						'description' 	=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'ocean-elementor-widgets' ),
                        'facebook' 		=> '#',
                        'twitter' 		=> '#',
                        'instagram' 	=> '#',
					],
					[
						'image' 		=> [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'       	=> __( 'Member #4', 'ocean-elementor-widgets' ),
						'role'       	=> __( 'Co-Founder', 'ocean-elementor-widgets' ),
						'description' 	=> __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'ocean-elementor-widgets' ),
                        'facebook' 		=> '#',
                        'twitter' 		=> '#',
                        'instagram' 	=> '#',
					],
				],
				'title_field' 	=> '{{{ name }}}',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' 		=> __( 'Name HTML Tag', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'h3',
				'options' 		=> oew_get_available_tags(),
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> __( 'Social Icons Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 6,
						'max' => 150,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a .owp-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_member_carousel',
			[
				'label' 		=> __( 'Carousel', 'ocean-elementor-widgets' ),
			]
		);

        $this->add_control(
            'carousel_effect',
            [
                'label'       => __('Effect', 'ocean-elementor-widgets'),
                'description' => __('Sets transition effect', 'ocean-elementor-widgets'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'slide',
                'options'     => [
                    'slide'     => __('Slide', 'ocean-elementor-widgets'),
                    'fade'      => __('Fade', 'ocean-elementor-widgets'),
                    'coverflow' => __('Coverflow', 'ocean-elementor-widgets'),
                ],
            ]
        );

        $this->add_responsive_control(
            'items',
            [
                'label'          => __('Visible Items', 'ocean-elementor-widgets'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => ['size' => 2],
                'tablet_default' => ['size' => 2],
                'mobile_default' => ['size' => 1],
                'range'          => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                        'step' => 1,
                    ],
                ],
                'size_units'     => '',
                'condition'      => [
                    'carousel_effect' => ['slide', 'coverflow'],
                ],
            ]
        );

        $this->add_responsive_control(
            'slides',
            [
                'label'          => __('Items By Slides', 'ocean-elementor-widgets'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => ['size' => 2],
                'tablet_default' => ['size' => 2],
                'mobile_default' => ['size' => 1],
                'range'          => [
                    'px' => [
                        'min'  => 1,
                        'max'  => 10,
                        'step' => 1,
                    ],
                ],
                'size_units'     => '',
                'condition'      => [
                    'carousel_effect' => ['slide', 'coverflow'],
                ],
            ]
        );

        $this->add_responsive_control(
            'margin',
            [
                'label'      => __('Items Gap', 'ocean-elementor-widgets'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => ['size' => 10],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'size_units' => '',
                'condition'  => [
                    'carousel_effect' => ['slide', 'coverflow'],
                ],
            ]
        );

        $this->add_control(
            'slider_speed',
            [
                'label'       => __('Slider Speed', 'ocean-elementor-widgets'),
                'description' => __('Duration of transition between slides (in ms)', 'ocean-elementor-widgets'),
                'type'        => Controls_Manager::SLIDER,
                'default'     => ['size' => 400],
                'range'       => [
                    'px' => [
                        'min'  => 100,
                        'max'  => 3000,
                        'step' => 1,
                    ],
                ],
                'size_units'  => '',
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'        => __('Autoplay', 'ocean-elementor-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'no',
                'label_on'     => __('Yes', 'ocean-elementor-widgets'),
                'label_off'    => __('No', 'ocean-elementor-widgets'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'      => __('Autoplay Speed', 'ocean-elementor-widgets'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => ['size' => 2000],
                'range'      => [
                    'px' => [
                        'min'  => 500,
                        'max'  => 5000,
                        'step' => 1,
                    ],
                ],
                'size_units' => '',
                'condition'  => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'        => __('Pause On Hover', 'ocean-elementor-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => '',
                'label_on'     => __('Yes', 'ocean-elementor-widgets'),
                'label_off'    => __('No', 'ocean-elementor-widgets'),
                'return_value' => 'yes',
                'condition'    => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'        => __('Infinite Loop', 'ocean-elementor-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __('Yes', 'ocean-elementor-widgets'),
                'label_off'    => __('No', 'ocean-elementor-widgets'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'navigation_heading',
            [
                'label'     => __('Navigation', 'ocean-elementor-widgets'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'arrows',
            [
                'label'        => __('Arrows', 'ocean-elementor-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __('Yes', 'ocean-elementor-widgets'),
                'label_off'    => __('No', 'ocean-elementor-widgets'),
                'return_value' => 'yes',
            ]
        );

        $this->add_control(
            'dots',
            [
                'label'        => __('Dots', 'ocean-elementor-widgets'),
                'type'         => Controls_Manager::SWITCHER,
                'default'      => 'yes',
                'label_on'     => __('Yes', 'ocean-elementor-widgets'),
                'label_off'    => __('No', 'ocean-elementor-widgets'),
                'return_value' => 'yes',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_arrows',
			[
				'label' 		=> __( 'Arrows', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
            'arrows_size',
            [
                'label'      => __('Size', 'ocean-elementor-widgets'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => ['size' => 20],
                'range'      => [
                    'px' => [
                        'min'  => 10,
                        'max'  => 100,
                        'step' => 1,
                    ],
                ],
                'selectors'     => [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-swiper-buttons svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label'         => __( 'Color', 'ocean-elementor-widgets' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-swiper-buttons svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label'     	=> __( 'Member', 'ocean-elementor-widgets' ),
				'tab'       	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'member_bg',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-details' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'member_border',
				'selector' 		=> '{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-details',
			]
		);

		$this->add_responsive_control(
			'member_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-details' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_responsive_control(
			'member_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'member_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_heading',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'text_align',
			[
				'label'   		=> __( 'Text Alignment', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label'      	=> __( 'Content Padding', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	
		$this->start_controls_section(
			'section_style_image',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'image_border',
				'label'       	=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-image',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				],
			]
		);

		$this->add_control(
			'image_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-image' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			[
				'label' 		=> __( 'Name', 'ocean-elementor-widgets' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'name_typography',
				'selector' 		=> '{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-name',
			]
		);

		$this->add_responsive_control(
			'name_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_role',
			[
				'label' 		=> __( 'Role', 'ocean-elementor-widgets' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'role_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-role' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'role_typography',
				'selector' 		=> '{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-role',
			]
		);

		$this->add_responsive_control(
			'role_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-role' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'text_typography',
				'selector' 		=> '{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-description',
			]
		);

		$this->add_responsive_control(
			'text_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social',
			[
				'label' 		=> __( 'Social Icon', 'ocean-elementor-widgets' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icons_bg',
			[
				'label'     	=> __( 'Wrapper Background', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'icons_wrap_padding',
			[
				'label'      	=> __( 'Wrapper Padding', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icons_style' );

		$this->start_controls_tab(
			'tab_icons_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icons_background',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a .owp-icon use' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icons_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icons_hover_background',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_hover_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a:hover .owp-icon use' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icons_hover_border_color',
			[
				'label'     	=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'icons_border',
				'label'       	=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'icons_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icons_padding',
			[
				'label'      	=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icons_size',
			[
				'label'     	=> __( 'Icons Size', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SLIDER,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li a .owp-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icons_indent',
			[
				'label'     	=> __( 'Icons Spacing', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SLIDER,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .oew-member-carousel-wrap .oew-member-carousel-social li:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_pagination',
			[
				'label' 		=> __( 'Pagination', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'dots_size',
            [
                'label'      => __('Size', 'ocean-elementor-widgets'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => ['size' => 8],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 30,
                        'step' => 1,
                    ],
                ],
                'selectors'     => [
                    '{{WRAPPER}} .oew-member-carousel-wrap .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dots_active_color',
            [
                'label'         => __( 'Active Color', 'ocean-elementor-widgets' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .oew-member-carousel-wrap .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label'         => __( 'Color', 'ocean-elementor-widgets' ),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .oew-member-carousel-wrap .swiper-pagination-bullet' => 'background: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();

	}

	protected function member_social_links( $item ) {
		$settings 	= $this->get_settings_for_display();
        $mail 		= $item['mail'];
        $facebook 	= $item['facebook'];
        $twitter 	= $item['twitter'];
        $instagram 	= $item['instagram'];
        $linkedin 	= $item['linkedin'];
        $youtube 	= $item['youtube'];
        $pinterest 	= $item['pinterest']; ?>

        <div class="oew-member-carousel-social">
            <ul>
                <?php
                if (!empty($mail)) { ?>
                    <li><a href="mailto:<?php esc_attr( $mail_address ); ?>"><?php oew_svg_icon( 'envelope' ); ?></a></li>
                <?php
            	}

                if (!empty($facebook)) { ?>
                    <li><a href="<?php esc_url( $facebook ); ?>"><?php oew_svg_icon( 'facebook' ); ?></a></li>
                <?php
            	}

                if (!empty($twitter)) { ?>
                    <li><a href="<?php esc_url( $twitter ); ?>" target="_blank"><?php oew_svg_icon( 'twitter' ); ?></a></li>
                <?php
            	}

                if (!empty($instagram)) { ?>
                    <li><a href="<?php esc_url( $instagram ); ?>" target="_blank"><?php oew_svg_icon( 'instagram' ); ?></a></li>
                <?php
            	}

                if (!empty($linkedin)) { ?>
                    <li><a href="<?php esc_url( $linkedin ); ?>" target="_blank"><?php oew_svg_icon( 'linkedin' ); ?></a></li>
                <?php
            	}

                if (!empty($youtube)) { ?>
                    <li><a href="<?php esc_url( $youtube ); ?>" target="_blank"><?php oew_svg_icon( 'youtube' ); ?></a></li>
                <?php
                }

                if (!empty($pinterest)) { ?>
                    <li><a href="<?php esc_url( $pinterest ); ?>" target="_blank"><?php oew_svg_icon( 'pinterest' ); ?></a></li>
                <?php
            	} ?>
            </ul>
        </div>
    <?php
    }

	protected function next_icon() {
        $icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.002 512.002" xml:space="preserve"><path d="M388.425,241.951L151.609,5.79c-7.759-7.733-20.321-7.72-28.067,0.04c-7.74,7.759-7.72,20.328,0.04,28.067l222.72,222.105L123.574,478.106c-7.759,7.74-7.779,20.301-0.04,28.061c3.883,3.89,8.97,5.835,14.057,5.835c5.074,0,10.141-1.932,14.017-5.795l236.817-236.155c3.737-3.718,5.834-8.778,5.834-14.05S392.156,245.676,388.425,241.951z"/></svg>';

        return $icon;
    }

    protected function prev_icon() {
        $icon = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 443.52 443.52" xml:space="preserve"><path d="M143.492,221.863L336.226,29.129c6.663-6.664,6.663-17.468,0-24.132c-6.665-6.662-17.468-6.662-24.132,0l-204.8,204.8c-6.662,6.664-6.662,17.468,0,24.132l204.8,204.8c6.78,6.548,17.584,6.36,24.132-0.42c6.387-6.614,6.387-17.099,0-23.712L143.492,221.863z"/></svg>';

        return $icon;
    }

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$title_tag 	= $settings['title_html_tag'];

		// Icons RTL
		if ( is_RTL() ) {
            $next = $this->prev_icon();
            $prev = $this->next_icon();
        } else {
            $next = $this->next_icon();
            $prev = $this->prev_icon();
        }

		$swiper_class = Plugin::$instance->experiments->is_feature_active( 'e_swiper_latest' ) ? 'swiper' : 'swiper-container';

		// Data settings
		$this->add_render_attribute(
            'oew-carousel-container',
            [
                'class'           => [
                    'oew-member-carousel',
                    $swiper_class,
                    'oew-carousel-container',
                ],
            ]
        );

        if ($settings['dots'] == 'yes') {
            $this->add_render_attribute( 'oew-carousel-container', 'class', 'has-dots' );
        }

        $carousel_settings = [];

        if (!empty($settings['items']['size'])) {
            $carousel_settings['items'] = $settings['items']['size'];
        }

        if (!empty($settings['items_tablet']['size'])) {
            $carousel_settings['items-tablet'] = $settings['items_tablet']['size'];
        }

        if (!empty($settings['items_mobile']['size'])) {
            $carousel_settings['items-mobile'] = $settings['items_mobile']['size'];
        }

        if (!empty($settings['slides']['size'])) {
            $carousel_settings['slides'] = $settings['slides']['size'];
        }

        if (!empty($settings['slides_tablet']['size'])) {
            $carousel_settings['slides-tablet'] = $settings['slides_tablet']['size'];
        }

        if (!empty($settings['slides_mobile']['size'])) {
            $carousel_settings['slides-mobile'] = $settings['slides_mobile']['size'];
        }

        if (!empty($settings['margin']['size'])) {
            $carousel_settings['margin'] = $settings['margin']['size'];
        }
        if (!empty($settings['margin_tablet']['size'])) {
            $carousel_settings['margin-tablet'] = $settings['margin_tablet']['size'];
        }
        if (!empty($settings['margin_mobile']['size'])) {
            $carousel_settings['margin-mobile'] = $settings['margin_mobile']['size'];
        }

        if ($settings['carousel_effect']) {
            $carousel_settings['effect'] = $settings['carousel_effect'];
        }

        if (!empty($settings['slider_speed']['size'])) {
            $carousel_settings['speed'] = $settings['slider_speed']['size'];
        }

        if ($settings['autoplay'] == 'yes' && !empty($settings['autoplay_speed']['size'])) {
            $carousel_settings['autoplay'] = $settings['autoplay_speed']['size'];
        } else {
            $carousel_settings['autoplay'] = '0';
        }

        if ($settings['pause_on_hover'] == 'yes') {
            $carousel_settings['pause-on-hover'] = 'true';
        }

        if ($settings['infinite_loop'] == 'yes') {
            $carousel_settings['loop'] = '1';
        }

        if ($settings['arrows'] == 'yes') {
            $carousel_settings['arrows'] = '1';
        }

        if ($settings['dots'] == 'yes') {
            $carousel_settings['dots'] = '1';
        }

        $this->add_render_attribute( 'oew-carousel-container', 'data-settings', wp_json_encode( $carousel_settings ) ); ?>

        <div class="oew-member-carousel-wrap swiper-container-wrap clr">

			<div <?php echo $this->get_render_attribute_string( 'oew-carousel-container' ); ?>>
				<div class="swiper-wrapper">

					<?php 
					foreach ( $settings['members'] as $index => $item ) :

						// Data
						$name 			= $item['name'];
						$role 			= $item['role'];
						$description 	= $item['description'];
						$mail 			= $item['mail'];
				        $facebook 		= $item['facebook'];
				        $twitter 		= $item['twitter'];
				        $instagram 		= $item['instagram'];
				        $linkedin 		= $item['linkedin'];
				        $youtube 		= $item['youtube'];
				        $pinterest 		= $item['pinterest']; ?>

						<div class="oew-member-carousel-slide swiper-slide">

							<div class="oew-member-carousel-details">

								<?php
								if ( ! empty( $item['image']['url'] ) ) { ?>
									<div class="oew-member-carousel-image">
										<?php echo Group_Control_Image_Size::get_attachment_image_html( $item, 'image' ); ?>
									</div>
								<?php
								} ?>
								
								<div class="oew-member-carousel-content">
									<?php
									if ( ! empty( $name ) ) { ?>
										<<?php echo $title_tag; ?> class="oew-member-carousel-name">
											<?php echo $name; ?>
										</<?php echo $title_tag; ?>>
									<?php
									}

									if ( ! empty( $role ) ) { ?>
										<span class="oew-member-carousel-role"><?php echo $role; ?></span>
									<?php
									}

									if ( ! empty( $description ) ) { ?>
										<div class="oew-member-carousel-description"><?php echo $description; ?></div>
									<?php
									}

									if ( ! empty( $mail )
										|| ! empty( $facebook )
										|| ! empty( $twitter )
										|| ! empty( $instagram )
										|| ! empty( $linkedin )
										|| ! empty( $youtube )
										|| ! empty( $pinterest ) ) { ?>

							            <ul class="oew-member-carousel-social">
							                <?php
							                if ( ! empty( $mail ) ) { ?>
							                    <li><a href="mailto:<?php echo esc_attr( $mail_address ); ?>"><?php oew_svg_icon( 'envelope' ); ?></a></li>
							                <?php
							            	}

							                if ( ! empty( $facebook ) ) { ?>
							                    <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank"><?php oew_svg_icon( 'facebook' ); ?></a></li>
							                <?php
							            	}

							                if ( ! empty( $twitter ) ) { ?>
							                    <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank"><?php oew_svg_icon( 'twitter' ); ?></a></li>
							                <?php
							            	}

							                if ( !empty( $instagram ) ) { ?>
							                    <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank"><?php oew_svg_icon( 'instagram' ); ?></a></li>
							                <?php
							            	}

							                if ( ! empty( $linkedin ) ) { ?>
							                    <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank"><?php oew_svg_icon( 'linkedin' ); ?></a></li>
							                <?php
							            	}

							                if ( ! empty( $youtube ) ) { ?>
							                    <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank"><?php oew_svg_icon( 'youtube' ); ?></a></li>
							                <?php
							                }

							                if ( ! empty( $pinterest ) ) { ?>
							                    <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank"><?php oew_svg_icon( 'pinterest' ); ?></a></li>
							                <?php
							            	} ?>
							            </ul>

								    <?php
									} ?>

								</div>

							</div>

						</div>

					<?php
					endforeach; ?>

				</div>
			</div>

			<?php
	        if ($settings['arrows'] == 'yes') { ?>
	            <div class="swiper-button-next oew-swiper-buttons swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php echo $next; ?>
				</div>
	            <div class="swiper-button-prev oew-swiper-buttons swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php echo $prev; ?>
				</div>
	        <?php
	    	}

	        if ($settings['dots'] == 'yes') { ?>
	            <div class="swiper-pagination swiper-pagination-<?php echo esc_attr( $this->get_id() ); ?>"></div>
	        <?php
	    	} ?>

		</div>

	<?php
	}

}