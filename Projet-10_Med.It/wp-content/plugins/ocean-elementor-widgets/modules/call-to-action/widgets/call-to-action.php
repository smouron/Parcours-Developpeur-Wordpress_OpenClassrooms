<?php
namespace owpElementor\Modules\CallToAction\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

class CallToAction extends Widget_Base {

	public function get_name() {
		return 'oew-call-to-action';
	}

	public function get_title() {
		return __( 'Call To Action', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-call-to-action';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_style_depends() {
		return [ 'oew-call-to-action' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_call_to_action',
			[
				'label' 		=> __( 'General', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label'       	=> esc_html__( 'Title', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> esc_html__( 'Call to action heading', 'ocean-elementor-widgets' ),
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'       	=> '',
				'type'        	=> Controls_Manager::WYSIWYG,
				'default' 		=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' 		=> __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'h3',
				'options' 		=> oew_get_available_tags(),
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			[
				'label' 		=> __( 'Button', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Click me', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Click me', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' 		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default' 		=> [
					'url' => '#',
				],
			]
		);

		$this->add_responsive_control(
			'alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> 'right',
				'options' 		=> [
					'left'    	=> [
						'title' 	=> __( 'Left', 'ocean-elementor-widgets' ),
						'icon' 		=> 'fa fa-align-left',
					],
					'center' 	=> [
						'title' 	=> __( 'Center', 'ocean-elementor-widgets' ),
						'icon' 		=> 'fa fa-align-center',
					],
					'right' 	=> [
						'title' 	=> __( 'Right', 'ocean-elementor-widgets' ),
						'icon' 		=> 'fa fa-align-right',
					],
				],
				'prefix_class'	=> 'oew-call-to-action-'
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICONS,
				'label_block' 	=> true,
				'default'		=> [
					'value'   => '',
					'library' => 'solid',
				],
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' 		=> __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'left',
				'options' 		=> [
					'left' => __( 'Before', 'ocean-elementor-widgets' ),
					'right' => __( 'After', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 3,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-call-to-action .oew-button-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' 		=> __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action-btn .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-call-to-action-btn .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Box', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default'		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action',
			]
		);

		$this->add_responsive_control(
			'padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action',
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

		$this->add_control(
			'title_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-title' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typo',
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-title',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'title_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-title',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'title_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-title',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_description_style',
			[
				'label' 		=> __( 'Description', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'description_typo',
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-description',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_responsive_control(
			'description_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' 			=> 'description_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-description',
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
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a',
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
				'scheme' 		=> [
					'type' => Scheme_Color::get_type(),
					'value' => Scheme_Color::COLOR_4,
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a' => 'color: {{VALUE}};',
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
			'button_background_hover_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_animation',
			[
				'label' 		=> __( 'Hover Animation', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HOVER_ANIMATION,
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
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a',
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
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-call-to-action .oew-call-to-action-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings 			= $this->get_settings_for_display();
		$title 				= $settings['title'];
		$tag 				= $settings['title_html_tag'];
		$editor_content 	= $this->get_settings_for_display( 'description' );
		$btn_text 			= $settings['btn_text'];
        $btn_link 			= $settings['btn_link'];

		$this->add_render_attribute( 'wrap', 'class', 'oew-call-to-action' );
		$this->add_render_attribute( 'text', 'class', 'oew-call-to-action-text' );

		$this->add_render_attribute( 'title', 'class', 'oew-call-to-action-title' );
		$this->add_inline_editing_attributes( 'title', 'basic' );

		$this->add_render_attribute( 'editor', 'class', 'oew-call-to-action-description' );
		$this->add_inline_editing_attributes( 'editor', 'advanced' );

		if ( ! empty( $btn_link['url'] ) ) {
			$this->add_render_attribute( 'link-wrap', 'class', 'oew-call-to-action-btn' );
			$this->add_render_attribute( 'link', 'class', 'button' );
			$this->add_render_attribute( 'link', 'href', $btn_link['url'] );

			if ( $btn_link['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $btn_link['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}

			if ( $settings['button_hover_animation'] ) {
				$this->add_render_attribute( 'link', 'class', 'elementor-animation-' . $settings['button_hover_animation'] );
			}
		}
        
		$this->add_render_attribute( 'icon-align', 'class', [
			'oew-button-icon',
			'elementor-align-icon-' . $settings['icon_align'],
		] ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'text' ); ?>>
				<?php
				if ( $title ) { ?>
					<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string( 'title' ); ?>>
						<?php echo $this->parse_text_editor( $title ); ?>
					</<?php echo $tag; ?>>
				<?php
				} ?>

				<?php
				if ( $settings['description'] ) { ?>
					<div <?php echo $this->get_render_attribute_string( 'editor' ); ?>><?php echo $this->parse_text_editor( $editor_content ); ?></div>
				<?php
				} ?>
			</div>

			<?php
			if ( ! empty( $btn_link['url'] ) ) { ?>
				<div <?php echo $this->get_render_attribute_string( 'link-wrap' ); ?>>
					<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
						<?php
						if ( ! empty( $settings['icon'] ) && 'left' == $settings['icon_align'] ) { ?>
							<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php
						} ?>

						<span><?php echo esc_attr( $btn_text ); ?></span>

						<?php
						if ( ! empty( $settings['icon'] ) && 'right' == $settings['icon_align'] ) { ?>
							<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
								<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php
						} ?>
					</a>
				</div>
			<?php
			} ?>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<#
		view.addRenderAttribute( 'title', 'class', 'oew-call-to-action-title' );
		view.addInlineEditingAttributes( 'title', 'basic' );

		view.addRenderAttribute( 'editor', 'class', 'oew-call-to-action-description' );
		view.addInlineEditingAttributes( 'editor', 'advanced' ); #>

		<# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>

		<div class="oew-call-to-action">
			<div class="oew-call-to-action-text">
				<# if ( settings.title ) { #>
					<{{ settings.title_html_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>
						{{{ settings.title }}}
					</{{ settings.title_html_tag }}>
				<# } #>

				<# if ( settings.description ) { #>
					<div {{{ view.getRenderAttributeString( 'editor' ) }}}>{{{ settings.description }}}</div>
				<# } #>
			</div>

			<# if ( settings.btn_link.url ) { #>
				<div class="oew-call-to-action-btn">
					<a class="button elementor-animation-{{ settings.hover_animation }}" href="{{ settings.btn_link.url }}" role="button">
						<# if ( settings.icon && 'left' == settings.icon_align ) { #>
							<span class="oew-button-icon elementor-align-icon-{{ settings.icon_align }}">
								{{{ iconHTML.value }}}
							</span>
						<# } #>

						<span>{{{ settings.btn_text }}}</span>

						<# if ( settings.icon && 'right' == settings.icon_align ) { #>
							<span class="oew-button-icon elementor-align-icon-{{ settings.icon_align }}">
								{{{ iconHTML.value }}}
							</span>
						<# } #>
					</a>
				</div>
			<# } #>
		</div>
	<?php
	}

}