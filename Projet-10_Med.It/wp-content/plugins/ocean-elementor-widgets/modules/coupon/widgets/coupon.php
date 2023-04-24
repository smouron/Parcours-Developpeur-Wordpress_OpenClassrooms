<?php
namespace owpElementor\Modules\Coupon\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Coupon extends Widget_Base {

	public function get_name() {
		return 'oew-coupon';
	}

	public function get_title() {
		return __( 'NEW Coupon', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-product-price';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'coupon',
			'discount',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-coupon' );
	}

	public function get_script_depends() {
		return array( 'oew-coupon' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_general',
			array(
				'label' => esc_html__( 'Coupon', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Product for Deal', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Product for Deal', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h4',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'Div',
					'span' => 'Span',
					'p'    => 'Paragraph',
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'image',
				'label'   => __( 'Image Size', 'ocean-elementor-widgets' ),
				'default' => 'medium',
			)
		);

		$this->add_control(
			'show_discount',
			array(
				'label'        => __( 'Show Discount', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'discount',
			array(
				'label'     => __( 'Discount', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => '5% OFF',
				'condition' => array(
					'show_discount' => 'yes',
				),
			)
		);

		$this->add_control(
			'coupon_code',
			array(
				'label'   => __( 'Coupon Code', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => 'ABCDEF',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => esc_html__( 'Button', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => __( 'Button Text', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'View This Deal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_icon',
			array(
				'label'       => __( 'Button Icon', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-long-arrow-alt-right',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'button_separator',
			array(
				'label'        => __( 'Separator', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'button_link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_coupon_style',
			array(
				'label' => esc_html__( 'Coupon', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'coupon_align',
			array(
				'label'                => __( 'Align', 'ocean-elementor-widgets' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => is_rtl() ? 'left' : 'right',
				'label_block'          => false,
				'separator'            => 'before',
				'options'              => array(
					'left'  => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right' => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'toggle'               => false,
				'selectors_dictionary' => array(
					'left'  => 'left: 0;right: auto;',
					'center' => 'left: 0;right: 0;width: fit-content;margin-left: auto;margin-right: auto;',
					'right' => 'right: 0;left: auto;',

				),
				'selectors'            => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-code' => '{{VALUE}}',
				),
			)
		);

		$this->add_control(
			'coupon_code_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-code' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'coupon_code_typography',
				'label'     => __( 'Coupon Code Typography', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-coupons .oew-coupon-code-text',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'coupon_code_color',
			array(
				'label'     => __( 'Coupon Code Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-code-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'coupon_code_copy_text_typography',
				'label'     => __( 'Coupon Copy Text Typography', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-coupons .oew-coupon-copy-text',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'coupon_code_copy_text_color',
			array(
				'label'     => __( 'Coupon Copy Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-copy-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'coupon_code_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-code' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_discount_style',
			array(
				'label' => esc_html__( 'Discount', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'discount_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-discount' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'discount_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-coupons .oew-coupon-discount',
			)
		);

		$this->add_control(
			'discount_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-discount' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'discount_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-discount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'discount_border',
				'selector' => '{{WRAPPER}} .oew-coupons .oew-coupon-discount',
			)
		);

		$this->add_responsive_control(
			'discount_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-discount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'discount_align',
			array(
				'label'                => __( 'Align', 'ocean-elementor-widgets' ),
				'type'                 => Controls_Manager::CHOOSE,
				'default'              => is_rtl() ? 'right' : 'left',
				'label_block'          => false,
				'separator'            => 'before',
				'options'              => array(
					'left'  => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'toggle'               => false,
				'selectors_dictionary' => array(
					'left'  => 'left: 0;right: auto;',
					'right' => 'right: 0;left: auto;',

				),
				'selectors'            => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-discount' => '{{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Coupon Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'title_alignment',
			array(
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-title-wrap'  => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-coupons .oew-coupon-title',
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-title-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			array(
				'label' => esc_html__( 'Button', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'button_size',
			array(
				'label'   => __( 'Size', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => array(
					'sm' => __( 'Small', 'ocean-elementor-widgets' ),
					'md' => __( 'Medium', 'ocean-elementor-widgets' ),
					'lg' => __( 'Large', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'button_alignment',
			array(
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-button-wrap'   => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-button-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-button' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-button-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_text_color_hover',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-button-wrap:hover .oew-button-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_bg_color_hover',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-button:hover ' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_icon_color_hover',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-coupons .oew-coupon-button:hover .oew-button-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_separator_heading',
			array(
				'label'     => __( 'Separator', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'button_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_separator_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-coupon-separator' => 'border-top-color: {{VALUE}}',
				),
				'condition' => array(
					'button_separator' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_separator_style',
			array(
				'label'     => __( 'Style', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'solid'  => __( 'Solid', 'ocean-elementor-widgets' ),
					'dotted' => __( 'Dotted', 'ocean-elementor-widgets' ),
					'dashed' => __( 'Dashed', 'ocean-elementor-widgets' ),
				),
				'default'   => 'solid',
				'selectors' => array(
					'{{WRAPPER}} .oew-coupon-separator' => 'border-top-style: {{VALUE}}',
				),
				'condition' => array(
					'button_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'button_separator_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 500,
						'step' => 1,
					),
				),
				'default'    => array(
					'size' => 60,
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-coupon-separator-container' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_separator' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'button_separator_size',
			array(
				'label'      => __( 'Size', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-coupon-separator' => 'border-top-width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_separator' => 'yes',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$title       = $settings['title'];
		$title_tag   = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'h4';
		$coupon_code = $settings['coupon_code'];
		$button_link = $settings['button_link'];

		$this->add_render_attribute( 'coupon', 'class', 'oew-coupons' );

		$this->add_render_attribute( 'content', 'class', 'oew-coupon-content' );
		$this->add_render_attribute( 'title', 'class', 'oew-coupon-title' );
		$this->add_render_attribute( 'coupon_code', 'class', 'oew-coupon-code-text' );

		$this->add_render_attribute(
			'coupon-button',
			'class',
			array(
				'oew-coupon-button',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
			)
		);

		?>

		<div <?php echo $this->get_render_attribute_string( 'coupon' ); ?>>
			<div class="oew-coupon-wrap">
				<div class="oew-coupon">
					<div class="oew-coupon-image-wrapper">
						<?php if ( 'yes' === $settings['show_discount'] && $settings['discount'] ) { ?>
							<div class="oew-coupon-discount">
								<?php echo $settings['discount']; ?>
							</div>
						<?php } ?>
						<div class="oew-coupon-code oew-coupon-style-copy" data-coupon-code="<?php echo esc_attr( $coupon_code ); ?>">
							<span <?php echo $this->get_render_attribute_string( 'coupon_code' ); ?>><?php echo esc_attr( $coupon_code ); ?> </span>
							<span class="oew-coupon-copy-text"><?php _e( 'Copy', 'ocean-elementor-widgets' ); ?> </span>
						</div>
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
					</div>
					<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>
						<div class="oew-coupon-title-wrap">
							<div class="oew-coupon-title-container">
								<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string( 'title' ); ?>>
									<?php echo esc_attr( $title ); ?>
								</<?php echo $title_tag; ?>>
							</div>	
						</div>

						<?php if ( 'yes' === $settings['button_separator'] ) { ?>
							<div class="oew-coupon-separator-container">
								<hr class="oew-coupon-separator">
							</div>
						<?php } ?>

						<div class="oew-coupon-button-wrap">
								<?php
								if ( ! empty( $button_link['url'] ) ) {
									$this->add_render_attribute( 'link', 'href', $button_link['url'] );

									if ( $button_link['is_external'] ) {
										$this->add_render_attribute( 'link', 'target', '_blank' );
									}

									if ( $button_link['nofollow'] ) {
										$this->add_render_attribute( 'link', 'rel', 'nofollow' );
									}

									$this->add_render_attribute( 'link', 'class', 'oew-coupon-link' );

									echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
								}
								?>
								<div <?php echo $this->get_render_attribute_string( 'coupon-button' ); ?>>
									<span class="oew-button-text">
										<?php echo esc_attr( $settings['button_text'] ); ?>
									</span>
									<span class="oew-button-icon">
										<?php Icons_Manager::render_icon( $settings['button_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</span>
								</div>
								<?php if ( ! empty( $button_link['url'] ) ) : ?>
									</a>
								<?php endif; ?>
								<?php if ( $button_link['is_external'] ) : ?>
									<span class="screen-reader-text"><?php _e( 'Opens in a new tab', 'ocean-elementor-widgets' ); ?></span>
								<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
