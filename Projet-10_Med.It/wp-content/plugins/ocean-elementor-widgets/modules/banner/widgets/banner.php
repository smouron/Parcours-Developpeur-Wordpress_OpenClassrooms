<?php
namespace owpElementor\Modules\Banner\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Banner extends Widget_Base {

	public function get_name() {
		return 'oew-banner';
	}

	public function get_title() {
		return __( 'Banner', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_style_depends() {
		return [ 'oew-banner' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_banner',
			[
				'label' 		=> __( 'Banner', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   		=> __( 'Image', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label' 		=> __( 'Image Size', 'ocean-elementor-widgets' ),
				'default' 		=> 'large',
			]
		);

		$this->add_control(
			'title',
			[
				'label'   		=> __( 'Title', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   		=> __( 'Description', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::TEXTAREA,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'   		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
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
			'effect',
			[
				'label'   => __( 'Animation Effect', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'apolo',
				'options' => [
					'apolo'  	=> __( 'Apolo', 'ocean-elementor-widgets' ),
					'bubba'  	=> __( 'Bubba', 'ocean-elementor-widgets' ),
					'chico'  	=> __( 'Chico', 'ocean-elementor-widgets' ),
					'jazz'  	=> __( 'Jazz', 'ocean-elementor-widgets' ),
					'layla'  	=> __( 'Layla', 'ocean-elementor-widgets' ),
					'lily'   	=> __( 'Lily', 'ocean-elementor-widgets' ),
					'ming' 		=> __( 'Ming', 'ocean-elementor-widgets' ),
					'marley' 	=> __( 'Marley', 'ocean-elementor-widgets' ),
					'romeo'  	=> __( 'Romeo', 'ocean-elementor-widgets' ),
					'roxy'   	=> __( 'Roxy', 'ocean-elementor-widgets' ),
					'ruby'   	=> __( 'Ruby', 'ocean-elementor-widgets' ),
					'oscar'  	=> __( 'Oscar', 'ocean-elementor-widgets' ),
					'sadie' 	=> __( 'Sadie', 'ocean-elementor-widgets' ),
					'sarah'  	=> __( 'Sarah', 'ocean-elementor-widgets' ),
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> esc_html__( 'General', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_banner_style' );

		$this->start_controls_tab(
			'tab_banner_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'banner_normal_opacity',
			[
				'label' 		=> __( 'Opacity', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' 	=> [
					'body {{WRAPPER}} .oew-banner img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_banner_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'banner_hover_opacity',
			[
				'label' 		=> __( 'Opacity', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' 	=> [
					'body {{WRAPPER}} .oew-banner:hover img' => 'opacity: {{SIZE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'banner_background',
				'selector' 		=> '{{WRAPPER}} .oew-banner',
				'separator' 	=> 'before',
			)
		);

		$this->add_control(
			'banner_additional_color',
			[
				'label' 		=> __( 'Additional Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
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
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'banner_border',
				'selector' 		=> '{{WRAPPER}} .oew-banner',
			]
		);

		$this->add_responsive_control(
			'banner_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'banner_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'banner_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-banner',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' 		=> esc_html__( 'Banner Title', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-banner .oew-banner-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typo',
				'selector' 		=> '{{WRAPPER}} .oew-banner .oew-banner-title',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' 		=> esc_html__( 'Banner Description', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-banner .oew-banner-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typo',
				'selector' 		=> '{{WRAPPER}} .oew-banner .oew-banner-text',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();
		$title 			= $settings['title'];
		$description 	= $settings['description'];
        $link 			= $settings['link'];
        $effect 		= $settings['effect'];

		$this->add_render_attribute( 'banner', 'class', 'oew-banner' );
        
		if ( ! empty( $effect ) ) {
            $this->add_render_attribute( 'banner', 'class', 'oew-'. $effect );
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

				$this->add_render_attribute( 'link', 'class', 'oew-brands-link' );

				echo '<a ' . $this->get_render_attribute_string( 'link' ) . '>';
			} ?>
				<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
				<figcaption>
					<div <?php echo $this->get_render_attribute_string( 'content' ); ?>>
						<h5 <?php echo $this->get_render_attribute_string( 'title' ); ?>><?php echo esc_attr( $title ); ?></h5>
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