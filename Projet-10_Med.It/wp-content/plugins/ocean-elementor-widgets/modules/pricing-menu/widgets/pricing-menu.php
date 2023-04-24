<?php
namespace owpElementor\Modules\PricingMenu\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class PricingMenu extends Widget_Base {

	public function get_name() {
		return 'oew-pricing-menu';
	}

	public function get_title() {
		return __( 'NEW Pricing Menu', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-menu-card';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'pricing',
			'menu',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-pricing-menu' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_pricing_menu',
			array(
				'label' => __( 'Pricing Menu', 'ocean-elementor-widgets' ),
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
			'title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Cheese Pizza', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Cheese Pizza', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'price',
			array(
				'label'       => __( 'Price', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$99', 'ocean-elementor-widgets' ),
				'placeholder' => __( '$99', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Pricing Menu Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price_style',
			array(
				'label' => esc_html__( 'Pricing Menu Price', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-price span' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-price span',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => esc_html__( 'Pricing Menu Image', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'body {{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'body {{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-image img',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'image_opacity',
			array(
				'label'     => __( 'Opacity', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max'  => 1,
						'min'  => 0.10,
						'step' => 0.01,
					),
				),
				'selectors' => array(
					'body {{WRAPPER}} .oew-pricing-menu .oew-pricing-menu-image img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$title     = $settings['title'];
		$title_tag = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'h4';
		$price     = $settings['price'];
		$link      = $settings['link'];

		$this->add_render_attribute( 'pricing-menu', 'class', 'oew-pricing-menu' );

		$this->add_render_attribute( 'content', 'class', 'oew-pricing-menu-content' );
		$this->add_render_attribute( 'title', 'class', 'oew-pricing-menu-title' );
		$this->add_render_attribute( 'price', 'class', 'oew-pricing-menu-price-discount' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'pricing-menu' ); ?>>
			<div class="oew-pricing-menu-items">
				<div class="oew-pricing-menu-item-wrap">
					<div class="oew-pricing-menu-item">
						<?php
						if ( ! empty( $link['url'] ) ) {
							$this->add_render_attribute( 'link', 'href', $link['url'] );

							if ( $link['is_external'] ) {
								$this->add_render_attribute( 'link', 'target', '_blank' );
							}

							if ( $link['nofollow'] ) {
								$this->add_render_attribute( 'link', 'rel', 'nofollow' );
							}

							$this->add_render_attribute( 'link', 'class', 'oew-pricing-menu-link' );

							echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
						}
						?>
													
						<div class="oew-pricing-menu-image">						
							<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
							<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>
								<div class="oew-pricing-menu-header">
									<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string( 'title' ); ?>>
		
											<?php echo esc_attr( $title ); ?>

									</<?php echo $title_tag; ?>>
								</div>
								<span class="oew-pricing-menu-price">
									<span <?php echo $this->get_render_attribute_string( 'price' ); ?>><?php echo $price; ?></span>
								</span>
							</div>
						</div>
						<?php if ( ! empty( $link['url'] ) ) : ?>
						</a>
						<?php endif; ?>
						<?php if ( $link['is_external'] ) : ?>
							<span class="screen-reader-text"><?php _e( 'Opens in a new tab', 'ocean-elementor-widgets' ); ?></span>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

}
