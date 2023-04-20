<?php
namespace owpElementor\Modules\Woocommerce\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Woo_Categories extends Widget_Base {

	public function get_name() {
		return 'oew-woo-categories';
	}

	public function get_title() {
		return __( 'Woo - Categories', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-woocommerce';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_woo_categories',
			[
				'label' 		=> __( 'Products', 'ocean-elementor-widgets' ),
			]
		);
		
		$this->add_control(
			'columns',
			[
				'label' 		=> __( 'Columns', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '4',
				'options' 		=> [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
				],
			]
		);

		$this->add_control(
			'number',
			[
				'label' 		=> __( 'Categories Count', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '4',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filter',
			[
				'label' 		=> __( 'Query', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'source',
			[
				'label'   		=> _x( 'Source', 'Posts Query Control', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'options' 		=> [
					''          => __( 'Show All', 'ocean-elementor-widgets' ),
					'by_id'     => __( 'Manual Selection', 'ocean-elementor-widgets' ),
					'by_parent' => __( 'By Parent', 'ocean-elementor-widgets' ),
				],
			]
		);

		$categories = get_terms( 'product_cat' );

		$options = [];
		foreach ( $categories as $category ) {
			$options[ $category->term_id ] = $category->name;
		}

		$this->add_control(
			'categories',
			[
				'label' 		=> __( 'Categories', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::SELECT2,
				'options'     	=> $options,
				'default'     	=> [],
				'label_block' 	=> true,
				'multiple'    	=> true,
				'condition'   	=> [
					'source' => 'by_id',
				],
			]
		);

		$parent_options = [ '0' => __( 'Only Top Level', 'ocean-elementor-widgets' ) ] + $options;
		$this->add_control(
			'parent',
			[
				'label'     	=> __( 'Parent', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SELECT,
				'default'   	=> '0',
				'options'   	=> $parent_options,
				'condition' 	=> [
					'source' => 'by_parent',
				],
			]
		);

		$this->add_control(
			'hide_empty',
			[
				'label'        	=> __( 'Hide Empty', 'ocean-elementor-widgets' ),
				'type'         	=> Controls_Manager::SWITCHER,
				'return_value' 	=> 'yes',
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   		=> __( 'Order by', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'name',
				'options' 		=> [
					'name'        => __( 'Name', 'ocean-elementor-widgets' ),
					'slug'        => __( 'Slug', 'ocean-elementor-widgets' ),
					'description' => __( 'Description', 'ocean-elementor-widgets' ),
					'count'       => __( 'Count', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   		=> __( 'Order', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'desc',
				'options' 		=> [
					'asc'  => __( 'ASC', 'ocean-elementor-widgets' ),
					'desc' => __( 'DESC', 'ocean-elementor-widgets' ),
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
			'item_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce .products .product-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'item_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .woocommerce .products .product-inner',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'item_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce .products .product-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'item_box_shadow',
				'selector' 		=> '{{WRAPPER}} .woocommerce .products .product-inner',
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce .products .product-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'item_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce .products .product-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'image_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product-category.product .woo-entry-image img',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product-category.product .woo-entry-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product-category.product .woo-entry-image img',
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product-category.product .woo-entry-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' 			=> 'title_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner a .woocommerce-loop-category__title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner a .woocommerce-loop-category__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     	=> esc_html__( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner a:hover .woocommerce-loop-category__title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner a .woocommerce-loop-category__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[
				'label' 		=> __( 'Description', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'desc_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner .description',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner .description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	private function get_shortcode() {
		$settings = $this->get_settings();

		$attributes = [
			'number'     => $settings['number'],
			'columns'    => $settings['columns'],
			'hide_empty' => ( 'yes' === $settings['hide_empty'] ) ? 1 : 0,
			'orderby'    => $settings['orderby'],
			'order'      => $settings['order'],
		];

		if ( 'by_id' === $settings['source'] ) {
			$attributes['ids'] = implode( ',', $settings['categories'] );
		} elseif ( 'by_parent' === $settings['source'] ) {
			$attributes['parent'] = $settings['parent'];
		}

		$this->add_render_attribute( 'shortcode', $attributes );

		$shortcode = sprintf( '[product_categories %s]', $this->get_render_attribute_string( 'shortcode' ) );

		return $shortcode;
	}

	public function render() {
		echo do_shortcode( $this->get_shortcode() );
	}

	public function render_plain_content() {
		echo $this->get_shortcode();
	}

}