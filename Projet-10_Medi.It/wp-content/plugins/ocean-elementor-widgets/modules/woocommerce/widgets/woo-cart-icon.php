<?php
namespace owpElementor\Modules\Woocommerce\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use owpElementor\Modules\Woocommerce\Module;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Woo_CartIcon extends Widget_Base {

    public function get_name() {
		return 'oew-woo-cart-icon';
	}

	public function get_title() {
		return __( 'Woo - Cart Icon', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-woocommerce';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'woo',
            'woocommerce',
            'ecommerce',
            'cart',
            'icon',
            'owp',
        ];
    }

	public function get_script_depends() {
		return array( 'oew-woo-cart-icon' );
	}

	public function get_style_depends() {
		return [ 'oew-woo-cart-icon' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cart_icon',
			[
				'label' 		=> __( 'Cart Icon', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label'   		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'dropdown',
				'options' 		=> [
					'basket'  			=> __( 'Basket', 'ocean-elementor-widgets' ),
					'handbag'  			=> __( 'Handbag', 'ocean-elementor-widgets' ),
					'shopping-basket'  	=> __( 'Shopping Basket', 'ocean-elementor-widgets' ),
					'shopping-bag'  	=> __( 'Shopping Bag', 'ocean-elementor-widgets' ),
					'shopping-cart'  	=> __( 'Shopping Cart', 'ocean-elementor-widgets' ),
				],
				'prefix_class' => 'oew-cart-icon-',
			]
		);

		$this->add_control(
			'show_count',
			[
				'label' 		=> __( 'Items Count', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_on' 		=> __( 'Show', 'ocean-elementor-widgets' ),
				'label_off' 	=> __( 'Hide', 'ocean-elementor-widgets' ),
				'return_value' 	=> 'yes',
				'prefix_class' 	=> 'oew-cart-show-count-',
			]
		);

		$this->add_control(
			'show_subtotal',
			[
				'label' 		=> __( 'Subtotal', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'label_on' 		=> __( 'Show', 'ocean-elementor-widgets' ),
				'label_off' 	=> __( 'Hide', 'ocean-elementor-widgets' ),
				'return_value' 	=> 'yes',
				'prefix_class' 	=> 'oew-cart-show-subtotal-',
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
				'default' 		=> '',
				'prefix_class' => 'oew%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> esc_html__( 'Icon', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' 		=> __( 'Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'size_units' 	=> [ 'px', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .oew-cart-link .owp-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-cart-link .owp-icon use' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon_bg_hover',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link:hover i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_border_color_hover',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'icon_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-cart-link',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'icon_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'items_count_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Items Count', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
				'condition' 	=> [
					'show_count!' => '',
				],
			]
		);

		$this->add_control(
			'items_count_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-count' => 'color: {{VALUE}}',
				],
				'condition' 	=> [
					'show_count!' => '',
				],
			]
		);

		$this->add_control(
			'items_count_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-count' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .oew-cart-count:before' => 'border-color: {{VALUE}}',
				],
				'condition' 	=> [
					'show_count!' => '',
				],
			]
		);

		$this->add_control(
			'items_count_distance',
			[
				'label' 		=> __( 'Distance', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'unit' => 'px',
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-count' => 'margin-left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .oew-cart-count' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
				'condition' 	=> [
					'show_count!' => '',
				],
			]
		);

		$this->add_control(
			'subtotal_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Subtotal', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
				'condition' 	=> [
					'show_subtotal!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'subtotal_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-total',
				'condition' 	=> [
					'show_subtotal!' => '',
				],
			]
		);

		$this->add_control(
			'subtotal_distance',
			[
				'label' 		=> __( 'Distance', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'unit' => 'px',
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 50,
						'step' => 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-total' => 'margin-left: {{SIZE}}{{UNIT}}',
					'body.rtl {{WRAPPER}} .oew-cart-total' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
				'condition' 	=> [
					'show_subtotal!' => '',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_subtotal_style' );

		$this->start_controls_tab(
			'tab_subtotal_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'show_subtotal!' => '',
				],
			]
		);

		$this->add_control(
			'subtotal_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-total' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'show_subtotal!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_subtotal_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'show_subtotal!' => '',
				],
			]
		);

		$this->add_control(
			'subtotal_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-link:hover .oew-cart-total' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'show_subtotal!' => '',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cart_dropdown_style',
			[
				'label' 		=> esc_html__( 'Drop Down', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'cart_dropdown_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 350,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-cart-dropdown' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cart_dropdown_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'cart_dropdown_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-cart-dropdown',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'cart_dropdown_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cart_dropdown_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_products_style',
			[
				'label' 		=> esc_html__( 'Products', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cart_product_title_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Product Title', 'ocean-elementor-widgets' ),
			]
		);

		$this->start_controls_tabs( 'tabs_cart_product_title_style' );

		$this->start_controls_tab(
			'tab_cart_product_title_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_product_title_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid h3 a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cart_product_title_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_product_title_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid h3 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'cart_product_title_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid h3',
			]
		);

		$this->add_control(
			'cart_product_quantity_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Product Quantity', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'cart_product_quantity_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid .quantity' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'cart_product_quantity_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid .quantity',
			]
		);

		$this->add_control(
			'cart_product_price_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Product Price', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'cart_product_price_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid .quantity .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'cart_product_price_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid .quantity .amount',
			]
		);

		$this->add_control(
			'cart_remove_button_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Remove Button', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_cart_remove_button_style' );

		$this->start_controls_tab(
			'tab_cart_remove_button_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_remove_button_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid a.remove' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_remove_button_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid a.remove' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_remove_button_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid a.remove' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cart_remove_button_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_remove_button_bg_hover',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid a.remove:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_remove_button_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid a.remove:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_remove_button_border_color_hover',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li .oew-grid-wrap .oew-grid a.remove:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'cart_divider_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Divider', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'cart_divider_border_style',
			[
				'label' 		=> __( 'Style', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> [
					'' 			=> __( 'None', 'ocean-elementor-widgets' ),
					'solid' 	=> __( 'Solid', 'ocean-elementor-widgets' ),
					'double' 	=> __( 'Double', 'ocean-elementor-widgets' ),
					'dotted' 	=> __( 'Dotted', 'ocean-elementor-widgets' ),
					'dashed' 	=> __( 'Dashed', 'ocean-elementor-widgets' ),
					'groove' 	=> __( 'Groove', 'ocean-elementor-widgets' ),
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li' => 'border-bottom-style: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cart_divider_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cart_divider_width',
			[
				'label' 		=> __( 'Weight', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-products li:last-child' => 'border-bottom-width: 0',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_subtotal_style',
			[
				'label' 		=> esc_html__( 'Subtotal', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cart_subtotal_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-subtotal' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_subtotal_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-subtotal strong' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_subtotal_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-subtotal' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'cart_subtotal_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-dropdown .oew-cart-subtotal strong',
			]
		);

		$this->add_control(
			'cart_subtotal_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-subtotal' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cart_subtotal_price_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Price', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'cart_subtotal_price_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-dropdown .oew-cart-subtotal .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'cart_subtotal_price_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-dropdown .oew-cart-subtotal .amount',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_buttons_style',
			[
				'label' 		=> esc_html__( 'Buttons', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cart_wrap_buttons_bg',
			[
				'label' 		=> __( 'Wrap Background', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_wrap_buttons_padding',
			[
				'label' 		=> __( 'Wrap Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cart_view_cart_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'View Cart', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_cart_view_cart_style' );

		$this->start_controls_tab(
			'tab_cart_view_cart_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_view_cart_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_view_cart_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cart_view_cart_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_view_cart_bg_hover',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_view_cart_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_view_cart_border_color_hover',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'cart_view_cart_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart',
			]
		);

		$this->add_control(
			'cart_view_cart_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cart_view_cart_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'cart_view_cart_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-view-cart',
			]
		);

		$this->add_control(
			'cart_checkout_style',
			[
				'type' 			=> Controls_Manager::HEADING,
				'label' 		=> __( 'Checkout', 'ocean-elementor-widgets' ),
				'separator' 	=> 'before',
			]
		);

		$this->start_controls_tabs( 'tabs_cart_checkout_style' );

		$this->start_controls_tab(
			'tab_cart_checkout_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_checkout_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_checkout_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_cart_checkout_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'cart_checkout_bg_hover',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_checkout_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'cart_checkout_border_color_hover',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'cart_checkout_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout',
			]
		);

		$this->add_control(
			'cart_checkout_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'cart_checkout_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'cart_checkout_typo',
				'selector' 		=> '{{WRAPPER}} .oew-cart-footer-buttons .oew-cart-checkout',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		Module::render_menu_cart();
	}

	// No template because it cause a js error in the edit mode
	protected function content_template() {}

}