<?php
namespace owpElementor\Modules\Timeline\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Timeline extends Widget_Base {

	public function get_name() {
		return 'oew-timeline';
	}

	public function get_title() {
		return __( 'Timeline', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-time-line';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'timeline',
            'post',
            'owp',
        ];
    }

	public function get_style_depends() {
		return [ 'oew-timeline' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_timeline_layout',
			[
				'label' 		=> __( 'Layout', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'source',
			[
				'label'   		=> __( 'Source', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'post',
				'options' 		=> [
					'post'  	=> __( 'Post', 'ocean-elementor-widgets' ),
					'custom'  	=> __( 'Custom Content', 'ocean-elementor-widgets' ),
				],
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
				],
				'default' 		=> 'center',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_query',
			[
				'label' 		=> __( 'Query', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'source' => 'post',
				],
			]
		);

		$this->add_control(
			'query_source',
			[
				'label'   		=> __( 'Source', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					''  		=> __( 'Show All', 'ocean-elementor-widgets' ),
					'manual'  	=> __( 'Manual Selection', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'categories',
			[
				'label'   		=> __( 'Categories', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT2,
				'default' 		=> '0',
				'multiple'    	=> true,
				'options' 		=> $this->get_available_categories(),
				'condition' 	=> [
					'query_source' => 'manual',
				],
			]
		);

		$this->add_control(
			'number_posts',
			[
				'label' 		=> __( 'Number of Posts', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '4',
			]
		);

		$this->add_control(
			'order',
			[
				'label' 		=> __( 'Order', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 			=> __( 'Default', 'ocean-elementor-widgets' ),
					'DESC' 		=> __( 'DESC', 'ocean-elementor-widgets' ),
					'ASC' 		=> __( 'ASC', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 		=> __( 'Order By', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'date',
				'options' 		=> [
					'date' 			=> __( 'Date', 'ocean-elementor-widgets' ),
					'title' 		=> __( 'Title', 'ocean-elementor-widgets' ),
					'category' 		=> __( 'Category', 'ocean-elementor-widgets' ),
					'rand' 			=> __( 'Random', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_custom',
			[
				'label' 		=> __( 'Custom Content', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'source' => 'custom',
				],
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
            'timeline_title',
            [
				'name' => 'timeline_title',
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Your timeline title here', 'ocean-elementor-widgets' ),
				'label_block' => 'true',
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'timeline_date',
            [
				'name' => 'timeline_date',
				'label' => __( 'Date', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( '13 October 2018', 'ocean-elementor-widgets' ),
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'timeline_image',
            [
				'name' => 'timeline_image',
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'timeline_text',
            [
				'name' => 'timeline_text',
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'timeline_link',
            [
				'name' => 'timeline_link',
				'label' => __( 'Item Link', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default' => '#',
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'timeline_icon',
            [
				'name' => 'timeline_icon',
				'label' => __( 'Timeline Icon', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::ICONS,
				'default'		=> [
					'value'   => 'fas fa-file-alt',
					'library' => 'solid',
				],
			]
        );

		$this->add_control(
			'items',
			[
				'label' 		=> __( 'List Items', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::REPEATER,
                'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'timeline_title' => __( 'Your timeline title here #1', 'ocean-elementor-widgets' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
					[
						'timeline_title' => __( 'Your timeline title here #2', 'ocean-elementor-widgets' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
					[
						'timeline_title' => __( 'Your timeline title here #3', 'ocean-elementor-widgets' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
					[
						'timeline_title' => __( 'Your timeline title here #4', 'ocean-elementor-widgets' ),
						'timeline_text' => __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
						'timeline_icon'  => 'fas fa-file-alt',
					],
				],
				'title_field' 	=> '{{{ timeline_title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label' 		=> __( 'Additional Options', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'show_image',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_title',
			[
				'label' 		=> __( 'Title', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label' 		=> __( 'Meta', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_excerpt',
			[
				'label' 		=> __( 'Excerpt', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'excerpt_length',
			[
				'label' 		=> __( 'Excerpt Length', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '20',
				'condition' 	=> [
					'show_excerpt' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_readmore',
			[
				'label' 		=> __( 'Read More', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'readmore_text',
			[
				'label' 		=> __( 'Read More Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Read More', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'show_readmore' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICONS,
				'label_block' 	=> true,
				'default'		=> [
					'value'   => 'fas fa-long-arrow-alt-right',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' 		=> __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'right',
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
				'default' 		=> [
					'size' => 4,
				],
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-readmore .oew-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-timeline .oew-timeline-readmore .oew-align-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[
				'label' 		=> __( 'Item', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'timeline_item_bg',
			[
				'label'     	=> esc_html__( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-item-main' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_item_border',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-item-main',
			]
		);

		$this->add_control(
			'timeline_item_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-item-main' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_item_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-item-main',
			]
		);

		$this->add_responsive_control(
			'timeline_item_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-item-main' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_image_max_width',
			[
				'label' 		=> __( 'Max Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-thumbnail' => 'width: {{SIZE}}{{UNIT}}; margin-left: auto; margin-right: auto;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_image_border',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-thumbnail',
			]
		);

		$this->add_control(
			'timeline_image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-thumbnail' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-thumbnail',
			]
		);

		$this->add_responsive_control(
			'timeline_image_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-thumbnail' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> __( 'Title', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_title_typography',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-title',
			]
		);

		$this->start_controls_tabs( 'tabs_timeline_title_style' );

		$this->start_controls_tab(
			'tab_timeline_title_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'timeline_title_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_title_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'timeline_title_hover_color',
			[
				'label'     	=> esc_html__( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'timeline_title_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_meta_style',
			[
				'label' 		=> __( 'Meta', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_meta_typography',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-meta',
			]
		);

		$this->start_controls_tabs( 'tabs_timeline_meta_style' );

		$this->start_controls_tab(
			'tab_timeline_meta_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'timeline_meta_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-meta, {{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-meta a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_meta_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'timeline_meta_hover_color',
			[
				'label'     	=> esc_html__( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-meta a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'timeline_meta_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt_style',
			[
				'label' 		=> __( 'Excerpt', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_excerpt_typography',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-excerpt',
			]
		);

		$this->add_control(
			'timeline_excerpt_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-excerpt' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'timeline_excerpt_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_button_typography',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore',
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_timeline_button_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'timeline_button_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_button_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_timeline_button_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'timeline_button_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_button_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_button_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'timeline_button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore',
			]
		);

		$this->add_responsive_control(
			'timeline_button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'timeline_button_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_icon_style',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_icon_size',
			[
				'label' 		=> __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 35,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-icon span:after, {{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-custom-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'timeline_icon_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '#ffffff',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-icon span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_icon_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-icon span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_icon_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-icon span',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_icon_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-icon span',
			]
		);

		$this->add_responsive_control(
			'timeline_icon_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'%' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'default' 		=> [
					'size' 	=> 50,
					'unit' 	=> '%',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-icon span' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'timeline_icon_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 35,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-icon span' => 'padding: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_line_style',
			[
				'label' 		=> __( 'Line', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'timeline_line_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'default' 		=> [
					'size' => 3,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-line span' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'timeline_line_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-item-wrap .oew-timeline-line span' => 'background-color: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_timeline_date_style',
			[
				'label' 		=> __( 'Date', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'timeline_date_typography',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-date span',
			]
		);

		$this->add_control(
			'timeline_date_bg',
			[
				'label'     	=> esc_html__( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-date span' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_date_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-date span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'timeline_date_border',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-date span',
			]
		);

		$this->add_control(
			'timeline_date_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-date span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'timeline_date_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-timeline .oew-timeline-date span',
			]
		);

		$this->add_responsive_control(
			'timeline_date_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-timeline .oew-timeline-date span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function get_available_categories() {

		$categories = get_terms( 'category' );

		$result = array( __( '-- Select --', 'ocean-elementor-widgets' ) );

		foreach ( $categories as $category ) {
			$result[ $category->slug ] = $category->name;
		}

		return $result;
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$source 	= $settings['source'];
		$align 		= $settings['align'];
		$items 		= $settings['items'];

		$this->add_render_attribute( 'wrap', 'class', [
			'oew-timeline',
			'oew-timeline-' . $align,
		] );

		$this->add_render_attribute( 'inner', 'class', 'oew-timeline-inner' );

		// If posts
		if ( 'post' == $source ) {
			global $post;

			$args = array(
				'posts_per_page' => $settings['number_posts'],
				'order'          => $settings['order'],
				'orderby'        => $settings['orderby'],
				'post_status'    => 'publish'
			);
			
			if ( 'manual' == $settings['query_source'] ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'category',
					'field'    => 'slug',
					'terms'    => $settings['categories'],
				);
			}

			$query = new \WP_Query( $args );

			if ( $query->have_posts() ) : ?> 

				<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
					<div <?php echo $this->get_render_attribute_string( 'inner' ); ?>>

						<?php
						$count = 0;

						while ( $query->have_posts() ) : $query->the_post();
							$count++;

							$thumbnail 		= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
							$post_format 	= get_post_format() ? : 'standard';
							$category 		= '';
							$position 		= ( $count%2 == 0 ) ? 'right' : 'left';
							$date_class 	= ( 'center' == $align ) ? 'hidden' : 'normal';
					  		
							if ( $count%2 == 0
								&& 'center' == $align ) { ?>
					  			<div class="oew-timeline-item">
							  		<div class="oew-timeline-date oew-timeline-date-right"><span><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></span></div>
								</div>
							<?php
							} ?>

				  			<div class="oew-timeline-item oew-timeline-item-<?php echo esc_attr( $position ); ?>">
					  			<div class="oew-timeline-item-wrap">

					  				<div class="oew-timeline-line<?php echo $query->current_post + 1 === $query->post_count ? ' oew-last-line' : '' ?>"><span></span></div>

						  			<div class="oew-timeline-item-container">
						  				<div class="oew-timeline-icon oew-timeline-post-icon oew-post-format-<?php echo esc_attr( $post_format ); ?>"><span></span></div>

							  			<div class="oew-timeline-item-main">
							  				<span class="oew-timeline-arrow"></span>

							  				<?php
							  				if ( 'yes' == $settings['show_image']
							  					&& isset( $thumbnail[0] ) ) { ?>
										  		<div class="oew-timeline-thumbnail">
													<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>">
										  				<img src="<?php echo esc_url( $thumbnail[0] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
										  			</a>
										  		</div>
									  		<?php
									  		} ?>

									  		<div class="oew-timeline-desc">
												<?php
												if ( 'yes' == $settings['show_title'] ) { ?>
													<h4 class="oew-timeline-title">
														<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
													</h4>
												<?php
									  			}

												if ( 'yes' == $settings['show_meta'] ) { ?>
													<ul class="oew-timeline-meta">
														<li class="oew-timeline-meta-date oew-timeline-<?php echo esc_attr( $date_class ); ?>"><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></li>
														<li><?php echo get_the_category_list( ', ' ); ?></li>															
													</ul>
												<?php
												}

												if ( 'yes' == $settings['show_excerpt'] ) { ?>
													<div class="oew-timeline-excerpt"><?php do_shortcode( the_excerpt() ); ?></div>
												<?php
												}

												if ( 'yes' == $settings['show_readmore'] ) { ?>
													<a href="<?php echo esc_url( get_permalink() ); ?>" class="oew-timeline-readmore button">
														<?php
														if ( $settings['icon'] && 'left' == $settings['icon_align'] ) { ?>
															<span class="oew-button-icon oew-align-<?php echo esc_attr( $settings['icon_align'] ); ?>">
																<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
															</span>
														<?php
														} ?>

														<?php echo esc_html( $settings['readmore_text'] ); ?>

														<?php
														if ( $settings['icon'] && 'right' == $settings['icon_align'] ) { ?>
															<span class="oew-button-icon oew-align-<?php echo esc_attr( $settings['icon_align'] ); ?>">
																<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
															</span>
														<?php
														} ?>
													</a>
												<?php
												} ?>
									  		</div>
										</div>
									</div>
								</div>
							</div>

						  	<?php
						  	if ( $count%2 == 1
						  		&& ( 'center' == $align ) ) { ?>
						  		<?php 
						  		$position = ( $count%2 == 1 ) ? 'right' : 'left'; ?>
					  			<div class="oew-timeline-item">
							  		<div class="oew-timeline-date"><span><?php echo esc_attr( get_the_date( 'd F Y' ) ); ?></span></div>
								</div>
							<?php
							} ?>

						<?php
						endwhile; ?>

					</div>
				</div>
			
			 	<?php 
			 	wp_reset_postdata();

	 		endif;

		}

		// If custom content
		else if ( 'custom' == $source ) { ?>

			<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'inner' ); ?>>

					<?php
					$count = 0;
					$i = 1;

					foreach ( $items as $item ) :
						$count++;

						$position 		= ( $count%2 == 0 ) ? 'right' : 'left';
						$date_class 	= ( 'center' == $align ) ? 'hidden' : '';
						$image_url 		= wp_get_attachment_image_src( $item['timeline_image']['id'], 'full' );
						$image_url 		= ( '' != $image_url ) ? $image_url[0] : $item['timeline_image']['url'];

						if ( $count%2 == 0
							&& 'center' == $align ) { ?>
							<div class="oew-timeline-item">
						  		<div class="oew-timeline-date oew-timeline-date-right"><span><?php echo esc_attr( $item['timeline_date'] ); ?></span></div>
							</div>
						<?php
						} ?>

				  		<div class="oew-timeline-item oew-timeline-item-<?php echo esc_attr( $position ); ?>">
				  			<div class="oew-timeline-item-wrap">

				  				<div class="oew-timeline-line"><span></span></div>

					  			<div class="oew-timeline-item-container">
					  				<div class="oew-timeline-icon oew-timeline-custom-icon"><span><?php \Elementor\Icons_Manager::render_icon( $item['timeline_icon'], [ 'aria-hidden' => 'true' ] ); ?></span></div>

						  			<div class="oew-timeline-item-main">
						  				<span class="oew-timeline-arrow"></span>

						  				<?php
						  				if ( 'yes' == $settings['show_image'] ) { ?>
									  		<div class="oew-timeline-thumbnail">
												<a href="<?php echo esc_url( $item['timeline_link'] ); ?>" title="<?php echo esc_attr( $item['timeline_title'] ); ?>">
									  				<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $item['timeline_title'] ); ?>">
									  			</a>
									  		</div>
								  		<?php
								  		} ?>

								  		<div class="oew-timeline-desc">
											<?php
											if ( 'yes' == $settings['show_title'] ) { ?>
												<h4 class="oew-timeline-title">
													<a href="<?php echo esc_url( $item['timeline_link'] ); ?>" title="<?php echo esc_attr( $item['timeline_title'] ); ?>"><?php echo esc_html( $item['timeline_title'] ); ?></a>
												</h4>
											<?php
								  			}

											if ( 'yes' == $settings['show_meta'] ) { ?>
												<ul class="oew-timeline-meta oew-timeline-<?php echo esc_attr( $date_class ); ?>">
													<li><?php echo esc_attr( $item['timeline_date'] ); ?></li>
												</ul>
											<?php
											}

											if ( 'yes' == $settings['show_excerpt'] ) { ?>
												<div class="oew-timeline-excerpt"><?php echo do_shortcode( $item['timeline_text'] ); ?></div>
											<?php
											}

											if ( 'yes' == $settings['show_readmore'] ) { ?>
												<a href="<?php echo esc_url( $item['timeline_link'] ); ?>" class="oew-timeline-readmore button">
													<?php
													if ( $settings['icon'] && 'left' == $settings['icon_align'] ) { ?>
														<span class="oew-button-icon oew-align-<?php echo esc_attr( $settings['icon_align'] ); ?>">
															<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
														</span>
													<?php
													} ?>

													<?php echo esc_html( $settings['readmore_text'] ); ?>

													<?php
													if ( $settings['icon'] && 'right' == $settings['icon_align'] ) { ?>
														<span class="oew-button-icon oew-align-<?php echo esc_attr( $settings['icon_align'] ); ?>">
															<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
														</span>
													<?php
													} ?>
												</a>
											<?php
											} ?>
								  		</div>
									</div>
								</div>

							</div>
						</div>

					  	<?php
					  	if ( $count%2 == 1
					  		&& ( 'center' == $align ) ) { ?>
					  		<?php 
					  		$position = ( $count%2 == 1 ) ? 'right' : 'left'; ?>
				  			<div class="oew-timeline-item">
						  		<div class="oew-timeline-date"><span><?php echo esc_attr( $item['timeline_date'] ); ?></span></div>
							</div>
						<?php
						}

					endforeach; ?>

				</div>
			</div>

		<?php
		}

	}

}