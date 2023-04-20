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

class Woo_Products extends Widget_Base {

	private $query = null;

	public function get_name() {
		return 'oew-woo-products';
	}

	public function get_title() {
		return __( 'Woo - Products', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-woocommerce';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_query() {
		return $this->query;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_woo_products',
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
			'posts_per_page',
			[
				'label' 		=> __( 'Products Count', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::NUMBER,
				'default' 		=> '4',
			]
		);

		$this->add_control(
			'pagination',
			[
				'label' 		=> __( 'Pagination', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> '',
			]
		);

		$this->add_control(
			'pagination_position',
			[
				'label' 		=> __( 'Pagination Position', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon' 	=> 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon' 	=> 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon' 	=> 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} ul.page-numbers' => 'text-align: {{VALUE}};',
				],
				'default' 		=> 'center',
				'condition' => [
					'pagination' => 'yes',
				],
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
			'query_type',
			[
				'label'   		=> __( 'Source', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'all',
				'options' 		=> [
					'all'    => __( 'All Products', 'ocean-elementor-widgets' ),
					'custom' => __( 'Custom Query', 'ocean-elementor-widgets' ),
					'manual' => __( 'Manual Selection', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'category_filter_rule',
			[
				'label'     	=> __( 'Cat Filter Rule', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SELECT,
				'default'   	=> 'IN',
				'options'   	=> [
					'IN'     => __( 'Match Categories', 'ocean-elementor-widgets' ),
					'NOT IN' => __( 'Exclude Categories', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'query_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'category_filter',
			[
				'label'     	=> __( 'Select Categories', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SELECT2,
				'multiple'  	=> true,
				'default'   	=> '',
				'options'   	=> $this->get_product_categories(),
				'condition' 	=> [
					'query_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'tag_filter_rule',
			[
				'label'     	=> __( 'Tag Filter Rule', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SELECT,
				'default'   	=> 'IN',
				'options'   	=> [
					'IN'     => __( 'Match Tags', 'ocean-elementor-widgets' ),
					'NOT IN' => __( 'Exclude Tags', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'query_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'tag_filter',
			[
				'label'     	=> __( 'Select Tags', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SELECT2,
				'multiple'  	=> true,
				'default'   	=> '',
				'options'   	=> $this->get_product_tags(),
				'condition' 	=> [
					'query_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'offset',
			[
				'label'       	=> __( 'Offset', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::NUMBER,
				'default'     	=> 0,
				'description' 	=> __( 'Number of post to displace or pass over.', 'ocean-elementor-widgets' ),
				'condition'   	=> [
					'query_type' => 'custom',
				],
			]
		);

		$this->add_control(
			'query_manual_ids',
			[
				'label'     	=> __( 'Select Products', 'ocean-elementor-widgets' ),
				'type'      	=> 'oew-query-posts',
				'post_type' 	=> 'product',
				'multiple'  	=> true,
				'condition'	 => [
					'query_type' => 'manual',
				],
			]
		);

		$this->add_control(
			'query_exclude',
			[
				'label'     	=> __( 'Exclude', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> [
					'query_type!' => 'manual',
				],
			]
		);

		$this->add_control(
			'query_exclude_ids',
			[
				'label'       	=> __( 'Select Products', 'ocean-elementor-widgets' ),
				'type'        	=> 'oew-query-posts',
				'post_type'   	=> 'product',
				'multiple'    	=> true,
				'description' 	=> __( 'Select products to exclude from the query.', 'ocean-elementor-widgets' ),
				'condition'   	=> [
					'query_type!' => 'manual',
				],
			]
		);

		$this->add_control(
			'query_exclude_current',
			[
				'label'        	=> __( 'Exclude Current Product', 'ocean-elementor-widgets' ),
				'type'         	=> Controls_Manager::SWITCHER,
				'label_on'     	=> __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    	=> __( 'No', 'ocean-elementor-widgets' ),
				'return_value' 	=> 'yes',
				'default'      	=> '',
				'description'  	=> __( 'Enable this option to remove current product from the query.', 'ocean-elementor-widgets' ),
				'condition'    	=> [
					'query_type!' => 'manual',
				],
			]
		);

		$this->add_control(
			'advanced',
			[
				'label' 		=> __( 'Advanced', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'filter_by',
			[
				'label' 		=> __( 'Filter By', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					'' 			=> __( 'None', 'ocean-elementor-widgets' ),
					'featured' 	=> __( 'Featured', 'ocean-elementor-widgets' ),
					'sale' 		=> __( 'Sale', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' 		=> __( 'Order by', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'date',
				'options' 		=> [
					'date' 			=> __( 'Date', 'ocean-elementor-widgets' ),
					'title' 		=> __( 'Title', 'ocean-elementor-widgets' ),
					'price' 		=> __( 'Price', 'ocean-elementor-widgets' ),
					'popularity' 	=> __( 'Popularity', 'ocean-elementor-widgets' ),
					'rating' 		=> __( 'Rating', 'ocean-elementor-widgets' ),
					'rand' 			=> __( 'Random', 'ocean-elementor-widgets' ),
					'menu_order' 	=> __( 'Menu Order', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' 		=> __( 'Order', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
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
					'{{WRAPPER}} .woocommerce .products .owp-content-center .product-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'item_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .woocommerce .products .owp-content-center .product-inner',
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
					'{{WRAPPER}} .woocommerce .products .owp-content-center .product-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'item_box_shadow',
				'selector' 		=> '{{WRAPPER}} .woocommerce .products .owp-content-center .product-inner',
			]
		);

		$this->add_responsive_control(
			'item_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce .products .owp-content-center .product-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .woocommerce .products .owp-content-center .product-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-image',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-image, {{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner li.image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; position: relative; overflow: hidden;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-image',
			]
		);

		$this->add_responsive_control(
			'image_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'category_heading',
			[
				'label' 		=> __( 'Category', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'category_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product li.category a',
			]
		);

		$this->add_control(
			'category_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product li.category a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'category_hover_color',
			[
				'label'     	=> esc_html__( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product li.category a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'category_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product li.category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' 		=> __( 'Title', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product li.title a',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product li.title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     	=> esc_html__( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product li.title a:hover' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .woocommerce ul.products li.product .woo-entry-inner li.title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'price_heading',
			[
				'label' 		=> __( 'Price', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'price_color',
			[
				'label'     	=> esc_html__( 'Price Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .price, {{WRAPPER}} .woocommerce ul.products li.product .price .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'price_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .price, {{WRAPPER}} .woocommerce ul.products li.product .price .amount',
			]
		);

		$this->add_control(
			'del_price_color',
			[
				'label'     	=> esc_html__( 'Del Price Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .price del .amount' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'del_price_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .price del .amount',
			]
		);

		$this->add_responsive_control(
			'price_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product li.inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'rating_heading',
			[
				'label' 		=> __( 'Rating', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'rating_color',
			[
				'label'     	=> esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .star-rating span::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'rating_fill_color',
			[
				'label'     	=> esc_html__( 'Fill Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .star-rating::before' => 'color: {{VALUE}};',
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
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a',
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
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a:hover' => 'border-color: {{VALUE}};',
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
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a',
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
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .woocommerce ul.products li.product .product-inner .btn-wrap a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_badge_style',
			[
				'label' 		=> __( 'Badge', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'badge_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .woocommerce span.onsale',
			]
		);

		$this->add_control(
			'badge_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce span.onsale' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'badge_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce span.onsale' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'badge_border',
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .woocommerce span.onsale',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'badge_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce span.onsale' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'badge_box_shadow',
				'selector' 		=> '{{WRAPPER}} .woocommerce span.onsale',
			]
		);

		$this->add_responsive_control(
			'badge_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce span.onsale' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'badge_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .woocommerce span.onsale' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function get_product_categories() {

		$product_cat = array();

		$cat_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$product_categories = get_terms( 'product_cat', $cat_args );

		if ( ! empty( $product_categories ) ) {
			foreach ( $product_categories as $key => $category ) {
				$product_cat[ $category->slug ] = $category->name;
			}
		}

		return $product_cat;
	}

	protected function get_product_tags() {

		$product_tag = array();

		$tag_args = array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
		);

		$product_tag = get_terms( 'product_tag', $tag_args );

		if ( ! empty( $product_tag ) ) {
			foreach ( $product_tag as $key => $tag ) {
				$product_tag[ $tag->slug ] = $tag->name;
			}
		}

		return $product_tag;
	}

	public function query_posts() {
		$settings = $this->get_settings();
		
		global $post;

		$query_args = [
			'post_type'      => 'product',
			'posts_per_page' => $settings['posts_per_page'],
			'post__not_in'   => array(),
		];

		// Default ordering args.
		$ordering_args = WC()->query->get_catalog_ordering_args( $settings['orderby'], $settings['order'] );

		$query_args['orderby'] = $ordering_args['orderby'];
		$query_args['order']   = $ordering_args['order'];

		if ( 'sale' === $settings['filter_by'] ) {
			$query_args['post__in'] = array_merge( array( 0 ), wc_get_product_ids_on_sale() );
		} elseif ( 'featured' === $settings['filter_by'] ) {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();

			$query_args['tax_query'][] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['featured'],
			];
		}

		if ( 'custom' === $settings['query_type'] ) {
			if ( ! empty( $settings['category_filter'] ) ) {
				$cat_operator = $settings['category_filter_rule'];

				$query_args['tax_query'][] = [
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => $settings['category_filter'],
					'operator' => $cat_operator,
				];
			}

			if ( ! empty( $settings['tag_filter'] ) ) {
				$tag_operator = $settings['tag_filter_rule'];

				$query_args['tax_query'][] = [
					'taxonomy' => 'product_tag',
					'field'    => 'slug',
					'terms'    => $settings['tag_filter'],
					'operator' => $tag_operator,
				];
			}

			if ( 0 < $settings['offset'] ) {
				$query_args['offset_to_fix'] = $settings['offset'];
			}
		}

		if ( 'manual' === $settings['query_type'] ) {
			$manual_ids = $settings['query_manual_ids'];
			$query_args['post__in'] = $manual_ids;
		}

		if ( 'manual' !== $settings['query_type'] ) {
			if ( '' !== $settings['query_exclude_ids'] ) {
				$exclude_ids = $settings['query_exclude_ids'];
				$query_args['post__not_in'] = $exclude_ids;
			}

			if ( 'yes' === $settings['query_exclude_current'] ) {
				$query_args['post__not_in'][] = $post->ID;
			}
		}

		if ( 'yes' === $settings['pagination'] ) {

			// Paged
			global $paged;
			if ( get_query_var( 'paged' ) ) {
				$paged = get_query_var( 'paged' );
			} else if ( get_query_var( 'page' ) ) {
				$paged = get_query_var( 'page' );
			} else {
				$paged = 1;
			}

			$query_args['posts_per_page'] = $settings['posts_per_page'];

			if ( 1 < $paged ) {
				$query_args['paged'] = $paged;
			}

		}

		$this->query = new \WP_Query( $query_args );
	}

	public function render() {
		$settings = $this->get_settings();

		$this->query_posts();
		
		$query = $this->get_query();

		if ( ! $query->have_posts() ) {
			return;
		}

		global $woocommerce_loop;

		$woocommerce_loop['columns'] = (int) $settings['columns'];

		echo '<div class="woocommerce columns-' . $woocommerce_loop['columns'] . '">';

		woocommerce_product_loop_start();

		while ( $query->have_posts() ) : $query->the_post();
			wc_get_template_part( 'content', 'product' );
		endwhile;

		woocommerce_product_loop_end();

		// Display pagination if enabled
		if ( 'yes' == $settings['pagination'] ) {
			oceanwp_pagination( $query );
		}

		woocommerce_reset_loop();

		wp_reset_postdata();

		echo '</div>';
	}

}