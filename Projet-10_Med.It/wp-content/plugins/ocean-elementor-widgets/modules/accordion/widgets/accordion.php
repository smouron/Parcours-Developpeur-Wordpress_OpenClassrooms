<?php
namespace owpElementor\Modules\Accordion\Widgets;

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

class Accordion extends Widget_Base {

	public function get_name() {
		return 'oew-accordion';
	}

	public function get_title() {
		return __( 'Accordion', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-accordion';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'oew-accordion' ];
	}

	public function get_style_depends() {
		return [ 'oew-accordion' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_accordion',
			[
				'label' 		=> __( 'Accordion', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'tabs',
			[
				'label' 		=> __( 'Items', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::REPEATER,
				'default' => [
					[
						'tab_title'   	=> __( 'Accordion #1', 'ocean-elementor-widgets' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
					],
					[
						'tab_title'   	=> __( 'Accordion #2', 'ocean-elementor-widgets' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
					],
					[
						'tab_title'   	=> __( 'Accordion #3', 'ocean-elementor-widgets' ),
						'tab_content' 	=> __( 'I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ocean-elementor-widgets' ),
					],
				],
				'fields' => [
					[
						'name'        	=> 'tab_title',
						'label'       	=> __( 'Title & Content', 'ocean-elementor-widgets' ),
						'type'        	=> Controls_Manager::TEXT,
						'default'     	=> __( 'Accordion Title' , 'ocean-elementor-widgets' ),
						'label_block' 	=> true,
						'dynamic' 		=> [ 'active' => true ],
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
			'icon',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-plus',
			]
		);

		$this->add_control(
			'active_icon',
			[
				'label' 		=> __( 'Active Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICON,
				'label_block' 	=> true,
				'default' 		=> 'fa fa-minus',
				'condition'   	=> [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label' 		=> __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'div',
				'options' 		=> oew_get_available_tags(),
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
			'multiple',
			[
				'label' 		=> __( 'Open Multiple Items', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
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
				'label' 		=> __( 'Item', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
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
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-title'   => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .oew-accordion .oew-accordion-content' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_spacing',
			[
				'label' 		=> __( 'Item Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-item + .oew-accordion-item' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
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

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'title_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-title',
			]
		);

		$this->start_controls_tabs( 'tabs_title_style' );

		$this->start_controls_tab(
			'tab_title_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'title_background_color',
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-title',
			)
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'title_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-item .oew-accordion-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'title_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-accordion .oew-accordion-item .oew-accordion-title',
			]
		);

		$this->add_control(
			'title_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-item .oew-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      	=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_title_active',
			[
				'label' 		=> __( 'Active', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'title_active_background_color',
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-item.oew-active .oew-accordion-title',
			)
		);

		$this->add_control(
			'title_active_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-item.oew-active .oew-accordion-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'title_active_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-item.oew-active .oew-accordion-title',
				'separator' 	=> 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'title_active_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-accordion .oew-accordion-item.oew-active .oew-accordion-title',
			]
		);

		$this->add_control(
			'title_active_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-item.oew-active .oew-accordion-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label' 		=> __( 'Icon', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'icon!' => '',
				],
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
				'default'     	=> is_rtl() ? 'left' : 'right',
				'toggle'      	=> false,
				'label_block' 	=> false,
				'condition'   	=> [
					'icon!' => '',
				],
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
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-title .oew-accordion-icon i' => 'color: {{VALUE}};',
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
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-item.oew-active .oew-accordion-title .oew-accordion-icon i' => 'color: {{VALUE}};',
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
				'condition' 	=> [
					'icon!' => '',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-icon.oew-accordion-icon-left'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-accordion .oew-accordion-icon.oew-accordion-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

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
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     		=> 'content_background_color',
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-content',
			)
		);

		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-content'  => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     		=> 'content_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-accordion .oew-accordion-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'content_border',
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-accordion .oew-accordion-content',
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-accordion .oew-accordion-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .oew-accordion .oew-accordion-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$id 		= $this->get_id();
		$title_tag 	= $settings['title_html_tag'];
		$data 		= [
            'multiple' => ( 'yes' == $settings['multiple'] ) ? 'true' : 'false',
        ];

        if ( ! empty( $settings['active_item'] ) ) {
        	$data['active_item'] = $settings['active_item'];
			$this->add_render_attribute( 'wrap', 'class', 'oew-has-active-item' );
		}

		$this->add_render_attribute( 'wrap', 'id', 'oew-accordion-' . esc_attr( $id ) );
		$this->add_render_attribute( 'wrap', 'class', 'oew-accordion' );
    	$this->add_render_attribute( 'wrap', 'data-settings', wp_json_encode( $data ) ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>

			<?php
			foreach ( $settings['tabs'] as $index => $item ) :
				$tab_count 			= $index + 1;
				$tab_title_key 		= $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
				$tab_content_key 	= $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

				$this->add_render_attribute( $tab_title_key, 'class', 'oew-accordion-title' );
				$this->add_render_attribute( $tab_content_key, 'class', 'oew-accordion-content' );
				$this->add_inline_editing_attributes( $tab_content_key, 'advanced' ); ?>

				<div class="oew-accordion-item<?php echo ( $tab_count === $settings['active_item'] ) ? ' oew-active' : ''; ?>">
					<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string( $tab_title_key ); ?>>
						<?php
						if ( $settings['icon'] ) { ?>
							<span class="oew-accordion-icon oew-accordion-icon-<?php echo esc_attr( $settings['icon_align'] ); ?>" aria-hidden="true">
								<i class="oew-accordion-icon-closed <?php echo esc_attr( $settings['icon'] ); ?>"></i>
								<i class="oew-accordion-icon-opened <?php echo esc_attr( $settings['active_icon'] ); ?>"></i>
							</span>
						<?php
						} ?>

						<?php echo $item['tab_title']; ?>
					</<?php echo $title_tag; ?>>

					<div <?php echo $this->get_render_attribute_string( $tab_content_key ); ?>>
						<?php
		            	if ( 'custom' == $item['source']
		            		&& ! empty( $item['tab_content'] ) ) {
		            		echo wp_kses_post( $item['tab_content'] );
		            	} else if ( 'template' == $item['source']
		            		&& ( '0' != $item['templates'] && ! empty( $item['templates'] ) ) ) {
		            		echo Plugin::instance()->frontend->get_builder_content_for_display( $item['templates'] );
		            	} ?>
					</div>
				</div>
			<?php
			endforeach; ?>

		</div>

	<?php
	}
}