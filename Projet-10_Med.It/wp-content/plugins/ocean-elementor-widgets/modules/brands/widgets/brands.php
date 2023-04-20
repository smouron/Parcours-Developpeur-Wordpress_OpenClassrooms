<?php
namespace owpElementor\Modules\Brands\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Brands extends Widget_Base {

	public function get_name() {
		return 'oew-brands';
	}

	public function get_title() {
		return __( 'Brands', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-photo-library';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_style_depends() {
		return [ 'oew-brands' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_brands',
			[
				'label' 		=> __( 'Brands', 'ocean-elementor-widgets' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_image',
			[
				'label'   		=> __( 'Company Logo', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'item_name',
			[
				'label'   		=> __( 'Company Name', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::TEXT,
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'item_description',
			[
				'label'   		=> __( 'Company Description', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::TEXTAREA,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'item_link',
			[
				'label'   		=> __( 'Company URL', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default' 		=> [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'brands',
			[
				'label' 		=> __( 'Brands Items', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::REPEATER,
				'default' 		=> [
					[
						'item_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'item_name' 	=> __( 'Company #1', 'ocean-elementor-widgets' ),
						'item_link' 	=> [
							'url' => '#',
						],
					],
					[
						'item_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'item_name' 	=> __( 'Company #2', 'ocean-elementor-widgets' ),
						'item_link' 	=> [
							'url' => '#',
						],
					],
				],
				'fields' 		=> array_values( $repeater->get_controls() ),
				'title_field' 	=> '{{{ item_name }}}',
			]
		);

		$this->add_responsive_control(
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
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-item' => 'width: calc( 100% / {{VALUE}} );',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
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
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-item' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Brands Items', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'items_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'items_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logo_style',
			[
				'label' 		=> __( 'Company Logo', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'logo_wrap_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-img' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'logo_wrap_border',
				'selector' 		=> '{{WRAPPER}} .oew-brands .oew-brands-img',
			]
		);

		$this->add_responsive_control(
			'logo_wrap_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_wrap_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'logo_wrap_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'logo_wrap_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-brands .oew-brands-img',
			]
		);

		$this->add_control(
			'logo_heading',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'logo_border',
				'selector' 		=> '{{WRAPPER}} .oew-brands img',
			]
		);

		$this->add_responsive_control(
			'logo_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_name_style',
			[
				'label' 		=> __( 'Company Name', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'name_typo',
				'selector' 		=> '{{WRAPPER}} .oew-brands .oew-brands-name',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'name_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' 		=> __( 'Company Description', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typo',
				'selector' 		=> '{{WRAPPER}} .oew-brands .oew-brands-desc',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-brands .oew-brands-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display(); ?>

		<div class="oew-brands">
			<div class="oew-brands-list">
				
				<?php foreach ( $settings['brands'] as $index => $item ) :

					$key 			= $this->get_repeater_setting_key( 'item_image', 'brands', $index );
					$url 			= $item['item_image']['url'];
					$alt 			= trim( strip_tags( get_post_meta( $item['item_image']['id'], '_wp_attachment_image_alt', true ) ) );
					$link 			= $item['item_link'];

					$this->add_render_attribute( $key, 'src', $url );

					if ( '' !== $alt ) {
						$this->add_render_attribute( $key, 'alt', $alt );
					} ?>

					<div class="oew-brands-item">
						<?php if ( ! empty( $link['url'] ) ) {
							$link_key = 'link_' . $index;

							$this->add_render_attribute( $link_key, 'href', $link['url'] );

							if ( $link['is_external'] ) {
								$this->add_render_attribute( $link_key, 'target', '_blank' );
							}

							if ( $link['nofollow'] ) {
								$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
							}

							$this->add_render_attribute( $link_key, 'class', 'oew-brands-link' );

							echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
						} ?>
							<div class="oew-brands-img">
								<img <?php echo $this->get_render_attribute_string( $key ); ?> />
							</div>
							<h5 class="oew-brands-name"><?php echo $item['item_name']; ?></h5>
							<div class="oew-brands-desc"><?php echo $item['item_description']; ?></div>
						<?php if ( ! empty( $link['url'] ) ) : ?>
							</a>
						<?php endif; ?>
					</div>

				<?php endforeach; ?>
			</div>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<div class="oew-brands">
			<div class="oew-brands-list oceanwp-row">
				<# _.each( settings.brands, function( item, index ) {
					var key = view.getRepeaterSettingKey( 'item_image', 'brands', index );
					view.addRenderAttribute( key, 'src', item.item_image.url ); #>

					<div class="oew-brands-item col span_1_of_{{ settings.columns }}">
						<# if ( '' !== item.item_link.url ) { #>
							<a class="oew-brands-link" href="{{ item.item_link.url }}">
						<# } #>
							<div class="oew-brands-img">
								<img {{{ view.getRenderAttributeString( key ) }}} />
							</div>
							<h5 class="oew-brands-name">{{{ item.item_name }}}</h5>
							<div class="oew-brands-desc">{{{ item.item_description }}}</div>
						<# if ( '' !== item.item_link.url ) { #>
							</a>
						<# } #>
					</div>

				<# } ); #>
			</div>
		</div>
	<?php
	}

}