<?php
namespace owpElementor\Modules\PriceList\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Price_List extends Widget_Base {

	public function get_name() {
		return 'oew-price-list';
	}

	public function get_title() {
		return __( 'Price List', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-bullet-list';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'price',
            'list',
            'menu',
            'owp',
        ];
    }

	public function get_style_depends() {
		return [ 'oew-price-list' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_price_list',
			[
				'label' 		=> __( 'List', 'ocean-elementor-widgets' ),
			]
		);

		$repeater = new Repeater();

        $repeater->add_control(
            'price',
            [
				'name' => 'price',
				'label' => __( 'Price', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'dynamic' => [ 'active' => true ],
			]
        );

        $repeater->add_control(
            'has_discount',
            [
				'label' => __( 'Offering Discount?', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'default' => 'no',
				'return_value' => 'yes',
			]
        );

        $repeater->add_control(
            'original_price',
            [
				'label' => __( 'Original Price', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '$99',
				'dynamic' => [ 'active' => true ],
				'condition' => [
					'has_discount' => 'yes',
				],
			]
        );

		$repeater->add_control(
            'title',
            [
				'name' => 'title',
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'label_block' => 'true',
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'description',
            [
				'name' => 'description',
				'label' => __( 'Description', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => '',
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'image',
            [
				'name' => 'image',
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [],
				'dynamic' => [ 'active' => true ],
			]
        );

		$repeater->add_control(
            'link',
            [
				'name' => 'link',
				'label' => __( 'Link', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::URL,
				'default' => [ 'url' => '#' ],
			]
        );

		$this->add_control(
			'price_list',
			[
				'label' 		=> __( 'List Items', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::REPEATER,
                'fields' 		=> $repeater->get_controls(),
				'default' 		=> [
					[
						'title' => __( 'Menu item #1', 'ocean-elementor-widgets' ),
						'price' => '$49',
						'link' => [ 'url' => '#' ],
					],
					[
						'title' => __( 'Menu item #2', 'ocean-elementor-widgets' ),
						'price' => '$24',
						'link' => [ 'url' => '#' ],
					],
					[
						'title' => __( 'Menu item #3', 'ocean-elementor-widgets' ),
						'price' => '$69',
						'link' => [ 'url' => '#' ],
					],
				],
				'title_field' 	=> '{{{ title }}}',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			[
				'label' 		=> __( 'Settings', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   		=> __( 'Style', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'side',
				'options' 		=> [
					'side'  	=> __( 'Side', 'ocean-elementor-widgets' ),
					'inline'  	=> __( 'Inline', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'separator',
			[
				'label' 		=> __( 'Separator', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list .oew-price-list-item' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'vertical_align',
			[

				'label' 		=> __( 'Vertical Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'top' => [
						'title' => __( 'Top', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-long-arrow-up',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-arrows-v',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-long-arrow-down',
					],
				],
				'default' 		=> 'center',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list .oew-price-list-item' => 'align-items: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'bottom' => 'flex-end',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Price List', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'items_bg',
			[
				'label'     	=> esc_html__( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-item' => 'background-color: {{VALUE}};',

				],
			]
		);

		$this->add_responsive_control(
			'items_spacing',
			[
				'label' 		=> __( 'Items Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 100,
					],
					'%' => [
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list .oew-price-list-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'items_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-item',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'items_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'items_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-item',
			]
		);

		$this->add_responsive_control(
			'items_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_control(
			'title_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-title' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-title',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_separator_style',
			[
				'label' 		=> __( 'Separator', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'separator' => 'yes',
				],
			]
		);

		$this->add_control(
			'separator_style',
			[
				'label' 		=> __( 'Style', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'' => __( 'Default', 'ocean-elementor-widgets' ),
					'solid' => __( 'Solid', 'ocean-elementor-widgets' ),
					'dotted' => __( 'Dotted', 'ocean-elementor-widgets' ),
					'dashed' => __( 'Dashed', 'ocean-elementor-widgets' ),
					'double' => __( 'Double', 'ocean-elementor-widgets' ),
				],
				'default' 		=> '',
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list .oew-price-list-separator' => 'border-bottom-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_weight',
			[
				'label' 		=> __( 'Weight', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 10,
					],
				],
				'default' 		=> [
					'size' => 1,
				],
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-separator' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'separator_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-separator' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'separator_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 40,
					],
				],
				'condition' 	=> [
					'separator' => 'yes',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-separator' => 'margin: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			[
				'label' 		=> __( 'Price', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'price_typography',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-price',
			]
		);

		$this->start_controls_tabs( 'tabs_price_style' );

		$this->start_controls_tab(
			'tab_price_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'price_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-price' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_price_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'price_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-item:hover .oew-price-list-price' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-item:hover .oew-price-list-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'price_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-item:hover .oew-price-list-price' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'price_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-price',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'price_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'price_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-price',
			]
		);

		$this->add_responsive_control(
			'price_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'price_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-price-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'discount_title',
            [
                'label' 		=> __( 'Discount Price', 'ocean-elementor-widgets' ),
                'type'  		=> Controls_Manager::HEADING,
            ]
        );

		$this->add_control(
			'discount_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list .oew-price-list-discount-price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'discount_typo',
				'selector' 		=> '{{WRAPPER}} .oew-price-list .oew-price-list-discount-price',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' 		=> __( 'Description', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-description' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typography',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-description',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    		=> 'image_size',
				'default' 		=> 'thumbnail',
			)
		);

		$this->add_responsive_control(
			'image_width',
			[
				'label' 		=> __( 'Image Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'max' => 300,
					],
					'%' => [
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list .oew-price-list-image' => 'width: {{SIZE}}{{UNIT}}; min-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'image_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-image img',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'price_image_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-image, {{WRAPPER}} .oew-price-list-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-price-list-image img',
			]
		);

		$this->add_responsive_control(
			'image_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-price-list-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	private function render_price( $index ) {
		$settings  = $this->get_settings_for_display();
		$item      = $settings['price_list'][ $index ];

		$key = $this->get_repeater_setting_key( 'wrapper', 'price_list', $index );
		$this->add_render_attribute( $key, 'class', 'oew-price-list-price-wrap' );

		if ( 'yes' === $item['has_discount'] ) {
			$this->add_render_attribute( $key, 'class', 'has-discount' );
		}

		$price_key = $this->get_repeater_setting_key( 'price', 'price_list', $index );

		$this->add_render_attribute( $price_key, 'class', 'oew-price-list-price' );
		$this->add_inline_editing_attributes( $price_key, 'basic' );

		$discount_price_key = $this->get_repeater_setting_key( 'original_price', 'price_list', $index );

		$this->add_render_attribute( $discount_price_key, 'class', 'oew-price-list-discount-price' );
		$this->add_inline_editing_attributes( $discount_price_key, 'basic' ); ?>

		<div <?php echo $this->get_render_attribute_string( $key ); ?>>
			<?php
			if ( 'yes' === $item['has_discount'] ) { ?>
				<span <?php echo $this->get_render_attribute_string( $discount_price_key ); ?>><?php echo wp_kses_post( $item['original_price'] ); ?></span>
			<?php
			} ?>

			<span <?php echo $this->get_render_attribute_string( $price_key ); ?>><?php echo wp_kses_post( $item['price'] ); ?></span>
		</div>

	<?php
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$style 		= $settings['style'];

		$this->add_render_attribute( 'wrap', 'class', [
			'oew-price-list',
			'oew-price-list-' . $style
		] );

		if ( 'yes' != $settings['separator'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'no-separator' );
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>

			<?php
			foreach ( $settings['price_list'] as $index => $item ) :
				$title_key = $this->get_repeater_setting_key( 'title', 'price_list', $index );
				$this->add_render_attribute( $title_key, 'class', 'oew-price-list-title' );
				$this->add_inline_editing_attributes( $title_key, 'basic' );

				$desc_key = $this->get_repeater_setting_key( 'description', 'price_list', $index );
				$this->add_render_attribute( $desc_key, 'class', 'oew-price-list-description' );
				$this->add_inline_editing_attributes( $desc_key, 'basic' );

				$item_id 	= 'item-' . $index;

				$url 		= $item['link']['url'];
				$has_image 	= ( $item['image']['url'] ) ? 'has-image ' : '';
				$image_id   = $item['image']['id'];
				$image_size = $settings['image_size_size'];

				if ( 'custom' === $image_size ) {
					$image_src = Group_Control_Image_Size::get_attachment_image_src( $image_id, 'image_size', $settings );
				} else {
					$image_src = wp_get_attachment_image_src( $image_id, $image_size );
					$image_src = ( false !== $image_src ) ? $image_src[0] : '';
				}

				if ( '' === $image_id ) {
					if ( isset( $item['image']['url'] ) ) {
						$image_src = $item['image']['url'];
					}
				}


				$this->add_render_attribute( $item_id, 'class', 'oew-price-list-item' );

				if ( $url ) {
					$this->add_render_attribute( $item_id, 'href', $url );

					if ( $item['link']['is_external'] ) {
						$this->add_render_attribute( $item_id, 'target', '_blank' );
					} ?>

					<a <?php echo $this->get_render_attribute_string( $item_id ); ?>>

				<?php
				} else { ?>
					<div <?php echo $this->get_render_attribute_string( $item_id ); ?>>
				<?php
				} ?>
					<?php
					if ( ! empty( $item['image']['url'] ) ) { ?>
						<div class="oew-price-list-image">
							<?php echo sprintf( '<img src="%s" alt="%s" />', esc_url( $image_src ), wp_kses_post( $item['title'] ) ); ?>
						</div>
					<?php
					} ?>

					<div class="oew-price-list-text">

						<div class="oew-price-list-header">

							<span <?php echo $this->get_render_attribute_string( $title_key ); ?>><?php echo esc_html( $item['title'] ); ?></span>

							<?php
							if ( 'yes' == $settings['separator'] ) { ?>
								<span class="oew-price-list-separator"></span>
							<?php
							}

							if ( 'side' == $style ) {
								$this->render_price( $index );
							} ?>

						</div>

						<?php
						if ( $item['description'] ) { ?>
							<p <?php echo $this->get_render_attribute_string( $desc_key ); ?>><?php echo wp_kses_post( $item['description'] ); ?></p>
						<?php
						}

						if ( 'inline' == $style ) {
							$this->render_price( $index );
						} ?>

					</div>

				<?php
				if ( $item['link']['url'] ) { ?>
					</a>
				<?php
				} else { ?>
					</div>
				<?php
				} ?>

			<?php
			endforeach; ?>

		</div>

	<?php
	}

	/**
	 * Render Price List widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		view.addRenderAttribute( 'wrap', 'class', ['oew-price-list', 'oew-price-list-' + settings.style] );

		if ( 'yes' != settings.separator ) {
			view.addRenderAttribute( 'wrap', 'class', 'no-separator' );
		} #>
		<div {{{ view.getRenderAttributeString( 'wrap' ) }}}>
			<# _.each( settings.price_list, function( item, index ) {
				var key 				= view.getRepeaterSettingKey( 'wrap', 'price_list', index ),
					titleKey 			= view.getRepeaterSettingKey( 'title', 'price_list', index ),
					descKey 			= view.getRepeaterSettingKey( 'description', 'price_list', index )
					priceKey 			= view.getRepeaterSettingKey( 'price', 'price_list', index )
					discountPriceKey 	= view.getRepeaterSettingKey( 'original_price', 'price_list', index );

				view.addRenderAttribute( key, 'class', 'oew-price-list-wrap' );

				if ( 'yes' === item.has_discount ) {
					view.addRenderAttribute( key, 'class', 'has-discount' );
				}

				view.addRenderAttribute( titleKey, 'class', 'oew-price-list-title' );
				view.addInlineEditingAttributes( titleKey, 'basic' );

				view.addRenderAttribute( descKey, 'class', 'oew-price-list-description' );
				view.addInlineEditingAttributes( descKey, 'basic' );

				view.addRenderAttribute( priceKey, 'class', 'oew-price-list-price' );
				view.addInlineEditingAttributes( priceKey, 'basic' );

				view.addRenderAttribute( discountPriceKey, 'class', 'oew-price-list-discount-price' );
				view.addInlineEditingAttributes( discountPriceKey, 'basic' );

				if ( item.link.url ) { #>
					<a class="oew-price-list-item" href="{{ item.link.url }}">
				<# } else { #>
					<div class="oew-price-list-item">
				<# } #>
					<# if ( item.image && item.image.id ) {

						var image = {
							id: item.image.id,
							url: item.image.url,
							size: settings.image_size_size,
							dimension: settings.image_custom_dimension,
							model: view.getEditModel()
						};

						var image_url = elementor.imagesManager.getImageUrl( image );

						if ( image_url ) { #>
							<div class="oew-price-list-image"><img src="{{ image_url }}" alt="{{ item.title }}"></div>
						<# } #>

					<# } #>

					<div class="oew-price-list-text">

						<div class="oew-price-list-header">

							<span {{{ view.getRenderAttributeString( titleKey ) }}}>{{{ item.title }}}</span>

							<# if ( 'yes' == settings.separator ) { #>
								<span class="oew-price-list-separator"></span>
							<# } #>

							<# if ( 'side' == settings.style ) { #>
								<div {{{ view.getRenderAttributeString( key ) }}}>
									<# if( 'yes' == item.has_discount ) { #>
										<span {{{ view.getRenderAttributeString( discountPriceKey ) }}}>{{{ item.original_price }}}</span>
									<# } #>

									<span {{{ view.getRenderAttributeString( priceKey ) }}}>{{{ item.price }}}</span>
								</div>
							<# } #>

						</div>

						<# if ( item.description ) { #>
							<p {{{ view.getRenderAttributeString( descKey ) }}}>{{{ item.description }}}</p>
						<# } #>

						<# if ( 'inline' == settings.style ) { #>
							<div {{{ view.getRenderAttributeString( key ) }}}>
								<# if( 'yes' == item.has_discount ) { #>
									<span {{{ view.getRenderAttributeString( discountPriceKey ) }}}>{{{ item.original_price }}}</span>
								<# } #>

								<span {{{ view.getRenderAttributeString( priceKey ) }}}>{{{ item.price }}}</span>
							</div>
						<# } #>

					</div>

				<# if ( item.link.url ) { #>
					</a>
				<# } else { #>
					</div>
				<# } #>

			<# } ); #>
		</div>
	<?php
	}

}