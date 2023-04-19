<?php
namespace owpElementor\Modules\TestimonialCarousel\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Testimonial_Carousel extends Widget_Base {

	public function get_name() {
		return 'oew-testimonial-carousel';
	}

	public function get_title() {
		return __( 'Testimonial Carousel', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-testimonial-carousel';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'testimonial',
			'testimonials',
			'blockquote',
			'testi',
			'review',
			'recommendation',
			'appreciation',
			'feedback',
			'testimonial carousel',
			'testimonial slider',
			'carousel',
			'slider',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-testimonial-carousel' );
	}

	public function get_style_depends() {
		return array( 'oew-testimonial-carousel' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonial',
			array(
				'label' => __( 'Testimonial', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'testimonial_style',
			array(
				'label'   => __( 'Style', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'classic',
				'options' => array(
					'classic' => __( 'Classic', 'ocean-elementor-widgets' ),
					'inline'  => __( 'Inline', 'ocean-elementor-widgets' ),
					'bubble'  => __( 'Bubble', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'testimonial_inline_image_position',
			array(
				'label'          => __( 'Image Alignment', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'before',
				'options'        => array(
					'before' => array(
						'title' => __( 'Before', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'after'  => array(
						'title' => __( 'After', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'style_transfer' => true,
				'condition'      => array(
					'testimonial_style' => 'inline',
				),
			)
		);

		$this->add_control(
			'testimonial_symbol',
			array(
				'label'   => __( 'Display Symbol', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'dynamic' => array(
					'active' => true,
				),
				'default' => 'yes',
			)
		);

		$this->add_control(
			'testimonial_alignment',
			array(
				'label'          => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'center',
				'options'        => array(
					'left'   => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'style_transfer' => true,
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'testimonial_content',
			array(
				'label'   => __( 'Content', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => array(
					'active' => true,
				),
				'rows'    => '10',
				'default' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'ocean-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'testimonial_image',
			array(
				'label'   => __( 'Choose Image', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'dynamic' => array(
					'active' => true,
				),
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'testimonial_image',
				'default'   => 'full',
				'separator' => 'none',
			)
		);

		$repeater->add_control(
			'testimonial_name',
			array(
				'label'   => __( 'Name', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Mark Wolf', 'ocean-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'testimonial_company',
			array(
				'label'   => __( 'Company', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Web Designer', 'ocean-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'testimonial_rating',
			array(
				'label'   => __( 'Display Rating', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'dynamic' => array(
					'active' => true,
				),
				'default' => 'no',
			)
		);

		$repeater->add_control(
			'testimonial_rating_number',
			array(
				'label'     => __( 'Rating Number', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'rating-five',
				'options'   => array(
					'rating-one'   => __( '1', 'ocean-elementor-widgets' ),
					'rating-two'   => __( '2', 'ocean-elementor-widgets' ),
					'rating-three' => __( '3', 'ocean-elementor-widgets' ),
					'rating-four'  => __( '4', 'ocean-elementor-widgets' ),
					'rating-five'  => __( '5', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'testimonial_rating' => 'yes',
				),
			)
		);

		$this->add_control(
			'testimonial_slider',
			array(
				'label'       => __( 'Testimonial Item', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'testimonial_content' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'ocean-elementor-widgets' ),
						'testimonial_image'   => Utils::get_placeholder_image_src(),
						'testimonial_name'    => __( 'Mark Wolf', 'ocean-elementor-widgets' ),
						'testimonial_company' => __( 'Web Designer', 'ocean-elementor-widgets' ),
						'testimonial_rating'  => 'no',
					),
					array(
						'testimonial_content' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'ocean-elementor-widgets' ),
						'testimonial_image'   => Utils::get_placeholder_image_src(),
						'testimonial_name'    => __( 'Mark Wolf', 'ocean-elementor-widgets' ),
						'testimonial_company' => __( 'Web Designer', 'ocean-elementor-widgets' ),
						'testimonial_rating'  => 'no',
					),
					array(
						'testimonial_content' => __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'ocean-elementor-widgets' ),
						'testimonial_image'   => Utils::get_placeholder_image_src(),
						'testimonial_name'    => __( 'Mark Wolf', 'ocean-elementor-widgets' ),
						'testimonial_company' => __( 'Web Designer', 'ocean-elementor-widgets' ),
						'testimonial_rating'  => 'no',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ testimonial_name }}}',
			)
		);

		$this->add_control(
			'testimonial_image_position',
			array(
				'label'          => __( 'Image Position', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'aside',
				'options'        => array(
					'aside' => __( 'Aside', 'ocean-elementor-widgets' ),
					'top'   => __( 'Top', 'ocean-elementor-widgets' ),
				),
				'condition'      => array(
					'testimonial_style!' => 'inline',
				),
				'separator'      => 'before',
				'style_transfer' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_blog_carousel',
			array(
				'label' => __( 'Carousel', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'carousel_effect',
			array(
				'label'       => __( 'Effect', 'ocean-elementor-widgets' ),
				'description' => __( 'Sets transition effect', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'slide',
				'options'     => array(
					'slide'     => __( 'Slide', 'ocean-elementor-widgets' ),
					'fade'      => __( 'Fade', 'ocean-elementor-widgets' ),
					'coverflow' => __( 'Coverflow', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'items',
			array(
				'label'          => __( 'Visible Items', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array( 'size' => 1 ),
				'tablet_default' => array( 'size' => 1 ),
				'mobile_default' => array( 'size' => 1 ),
				'range'          => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'size_units'     => '',
				'condition'      => array(
					'carousel_effect' => array( 'slide', 'coverflow' ),
				),
			)
		);

		$this->add_responsive_control(
			'slides',
			array(
				'label'          => __( 'Items By Slides', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array( 'size' => 1 ),
				'tablet_default' => array( 'size' => 1 ),
				'mobile_default' => array( 'size' => 1 ),
				'range'          => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'size_units'     => '',
				'condition'      => array(
					'carousel_effect' => array( 'slide', 'coverflow' ),
				),
			)
		);

		$this->add_responsive_control(
			'margin',
			array(
				'label'      => __( 'Items Gap', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array( 'size' => 10 ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => '',
				'condition'  => array(
					'carousel_effect' => array( 'slide', 'coverflow' ),
				),
			)
		);

		$this->add_control(
			'slider_speed',
			array(
				'label'       => __( 'Slider Speed', 'ocean-elementor-widgets' ),
				'description' => __( 'Duration of transition between slides (in ms)', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => array( 'size' => 400 ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 3000,
						'step' => 1,
					),
				),
				'size_units'  => '',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'        => __( 'Autoplay', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'      => __( 'Autoplay Speed', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array( 'size' => 2000 ),
				'range'      => array(
					'px' => array(
						'min'  => 500,
						'max'  => 5000,
						'step' => 1,
					),
				),
				'size_units' => '',
				'condition'  => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'pause_on_hover',
			array(
				'label'        => __( 'Pause On Hover', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => '',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
				'condition'    => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'infinite_loop',
			array(
				'label'        => __( 'Infinite Loop', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'navigation_heading',
			array(
				'label'     => __( 'Navigation', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'arrows',
			array(
				'label'        => __( 'Arrows', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'dots',
			array(
				'label'        => __( 'Dots', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_arrows',
			array(
				'label' => __( 'Arrows', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'arrows_size',
			array(
				'label'     => __( 'Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array( 'size' => 20 ),
				'range'     => array(
					'px' => array(
						'min'  => 10,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-carousel .oew-swiper-buttons svg' => 'width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrows_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-carousel .oew-swiper-buttons svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_icon',
			array(
				'label' => __( 'Quote Icon', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-symbol path' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-symbol-inner' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-symbol-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-symbol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icon_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-symbol-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_content',
			array(
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .oew-testimonial-content',
			)
		);

		$this->add_control(
			'content_bg',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_img',
			array(
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'img_width',
			array(
				'label'      => __( 'Image Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'size' => 60,
					'unit' => 'px',
				),
				'range'      => array(
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-image img' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'img_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'body {{WRAPPER}} .oew-testimonial-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'img_border',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-testimonial-image img',
			)
		);

		$this->add_control(
			'img_border_radius',
			array(
				'label'     => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_details',
			array(
				'label' => __( 'Details', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'name_heading',
			array(
				'label' => __( 'Name', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .oew-testimonial-name',
			)
		);

		$this->add_control(
			'company_heading',
			array(
				'label'     => __( 'Company', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'company_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-company' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'company_typography',
				'selector' => '{{WRAPPER}} .oew-testimonial-company',
			)
		);

		$this->add_control(
			'rating_heading',
			array(
				'label'     => __( 'Rating', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'rating_spacing',
			array(
				'label'      => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-rating li' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .oew-testimonial-rating li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
				),
			)
		);

		$this->add_responsive_control(
			'rating_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination',
			array(
				'label' => __( 'Pagination', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'dots_size',
			array(
				'label'     => __( 'Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array( 'size' => 8 ),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 30,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-carousel .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'dots_active_color',
			array(
				'label'     => __( 'Active Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-carousel .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'dots_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-testimonial-carousel .swiper-pagination-bullet' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function testimonial_img( $item ) {

		$html           = '<div class="oew-testimonial-image">';
			$image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'testimonial_image' );
			$html      .= $image_html;
		$html          .= '</div>';

		return $html;

	}

	protected function testimonial_meta( $item ) {
		$settings     = $this->get_settings_for_display();
		$style        = $settings['testimonial_style'];
		$img_position = $settings['testimonial_image_position'];
		$has_content  = ! ! $item['testimonial_content'];
		$has_image    = ! ! $item['testimonial_image']['url'];
		$has_name     = ! ! $item['testimonial_name'];
		$has_company  = ! ! $item['testimonial_company'];
		$has_rating   = $item['testimonial_rating'];

		$this->add_render_attribute( 'meta', 'class', 'oew-testimonial-meta' );

		if ( $item['testimonial_image']['url'] ) {
			$this->add_render_attribute( 'meta', 'class', 'oew-has-image' );
		}

		if ( $img_position && 'inline' != $style ) {
			$this->add_render_attribute( 'meta', 'class', 'oew-testimonial-image-position-' . $img_position );
		}

		if ( $has_rating ) {
			$this->add_render_attribute(
				'rating',
				array(
					'class' => array(
						'oew-testimonial-rating',
						$item['testimonial_rating_number'],
					),
				)
			);
		}

		$html      = '<div ' . $this->get_render_attribute_string( 'meta' ) . '>';
			$html .= '<div class="oew-testimonial-meta-inner">';
		if ( $has_image && 'inline' != $style ) {
			$html .= $this->testimonial_img( $item );
		}

		if ( $has_name || $has_company ) {

			$html .= '<div class="oew-testimonial-details">';
			if ( $has_name ) {
					$this->add_render_attribute( 'testimonial_name', 'class', 'oew-testimonial-name' );

					$testimonial_name_html = $item['testimonial_name'];

					$html .= '<div ' . $this->get_render_attribute_string( 'testimonial_name' ) . '>' . $testimonial_name_html . '</div>';

			}

			if ( $has_company ) {

						$this->add_render_attribute( 'testimonial_company', 'class', 'oew-testimonial-company' );

						$testimonial_company_html = $item['testimonial_company'];

						$html .= '<div ' . $this->get_render_attribute_string( 'testimonial_company' ) . '>' . $testimonial_company_html . '</div>';

			}

			if ( 'yes' == $has_rating ) {
				$html .= '<ul ' . $this->get_render_attribute_string( 'rating' ) . '>';
				$html .= '<li><i class="fas fa-star" aria-hidden="true"></i></li>';
				$html .= '<li><i class="fas fa-star" aria-hidden="true"></i></li>';
				$html .= '<li><i class="fas fa-star" aria-hidden="true"></i></li>';
				$html .= '<li><i class="fas fa-star" aria-hidden="true"></i></li>';
				$html .= '<li><i class="fas fa-star" aria-hidden="true"></i></li>';
				$html .= '</ul>';
			}

							$html .= '</div>';

		}

			$html .= '</div>';

		$html .= '</div>';

		return $html;
	}

	protected function testimonial_symbol() {
		$html          = '<div class="oew-testimonial-symbol">';
			$html     .= '<div class="oew-testimonial-symbol-inner">';
				$html .= '<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>';
			$html     .= '</div>';
		$html         .= '</div>';

		return $html;
	}

	protected function next_icon() {
		$html = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.002 512.002" xml:space="preserve"><path d="M388.425,241.951L151.609,5.79c-7.759-7.733-20.321-7.72-28.067,0.04c-7.74,7.759-7.72,20.328,0.04,28.067l222.72,222.105L123.574,478.106c-7.759,7.74-7.779,20.301-0.04,28.061c3.883,3.89,8.97,5.835,14.057,5.835c5.074,0,10.141-1.932,14.017-5.795l236.817-236.155c3.737-3.718,5.834-8.778,5.834-14.05S392.156,245.676,388.425,241.951z"/></svg>';

		return $html;
	}

	protected function prev_icon() {
		$html = '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 443.52 443.52" xml:space="preserve"><path d="M143.492,221.863L336.226,29.129c6.663-6.664,6.663-17.468,0-24.132c-6.665-6.662-17.468-6.662-24.132,0l-204.8,204.8c-6.662,6.664-6.662,17.468,0,24.132l204.8,204.8c6.78,6.548,17.584,6.36,24.132-0.42c6.387-6.614,6.387-17.099,0-23.712L143.492,221.863z"/></svg>';

		return $html;
	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$style      = $settings['testimonial_style'];
		$align      = $settings['testimonial_alignment'];
		$img_align  = $settings['testimonial_inline_image_position'];
		$has_symbol = $settings['testimonial_symbol'];

		$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-wrapper oew-carousel-container' );

		if ( $align ) {
			$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-text-align-' . $align );
		}

		if ( $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-' . $style );
		}

		if ( 'inline' == $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-image-' . $img_align );
		}

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
		$this->add_render_attribute( 'wrapper', 'class', $swiper_class );

		if ( $settings['dots'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'has-dots' );
		}

		$carousel_settings = array();

		if ( ! empty( $settings['items']['size'] ) ) {
			$carousel_settings['items'] = $settings['items']['size'];
		}

		if ( ! empty( $settings['items_tablet']['size'] ) ) {
			$carousel_settings['items-tablet'] = $settings['items_tablet']['size'];
		}

		if ( ! empty( $settings['items_mobile']['size'] ) ) {
			$carousel_settings['items-mobile'] = $settings['items_mobile']['size'];
		}

		if ( ! empty( $settings['slides']['size'] ) ) {
			$carousel_settings['slides'] = $settings['slides']['size'];
		}

		if ( ! empty( $settings['slides_tablet']['size'] ) ) {
			$carousel_settings['slides-tablet'] = $settings['slides_tablet']['size'];
		}

		if ( ! empty( $settings['slides_mobile']['size'] ) ) {
			$carousel_settings['slides-mobile'] = $settings['slides_mobile']['size'];
		}

		if ( ! empty( $settings['margin']['size'] ) ) {
			$carousel_settings['margin'] = $settings['margin']['size'];
		}
		if ( ! empty( $settings['margin_tablet']['size'] ) ) {
			$carousel_settings['margin-tablet'] = $settings['margin_tablet']['size'];
		}
		if ( ! empty( $settings['margin_mobile']['size'] ) ) {
			$carousel_settings['margin-mobile'] = $settings['margin_mobile']['size'];
		}

		if ( $settings['carousel_effect'] ) {
			$carousel_settings['effect'] = $settings['carousel_effect'];
		}

		if ( ! empty( $settings['slider_speed']['size'] ) ) {
			$carousel_settings['speed'] = $settings['slider_speed']['size'];
		}

		if ( $settings['autoplay'] == 'yes' && ! empty( $settings['autoplay_speed']['size'] ) ) {
			$carousel_settings['autoplay'] = $settings['autoplay_speed']['size'];
		} else {
			$carousel_settings['autoplay'] = '0';
		}

		if ( $settings['pause_on_hover'] == 'yes' ) {
			$carousel_settings['pause-on-hover'] = 'true';
		}

		if ( $settings['infinite_loop'] == 'yes' ) {
			$carousel_settings['loop'] = '1';
		}

		if ( $settings['arrows'] == 'yes' ) {
			$carousel_settings['arrows'] = '1';
		}

		if ( $settings['dots'] == 'yes' ) {
			$carousel_settings['dots'] = '1';
		}

		$this->add_render_attribute( 'wrapper', 'data-settings', wp_json_encode( $carousel_settings ) ); ?>

		<div class="oew-testimonial-carousel swiper-container-wrap clr">

			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

				<div class="swiper-wrapper">

					<?php
					$i = 0;
					foreach ( $settings['testimonial_slider'] as $item ) :
						$has_content = ! ! $item['testimonial_content'];
						$has_image   = ! ! $item['testimonial_image']['url'];
						$has_name    = ! ! $item['testimonial_name'];
						$has_company = ! ! $item['testimonial_company'];
						$has_rating  = $item['testimonial_rating'];
						?>

						<div class="swiper-slide">

							<?php
							if ( $has_image && 'inline' == $style && 'before' == $img_align ) {
								echo $this->testimonial_img( $item );
							}

							if ( 'yes' == $has_symbol &&
								( 'inline' != $style || 'inline' == $style && 'after' == $img_align ) ) {
								echo $this->testimonial_symbol();
							}

							if ( $has_content ) {
								$this->add_render_attribute( 'testimonial_content_wrapper', 'class', 'oew-testimonial-content' );
								$this->add_render_attribute( 'testimonial_content', 'class', 'oew-testimonial-content-inner' );
								?>

								<div <?php echo $this->get_render_attribute_string( 'testimonial_content_wrapper' ); ?>>
									<div <?php echo $this->get_render_attribute_string( 'testimonial_content' ); ?>>
										<?php echo $item['testimonial_content']; ?>
									</div>

									<?php
									if ( 'inline' == $style && ( $has_image || $has_name || $has_company ) ) {
										echo $this->testimonial_meta( $item );
									}
									?>
								</div>
								<?php
							}

							if ( 'inline' != $style && ( $has_image || $has_name || $has_company ) ) {
								echo $this->testimonial_meta( $item );
							}

							if ( 'yes' == $has_symbol && 'inline' == $style && 'before' == $img_align ) {
								echo $this->testimonial_symbol();
							}

							if ( $has_image && 'inline' == $style && 'after' == $img_align ) {
								echo $this->testimonial_img( $item );
							}
							?>

						</div>

						<?php
						$i++;
					endforeach;
					?>

				</div>

			</div>

			<?php
			if ( $settings['arrows'] == 'yes' ) {
				?>
				<div class="swiper-button-next oew-swiper-buttons swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php echo $next; ?>
				</div>
				<div class="swiper-button-prev oew-swiper-buttons swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
					<?php echo $prev; ?>
				</div>
				<?php
			}

			if ( $settings['dots'] == 'yes' ) {
				?>
				<div class="swiper-pagination swiper-pagination-<?php echo esc_attr( $this->get_id() ); ?>"></div>
				<?php
			}
			?>

		</div>

		<?php
	}

}
