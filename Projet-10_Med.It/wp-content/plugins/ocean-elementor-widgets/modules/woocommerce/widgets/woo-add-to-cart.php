<?php
namespace owpElementor\Modules\Woocommerce\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use owpElementor\Modules\QueryPost\Module;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Woo_Add_To_Cart extends Widget_Base {

	public function get_name() {
		return 'oew-woo-add-to-cart';
	}

	public function get_title() {
		return __( 'Woo - Add To Cart', 'ocean-elementor-widgets' );
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
            'add to cart',
            'button',
            'owp',
        ];
    }

	public function get_style_depends() {
		return [ 'oew-woo-addtocart' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_woo_product',
			[
				'label' 		=> __( 'Product', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'product_id',
			[
				'label' 		=> __( 'Select Product', 'ocean-elementor-widgets' ),
				'type' 			=> 'oew-query-posts',
				'post_type' 	=> 'product',
			]
		);

		$this->add_control(
			'quantity',
			[
				'label' 		=> __( 'Quantity', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> 1,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' 		=> __( 'Button', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Add To Cart', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
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
					'value'   => 'fas fa-shopping-basket',
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
					'{{WRAPPER}} .oew-addtocart .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-addtocart .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .oew-addtocart .oew-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
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
				'name' 			=> 'button_typography',
				'selector' 		=> '{{WRAPPER}} .oew-addtocart',
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
			'button_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart' => 'color: {{VALUE}};',
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
			'button_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'button_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-addtocart',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-addtocart',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'button_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_view_cart_style',
			[
				'label' 		=> __( 'View Cart Text', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'view_cart_typography',
				'selector' 		=> '{{WRAPPER}} .oew-addtocart-wrap .added_to_cart',
			]
		);

		$this->start_controls_tabs( 'tabs_view_cart_style' );

		$this->start_controls_tab(
			'tab_view_cart_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'view_cart_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view_cart_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_view_cart_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'view_cart_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view_cart_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'view_cart_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'view_cart_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-addtocart-wrap .added_to_cart',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'view_cart_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'view_cart_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-addtocart-wrap .added_to_cart',
			]
		);

		$this->add_responsive_control(
			'view_cart_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'view_cart_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-addtocart-wrap .added_to_cart' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$html 		= '';
		$product 	= false;

		if ( ! empty( $settings['product_id'] ) ) {
			$product_data = get_post( $settings['product_id'] );
		}

		$product = ! empty( $product_data ) && in_array( $product_data->post_type, [ 'product', 'product_variation' ] ) ? wc_setup_product_data( $product_data ) : false;

		$this->add_render_attribute( 'button-wrap', 'class', 'oew-addtocart-wrap' );
		$this->add_render_attribute( 'button-text', 'class', 'oew-addtocart-text' );

		if ( $product ) {

			$product_id   = $product->get_id();
			$product_type = $product->get_type();

			$class = [
				'oew-addtocart',
				'button',
				'product_type_' . $product_type,
				$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
				$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
			];

			$this->add_render_attribute(
				'button', [
					'href'            => $product->add_to_cart_url(),
					'class'           => $class,
					'data-quantity'   => ( isset( $settings['quantity'] ) ? $settings['quantity'] : 1 ),
					'data-product_id' => $product_id,
					'rel'             => 'nofollow',
				]
			);
		
			$this->add_render_attribute( 'icon-align', 'class', [
				'oew-button-icon',
				'elementor-align-icon-' . $settings['icon_align'],
			] ); ?>

			<div <?php echo $this->get_render_attribute_string( 'button-wrap' ); ?>>
				<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
					<?php
					if ( ! empty( $settings['icon'] ) && 'left' == $settings['icon_align'] ) { ?>
						<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
							<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</span>
					<?php
					} ?>

					<span <?php echo $this->get_render_attribute_string( 'button-text' ); ?>><?php echo esc_attr( $settings['text'] ); ?></span>

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
		} elseif ( current_user_can( 'manage_options' ) ) {

			$this->add_render_attribute( 'button', 'href', '#' );
			$this->add_render_attribute( 'button', 'class', [
				'oew-addtocart',
				'button',
			] ); ?>

			<div <?php echo $this->get_render_attribute_string( 'button-wrap' ); ?>>
				<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
					<span <?php echo $this->get_render_attribute_string( 'button-text' ); ?>><?php echo __( 'Please select a product', 'ocean-elementor-widgets' ); ?></span>
				</a>
			</div>

		<?php
		}
	}

}