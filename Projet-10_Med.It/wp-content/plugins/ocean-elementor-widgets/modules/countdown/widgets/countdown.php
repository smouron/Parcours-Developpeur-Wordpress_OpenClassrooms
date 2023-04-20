<?php
namespace owpElementor\Modules\Countdown\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Utils;

class Countdown extends Widget_Base {

	public function get_name() {
		return 'oew-countdown';
	}

	public function get_title() {
		return __( 'Countdown', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-countdown';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'oew-countdown' ];
	}

	public function get_style_depends() {
		return [ 'oew-countdown' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_countdown',
			[
				'label' 		=> __( 'Countdown', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'due_date',
			[
				'label'       	=> __( 'Due Date', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::DATE_TIME,
				'default'     	=> date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'description' 	=> sprintf( __( 'Date set according to your timezone: %s.', 'ocean-elementor-widgets' ), Utils::get_timezone_string() ),
			]
		);

		$this->add_control(
			'label_display',
			[
				'label'   		=> __( 'View', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'options' 		=> [
					'block'  => __( 'Block', 'ocean-elementor-widgets' ),
					'inline' => __( 'Inline', 'ocean-elementor-widgets' ),
				],
				'default'      	=> 'block',
				'prefix_class' 	=> 'oew-countdown-label-',
			]
		);

		$this->add_control(
			'show_days',
			[
				'label'   		=> __( 'Days', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_hours',
			[
				'label'   		=> __( 'Hours', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_minutes',
			[
				'label'   		=> __( 'Minutes', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				]
		);

		$this->add_control(
			'show_seconds',
			[
				'label'   		=> __( 'Seconds', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'show_labels',
			[
				'label'   		=> __( 'Show Label', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'custom_labels',
			[
				'label'        	=> __( 'Custom Label', 'ocean-elementor-widgets' ),
				'type'         	=> Controls_Manager::SWITCHER,
				'return_value' 	=> 'yes',
				'condition'    	=> [
					'show_labels!' => '',
				],
			]
		);

		$this->add_control(
			'label_days',
			[
				'label'       	=> __( 'Days', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __( 'Days', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Days', 'ocean-elementor-widgets' ),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_days'      => 'yes',
				],
				'dynamic' 	  	=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_hours',
			[
				'label'       	=> __( 'Hours', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __( 'Hours', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Hours', 'ocean-elementor-widgets' ),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_hours'     => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_minutes',
			[
				'label'       	=> __( 'Minutes', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __( 'Minutes', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Minutes', 'ocean-elementor-widgets' ),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_minutes'   => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'label_seconds',
			[
				'label'       	=> __( 'Seconds', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXT,
				'default'     	=> __( 'Seconds', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Seconds', 'ocean-elementor-widgets' ),
				'condition'   	=> [
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_seconds'   => 'yes',
				],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label' 		=> __( 'Additional Options', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_responsive_control(
			'container_width',
			[
				'label'   		=> __( 'Container Width', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'unit' => '%',
					'size' => 80,
				],
				'tablet_default' => [
					'unit' => '%',
				],
				'mobile_default' => [
					'unit' => '%',
				],
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'size_units' 	=> [ '%', 'px' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-countdown-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'         	=> Controls_Manager::CHOOSE,
				'default'      	=> 'center',
				'options'      	=> [
					'left' => [
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
				],
				'prefix_class'	=> 'oew-countdown-align-'
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' 		=> __( 'Columns', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '4',
				'tablet_default' => '2',
				'mobile_default' => '2',
				'options' 		=> [
					'1' => __( '1', 'ocean-elementor-widgets' ),
					'2' => __( '2', 'ocean-elementor-widgets' ),
					'3' => __( '3', 'ocean-elementor-widgets' ),
					'4' => __( '4', 'ocean-elementor-widgets' ),
				],
				'prefix_class'	=> 'oew%s-countdown-column-'
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Boxes', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'boxes_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'boxes_spacing',
			[
				'label' 		=> __( 'Space Between', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 8,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'boxes_border',
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'boxes_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'boxes_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item',
			]
		);

		$this->add_responsive_control(
			'boxes_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_numbers_style',
			[
				'label' 		=> __( 'Numbers', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'numbers_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number',
			]
		);

		$this->add_control(
			'numbers_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'numbers_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'numbers_border',
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'numbers_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'numbers_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number',
			]
		);

		$this->add_responsive_control(
			'numbers_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
			[
				'label' 		=> __( 'Labels', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'labels_typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label',
			]
		);

		$this->add_control(
			'labels_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'labels_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'labels_border',
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'labels_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'labels_box_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label',
			]
		);

		$this->add_responsive_control(
			'labels_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'labels_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

	}

	private function get_strftime( $instance ) {
		$string = '';
		if ( $instance['show_days'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_days', 'oew-countdown-days' );
		}
		if ( $instance['show_hours'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_hours', 'oew-countdown-hours' );
		}
		if ( $instance['show_minutes'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_minutes', 'oew-countdown-minutes' );
		}
		if ( $instance['show_seconds'] ) {
			$string .= $this->render_countdown_item( $instance, 'label_seconds', 'oew-countdown-seconds' );
		}

		return $string;
	}

	private $_default_countdown_labels;

	private function _init_default_countdown_labels() {
		$this->_default_countdown_labels = [
			'label_months' => __( 'Months', 'ocean-elementor-widgets' ),
			'label_weeks' => __( 'Weeks', 'ocean-elementor-widgets' ),
			'label_days' => __( 'Days', 'ocean-elementor-widgets' ),
			'label_hours' => __( 'Hours', 'ocean-elementor-widgets' ),
			'label_minutes' => __( 'Minutes', 'ocean-elementor-widgets' ),
			'label_seconds' => __( 'Seconds', 'ocean-elementor-widgets' ),
		];
	}

	public function get_default_countdown_labels() {
		if ( ! $this->_default_countdown_labels ) {
			$this->_init_default_countdown_labels();
		}

		return $this->_default_countdown_labels;
	}

	private function render_countdown_item( $instance, $label, $part_class ) {
		$string = '<div class="oew-countdown-item-wrap"><div class="oew-countdown-item"><span class="oew-countdown-number ' . $part_class . '"></span>';

		if ( $instance['show_labels'] ) {
			$default_labels = $this->get_default_countdown_labels();
			$label = ( $instance['custom_labels'] ) ? $instance[ $label ] : $default_labels[ $label ];
			$string .= ' <span class="oew-countdown-label">' . $label . '</span>';
		}

		$string .= '</div></div>';

		return $string;
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$due_date  	= $settings['due_date'];
		$string    	= $this->get_strftime( $settings );

		// Handle timezone ( we need to set GMT time )
		$gmt 		= get_gmt_from_date( $due_date . ':00' );
		$due_date 	= strtotime( $gmt );
		
		$this->add_render_attribute( 'wrap', 'class', 'oew-countdown-wrap' );
		$this->add_render_attribute( 'wrap', 'data-date', $due_date ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<?php echo $string; ?>
		</div>

	<?php
	}

}