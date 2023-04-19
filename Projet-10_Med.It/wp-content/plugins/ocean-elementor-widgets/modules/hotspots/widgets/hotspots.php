<?php
namespace owpElementor\Modules\Hotspots\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Hotspots extends Widget_Base {

	public function get_name() {
		return 'oew-hotspots';
	}

	public function get_title() {
		return __( 'Hotspots', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-image-rollover';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'hot',
			'spot',
			'hotspot',
			'image',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-hotspots' );
	}

	public function get_style_depends() {
		return array( 'oew-hotspots', 'tippy', 'tippy-arrow' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_hotspots_image',
			array(
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Choose Image', 'ocean-elementor-widgets' ),
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

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots',
			array(
				'label' => __( 'Hotspots', 'ocean-elementor-widgets' ),
			)
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'hotspots_tabs' );

		$repeater->start_controls_tab( 'tab_content', array( 'label' => __( 'Content', 'ocean-elementor-widgets' ) ) );

		$repeater->add_control(
			'hotspot_type',
			array(
				'label'   => __( 'Type', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text'  => __( 'Text', 'ocean-elementor-widgets' ),
					'icon'  => __( 'Icon', 'ocean-elementor-widgets' ),
					'blank' => __( 'Blank', 'ocean-elementor-widgets' ),
				),
			)
		);

		$repeater->add_control(
			'hotspot_text',
			array(
				'label'     => __( 'Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( '1', 'ocean-elementor-widgets' ),
				'condition' => array(
					'hotspot_type' => 'text',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'hotspot_icon',
			array(
				'label'     => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICON,
				'default'   => '',
				'condition' => array(
					'hotspot_type' => 'icon',
				),
			)
		);

		$repeater->add_control(
			'hotspot_link',
			array(
				'label'   => __( 'Link', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::URL,
				'default' => array(
					'url' => '',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_position', array( 'label' => __( 'Position', 'ocean-elementor-widgets' ) ) );

		$repeater->add_control(
			'hotspot_top_position',
			array(
				'label'     => __( 'Top position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}%;',
				),
			)
		);

		$repeater->add_control(
			'hotspot_left_position',
			array(
				'label'     => __( 'Left position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 0.1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}%;',
				),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab( 'tab_tooltip', array( 'label' => __( 'Tooltip', 'ocean-elementor-widgets' ) ) );

		$repeater->add_control(
			'tooltip',
			array(
				'label'   => __( 'Tooltip', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$repeater->add_control(
			'tooltip_position',
			array(
				'label'     => __( 'Tooltip Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 's',
				'options'   => array(
					'n'      => __( 'Top', 'ocean-elementor-widgets' ),
					'ne-alt' => __( 'Top Start', 'ocean-elementor-widgets' ),
					'ne'     => __( 'Top End', 'ocean-elementor-widgets' ),
					'e'      => __( 'Right', 'ocean-elementor-widgets' ),
					'se-alt' => __( 'Right Start', 'ocean-elementor-widgets' ),
					'se'     => __( 'Right End', 'ocean-elementor-widgets' ),
					's'      => __( 'Bottom', 'ocean-elementor-widgets' ),
					'sw-alt' => __( 'Bottom Start', 'ocean-elementor-widgets' ),
					'sw'     => __( 'Bottom End', 'ocean-elementor-widgets' ),
					'w'      => __( 'Left', 'ocean-elementor-widgets' ),
					'nw-alt' => __( 'Left Start', 'ocean-elementor-widgets' ),
					'nw'     => __( 'Left End', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'tooltip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'tooltip_content',
			array(
				'label'     => __( 'Tooltip Content', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::WYSIWYG,
				'default'   => __( 'Add your tooltip content here', 'ocean-elementor-widgets' ),
				'condition' => array(
					'tooltip' => 'yes',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tab();

		$this->add_control(
			'hotspots',
			array(
				'label'       => __( 'Hotspots', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'default'     => array(
					array(
						'hotspot_text' => '1',
					),
				),
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ hotspot_text }}}',
			)
		);

		$this->add_control(
			'disable_pulse',
			array(
				'label'        => __( 'Disable Pulse Effect', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'return_value' => 'none',
				'selectors'    => array(
					'{{WRAPPER}} .oew-hotspot-inner:before' => 'display: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_tooltip',
			array(
				'label' => __( 'Tooltip', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'fade_in_time',
			array(
				'label'              => __( 'Fade In Time (ms)', 'ocean-elementor-widgets' ),
				'description'        => __( 'Time until tooltips appear.', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 200,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'fade_out_time',
			array(
				'label'              => __( 'Fade Out Time (ms)', 'ocean-elementor-widgets' ),
				'description'        => __( 'Time until tooltips dissapear.', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 100,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_image_style',
			array(
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'label'    => __( 'Image Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-hotspots-wrap img',
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-hotspots-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .oew-hotspots-wrap img',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_hotspots_style',
			array(
				'label' => __( 'Hotspots', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'hotspots_typo',
				'selector' => '{{WRAPPER}} .oew-hotspot-inner',
			)
		);

		$this->start_controls_tabs( 'tabs_hotspots_style' );

		$this->start_controls_tab(
			'tab_hotspots_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'hotspots_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hotspots_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_hotspots_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'hotspots_hover_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-hotspot-inner:hover, {{WRAPPER}} .oew-hotspot-inner:hover:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'hotspots_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-hotspot-inner:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'hotspots_size',
			array(
				'label'     => __( 'Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 40,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:before' => 'min-width: {{SIZE}}{{UNIT}}; min-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-hotspot-inner' => 'line-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'hotspots_border',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-hotspot-inner',
			)
		);

		$this->add_responsive_control(
			'hotspots_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-hotspot-inner, {{WRAPPER}} .oew-hotspot-inner:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'hotspots_box_shadow',
				'selector' => '{{WRAPPER}} .oew-hotspot-inner',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			array(
				'label' => __( 'Tooltips', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tooltips_typo',
				'selector' => 'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_control(
			'tooltips_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box' => 'background-color: {{VALUE}};',
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box > .tippy-svg-arrow' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tooltips_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tooltips_border',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => 'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_responsive_control(
			'tooltips_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltips_box_shadow',
				'selector' => 'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box',
			)
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
			if ( $settings['hotspots'] ) {
				?>
				<div class="oew-hotspot-wrap">
					<?php
					foreach ( $settings['hotspots'] as $index => $item ) :
						$hotspot_tag = 'div';
						$hotspot     = $this->get_repeater_setting_key( 'hotspot', 'hotspots', $index );
						$text        = $this->get_repeater_setting_key( 'hotspot_text', 'hotspots', $index );
						$icon        = $this->get_repeater_setting_key( 'hotspot_icon', 'hotspots', $index );

						$this->add_render_attribute(
							$hotspot,
							array(
								'class' => array(
									'oew-hotspot-inner',
									'elementor-repeater-item-' . $item['_id'],
								),
							)
						);

						if ( 'yes' == $item['tooltip'] ) {
							$this->add_render_attribute(
								$hotspot,
								array(
									'class' => array(
										'oew-hotspot-tooltip',
										'oew-tooltip-' . $item['tooltip_position'],
									),
									'aria-label' => trim( $this->parse_text_editor( $item['tooltip_content'] ) ),
								)
							);
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
						}
						?>

						<<?php echo $hotspot_tag; ?> <?php echo $this->get_render_attribute_string( $hotspot ); ?>>
							<?php
							if ( 'blank' != $item['hotspot_type'] ) {
								?>
								<span <?php echo $this->get_render_attribute_string( $text ); ?>>
									<?php
									if ( 'icon' == $item['hotspot_type'] && ! empty( $item['hotspot_icon'] ) ) {
										?>
										<i class="<?php echo esc_attr( $item['hotspot_icon'] ); ?>""></i>
										<?php
									} else {
										echo $item['hotspot_text'];
									}
									?>
								</span>
								<?php
							}
							?>
						</<?php echo $hotspot_tag; ?>>

						<?php
					endforeach;
					?>
				</div>
				<?php
			}
			?>
		</div>

		<?php
	}

	protected function content_template() {
		?>
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
								view.addRenderAttribute( hotspot, 'aria-label', item.tooltip_content );
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
