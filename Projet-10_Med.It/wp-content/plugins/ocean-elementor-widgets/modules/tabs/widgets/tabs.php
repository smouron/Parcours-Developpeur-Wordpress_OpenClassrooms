<?php
namespace owpElementor\Modules\Tabs\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Tabs extends Widget_Base {

	public function get_name() {
		return 'oew-tabs';
	}

	public function get_title() {
		return __( 'Tabs', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-tabs';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'oew-tabs' ];
	}

	public function get_style_depends() {
		return [ 'oew-tabs' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_tabs',
			[
				'label' 		=> __( 'Tabs', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' 		=> __( 'Items', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   	=> __( 'Tab #1', 'ocean-elementor-widgets' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
					],
					[
						'tab_title'   	=> __( 'Tab #2', 'ocean-elementor-widgets' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
					],
					[
						'tab_title'   	=> __( 'Tab #3', 'ocean-elementor-widgets' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
					],
				],
				'fields' => [
					[
						'name'        	=> 'tab_title',
						'label'       	=> __( 'Title & Content', 'ocean-elementor-widgets' ),
						'type'        	=> Controls_Manager::TEXT,
						'default'     	=> __( 'Tab Title' , 'ocean-elementor-widgets' ),
						'label_block' 	=> true,
						'dynamic' 		=> [ 'active' => true ],
					],
					[
						'name'        	=> 'tab_icon',
						'label'       	=> __( 'Icon', 'ocean-elementor-widgets' ),
						'type'        	=> Controls_Manager::ICONS,
						'default'		=> [
							'value'   => '',
							'library' => 'solid',
						],
					],
					[
						'name'    		=> 'source',
						'label'   		=> __( 'Select Source', 'ocean-elementor-widgets' ),
						'type'    		=> Controls_Manager::SELECT,
						'default' 		=> 'custom',
						'options' 		=> [
							'custom'    => __( 'Custom', 'ocean-elementor-widgets' ),
							'template' 	=> __( 'Template', 'ocean-elementor-widgets' ),
						],
					],
					[
						'name'       	=> 'tab_content',
						'label'      	=> __( 'Content', 'ocean-elementor-widgets' ),
						'type'       	=> Controls_Manager::WYSIWYG,
						'default' 		=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
						'show_label' 	=> false,
						'condition' 	=> [
							'source' => 'custom',
						],
						'dynamic' 		=> [ 'active' => true ],
					],
					[
						'name'        	=> 'templates',
						'label'       	=> __( 'Content', 'ocean-elementor-widgets' ),
						'type'        	=> Controls_Manager::SELECT,
						'default' 		=> '0',
						'options' 		=> oew_get_available_templates(),
						'condition' 	=> [
							'source' => 'template',
						],
					],
				],
				'title_field' 	=> '{{{ tab_title }}}',
			]
		);

		$this->add_control(
			'tab_layout',
			[
				'label'   		=> __( 'Layout', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'top',
				'options' 		=> [
					'top' 		=> __( 'Top', 'ocean-elementor-widgets' ),
					'bottom'  	=> __( 'Bottom', 'ocean-elementor-widgets' ),
					'left'    	=> __( 'Left', 'ocean-elementor-widgets' ),
					'right'   	=> __( 'Right', 'ocean-elementor-widgets' ),
				],
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'align',
			[
				'label'   		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left'    => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'ocean-elementor-widgets' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'condition' 	=> [
					'tab_layout' => [ 'top', 'bottom' ]
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label' 		=> __( 'Additional Options', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'active_item',
			[
				'label' 		=> __( 'Active Item No', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::NUMBER,
				'min'   		=> 1,
				'max'   		=> 20,
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Tab', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'tab_spacing',
			[
				'label' 		=> __( 'Tab Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs-wrap' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-tabs-wrap .oew-tab-title' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-tabs-left .oew-tabs-wrap .oew-tab-title, {{WRAPPER}} .oew-tabs-right .oew-tabs-wrap .oew-tab-title' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'tab_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tab-title',
			]
		);

		$this->start_controls_tabs( 'tabs_tab_style' );

		$this->start_controls_tab(
			'tab_tab_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'tab_background_color',
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tab-title',
			)
		);

		$this->add_control(
			'tab_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'tab_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tab-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'tab_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-tabs .oew-tab-title',
			]
		);

		$this->add_control(
			'tab_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_padding',
			[
				'label'      	=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_tab_active',
			[
				'label' 		=> __( 'Active', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'tab_active_background_color',
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tab-title.oew-active',
			)
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title.oew-active' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'tab_active_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tab-title.oew-active',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'tab_active_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-tabs .oew-tab-title.oew-active',
			]
		);

		$this->add_control(
			'tab_active_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title.oew-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tab-content',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'content_background_color',
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tabs-content-wrap',
			)
		);

		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' 		=> __( 'Content Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs.oew-tabs-top .oew-tab-content' => 'margin-top: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-tabs.oew-tabs-bottom .oew-tab-content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-tabs.oew-tabs-left .oew-tab-content' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-tabs.oew-tabs-right .oew-tab-content' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'content_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-tabs .oew-tabs-content-wrap',
			]
		);

		$this->add_responsive_control(
			'content_border_width',
			[
				'label' 		=> __( 'Border Width', 'elementor' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 1,
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-tabs .oew-tab-content, {{WRAPPER}} .oew-tabs .oew-tab-mobile-title' => 'border-width: {{SIZE}}{{UNIT}}; border-top: 0;',
					'{{WRAPPER}} .oew-tabs .oew-tabs-content-wrap' => 'border-top-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_border_style',
			[
				'label'   		=> __( 'Border Style', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'solid',
				'options' 		=> [
					'none' 		=> __( 'None', 'ocean-elementor-widgets' ),
					'solid'  	=> __( 'Solid', 'ocean-elementor-widgets' ),
					'double'    => __( 'Double', 'ocean-elementor-widgets' ),
					'dotted'   	=> __( 'Dotted', 'ocean-elementor-widgets' ),
					'dashed'   	=> __( 'Dashed', 'ocean-elementor-widgets' ),
					'groove'   	=> __( 'Groove', 'ocean-elementor-widgets' ),
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-content, {{WRAPPER}} .oew-tabs .oew-tab-mobile-title, {{WRAPPER}} .oew-tabs .oew-tabs-content-wrap' => 'border-style: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-content, {{WRAPPER}} .oew-tabs .oew-tab-mobile-title, {{WRAPPER}} .oew-tabs .oew-tabs-content-wrap' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-tabs .oew-tabs-content-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      	=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __( 'Start', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					],
					'right' => [
						'title' => __( 'End', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'     	=> is_rtl() ? 'right' : 'left',
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_active',
			[
				'label' 		=> __( 'Active', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon_active_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title.oew-active i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'icon_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-tabs .oew-tab-title .oew-icon-align-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-tabs .oew-tab-title .oew-icon-align-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$id_int 	= substr( $this->get_id_int(), 0, 3 );
		$layout 	= $settings['tab_layout'];

		$this->add_render_attribute( 'wrap', 'class', [
			'oew-tabs',
			'oew-tabs-' . $layout
		] );

        if ( ! empty( $settings['active_item'] ) ) {
			$data = [ $settings['active_item'] ];
			$this->add_render_attribute( 'wrap', 'class', 'oew-has-active-item' );
    		$this->add_render_attribute( 'wrap', 'data-settings', wp_json_encode( $data ) );
		}

		$this->add_render_attribute( 'tabs-wrap', 'class', 'oew-tabs-wrap' );

        if ( 'top' == $layout
        	|| 'bottom' == $layout ) {
			$this->add_render_attribute( 'tabs-wrap', 'class', [
				'oew-tabs-normal',
				'oew-tabs-' . $settings['align']
			] );
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>

			<?php
			if ( 'bottom' != $layout ) { ?>
				<div <?php echo $this->get_render_attribute_string( 'tabs-wrap' ); ?>>
					<?php
					foreach ( $settings['tabs'] as $index => $item ) :
						$tab_count 		= $index + 1;
						$active_item 	= ( $tab_count === $settings['active_item'] ) ? ' oew-active' : '';
						$tab_title_key 	= $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

						$this->add_render_attribute( $tab_title_key, [
							'id' 			=> 'oew-tab-title-' . $id_int . $tab_count,
							'class' 		=> [ 'oew-tab-title', $active_item ],
							'data-tab' 		=> $tab_count,
							'tabindex' 		=> $id_int . $tab_count,
							'role' 			=> 'tab',
							'aria-controls' => 'oew-tab-content-' . $id_int . $tab_count,
						] ); ?>

						<div <?php echo $this->get_render_attribute_string( $tab_title_key ); ?>>
							<?php
							if ( ! empty( $item['tab_icon'] )
								&& 'left' == $settings['icon_align'] ) { ?>
								<span class="oew-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
									<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>
							<?php
							}

							if ( $item['tab_title'] ) {
								echo $item['tab_title'];
							}

							if ( ! empty( $item['tab_icon'] )
								&& 'right' == $settings['icon_align'] ) { ?>
								<span class="oew-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
									<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>
							<?php
							} ?>
						</div>
					<?php
					endforeach; ?>
				</div>
			<?php
			} ?>

			<div class="oew-tabs-content-wrap">
				<?php
				foreach ( $settings['tabs'] as $index => $item ) :
					$tab_count 				= $index + 1;
					$active_item 			= ( $tab_count === $settings['active_item'] ) ? ' oew-active' : '';
					$tab_content_key 		= $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
					$tab_title_mobile_key 	= $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

					$this->add_render_attribute( $tab_content_key, [
						'id' 				=> 'oew-tab-content-' . $tab_count,
						'class' 			=> [ 'oew-tab-content', $active_item ],
						'role' 				=> 'tabpanel',
						'aria-labelledby' 	=> 'oew-tab-title-' . $id_int . $tab_count,
					] );

					$this->add_render_attribute( $tab_title_mobile_key, [
						'class' 	=> [ 'oew-tab-title', 'oew-tab-mobile-title', $active_item ],
						'tabindex' 	=> $id_int . $tab_count,
						'data-tab' 	=> $tab_count,
						'role' 		=> 'tab',
					] ); ?>

					<div <?php echo $this->get_render_attribute_string( $tab_title_mobile_key ); ?>>
						<?php
						if ( ! empty( $item['tab_icon'] )
							&& 'left' == $settings['icon_align'] ) { ?>
							<span class="oew-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php
						}

						if ( $item['tab_title'] ) {
							echo $item['tab_title'];
						}

						if ( ! empty( $item['tab_icon'] )
							&& 'right' == $settings['icon_align'] ) { ?>
							<span class="oew-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
								<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php
						} ?>
					</div>

					<div <?php echo $this->get_render_attribute_string( $tab_content_key ); ?>>
						<?php
		            	if ( 'custom' == $item['source']
		            		&& ! empty( $item['tab_content'] ) ) {
		            		echo $item['tab_content'];
		            	} else if ( 'template' == $item['source']
		            		&& ( '0' != $item['templates'] && ! empty( $item['templates'] ) ) ) {
		            		echo Plugin::instance()->frontend->get_builder_content_for_display( $item['templates'] );
		            	} ?>
					</div>
				<?php
				endforeach; ?>
			</div>

			<?php
			if ( 'bottom' == $layout ) { ?>
				<div <?php echo $this->get_render_attribute_string( 'tabs-wrap' ); ?>>
					<?php
					foreach ( $settings['tabs'] as $index => $item ) :
						$tab_count 		= $index + 1;
						$active_item 	= ( $tab_count === $settings['active_item'] ) ? ' oew-active' : '';
						$tab_title_key 	= $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

						$this->add_render_attribute( $tab_title_key, [
							'id' 			=> 'oew-tab-title-' . $id_int . $tab_count,
							'class' 		=> [ 'oew-tab-title', $active_item ],
							'data-tab' 		=> $tab_count,
							'tabindex' 		=> $id_int . $tab_count,
							'role' 			=> 'tab',
							'aria-controls' => 'oew-tab-content-' . $id_int . $tab_count,
						] ); ?>

						<div <?php echo $this->get_render_attribute_string( $tab_title_key ); ?>>
							<?php
							if ( ! empty( $item['tab_icon'] )
								&& 'left' == $settings['icon_align'] ) { ?>
								<span class="oew-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
									<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>
							<?php
							}

							if ( $item['tab_title'] ) {
								echo $item['tab_title'];
							}

							if ( ! empty( $item['tab_icon'] )
								&& 'right' == $settings['icon_align'] ) { ?>
								<span class="oew-icon-align-<?php echo esc_html( $settings['icon_align'] ); ?>">
									<?php \Elementor\Icons_Manager::render_icon( $item['tab_icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>
							<?php
							} ?>
						</div>
					<?php
					endforeach; ?>
				</div>
			<?php
			} ?>

		</div>

	<?php
	}
}