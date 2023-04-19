<?php
namespace owpElementor\Modules\Navbar\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Navbar extends Widget_Base {

	public function get_name() {
		return 'oew-navbar';
	}

	public function get_title() {
		return __( 'Navbar', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-navigation-vertical';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'nav',
            'navigation',
            'menu',
            'owp',
        ];
    }

	public function get_script_depends() {
		return [ 'oew-navbar' ];
	}

	public function get_style_depends() {
		return [ 'oew-navbar', 'oew-off-canvas' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_navbar',
			[
				'label' 		=> __( 'Navbar', 'ocean-elementor-widgets' ),
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
				'name' 		=> 'icon',
				'label' 	=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 		=> Controls_Manager::ICONS,
				'default'		=> [
					'value'   => '',
					'library' => 'solid',
				],
			]
        );

		$repeater->add_control(
            'title',
            [
				'name' 		=> 'title',
				'label' 	=> __( 'Title', 'ocean-elementor-widgets' ),
				'type' 		=> Controls_Manager::TEXT,
				'default' 	=> __( 'Homepage' , 'ocean-elementor-widgets' ),
				'dynamic' 	=> [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'link',
            [
				'name' 		=> 'link',
				'label' 	=> __( 'Link', 'ocean-elementor-widgets' ),
				'type' 		=> Controls_Manager::URL,
				'default' 	=> [ 'url' => '#' ],
			]
        );

		$this->add_control(
			'navbar',
			[
				'label' 		=> __( 'Nav Items', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::REPEATER,
                'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' 	=> __( 'Homepage', 'ocean-elementor-widgets' ),
						'icon' 		=> 'fas fa-home',
						'link' 		=> [
							'url' => __( '#', 'ocean-elementor-widgets' ),
						] 
					],
					[
						'title' 	=> __( 'Blog', 'ocean-elementor-widgets' ),
						'icon' 		=> 'fas fa-comment',
						'link' 		=> [
							'url' => __( '#', 'ocean-elementor-widgets' ),
						] 
					],
					[
						'title' 	=> __( 'Shop', 'ocean-elementor-widgets' ),
						'icon' 		=> 'fas fa-shopping-basket',
						'link' 		=> [
							'url' => __( '#', 'ocean-elementor-widgets' ),
						] 
					],
					[
						'title' 	=> __( 'About Us', 'ocean-elementor-widgets' ),
						'icon' 		=> 'far fa-user-circle',
						'link' 		=> [
							'url' => __( '#', 'ocean-elementor-widgets' ),
						] 
					],
					[
						'title' 	=> __( 'Contact Us', 'ocean-elementor-widgets' ),
						'icon' 		=> 'fas fa-envelope',
						'link' 		=> [
							'url' => __( '#', 'ocean-elementor-widgets' ),
						] 
					],
				],
				'title_field' 	=> '{{{ title }}}',
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
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-navbar-wrap  a.oew-navbar-link .oew-navbar-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'navbar_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 50,
						'max' => 200,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap' => 'width: {{SIZE}}{{UNIT}};',
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap.oew-navbar-off-canvas.oew-navbar-left .oew-off-canvas-sidebar' => 'left: {{SIZE}}{{UNIT}};',
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap.oew-navbar-off-canvas.oew-navbar-right .oew-off-canvas-sidebar' => 'right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'navbar_position',
			[
				'label'   		=> __( 'Navbar Position', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'left',
				'options' 		=> [
					'left'   => __( 'Left', 'ocean-elementor-widgets' ),
					'right'  => __( 'Right', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_responsive_control(
			'navbar_offset',
			[
				'label' 		=> __( 'Top Offset', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap .oew-navbar-inner' => 'padding-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_branding',
			[
				'label' 		=> __( 'Branding', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'show_branding',
			[
				'label'   		=> __( 'Show Branding Image', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'branding_image',
			[
				'label'     	=> __( 'Choose Image', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::MEDIA,
				'condition' 	=> [
					'show_branding' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'branding_link',
			[
				'label' 		=> __( 'Custom Link', 'ocean-elementor-widgets' ),
				'label' 		=> __( 'By default, it is your homepage', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_responsive_control(
			'brading_space',
			[
				'label'   		=> __( 'Space', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 20,
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'condition' 	=> [
					'show_branding' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap .oew-navbar-logo' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_off_canvas',
			[
				'label' 		=> __( 'Off Canvas', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'show_off_canvas',
			[
				'label'   		=> __( 'Show Off Canvas', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
			]
		);

		$this->add_control(
			'source',
			[
				'label'   		=> __( 'Source', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'sidebar',
				'options' 		=> [
					'sidebar'  	=> __( 'Sidebar', 'ocean-elementor-widgets' ),
					'template'  => __( 'Template', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'sidebars',
			[
				'label'   		=> __( 'Choose Sidebar', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '0',
				'options' 		=> oew_get_available_sidebars(),
				'condition' 	=> [
					'source' => 'sidebar',
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'templates',
			[
				'label'   		=> __( 'Choose Template', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '0',
				'options' 		=> oew_get_available_templates(),
				'condition' 	=> [
					'source' => 'template',
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'off_canvas_title',
			[
				'label' 		=> __( 'Title', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Off Canvas' , 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'show_off_canvas' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'off_canvas_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					]
				],
				'condition' 	=> [
					'show_off_canvas' => 'yes',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_overlay',
			[
				'label' 		=> __( 'Overlay', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'condition' 	=> [
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_button',
			[
				'label'   		=> __( 'Close Button', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'condition' 	=> [
					'show_off_canvas' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mobile',
			[
				'label' 		=> __( 'Mobile Menu', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'show_mobile',
			[
				'label'   		=> __( 'Activate Responsive', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'mobile_breakpoint',
			[
				'label'   		=> __( 'Breakpoints', 'ocean-elementor-widgets' ),
				'description'   => __( 'Choose the media query where you want to display the mobile menu', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '959',
				'options' 		=> [
					'1280' 		=> __( 'From 1280px', 'ocean-elementor-widgets' ),
					'1080' 		=> __( 'From 1080px', 'ocean-elementor-widgets' ),
					'959' 		=> __( 'From 959px', 'ocean-elementor-widgets' ),
					'767' 		=> __( 'From 767px', 'ocean-elementor-widgets' ),
					'480' 		=> __( 'From 480px', 'ocean-elementor-widgets' ),
					'320' 		=> __( 'From 320px', 'ocean-elementor-widgets' ),
					'custom' 	=> __( 'Custom media query', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'show_mobile' => 'yes',
				],
			]
		);

		$this->add_control(
			'mobile_custom_breakpoint',
			[
				'label' 		=> __( 'Custom Media Query', 'ocean-elementor-widgets' ),
				'description' 	=> __( 'Enter your custom media query where you want to display the mobile menu.', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::NUMBER,
				'step'    		=> 1,
				'condition' 	=> [
					'show_mobile' => 'yes',
					'mobile_breakpoint' => 'custom',
				],
			]
		);

		$this->add_control(
			'mobile_title',
			[
				'label' 		=> __( 'Title', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Menu' , 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'show_mobile' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'mobile_close_title',
			[
				'label' 		=> __( 'Close Title', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Close' , 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'show_mobile' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Navbar', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'navbar_bg',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive ul.oew-navbar' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'navbar_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'navbar_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'navbar_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_links_style',
			[
				'label' 		=> __( 'Links', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'links_font_size',
			[
				'label' 		=> __( 'Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' => [
					'px' => [
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_links_style' );

		$this->start_controls_tab(
			'tab_links_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'links_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_links_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'links_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'links_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'links_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap ul a',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'links_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'links_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap ul a',
			]
		);

		$this->add_responsive_control(
			'links_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'links_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			[
				'label' 		=> __( 'Tooltips', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tooltips_size',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'range' 		=> [
					'px' => [
						'max' => 500,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'tooltips_typography',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip',
			]
		);

		$this->add_control(
			'tooltips_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-navbar-wrap.oew-navbar-left ul li a .oew-navbar-tooltip:before' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .oew-navbar-wrap.oew-navbar-right ul li a .oew-navbar-tooltip:before' => 'border-left-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltips_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'tooltips_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'tooltips_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'tooltips_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip',
			]
		);

		$this->add_responsive_control(
			'tooltips_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap ul li a .oew-navbar-tooltip' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'tooltips_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap.oew-navbar-left ul li a .oew-navbar-tooltip, {{WRAPPER}} .oew-navbar-wrap.oew-navbar-right ul li a .oew-navbar-tooltip' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_branding_style',
			[
				'label' 		=> __( 'Branding', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'branding_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap .oew-navbar-logo a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'branding_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap .oew-navbar-logo a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'branding_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap .oew-navbar-logo a',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'branding_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap .oew-navbar-logo a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'branding_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap .oew-navbar-logo a',
			]
		);

		$this->add_responsive_control(
			'branding_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap .oew-navbar-logo a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_off_canvas_style',
			[
				'label' 		=> __( 'Off Canvas', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'off_canvas_bg',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_color',
			[
				'label'     	=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_link_color',
			[
				'label'     	=> __( 'Link Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar a' => 'color: {{VALUE}};',
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar a *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_link_hover_color',
			[
				'label'     	=> __( 'Link Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'off_canvas_box_shadow',
				'selector' 		=> '#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar',
			]
		);

		$this->add_responsive_control(
			'off_canvas_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_heading',
			[
				'label' 		=> __( 'Close Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> [
					'off_canvas_close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'condition' 	=> [
					'off_canvas_close_button' => 'yes',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-close svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_hover_color',
			[
				'label'     	=> __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'condition' 	=> [
					'off_canvas_close_button' => 'yes',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-close:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_widget_style',
			[
				'label' 		=> __( 'Widgets', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_control(
			'off_canvas_widgets_bg',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'condition' 	=> [
					'source' => 'sidebar',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'off_canvas_widgets_border',
				'selector' 		=> '#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box',
				'condition' 	=> [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_responsive_control(
			'off_canvas_widgets_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'condition' 	=> [
					'source' => 'sidebar',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'off_canvas_widgets_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'condition' 	=> [
					'source' => 'sidebar',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_mobile_link_style',
			[
				'label' 		=> __( 'Mobile Link', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'mobile_link_typography',
				'selector' 		=> '{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a',
			]
		);

		$this->add_control(
			'mobile_link_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_link_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a .owp-icon use' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_link_hover_background_color',
			[
				'label' 		=> __( 'Background Color: Hover', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'mobile_link_hover_color',
			[
				'label' 		=> __( 'Color: Hover', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a:hover .owp-icon use' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mobile_link_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 			= $this->get_settings_for_display();
		$id 				= $this->get_id();
		$source 			= $settings['source'];
		$breakpoint 		= $settings['mobile_breakpoint'];
		$custom_breakpoint 	= $settings['mobile_custom_breakpoint'];

		$this->add_render_attribute( 'wrap', 'class', [
			'oew-navbar-wrap',
			'oew-navbar-' . $settings['navbar_position'],
		] );

		if ( 'yes' == $settings['show_off_canvas'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'oew-has-off-canvas' );
		}

		if ( 'yes' == $settings['show_mobile'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'oew-is-responsive' );

			if ( '959' == $breakpoint ) {
				$this->add_render_attribute( 'wrap', 'class', 'oew-default-breakpoint' );
			}
		}

		$this->add_render_attribute( 'inner', 'class', 'oew-navbar-inner' );
		$this->add_render_attribute( 'logo', 'class', 'oew-navbar-logo' );

        if ( ! empty( $settings['branding_image']['url'] ) ) {
        	$this->add_render_attribute( 'image', 'class', 'oew-navbar-image' );
	        $this->add_render_attribute( 'image-tag', 'src', $settings['branding_image']['url'] );
	        $this->add_render_attribute( 'image-tag', 'alt', Control_Media::get_image_alt( $settings['branding_image'] ) );
	    }

        $this->add_render_attribute( 'logo-text', 'class', 'oew-navbar-logo-text' );

        if ( ! empty( $settings['branding_link']['url'] ) ) {
			$this->add_render_attribute( 'logo-link', 'href', $settings['branding_link']['url'] );

			if ( $settings['branding_link']['is_external'] ) {
				$this->add_render_attribute( 'logo-link', 'target', '_blank' );
			}
		} else {
			$this->add_render_attribute( 'logo-link', 'href', esc_url( home_url( '/' ) ) );
		}
        $this->add_render_attribute( 'logo-link', 'title', esc_attr( get_bloginfo( 'name' ) ) );

        $this->add_render_attribute( 'mobile-wrap', 'class', 'oew-mobile-wrap' );
        $this->add_render_attribute( 'mobile-btn', 'class', 'oew-mobile-button' );
		$this->add_render_attribute( 'mobile-btn', 'href', '#' );

        $this->add_render_attribute( 'navbar', 'class', 'oew-navbar' );

		$this->add_render_attribute( 'off-canvas-li', 'class', 'oew-off-canvas-li' );
		$this->add_render_attribute( 'off-canvas-btn', 'class', 'oew-off-canvas-button' );
		$this->add_render_attribute( 'off-canvas-btn', 'class', [
			'oew-off-canvas-button',
			'oew-navbar-link',
		] );
		$this->add_render_attribute( 'off-canvas-btn', 'href', '#oew-off-canvas-' . esc_attr( $id ) );

		$this->add_render_attribute( 'off-canvas', 'id', 'oew-off-canvas-' . esc_attr( $id ) );
		$this->add_render_attribute( 'off-canvas', 'class', [
			'oew-off-canvas-wrap',
			'oew-navbar-off-canvas',
			'oew-navbar-' . $settings['navbar_position'],
		] );

		$this->add_render_attribute( 'off-canvas-close', 'type', 'button' );
		$this->add_render_attribute( 'off-canvas-close', 'class', 'oew-off-canvas-close' );

		$this->add_render_attribute( 'off-canvas-sidebar', 'class', 'oew-off-canvas-sidebar' );

		$this->add_render_attribute( 'off-canvas-overlay', 'class', 'oew-off-canvas-overlay' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'inner' ); ?>>
				<?php
				if ( 'yes' == $settings['show_branding'] ) { ?>
					<div <?php echo $this->get_render_attribute_string( 'logo' ); ?>>
						<?php
						if ( ! empty( $settings['branding_image']['url'] ) ) { ?>
							<div <?php echo $this->get_render_attribute_string( 'image' ); ?>>
								<a <?php echo $this->get_render_attribute_string( 'logo-link' ); ?>>
									<img <?php echo $this->get_render_attribute_string( 'image-tag' ); ?> />
								</a>
							</div>
						<?php
						} else {
							$string 	= get_bloginfo( 'name' );
							$words 		= explode( ' ', $string );
							$letters 	= '';

							foreach ( $words as $value ) {
								$letters .= substr( $value, 0, 1 );
							} ?>

							<div <?php echo $this->get_render_attribute_string( 'logo-text' ); ?>>
								<a <?php echo $this->get_render_attribute_string( 'logo-link' ); ?>>
									<?php echo esc_attr( $letters ); ?>
								</a>
							</div>
						<?php
						} ?>
					</div>
				<?php
				} ?>

				<?php
				if ( 'yes' == $settings['show_mobile'] ) { ?>
					<div <?php echo $this->get_render_attribute_string( 'mobile-wrap' ); ?>>
						<a <?php echo $this->get_render_attribute_string( 'mobile-btn' ); ?>>
							<span class="oew-mobile-icon">
								<?php oew_svg_icon( 'menu' ); ?>
							</span>
							<?php
							if ( ! empty( $settings['mobile_title'] ) ) { ?>
								<span class="oew-mobile-title"><?php echo esc_html( $settings['mobile_title'] ); ?></span>

								<?php
								if ( ! empty( $settings['mobile_close_title'] ) ) { ?>
									<span class="oew-mobile-title oew-mobile-close"><?php echo esc_html( $settings['mobile_close_title'] ); ?></span>
								<?php
								} ?>
							<?php
							} ?>
						</a>
					</div>
				<?php
				} ?>

				<ul <?php echo $this->get_render_attribute_string( 'navbar' ); ?>>
					<?php
					if ( 'yes' == $settings['show_off_canvas'] ) { ?>
						<li <?php echo $this->get_render_attribute_string( 'off-canvas-li' ); ?>>
							<a <?php echo $this->get_render_attribute_string( 'off-canvas-btn' ); ?>>
								<span class="oew-navbar-icon">
									<?php oew_svg_icon( 'menu' ); ?>
								</span>
								<?php
								if ( ! empty( $settings['off_canvas_title'] ) ) { ?>
									<span class="oew-navbar-tooltip"><?php echo esc_html( $settings['off_canvas_title'] ); ?></span>
								<?php
								} ?>
							</a>
						</li>
					<?php
					} ?>

					<?php
					foreach ( $settings['navbar'] as $index => $item ) :
						$link = $this->get_repeater_setting_key( 'link', 'links', $index );
						$this->add_render_attribute( $link, 'class', 'oew-navbar-link' );

						if ( ! empty( $item['link']['url'] ) ) {

							$this->add_render_attribute( $link, 'href', $item['link']['url'] );

							if ( ! empty( $item['link']['is_external'] ) ) {
								$this->add_render_attribute( $link, 'target', '_blank' );
							}

							if ( ! empty( $item['link']['nofollow'] ) ) {
								$this->add_render_attribute( $link, 'rel', 'nofollow' );
							}
						} ?>

						<li>
							<a <?php echo $this->get_render_attribute_string( $link ); ?>>
								<?php
								if ( ! empty( $item['icon'] ) ) { ?>
									<span class="oew-navbar-icon">
										<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</span>
									<span class="oew-navbar-tooltip"><?php echo esc_html( $item['title'] ); ?></span>
								<?php
								} ?>
							</a>
						</li>

					<?php
					endforeach; ?>
				</ul>
			</div>
		</div>
	    
		<?php
		if ( 'yes' == $settings['show_off_canvas'] ) { ?>
			<div <?php echo $this->get_render_attribute_string( 'off-canvas' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'off-canvas-sidebar' ); ?>>
					<?php
					if ( $settings['off_canvas_close_button'] ) { ?>
		        		<button <?php echo $this->get_render_attribute_string( 'off-canvas-close' ); ?>>
		        			<svg width="14" height="14" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
								<path d="M505.943,6.058c-8.077-8.077-21.172-8.077-29.249,0L6.058,476.693c-8.077,8.077-8.077,21.172,0,29.249
									C10.096,509.982,15.39,512,20.683,512c5.293,0,10.586-2.019,14.625-6.059L505.943,35.306
									C514.019,27.23,514.019,14.135,505.943,6.058z"/>
								<path d="M505.942,476.694L35.306,6.059c-8.076-8.077-21.172-8.077-29.248,0c-8.077,8.076-8.077,21.171,0,29.248l470.636,470.636
									c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.587-2.019,14.624-6.057C514.018,497.866,514.018,484.771,505.942,476.694z"/>
							</svg>
		        		</button>
		        	<?php
		        	} ?>
		        	
					<?php
					if ( ! empty( $source ) ) {
		            	if ( 'sidebar' == $source
		            		&& ( '0' != $settings['sidebars'] && ! empty( $settings['sidebars'] ) ) ) {
		            		dynamic_sidebar( $settings['sidebars'] );
		            	} else if ( 'template' == $source
		            		&& ( '0' != $settings['templates'] && ! empty( $settings['templates'] ) ) ) {
		            		echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['templates'] );
		            	}
		            } ?>
				</div>
				<?php
				if ( $settings['off_canvas_overlay'] ) { ?>
					<div <?php echo $this->get_render_attribute_string( 'off-canvas-overlay' ); ?>></div>
	        	<?php
	        	} ?>
			</div>
    	<?php
    	} ?>

		<?php
		if ( 'yes' == $settings['show_mobile']
			&& '959' != $breakpoint ) {
				$mobile_breakpoint = $breakpoint;

				if ( 'custom' == $breakpoint
					&& ! empty( $custom_breakpoint )
					&& '959' != $custom_breakpoint ) {
					$mobile_breakpoint = $custom_breakpoint;
				} ?>

			<style type="text/css">
				@media (min-width: <?php echo $mobile_breakpoint + 1; ?>px) {
				    .oew-navbar-wrap.oew-is-responsive ul.oew-navbar {
				        display: block !important;
				    }
				}

				@media (max-width: <?php echo $mobile_breakpoint; ?>px) {
					.oew-navbar-wrap.oew-is-responsive {
						width: 100% !important;
						height: 50px;
						top: 32px;
					}

					body .oew-navbar-wrap.oew-is-responsive .oew-mobile-wrap {
						display: block;
						float: right;
					}

					.oew-navbar-wrap.oew-is-responsive .oew-navbar-inner {
						position: relative;
						padding: 0 !important;
					}

					.oew-navbar-wrap.oew-is-responsive .oew-navbar-logo {
						float: left;
						margin: 0 !important;
					}

					.oew-navbar-wrap.oew-is-responsive ul.oew-navbar {
						display: none;
						width: 100%;
						background-color: #13aff0;
						max-height: 400px;
						overflow-y: auto;
						-webkit-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
						-moz-box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
						box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
					}

					.oew-navbar-wrap.oew-is-responsive ul.oew-navbar li {
						margin-bottom: 0;
					}

					.oew-navbar-wrap.oew-is-responsive ul.oew-navbar li.oew-off-canvas-li {
						display: none;
					}

					.oew-navbar-wrap.oew-is-responsive ul.oew-navbar li a {
						text-align: left;
					}

					.oew-navbar-wrap.oew-is-responsive ul.oew-navbar li a .oew-navbar-tooltip {
						position: relative;
						top: auto;
						left: auto;
						right: auto;
						width: auto;
						background-color: transparent;
						color: #fff;
						padding: 0;
						margin-left: 10px;
						border-radius: 0 !important;
						text-align: left;
						visibility: visible;
						opacity: 1;
						-webkit-transition: none;
						-moz-transition: none;
						-ms-transition: none;
						-o-transition: none;
						transition: none;
					}

					.oew-navbar-wrap.oew-is-responsive ul.oew-navbar li a .oew-navbar-tooltip:before {
						display: none;
					}

					.admin-bar .oew-navbar-wrap.oew-is-responsive {
						top: 32px;
					}
				}

				@media only screen and (max-width: 782px) {
				    .admin-bar .oew-navbar-wrap.oew-is-responsive {
				        top: 46px;
				    }
				}

				@media only screen and (max-width: 600px) {
				    .admin-bar .oew-navbar-wrap.oew-is-responsive {
				        top: 0;
				    }
				}
			</style>

		<?php
		} ?>

	<?php
	}

}