<?php
namespace owpElementor\Modules\ImageComparison\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

class ImageComparison extends Widget_Base {

	public function get_name() {
		return 'oew-image-comparison';
	}

	public function get_title() {
		return __( 'Image Comparison', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-image-before-after';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'oew-image-comparison', 'twentytwenty', 'event-move' ];
	}

	public function get_style_depends() {
		return [ 'oew-image-comparison' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_before_image',
			[
				'label' 		=> __( 'Before Image', 'ocean-elementor-widgets' ),
			]
		);

        $this->add_control(
            'before_label',
            [
                'label' 		=> __( 'Label', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __( 'Before', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
            ]
        );

		$this->add_control(
			'before_image',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_after_image',
            [
                'label' 		=> __( 'After Image', 'ocean-elementor-widgets' ),
            ]
        );

        $this->add_control(
            'after_label',
            [
                'label' 		=> __( 'Label', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::TEXT,
                'default' 		=> __( 'After', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
            ]
        );

		$this->add_control(
			'after_image',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::MEDIA,
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_image_settings',
            [
                'label' 		=> __( 'Settings', 'ocean-elementor-widgets' ),
            ]
        );
        
        $this->add_control(
            'visible_ratio',
            [
                'label' 		=> __( 'Visible Ratio', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SLIDER,
                'range' 		=> [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ],
                ],
                'size_units' 	=> '',
            ]
        );
        
        $this->add_control(
            'orientation',
            [
                'label' 		=> __( 'Orientation', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'horizontal',
                'options' 		=> [
                    'vertical'      => __( 'Vertical', 'ocean-elementor-widgets' ),
                    'horizontal'    => __( 'Horizontal', 'ocean-elementor-widgets' ),
                ],
            ]
        );
        
        $this->add_control(
            'move_slider',
            [
                'label' 		=> __( 'Move Slider', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SELECT,
                'default' 		=> 'drag',
                'options' 		=> [
                    'drag'          => __( 'Drag', 'ocean-elementor-widgets' ),
                    'mouse_move'    => __( 'Mouse Move', 'ocean-elementor-widgets' ),
                    'mouse_click'   => __( 'Mouse Click', 'ocean-elementor-widgets' ),
                ],
            ]
        );
        
        $this->add_control(
            'before_after',
            [
                'label' 		=> __( 'Before/After Labels', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SWITCHER,
                'default' 		=> 'yes',
                'return_value' 	=> 'yes',
            ]
        );

        $this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
			[
				'label' 		=> __( 'Labels', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_labels_style' );

        $this->start_controls_tab(
            'tab_label_before',
            [
                'label' 		=> __( 'Before', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'before_after' => 'yes',
				],
            ]
        );

		$this->add_control(
			'label_before_background',
			[
				'label' 		=> __( 'Background color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-before-label:before' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_before_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-before-label:before' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'tab_label_after',
            [
                'label' 		=> __( 'After', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'before_after' => 'yes',
				],
            ]
        );

		$this->add_control(
			'label_after_background',
			[
				'label' 		=> __( 'Background color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-after-label:before' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->add_control(
			'label_after_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-after-label:before' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'labels_typography',
				'selector' 		=> '{{WRAPPER}} .twentytwenty-overlay > div:before',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_3,
				'separator' 	=> 'before',
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->add_control(
			'labels_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-overlay > div:before' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'labels_horizontal_align',
			[
				'label' 		=> __( 'Horizontal Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'top' => [
						'title' => __( 'Top', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' 	=> [
					'orientation' => 'horizontal',
					'before_after' => 'yes',
				],
				'prefix_class' => 'oew-label-horizontal-'
			]
		);

		$this->add_responsive_control(
			'labels_vertical_align',
			[
				'label' 		=> __( 'Vertical Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'condition' 	=> [
					'orientation' => 'vertical',
					'before_after' => 'yes',
				],
				'prefix_class' => 'oew-label-vertical-'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'labels_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'selector' 		=> '{{WRAPPER}} .twentytwenty-overlay > div:before',
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->add_control(
			'labels_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-overlay > div:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'labels_box_shadow',
				'selector' 		=> '{{WRAPPER}} .twentytwenty-overlay > div:before',
				'condition' 	=> [
					'before_after' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_handle_style',
			[
				'label' 		=> __( 'Handle', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_handle_style' );

		$this->start_controls_tab(
			'tab_handle_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'handle_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-handle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'handle_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_handle_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'handle_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-handle:hover, {{WRAPPER}} .active .twentytwenty-handle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'handle_hover_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-left-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-left-arrow' => 'border-right-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-right-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-right-arrow' => 'border-left-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-down-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-down-arrow' => 'border-top-color: {{VALUE}};',
					'{{WRAPPER}} .twentytwenty-handle:hover .twentytwenty-up-arrow, {{WRAPPER}} .active .twentytwenty-handle .twentytwenty-up-arrow' => 'border-bottom-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'handle_size',
			[
				'label' 		=> __( 'Size (%)', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 38,
				],
				'range' 		=> [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'separator' 	=> 'before',
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-handle' => 'width: {{SIZE}}px; height: {{SIZE}}px; margin-left: calc(-{{SIZE}}px/2); margin-top: calc(-{{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before' => 'margin-bottom: calc({{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'margin-top: calc({{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before' => 'margin-left: calc({{SIZE}}px/2);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'margin-right: calc({{SIZE}}px/2);',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_separator_style',
			[
				'label' 		=> __( 'Separator', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
            'separator_color',
            [
                'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::COLOR,
                'selectors' 	=> [
                    '{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
			'separator_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
                    'size' => 2,
                    'unit' => 'px',
                ],
				'size_units' 	=> [ 'px', '%' ],
				'range' 		=> [
					'px' => [
						'max' => 20,
					],
				],
				'tablet_default' => [
					'unit' => 'px',
				],
				'mobile_default' => [
					'unit' => 'px',
				],
				'selectors' 	=> [
					'{{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-horizontal .twentytwenty-handle:after' => 'width: {{SIZE}}{{UNIT}}; margin-left: calc(-{{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:before, {{WRAPPER}} .twentytwenty-vertical .twentytwenty-handle:after' => 'height: {{SIZE}}{{UNIT}}; margin-top: calc(-{{SIZE}}{{UNIT}}/2);',
				],
			]
		);

        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', [
			'class' => [
				'oew-image-comparison',
				'twentytwenty-container',
			],
		] );

		$image_settings = [
            'visible_ratio'         => ( $settings['visible_ratio']['size'] != '' ? $settings['visible_ratio']['size'] : '0.5' ),
            'orientation'           => ( $settings['orientation'] != '' ? $settings['orientation'] : 'vertical' ),
            'before_label'          => ( $settings['before_label'] != '' ? esc_attr( $settings['before_label'] ) : '' ),
            'after_label'           => ( $settings['after_label'] != '' ? esc_attr( $settings['after_label'] ) : '' ),
            'slider_on_hover'       => ( $settings['move_slider'] == 'mouse_move' ? true : false ),
            'slider_with_handle'    => ( $settings['move_slider'] == 'drag' ? true : false ),
            'slider_with_click'     => ( $settings['move_slider'] == 'mouse_click' ? true : false ),
            'no_overlay'            => ( $settings['before_after'] == 'yes' ? false : true )
        ]; ?>

		<figure <?php echo $this->get_render_attribute_string( 'wrap' ) ?> data-settings='<?php echo wp_json_encode( $image_settings ); ?>'>
			
			<?php
			if ( ! empty( $settings['before_image']['url'] ) ) {
				echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'before_image' );
			}

			if ( ! empty( $settings['after_image']['url'] ) ) {
				echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'after_image' );
			} ?>

		</figure>

	<?php
	}

	protected function _content_template() { ?>

		<#
		var before_image = {
			id: settings.before_image.id,
			url: settings.before_image.url,
			size: settings.before_image_size,
			dimension: settings.before_image_custom_dimension,
			model: view.getEditModel()
		};

		var after_image = {
			id: settings.after_image.id,
			url: settings.after_image.url,
			size: settings.after_image_size,
			dimension: settings.after_image_custom_dimension,
			model: view.getEditModel()
		};

		view.addRenderAttribute( 'before-image', 'src', elementor.imagesManager.getImageUrl( before_image ) );
		view.addRenderAttribute( 'after-image', 'src', elementor.imagesManager.getImageUrl( after_image ) );

		var visible_ratio       = ( settings.visible_ratio.size != '' ) ? settings.visible_ratio.size : '0.5',
            slider_on_hover     = ( settings.move_slider == 'mouse_move' ) ? true : false,
            slider_with_handle  = ( settings.move_slider == 'drag' ) ? true : false,
            slider_with_click   = ( settings.move_slider == 'mouse_click' ) ? true : false,
            no_before_after     = ( settings.before_after == 'yes' ) ? false : true;
        #>

		<figure class="oew-image-comparison twentytwenty-container" data-settings='{ "visible_ratio":{{ visible_ratio }},"orientation":"{{ settings.orientation }}","before_label":"{{ settings.before_label }}","after_label":"{{ settings.after_label }}","slider_on_hover":{{ slider_on_hover }},"slider_with_handle":{{ slider_with_handle }},"slider_with_click":{{ slider_with_click }},"no_overlay":{{ no_before_after }} }'>

			<# if ( settings.before_image.url ) { #>
				<img {{{ view.getRenderAttributeString( 'before-image' ) }}}>
			<# } #>

			<# if ( settings.after_image.url ) { #>
				<img {{{ view.getRenderAttributeString( 'after-image' ) }}}>
			<# } #>

		</figure>
		
	<?php
	}

}