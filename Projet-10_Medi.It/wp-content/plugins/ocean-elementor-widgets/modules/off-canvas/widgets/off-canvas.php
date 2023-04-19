<?php
namespace owpElementor\Modules\OffCanvas\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Off_Canvas extends Widget_Base {

	public function get_name() {
		return 'oew-off-canvas';
	}

	public function get_title() {
		return __( 'Off Canvas', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-menu-bar';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'off',
            'canvas',
            'widget',
            'owp',
        ];
    }

	public function get_script_depends() {
		return [ 'oew-off-canvas' ];
	}

	public function get_style_depends() {
		return [ 'oew-off-canvas' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_off_canvas',
			[
				'label' 		=> __( 'Off Canvas', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'source',
			[
				'label'   		=> __( 'Source', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'sidebar',
				'options' 		=> [
					'sidebar'  	=> __( 'Sidebar', 'ocean-elementor-widgets' ),
					'template'  => __( 'Template', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'sidebars',
			[
				'label'   		=> __( 'Choose Sidebar', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '0',
				'options' 		=> oew_get_available_sidebars(),
				'condition' 	=> [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_control(
			'templates',
			[
				'label'   		=> __( 'Choose Template', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '0',
				'options' 		=> oew_get_available_templates(),
				'condition' 	=> [
					'source' => 'template',
				],
			]
		);

		$this->add_responsive_control(
			'off_canvas_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_overlay',
			[
				'label' 		=> __( 'Overlay', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'off_canvas_close_button',
			[
				'label'   		=> __( 'Close Button', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
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
			'text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Off Canvas', 'ocean-elementor-widgets' ),
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
					'value'   => 'fas fa-bars',
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
					'{{WRAPPER}} .oew-off-canvas-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-off-canvas-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .oew-off-canvas-button a, {{WRAPPER}} .oew-off-canvas-button a i, {{WRAPPER}} .oew-off-canvas-button a svg' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Off Canvas', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'off_canvas_bg',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_color',
			[
				'label'     	=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_link_color',
			[
				'label'     	=> __( 'Link Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar a' => 'color: {{VALUE}};',
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar a *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_link_hover_color',
			[
				'label'     	=> __( 'Link Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'off_canvas_box_shadow',
				'selector' 		=> '#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar',
			]
		);

		$this->add_responsive_control(
			'off_canvas_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_heading',
			[
				'label' 		=> __( 'Close Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HEADING,
				'separator' 	=> 'before',
				'condition' 	=> [
					'off_canvas_close_button' => 'yes',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'condition' 	=> [
					'off_canvas_close_button' => 'yes',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-close svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_close_btn_hover_color',
			[
				'label'     	=> __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'condition' 	=> [
					'off_canvas_close_button' => 'yes',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-close:hover svg' => 'fill: {{VALUE}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_widget_style',
			[
				'label' 		=> __( 'Widgets', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_control(
			'off_canvas_widgets_bg',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'condition' 	=> [
					'source' => 'sidebar',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'off_canvas_widgets_border',
				'selector' 		=> '#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box',
				'condition' 	=> [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_responsive_control(
			'off_canvas_widgets_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'condition' 	=> [
					'source' => 'sidebar',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'off_canvas_widgets_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'condition' 	=> [
					'source' => 'sidebar',
				],
				'selectors' 	=> [
					'#oew-off-canvas-{{ID}}.oew-off-canvas-wrap .oew-off-canvas-sidebar .sidebar-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'name' 			=> 'off_canvas_button_typography',
				'selector' 		=> '{{WRAPPER}} .oew-off-canvas-button a',
			]
		);

		$this->start_controls_tabs( 'tabs_off_canvas_button_style' );

		$this->start_controls_tab(
			'tab_off_canvas_button_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'off_canvas_button_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_button_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_off_canvas_button_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'off_canvas_button_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_button_hover_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'off_canvas_button_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'off_canvas_button_border',
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-off-canvas-button a',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'off_canvas_button_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'off_canvas_button_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-off-canvas-button a',
			]
		);

		$this->add_responsive_control(
			'off_canvas_button_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_responsive_control(
			'off_canvas_button_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-off-canvas-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings           = $this->get_settings_for_display();
		$id                 = $this->get_id();
		$source 			= $settings['source'];

		$this->add_render_attribute( 'button-wrap', 'class', 'oew-off-canvas-button' );
		$this->add_render_attribute( 'button', 'href', '#oew-off-canvas-' . esc_attr( $id ) );
		$this->add_render_attribute( 'button', 'class', 'button' );

		$this->add_render_attribute( 'icon-align', 'class', [
			'oew-button-icon',
			'elementor-align-icon-' . $settings['icon_align'],
		] );

		$this->add_render_attribute( 'off-canvas', 'id', 'oew-off-canvas-' . esc_attr( $id ) );
		$this->add_render_attribute( 'off-canvas', 'class', 'oew-off-canvas-wrap' );

		$this->add_render_attribute( 'off-canvas-close', 'type', 'button' );
		$this->add_render_attribute( 'off-canvas-close', 'class', 'oew-off-canvas-close' );

		$this->add_render_attribute( 'off-canvas-sidebar', 'class', 'oew-off-canvas-sidebar' );

		$this->add_render_attribute( 'off-canvas-overlay', 'class', 'oew-off-canvas-overlay' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'button-wrap' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?>>
				<?php
				if ( ! empty( $settings['icon'] ) && 'left' == $settings['icon_align'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php
				} ?>

				<span><?php echo esc_attr( $settings['text'] ); ?></span>

				<?php
				if ( ! empty( $settings['icon'] ) && 'right' == $settings['icon_align'] ) { ?>
					<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php
				} ?>
			</a>
		</div>

	    <div <?php echo $this->get_render_attribute_string( 'off-canvas' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'off-canvas-sidebar' ); ?>>
				<?php
				if ( $settings['off_canvas_close_button'] ) { ?>
	        		<button aria-label="<?php esc_attr( oew_lang_strings( 'oew-string-offc-close-btn' ) ); ?>" <?php echo $this->get_render_attribute_string( 'off-canvas-close' ); ?>>
	        			<svg focusable="false" aria-hidden="true" role="img" width="14" height="14" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
							<path d="M505.943,6.058c-8.077-8.077-21.172-8.077-29.249,0L6.058,476.693c-8.077,8.077-8.077,21.172,0,29.249
								C10.096,509.982,15.39,512,20.683,512c5.293,0,10.586-2.019,14.625-6.059L505.943,35.306
								C514.019,27.23,514.019,14.135,505.943,6.058z"/>
							<path d="M505.942,476.694L35.306,6.059c-8.076-8.077-21.172-8.077-29.248,0c-8.077,8.076-8.077,21.171,0,29.248l470.636,470.636
								c4.038,4.039,9.332,6.058,14.625,6.058c5.293,0,10.587-2.019,14.624-6.057C514.018,497.866,514.018,484.771,505.942,476.694z"/>
						</svg>
	        		</button>
	        	<?php
	        	} ?>

				<?php
				if ( ! empty( $source ) ) {
	            	if ( 'sidebar' == $source
	            		&& ( '0' != $settings['sidebars'] && ! empty( $settings['sidebars'] ) ) ) {
	            		dynamic_sidebar( $settings['sidebars'] );
	            	} else if ( 'template' == $source
	            		&& ( '0' != $settings['templates'] && ! empty( $settings['templates'] ) ) ) {
	            		echo Plugin::instance()->frontend->get_builder_content_for_display( $settings['templates'] );
	            	}
	            } ?>
			</div>
			<?php
			if ( $settings['off_canvas_overlay'] ) { ?>
				<div <?php echo $this->get_render_attribute_string( 'off-canvas-overlay' ); ?>></div>
        	<?php
        	} ?>
		</div>

	<?php
	}

}