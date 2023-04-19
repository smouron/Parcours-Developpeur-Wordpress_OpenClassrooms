<?php
namespace owpElementor\Modules\MagazineGridSimple\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\WP_Query;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Magazine_Grid_Simple extends Widget_Base {

	/**
	 * Get Widget Name
	 *
	 * @return string
	 */
	public function get_name() {
		return 'oew-magazine-grid-simple';
	}

	/**
	 * Get Widget Title
	 *
	 * @return string
	 */
	public function get_title() {
		return __( 'Magazine Grid Simple', 'ocean-elementor-widgets' );
	}

	/**
	 * Get Widget Icon
	 *
	 * @return string
	 */
	public function get_icon() {
		return 'oew-icon eicon-posts-grid';
	}

	/**
	 * Get Widget Categories
	 *
	 * @return array
	 */
	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	/**
	 * Get Widget Keywords
	 *
	 * @return array
	 */
	public function get_keywords() {
		return array(
			'post',
			'blog post',
			'blog',
			'grid',
			'owp',
		);
	}

	/**
	 * Get Style Depends
	 *
	 * @return array
	 */
	public function get_style_depends() {
		return array( 'oew-magazine-grid-simple' );
	}

	/**
	 * Register Controls
	 *
	 * @return void
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'           => __( 'Grid Columns', 'ocean-elementor-widgets' ),
				'type'            => Controls_Manager::SELECT,
				'default'         => 3,
				'options'         => array(
					'1' => esc_html__( '1', 'ocean-elementor-widgets' ),
					'2' => esc_html__( '2', 'ocean-elementor-widgets' ),
					'3' => esc_html__( '3', 'ocean-elementor-widgets' ),
					'4' => esc_html__( '4', 'ocean-elementor-widgets' ),
					'5' => esc_html__( '5', 'ocean-elementor-widgets' ),
					'6' => esc_html__( '6', 'ocean-elementor-widgets' ),
				),
				'desktop_default' => 2,
				'tablet_default'  => 2,
				'mobile_default'  => 1,
				'separator'       => 'before',
			)
		);

		$this->add_control(
			'selected_category',
			array(
				'label'       => __( 'Select Category', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => wp_list_pluck( get_terms( 'category' ), 'name', 'term_id' ),
				'multiple'    => true,
				'default'     => array(),
			)
		);

		$this->add_control(
			'posts_per_page',
			array(
				'label'       => __( 'Post Per Page', 'ocean-elementor-widgets' ),
				'description' => __( 'You can enter "-1" to display all posts.', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => __( 'Order', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => array(
					'DESC' => __( 'Default', 'ocean-elementor-widgets' ),
					'DESC' => __( 'DESC', 'ocean-elementor-widgets' ),
					'ASC'  => __( 'ASC', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => __( 'Order By', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => array(
					''              => __( 'Default', 'ocean-elementor-widgets' ),
					'date'          => __( 'Date', 'ocean-elementor-widgets' ),
					'title'         => __( 'Title', 'ocean-elementor-widgets' ),
					'name'          => __( 'Name', 'ocean-elementor-widgets' ),
					'modified'      => __( 'Modified', 'ocean-elementor-widgets' ),
					'author'        => __( 'Author', 'ocean-elementor-widgets' ),
					'rand'          => __( 'Random', 'ocean-elementor-widgets' ),
					'ID'            => __( 'ID', 'ocean-elementor-widgets' ),
					'comment_count' => __( 'Comment Count', 'ocean-elementor-widgets' ),
					'menu_order'    => __( 'Menu Order', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'show_date',
			array(
				'label'        => __( 'Date', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'show_author',
			array(
				'label'        => __( 'Author', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_author_image',
			array(
				'label'        => __( 'Author Image', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
				'condition'    => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'image_position',
			array(
				'label'   => __( 'Image Position', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => array(
					'left'  => __( 'Left', 'ocean-elementor-widgets' ),
					'right' => __( 'Right', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'inage_width',
			array(
				'label'     => __( 'Image Width', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 150,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 500,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-image img' => 'min-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_radius',
			array(
				'label'       => __( 'Radius', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::DIMENSIONS,
				'size_units'  => array( 'px', '%', 'rem', 'em' ),
				'label_block' => true,
				'selectors'   => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .oew-magazine-grid-simple-post-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-image img',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-image img',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_style',
			array(
				'label' => __( 'Category', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-info-category a',
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-category a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'category_color_hover',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-category:hover a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'category_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#f6a32b',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-category' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'category_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'category_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'category_border',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-info-category',
			)
		);

		$this->add_responsive_control(
			'category_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'category_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-info-category',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color_hover',
			array(
				'label'     => __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-title a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-title' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .oew-magazine-grid-simple-post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'title_border',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-title',
			)
		);

		$this->add_responsive_control(
			'title_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'title_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_date_style',
			array(
				'label' => __( 'Date', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'date_typography',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-info-date a.datetime',
			)
		);

		$this->add_control(
			'date_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-date a.datetime' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'date_color_hover',
			array(
				'label'     => __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-date a.datetime:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'date_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .datetime' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'date_background_color_hover',
			array(
				'label'     => __( 'Background Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-item .oew-magazine-grid-simple-post-info-date a.datetime:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'date_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-date a.datetime' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'date_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .oew-magazine-grid-simple-post-info-date a.datetime' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'date_border',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-info-date a.datetime',
			)
		);

		$this->add_responsive_control(
			'date_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-info-date a.datetime' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'date_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-grid-simple-post-info-date a.datetime',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_style',
			array(
				'label'     => __( 'Author', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_author' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'author_typography',
				'selector' => '{{WRAPPER}} .author-block a, {{WRAPPER}} .author-block span',
			)
		);

		$this->add_control(
			'author_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .author-block a, {{WRAPPER}} .author-block span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'author_color_hover',
			array(
				'label'     => __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .author-block:hover a, {{WRAPPER}} .author-block:hover span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'author_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .author-block' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'author_background_color_hover',
			array(
				'label'     => __( 'Background Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-grid-simple-post-item .oew-magazine-grid-simple-post-info-date .author-block:hover:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-magazine-grid-simple-post-item .oew-magazine-grid-simple-post-info-date .author-block:hover' => 'background-color: transparent;',
				),
			)
		);

		$this->add_responsive_control(
			'author_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .author-block' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'author_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .author-block' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'author_border',
				'selector' => '{{WRAPPER}} .author-block',
			)
		);

		$this->add_responsive_control(
			'author_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .author-block' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'author_box_shadow',
				'selector' => '{{WRAPPER}} .author-block',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_image_style',
			array(
				'label'     => __( 'Author Image', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_author_image' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'avatar_image_size',
			array(
				'label'   => __( 'Size', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 25,
			)
		);

		$this->add_responsive_control(
			'avatar_image_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .author-block .author-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'avatar_image_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .author-block .author-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'avatar_image_border',
				'selector' => '{{WRAPPER}} .author-block .author-img',
			)
		);

		$this->add_responsive_control(
			'avatar_image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .author-block .author-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'avatar_image_box_shadow',
				'selector' => '{{WRAPPER}} .author-block .author-img',
			)
		);
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$title_tag = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';

		$order             = $settings['order'];
		$orderby           = $settings['orderby'];
		$posts_per_page    = $settings['posts_per_page'];
		$categories        = $settings['selected_category'];
		$avatar_image_size = $settings['avatar_image_size'];

		$this->add_render_attribute( 'oew-magazine-grid-simple-post-item', 'class', 'oew-magazine-grid-simple-post-item' );
		$this->add_render_attribute( 'oew-magazine-grid-simple-post-item', 'class', 'image-' . $settings['image_position'] );

		// Wrapper classes.
		$wrap_attributes   = array();
		$wrap_attributes[] = 'data-desktop-columns=' . $settings['columns'];
		$wrap_attributes[] = isset( $settings['columns_tablet'] ) ? 'data-tablet-columns=' . $settings['columns_tablet'] : 'data-tablet-columns=2';
		$wrap_attributes[] = isset( $settings['columns_mobile'] ) ? 'data-mobile-columns=' . $settings['columns_mobile'] : 'data-mobile-columns=1';
		$wrap_attributes   = implode( ' ', $wrap_attributes );

		$args = array(
			'post_type'      => 'post',
			'category__in'   => $categories,
			'posts_per_page' => $posts_per_page,
			'order'          => $order,
			'orderby'        => $orderby,
		);

		?>
		<?php $query = new \WP_Query( $args ); ?>

		<div class="oew-magazine-grid-simple-wrapper" <?php echo $wrap_attributes; ?>>
		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			$post_category = get_the_category( get_the_ID() );
			?>
			<div <?php echo $this->get_render_attribute_string( 'oew-magazine-grid-simple-post-item' ); ?>>

				<div class="oew-magazine-grid-simple-post-item-inner">
					<div class="oew-magazine-grid-simple-post-image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php
								if ( has_post_thumbnail() ) {
									echo get_the_post_thumbnail( get_the_ID(), 'thumbnail' );
								}
								?>
						</a>
					</div>

					<div class="oew-magazine-grid-simple-post-content">

						<div class="oew-magazine-grid-simple-post-info oew-magazine-grid-simple-post-info-top">
							<div class="oew-magazine-grid-simple-post-info-category">
									<?php
									foreach ( $post_category as $key => $value ) {
										echo '<a href="' . esc_url( get_category_link( $value->term_id ) ) . '">' . $value->name . '</a>';
									}
									?>
							</div>
						</div>

						<div>
							<<?php echo $title_tag; ?> class="oew-magazine-grid-simple-post-title">
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
									<?php the_title(); ?> </a>
							</<?php echo $title_tag; ?>>
						</div>

						<div class="oew-magazine-grid-simple-post-info-date">
								<?php if ( 'yes' == $settings['show_date'] ) : ?>
									<a class="datetime" href="#"><?php echo get_the_date(); ?></a>
								<?php endif; ?>
								<div class="author-block">
									<?php if ( 'yes' == $settings['show_author'] ) : ?>
										<?php if ( 'yes' == $settings['show_author_image'] ) : ?>
											<div class="oew-magazine-grid-simple-post-info-author-image">
												<?php echo '<img class="author-img" src="' . esc_url( get_avatar_url( get_the_author_meta( 'ID' ), array( 'size' => $avatar_image_size ) ) ) . '" alt="' . esc_html( get_the_title() ) . '" />'; ?>
											</div>	
										<?php endif; ?>
										<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo esc_html( get_the_author() ); ?></a>
									<?php endif; ?>
								</div>
						</div>
					</div>
				</div>
			</div>
			<?php
		endwhile;
		wp_reset_postdata();
		?>
		</div>
		<?php
	}

}
