<?php
namespace owpElementor\Modules\Divider\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Divider extends Widget_Base {

	public function get_name() {
		return 'oew-divider';
	}

	public function get_title() {
		return __( 'Divider', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-divider';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'divider',
			'separator',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-divider' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_divider',
			array(
				'label' => __( 'General', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'divider_middle',
			array(
				'label'   => __( 'Text or Icon', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => array(
					'text' => __( 'Text', 'ocean-elementor-widgets' ),
					'icon' => __( 'Icon', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'     => __( 'Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => __( 'Text Divider', 'ocean-elementor-widgets' ),
				'condition' => array(
					'divider_middle' => 'text',
				),
				'dynamic'   => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_html_tag',
			array(
				'label'     => __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h6',
				'options'   => array(
					'h1'   => __( 'H1', 'ocean-elementor-widgets' ),
					'h2'   => __( 'H2', 'ocean-elementor-widgets' ),
					'h3'   => __( 'H3', 'ocean-elementor-widgets' ),
					'h4'   => __( 'H4', 'ocean-elementor-widgets' ),
					'h5'   => __( 'H5', 'ocean-elementor-widgets' ),
					'h6'   => __( 'H6', 'ocean-elementor-widgets' ),
					'div'  => __( 'div', 'ocean-elementor-widgets' ),
					'span' => __( 'span', 'ocean-elementor-widgets' ),
					'p'    => __( 'p', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'divider_middle' => 'text',
				),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'fas fa-star',
					'library' => 'solid',
				),
				'condition'   => array(
					'divider_middle' => 'icon',
				),
			)
		);

		$this->add_responsive_control(
			'alignment',
			array(
				'label'        => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'center',
				'options'      => array(
					'left'   => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'prefix_class' => 'oew-divider-',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Text / Icon', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'middle_typo',
				'selector'  => '{{WRAPPER}} .oew-divider-wrap .oew-divider-text, {{WRAPPER}} .oew-divider-wrap .oew-divider-middle i',
				'condition' => array(
					'divider_middle' => 'text',
				),
			)
		);

		$this->add_responsive_control(
			'spacing',
			array(
				'label'     => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 8,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'margin: 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.oew-divider-left .oew-divider-middle' => 'margin-left: 0; margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}}.oew-divider-right .oew-divider-middle' => 'margin-right: 0; margin-left: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => __( 'Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 150,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-text' => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle i' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'label'    => __( 'Text Border', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-divider-wrap .oew-divider-middle',
			)
		);

		$this->add_control(
			'border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider-middle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .oew-divider-wrap .oew-divider-middle',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'      => 'text_shadow',
				'selector'  => '{{WRAPPER}} .oew-divider-wrap .oew-divider-middle',
				'condition' => array(
					'divider_middle' => 'text',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_divider_style',
			array(
				'label' => __( 'Divider', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'divider_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'divider_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'unit' => '%',
					'size' => 100,
				),
				'range'      => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'divider_height',
			array(
				'label'     => __( 'Height', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 1,
				),
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-divider-wrap .oew-divider' => 'height: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$tag      = $settings['text_html_tag'];

		$this->add_render_attribute( 'wrap', 'class', 'oew-divider-wrap' );

		$this->add_render_attribute(
			'before',
			'class',
			array(
				'oew-divider',
				'oew-divider-before',
			)
		);

		$this->add_render_attribute(
			'after',
			'class',
			array(
				'oew-divider',
				'oew-divider-after',
			)
		);

		$this->add_render_attribute( 'middle', 'class', 'oew-divider-middle' );
		$this->add_render_attribute( 'text', 'class', 'oew-divider-text' );
		$this->add_inline_editing_attributes( 'text', 'basic' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'before' ); ?>></div>
			<div <?php echo $this->get_render_attribute_string( 'middle' ); ?>>
				<?php
				if ( 'text' == $settings['divider_middle'] ) {
					?>
					<<?php echo $tag; ?> <?php echo $this->get_render_attribute_string( 'text' ); ?>>
						<?php echo $this->parse_text_editor( $settings['text'] ); ?>
					</<?php echo $tag; ?>>
					<?php
				} else {
					\Elementor\Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) );
				}
				?>
			</div>
			<div <?php echo $this->get_render_attribute_string( 'after' ); ?>></div>
		</div>

		<?php
	}

	protected function content_template() {
		?>
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
