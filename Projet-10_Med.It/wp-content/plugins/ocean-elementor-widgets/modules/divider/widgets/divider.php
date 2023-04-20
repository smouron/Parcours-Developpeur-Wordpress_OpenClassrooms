<?php
namespace owpElementor\Modules\Divider\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

class Divider extends Widget_Base {

	public function get_name() {
		return 'oew-divider';
	}

	public function get_title() {
		return __( 'Divider', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-divider';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_style_depends() {
		return [ 'oew-divider' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_divider',
			[
				'label' 		=> __( 'General', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'divider_middle',
			[
				'label' 		=> __( 'Text or Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'text',
				'options' 		=> [
					'text' 	=> __( 'Text', 'ocean-elementor-widgets' ),
					'icon' 	=> __( 'Icon', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'text',
			[
				'label'			=> __( 'Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default'		=> __( 'Text Divider', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'divider_middle' => 'text',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'text_html_tag',
			[
				'label' 		=> __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'h6',
				'options' 		=> [
					'h1' 	=> __( 'H1', 'ocean-elementor-widgets' ),
					'h2' 	=> __( 'H2', 'ocean-elementor-widgets' ),
					'h3' 	=> __( 'H3', 'ocean-elementor-widgets' ),
					'h4' 	=> __( 'H4', 'ocean-elementor-widgets' ),
					'h5' 	=> __( 'H5', 'ocean-elementor-widgets' ),
					'h6' 	=> __( 'H6', 'ocean-elementor-widgets' ),
					'div' 	=> __( 'div', 'ocean-elementor-widgets' ),
					'span' 	=> __( 'span', 'ocean-elementor-widgets' ),
					'p' 	=> __( 'p', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'divider_middle' => 'text',
				],
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICONS,
				'label_block' 	=> true,
				'default'		=> [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' 	=> [
					'divider_middle' => 'icon',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> 'center',
				'options' 		=> [
					'left'    	=> [
						'title' 	=> __( 'Left', 'ocean-elementor-widgets' ),
						'icon' 		=> 'eicon-h-align-left',
					],
					'center' 	=> [
						'title' 	=> __( 'Center', 'ocean-elementor-widgets' ),
						'icon' 		=> 'eicon-h-align-center',
					],
					'right' 	=> [
						'title' 	=> __( 'Right', 'ocean-elementor-widgets' ),
						'icon' 		=> 'eicon-h-align-right',
					],
				],
				'prefix_class'	=> 'oew-divider-'
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Text / Icon', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'middle_typo',
				'selector' 		=> '{{WRAPPER}} .oew-divider-wrap .oew-divider-text, {{WRAPPER}} .oew-divider-wrap .oew-divider-middle i',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 8,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'margin: 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.oew-divider-left .oew-divider-middle' => 'margin-left: 0; margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.oew-divider-right .oew-divider-middle' => 'margin-right: 0; margin-left: {{SIZE}}{{UNIT}};',
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
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> __( 'Text Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-divider-wrap .oew-divider-middle',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-divider-wrap .oew-divider-middle',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'text_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-divider-wrap .oew-divider-middle',
				'condition' 	=> [
					'divider_middle' => 'text',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_divider_style',
			[
				'label'			=> __( 'Divider', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'divider_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'divider_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'default' 		=> [
					'unit' => '%',
					'size' => 100,
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'divider_height',
			[
				'label' 		=> __( 'Height', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 1,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 1,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-divider-wrap .oew-divider' => 'height: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$tag 		= $settings['text_html_tag'];

		$this->add_render_attribute( 'wrap', 'class', 'oew-divider-wrap' );

		$this->add_render_attribute( 'before', 'class', [
			'oew-divider',
			'oew-divider-before',
		] );

		$this->add_render_attribute( 'after', 'class', [
			'oew-divider',
			'oew-divider-after',
		] );

		$this->add_render_attribute( 'middle', 'class', 'oew-divider-middle' );
		$this->add_render_attribute( 'text', 'class', 'oew-divider-text' );
		$this->add_inline_editing_attributes( 'text', 'basic' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'before' ); ?>></div>
			<div <?php echo $this->get_render_attribute_string( 'middle' ); ?>>
				<?php
				if ( 'text' == $settings['divider_middle'] ) { ?>
					<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string( 'text' ); ?>>
						<?php echo $this->parse_text_editor( $settings['text'] ); ?>
					</<?php echo $tag; ?>>
				<?php
				} else {
					\Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
				} ?>
			</div>
			<div <?php echo $this->get_render_attribute_string( 'after' ); ?>></div>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<#
		if ( 'text' == settings.divider_middle ) {
			view.addRenderAttribute( 'text', 'class', [
				'oew-divider-text',
				'elementor-inline-editing'
			] );
			view.addRenderAttribute( 'text', 'data-elementor-inline-editing-toolbar', 'basic' );
			view.addRenderAttribute( 'text', 'data-elementor-setting-key', 'text' );
		} #>

		<# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

		<div class="oew-divider-wrap">
			<div class="oew-divider oew-divider-before"></div>
			<div class="oew-divider-middle">
				<# if ( 'text' == settings.divider_middle ) { #>
					<{{ settings.text_html_tag }} {{{ view.getRenderAttributeString( 'text' ) }}}>
						{{{ settings.text }}}
					</{{ settings.text_html_tag }}>
				<# } else { #>
					{{{ iconHTML.value }}}
				<# } #>
			</div>
			<div class="oew-divider oew-divider-after"></div>
		</div>
	<?php
	}

}