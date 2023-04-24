<?php
namespace owpElementor\Modules\Banner\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Banner extends Widget_Base {

	public function get_name() {
		return 'oew-banner';
	}

	public function get_title() {
		return __( 'Banner', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'banner',
			'image',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-banner' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_banner',
			array(
				'label' => __( 'Banner', 'ocean-elementor-widgets' ),
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
				'name'    => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label'   => __( 'Image Size', 'ocean-elementor-widgets' ),
				'default' => 'large',
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h5',
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

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'dynamic' => array( 'active' => true ),
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
			'section_settings',
			array(
				'label' => __( 'Settings', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'effect',
			array(
				'label'   => __( 'Animation Effect', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'apolo',
				'options' => array(
					'apolo'  => __( 'Apolo', 'ocean-elementor-widgets' ),
					'bubba'  => __( 'Bubba', 'ocean-elementor-widgets' ),
					'chico'  => __( 'Chico', 'ocean-elementor-widgets' ),
					'jazz'   => __( 'Jazz', 'ocean-elementor-widgets' ),
					'layla'  => __( 'Layla', 'ocean-elementor-widgets' ),
					'lily'   => __( 'Lily', 'ocean-elementor-widgets' ),
					'ming'   => __( 'Ming', 'ocean-elementor-widgets' ),
					'marley' => __( 'Marley', 'ocean-elementor-widgets' ),
					'romeo'  => __( 'Romeo', 'ocean-elementor-widgets' ),
					'roxy'   => __( 'Roxy', 'ocean-elementor-widgets' ),
					'ruby'   => __( 'Ruby', 'ocean-elementor-widgets' ),
					'oscar'  => __( 'Oscar', 'ocean-elementor-widgets' ),
					'sadie'  => __( 'Sadie', 'ocean-elementor-widgets' ),
					'sarah'  => __( 'Sarah', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => esc_html__( 'General', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs( 'tabs_banner_style' );

		$this->start_controls_tab(
			'tab_banner_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'banner_normal_opacity',
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
					'body {{WRAPPER}} .oew-banner img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_banner_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'banner_hover_opacity',
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
					'body {{WRAPPER}} .oew-banner:hover img' => 'opacity: {{SIZE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'      => 'banner_background',
				'selector'  => '{{WRAPPER}} .oew-banner',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'banner_additional_color',
			array(
				'label'     => __( 'Additional Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-banner.oew-apolo .oew-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-bubba figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-bubba figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-chico figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-jazz figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-layla figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-layla figcaption:after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-ming figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-marley .oew-banner-title:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-romeo figcaption:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-romeo figcaption:after' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-roxy figcaption:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-ruby .oew-banner-text' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-banner.oew-sarah .oew-banner-title:after' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'banner_border',
				'selector' => '{{WRAPPER}} .oew-banner',
			)
		);

		$this->add_responsive_control(
			'banner_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'banner_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'banner_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'banner_box_shadow',
				'selector' => '{{WRAPPER}} .oew-banner',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => esc_html__( 'Banner Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-banner .oew-banner-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .oew-banner .oew-banner-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			array(
				'label' => esc_html__( 'Banner Description', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'description_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-banner .oew-banner-text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'description_typo',
				'selector' => '{{WRAPPER}} .oew-banner .oew-banner-text',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings    = $this->get_settings_for_display();
		$title       = $settings['title'];
		$title_tag   = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'h5';
		$description = $settings['description'];
		$link        = $settings['link'];
		$effect      = $settings['effect'];

		$this->add_render_attribute( 'banner', 'class', 'oew-banner' );

		if ( ! empty( $effect ) ) {
			$this->add_render_attribute( 'banner', 'class', 'oew-' . $effect );
		}

		$this->add_render_attribute( 'content', 'class', 'oew-banner-content' );
		$this->add_render_attribute( 'title', 'class', 'oew-banner-title' );
		$this->add_render_attribute( 'description', 'class', 'oew-banner-text' ); ?>

		<figure <?php echo $this->get_render_attribute_string( 'banner' ); ?>>
			<?php
			if ( ! empty( $link['url'] ) ) {
				$this->add_render_attribute( 'link', 'class', 'oew-banner-link' );
				$this->add_render_attribute( 'link', 'href', $link['url'] );

				if ( $link['is_external'] ) {
					$this->add_render_attribute( 'link', 'target', '_blank' );
				}

				if ( $link['nofollow'] ) {
					$this->add_render_attribute( 'link', 'rel', 'nofollow' );
				}

				echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
			}
			?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
				<figcaption>
					<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>
						<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_attr( $title ); ?></<?php echo $title_tag; ?>>
						<div <?php echo $this->get_render_attribute_string( 'description' ); ?>><?php echo $description; ?></div>
					</div>
				</figcaption>
			<?php if ( ! empty( $link['url'] ) ) : ?>
				</a>
			<?php endif; ?>
		</figure>

		<?php
	}

}
