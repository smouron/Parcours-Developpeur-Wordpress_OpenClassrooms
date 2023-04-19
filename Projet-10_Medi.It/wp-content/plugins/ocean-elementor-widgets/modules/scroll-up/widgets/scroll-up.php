<?php
namespace owpElementor\Modules\ScrollUp\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Scroll_Up extends Widget_Base {

	public function get_name() {
		return 'oew-scroll-up';
	}

	public function get_title() {
		return __( 'Scroll Up', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-scroll';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'scroll',
            'up',
            'top',
            'owp',
        ];
    }

	public function get_script_depends() {
		return [ 'oew-scroll-up' ];
	}

	public function get_style_depends() {
		return [ 'oew-scroll-up' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_scroll_up',
			[
				'label' 		=> __( 'Scroll Up', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'display_text',
			[
				'label' 		=> __( 'Display Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'text',
			[
				'label'   		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::TEXT,
				'default' 		=> __( 'Scroll Up', 'ocean-elementor-widgets' ),
				'label_block' 	=> true,
				'condition' 	=> [
					'display_text' => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'ocean-elementor-widgets' ),
						'icon' 	=> 'eicon-text-align-justify',
					],
				],
				'default' 		=> '',
				'prefix_class' => 'oew%s-align-',
			]
		);

		$this->add_control(
			'icon',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICONS,
				'label_block' 	=> true,
				'default'		=> [
					'value'		=> 'fas fa-angle-up',
					'library' => 'solid',
				]
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

		$this->add_control(
			'icon_indent',
			[
				'label' 		=> __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 4,
				],
				'range' 		=> [
					'px' => [
						'max' => 50,
					],
				],
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button .elementor-align-icon-right' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-scroll-button .elementor-align-icon-left' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
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
				'name' 			=> 'scroll_button_typography',
				'selector' 		=> '{{WRAPPER}} .oew-scroll-button a',
			]
		);

		$this->start_controls_tabs( 'tabs_scroll_button_style' );

		$this->start_controls_tab(
			'tab_scroll_button_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'scroll_button_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_scroll_button_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'scroll_button_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'scroll_button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'scroll_button_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-scroll-button a',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'scroll_button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'scroll_button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-scroll-button a',
			]
		);

		$this->add_responsive_control(
			'scroll_button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'scroll_button_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-scroll-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'button-wrap', 'class', 'oew-scroll-button' );
		$this->add_render_attribute( 'button', 'href', '#' );
		$this->add_render_attribute( 'button', 'class', 'button' );

		$this->add_render_attribute( 'button-text', 'class', [
			'oew-button-text',
			'elementor-align-icon-' . $settings['icon_align'],
		] );

		$this->add_render_attribute( 'button-icon', 'class', 'oew-button-icon' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'button-wrap' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php
				if ( ! empty( $settings['icon'] ) && 'left' == $settings['icon_align'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'button-icon' ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php
				} ?>

				<?php
				if ( 'yes' == $settings['display_text'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'button-text' ); ?>><?php echo esc_attr( $settings['text'] ); ?></span>
				<?php
				} ?>

				<?php
				if ( ! empty( $settings['icon'] ) && 'right' == $settings['icon_align'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'button-icon' ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php
				} ?>
			</a>
		</div>

	<?php
	}

}