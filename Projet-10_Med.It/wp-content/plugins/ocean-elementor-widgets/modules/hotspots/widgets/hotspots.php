<?php
namespace owpElementor\Modules\Hotspots\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class Hotspots extends Widget_Base {

	public function get_name() {
		return 'oew-hotspots';
	}

	public function get_title() {
		return __( 'Hotspots', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'oew-hotspots', 'oew-tooltip' ];
	}

	public function get_style_depends() {
		return [ 'oew-hotspots', 'oew-tooltip' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_hotspots_image',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'image',
			[
				'label'   		=> __( 'Choose Image', 'ocean-elementor-widgets' ),
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

        $this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots',
			[
				'label' 		=> __( 'Hotspots', 'ocean-elementor-widgets' ),
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'hotspots_tabs' );

		$repeater->start_controls_tab( 'tab_content', [ 'label' => __( 'Content', 'ocean-elementor-widgets' ) ] );

		$repeater->add_control(
			'hotspot_type',
			[
				'label'			=> __( 'Type', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'text',
				'options' 		=> [
					'text'  => __( 'Text', 'ocean-elementor-widgets' ),
					'icon'  => __( 'Icon', 'ocean-elementor-widgets' ),
					'blank' => __( 'Blank', 'ocean-elementor-widgets' ),
				],
			]
		);

		$repeater->add_control(
			'hotspot_text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type'			=> Controls_Manager::TEXT,
				'default'		=> __( '1', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'hotspot_type' => 'text'
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'hotspot_icon',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICON,
				'default' 		=> '',
				'condition'		=> [
					'hotspot_type' => 'icon'
				],
			]
		);

		$repeater->add_control(
			'hotspot_link',
			[
				'label' 		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::URL,
				'default' 		=> [
					'url' => '',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_position', [ 'label' => __( 'Position', 'ocean-elementor-widgets' ) ] );

		$repeater->add_control(
			'hotspot_top_position',
			[
				'label' 	=> __( 'Top position', 'ocean-elementor-widgets' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
						'step'	=> 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				],
			]
		);

		$repeater->add_control(
			'hotspot_left_position',
			[
				'label' 	=> __( 'Left position', 'ocean-elementor-widgets' ),
				'type' 		=> Controls_Manager::SLIDER,
				'range' 	=> [
					'px' 	=> [
						'min' 	=> 0,
						'max' 	=> 100,
						'step'	=> 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				],
			]
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_tooltip', [ 'label' => __( 'Tooltip', 'ocean-elementor-widgets' ) ] );

		$repeater->add_control(
			'tooltip',
			[
				'label' 		=> __( 'Tooltip', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$repeater->add_control(
			'tooltip_position',
			[
				'label'			=> __( 'Tooltip Position', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 's',
				'options' 		=> [
					'n' 		=> __( 'Top', 'ocean-elementor-widgets' ),
					'e' 		=> __( 'Right', 'ocean-elementor-widgets' ),
					's' 		=> __( 'Bottom', 'ocean-elementor-widgets' ),
					'w' 		=> __( 'Left', 'ocean-elementor-widgets' ),
					'ne' 		=> __( 'Top Right', 'ocean-elementor-widgets' ),
					'ne-alt' 	=> __( 'Top Right Alt', 'ocean-elementor-widgets' ),
					'nw' 		=> __( 'Top Left', 'ocean-elementor-widgets' ),
					'nw-alt' 	=> __( 'Top Left Alt', 'ocean-elementor-widgets' ),
					'se' 		=> __( 'Bottom Right', 'ocean-elementor-widgets' ),
					'se-alt' 	=> __( 'Bottom Right Alt', 'ocean-elementor-widgets' ),
					'sw' 		=> __( 'Bottom Left', 'ocean-elementor-widgets' ),
					'sw-alt' 	=> __( 'Bottom Left Alt', 'ocean-elementor-widgets' ),
				],
				'condition'		=> [
					'tooltip' => 'yes',
				],
			]
		);

		$repeater->add_control(
			'tooltip_content',
			[
				'label' 		=> __( 'Tooltip Content', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::WYSIWYG,
				'default' 		=> __( 'Add your tooltip content here', 'ocean-elementor-widgets' ),
				'condition'		=> [
					'tooltip' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tab();

		$this->add_control(
			'hotspots',
			[
				'label' 		=> __( 'Hotspots', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::REPEATER,
				'default' 		=> [
					[
						'hotspot_text' => '1',
					],
				],
				'fields' 		=> array_values( $repeater->get_controls() ),
				'title_field' 	=> '{{{ hotspot_text }}}',
			]
		);

		$this->add_control(
			'disable_pulse',
			[
				'label' 		=> __( 'Disable Pulse Effect', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'no',
				'return_value' 	=> 'none',
				'selectors'		=> [
					'{{WRAPPER}} .oew-hotspot-inner:before' => 'display: {{VALUE}};'
				]
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_tooltip',
			[
				'label' 		=> __( 'Tooltip', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'fade_in_time',
			[
				'label' 		=> __( 'Fade In Time (ms)', 'ocean-elementor-widgets' ),
				'description' 	=> __( 'Time until tooltips appear.', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 200,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 1000,
					],
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'fade_out_time',
			[
				'label' 		=> __( 'Fade Out Time (ms)', 'ocean-elementor-widgets' ),
				'description' 	=> __( 'Time until tooltips dissapear.', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 100,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 1000,
					],
				],
				'frontend_available' => true,
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
				'label' 		=> __( 'Image Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-hotspots-wrap img',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-hotspots-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'image_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-hotspots-wrap img',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_style',
			[
				'label' 		=> __( 'Hotspots', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'hotspots_typo',
				'selector' 		=> '{{WRAPPER}} .oew-hotspot-inner',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->start_controls_tabs( 'tabs_hotspots_style' );

		$this->start_controls_tab(
			'tab_hotspots_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'hotspots_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hotspots_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hotspots_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'hotspots_hover_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-hotspot-inner:hover, {{WRAPPER}} .oew-hotspot-inner:hover:before' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hotspots_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-hotspot-inner:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'hotspots_size',
			[
				'label' 		=> __( 'Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 40,
				],
				'range' 		=> [
					'px' => [
						'min' 	=> 0,
						'max' 	=> 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:before' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-hotspot-inner' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'hotspots_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .oew-hotspot-inner',
			]
		);

		$this->add_responsive_control(
			'hotspots_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'hotspots_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-hotspot-inner',
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			[
				'label' 		=> __( 'Tooltips', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'tooltips_typo',
				'selector' 		=> '#powerTip.oew-hotspot-powertip',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->add_control(
			'tooltips_background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#powerTip.oew-hotspot-powertip' => 'background-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.n:before' => 'border-top-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.e:before' => 'border-right-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.s:before' => 'border-bottom-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.w:before' => 'border-left-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.ne:before, #powerTip.oew-hotspot-powertip.nw:before' => 'border-top-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.se:before, #powerTip.oew-hotspot-powertip.sw:before' => 'border-bottom-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.nw-alt:before, #powerTip.oew-hotspot-powertip.ne-alt:before, #powerTip.oew-hotspot-powertip.sw-alt:before, #powerTip.oew-hotspot-powertip.se-alt:before' => 'border-top-color: {{VALUE}};',
					'#powerTip.oew-hotspot-powertip.sw-alt:before, #powerTip.oew-hotspot-powertip.se-alt:before' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tooltips_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#powerTip.oew-hotspot-powertip' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'tooltips_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '#powerTip.oew-hotspot-powertip',
			]
		);

		$this->add_responsive_control(
			'tooltips_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'#powerTip.oew-hotspot-powertip' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'tooltips_box_shadow',
				'selector' 		=> '#powerTip.oew-hotspot-powertip',
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( empty( $settings['image']['url'] ) ) {
			return;
		} ?>

		<div class="oew-hotspots-wrap">
			<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>

			<?php
			if ( $settings['hotspots'] ) { ?>
				<div class="oew-hotspot-wrap">
					<?php
					foreach ( $settings['hotspots'] as $index => $item ) :
						$hotspot_tag 	= 'div';
						$hotspot 		= $this->get_repeater_setting_key( 'hotspot', 'hotspots', $index );
						$text 			= $this->get_repeater_setting_key( 'hotspot_text', 'hotspots', $index );
						$icon 			= $this->get_repeater_setting_key( 'hotspot_icon', 'hotspots', $index );

						$this->add_render_attribute( $hotspot, [
							'class' => [
								'oew-hotspot-inner',
								'elementor-repeater-item-' . $item['_id'],
							]
						] );

						if ( 'yes' == $item['tooltip'] ) {
							$this->add_render_attribute( $hotspot, [
								'class' => [
									'oew-hotspot-tooltip',
									'oew-tooltip-' . $item['tooltip_position'],
								],
								'title'	=> $this->parse_text_editor( $item['tooltip_content'] ),
							] );
						}

						$this->add_render_attribute( $text, 'class', 'oew-hotspot-text' );

						if ( ! empty( $item['hotspot_link']['url'] ) ) {
							$hotspot_tag = 'a';

							$this->add_render_attribute( $hotspot, 'href', $item['hotspot_link']['url'] );

							if ( $item['hotspot_link']['is_external'] ) {
								$this->add_render_attribute( $hotspot, 'target', '_blank' );
							}

							if ( ! empty( $item['hotspot_link']['nofollow'] ) ) {
								$this->add_render_attribute( $hotspot, 'rel', 'nofollow' );
							}
						} ?>

						<<?php echo $hotspot_tag; ?> <?php echo $this->get_render_attribute_string( $hotspot ); ?>>
							<?php
							if ( 'blank' != $item['hotspot_type'] ) { ?>
								<span <?php echo $this->get_render_attribute_string( $text ); ?>>
									<?php
									if ( 'icon' == $item['hotspot_type'] && ! empty( $item['hotspot_icon'] ) ) { ?>
										<i class="<?php echo esc_attr( $item['hotspot_icon'] ); ?>""></i>
									<?php
									} else {
										echo $item['hotspot_text'];
									} ?>
								</span>
							<?php
							} ?>
						</<?php echo $hotspot_tag; ?>>

					<?php
					endforeach; ?>
				</div>
			<?php
			} ?>
		</div>

	<?php
	}

	protected function _content_template() { ?>
		<# if ( settings.image.url ) {
			var image = {
				id: settings.image.id,
				url: settings.image.url,
				size: settings.image_size,
				dimension: settings.image_custom_dimension,
				model: view.getEditModel()
			};

			var image_url = elementor.imagesManager.getImageUrl( image );

			if ( ! image_url ) {
				return;
			} #>

			<div class="oew-hotspots-wrap">
				<img src="{{ image_url }}" />

				<# if ( settings.hotspots ) { #>
					<div class="oew-hotspot-wrap">
						<# _.each( settings.hotspots, function( item, index ) {

							var hotspot_tag 	= 'div',
								hotspot 		= view.getRepeaterSettingKey( 'hotspot', 'hotspots', index ),
								text 			= view.getRepeaterSettingKey( 'hotspot_text', 'hotspots', index ),
								icon 			= view.getRepeaterSettingKey( 'hotspot_icon', 'hotspots', index );

							view.addRenderAttribute( hotspot, 'class', [
								'oew-hotspot-inner',
								'elementor-repeater-item-' + item._id,
							] );

							if ( 'yes' == item.tooltip ) {
								view.addRenderAttribute( hotspot, 'class', 'oew-hotspot-tooltip' );
								view.addRenderAttribute( hotspot, 'class', 'oew-tooltip-' + item.tooltip_position );
								view.addRenderAttribute( hotspot, 'title', item.tooltip_content );
							}

							view.addRenderAttribute( text, 'class', 'oew-hotspot-text' );

							if ( '' != item.hotspot_link.url ) {
								hotspot_tag = 'a';
								view.addRenderAttribute( hotspot, 'href', item.hotspot_link.url );
							} #>

							<{{ hotspot_tag }} {{{ view.getRenderAttributeString( hotspot ) }}}>
								<# if ( 'blank' != item.hotspot_type ) { #>
									<span {{{ view.getRenderAttributeString( text ) }}}>
										<# if ( 'icon' == item.hotspot_type && '' !== item.hotspot_icon ) { #>
											<i class="{{{ item.hotspot_icon }}}"></i>
										<# } else { #>
											{{ item.hotspot_text }}
										<# } #>
									</span>
								<# } #>
							</{{ hotspot_tag }}>
						<# } ); #>
					</div>
				<# } #>
			</div>

		<# } #>
	<?php
	}

}