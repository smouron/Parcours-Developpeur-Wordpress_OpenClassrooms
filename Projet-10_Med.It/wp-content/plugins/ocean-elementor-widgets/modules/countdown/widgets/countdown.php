<?php
namespace owpElementor\Modules\Countdown\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Countdown extends Widget_Base {

	public function get_name() {
		return 'oew-countdown';
	}

	public function get_title() {
		return __( 'Countdown', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-countdown';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'countdown',
			'timer',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-countdown' );
	}

	public function get_style_depends() {
		return array( 'oew-countdown' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_countdown',
			array(
				'label' => __( 'Countdown', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'due_date',
			array(
				'label'       => __( 'Due Date', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::DATE_TIME,
				'default'     => date( 'Y-m-d H:i', strtotime( '+1 month' ) + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ) ),
				'description' => sprintf( __( 'Date set according to your timezone: %s.', 'ocean-elementor-widgets' ), Utils::get_timezone_string() ),
			)
		);

		$this->add_control(
			'enable_prolong',
			array(
				'label'   => __( 'Enable Prolong', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);

		$this->add_control(
			'prolong',
			array(
				'label'     => __( 'Prolong', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '12',
				'options'   => array(
					'12' => __( '12', 'ocean-elementor-widgets' ),
					'24' => __( '24', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'enable_prolong' => 'yes',
				),
			)
		);

		$this->add_control(
			'label_display',
			array(
				'label'        => __( 'View', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SELECT,
				'options'      => array(
					'block'  => __( 'Block', 'ocean-elementor-widgets' ),
					'inline' => __( 'Inline', 'ocean-elementor-widgets' ),
				),
				'default'      => 'block',
				'prefix_class' => 'oew-countdown-label-',
			)
		);

		$this->add_control(
			'show_days',
			array(
				'label'   => __( 'Days', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_hours',
			array(
				'label'   => __( 'Hours', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_minutes',
			array(
				'label'   => __( 'Minutes', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_seconds',
			array(
				'label'   => __( 'Seconds', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'show_labels',
			array(
				'label'     => __( 'Show Label', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'custom_labels',
			array(
				'label'        => __( 'Custom Label', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'condition'    => array(
					'show_labels!' => '',
				),
			)
		);

		$this->add_control(
			'label_days',
			array(
				'label'       => __( 'Days', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Days', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Days', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_days'      => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'label_hours',
			array(
				'label'       => __( 'Hours', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Hours', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Hours', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_hours'     => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'label_minutes',
			array(
				'label'       => __( 'Minutes', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Minutes', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Minutes', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_minutes'   => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'label_seconds',
			array(
				'label'       => __( 'Seconds', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Seconds', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Seconds', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'show_labels!'   => '',
					'custom_labels!' => '',
					'show_seconds'   => 'yes',
				),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			array(
				'label' => __( 'Additional Options', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'container_width',
			array(
				'label'          => __( 'Container Width', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SLIDER,
				'default'        => array(
					'unit' => '%',
					'size' => 80,
				),
				'tablet_default' => array(
					'unit' => '%',
				),
				'mobile_default' => array(
					'unit' => '%',
				),
				'range'          => array(
					'px' => array(
						'min' => 0,
						'max' => 2000,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'size_units'     => array( '%', 'px' ),
				'selectors'      => array(
					'{{WRAPPER}} .oew-countdown-wrap' => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'alignment',
			array(
				'label'        => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::CHOOSE,
				'default'      => 'center',
				'options'      => array(
					'left'   => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'prefix_class' => 'oew-countdown-align-',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Columns', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '2',
				'mobile_default' => '2',
				'options'        => array(
					'1' => __( '1', 'ocean-elementor-widgets' ),
					'2' => __( '2', 'ocean-elementor-widgets' ),
					'3' => __( '3', 'ocean-elementor-widgets' ),
					'4' => __( '4', 'ocean-elementor-widgets' ),
				),
				'prefix_class'   => 'oew%s-countdown-column-',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Boxes', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'boxes_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'boxes_spacing',
			array(
				'label'     => __( 'Space Between', 'ocean-elementor-widgets' ),
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
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item-wrap' => 'padding: 0 {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'boxes_border',
				'selector'  => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'boxes_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'boxes_box_shadow',
				'selector' => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item',
			)
		);

		$this->add_responsive_control(
			'boxes_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_numbers_style',
			array(
				'label' => __( 'Numbers', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'numbers_typography',
				'selector' => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number',
			)
		);

		$this->add_control(
			'numbers_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'numbers_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'numbers_border',
				'selector'  => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'numbers_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'numbers_box_shadow',
				'selector' => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number',
			)
		);

		$this->add_responsive_control(
			'numbers_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_labels_style',
			array(
				'label' => __( 'Labels', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'labels_typography',
				'selector' => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label',
			)
		);

		$this->add_control(
			'labels_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'labels_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'labels_border',
				'selector'  => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'labels_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'labels_box_shadow',
				'selector' => '{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label',
			)
		);

		$this->add_responsive_control(
			'labels_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'labels_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-countdown-wrap .oew-countdown-label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
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
		$this->_default_countdown_labels = array(
			'label_months'  => __( 'Months', 'ocean-elementor-widgets' ),
			'label_weeks'   => __( 'Weeks', 'ocean-elementor-widgets' ),
			'label_days'    => __( 'Days', 'ocean-elementor-widgets' ),
			'label_hours'   => __( 'Hours', 'ocean-elementor-widgets' ),
			'label_minutes' => __( 'Minutes', 'ocean-elementor-widgets' ),
			'label_seconds' => __( 'Seconds', 'ocean-elementor-widgets' ),
		);
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
			$label          = ( $instance['custom_labels'] ) ? $instance[ $label ] : $default_labels[ $label ];
			$string        .= ' <span class="oew-countdown-label">' . $label . '</span>';
		}

		$string .= '</div></div>';

		return $string;
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$due_date     = $settings['due_date'];
		$prolong_time = $settings['prolong'];
		$string       = $this->get_strftime( $settings );

		// Handle timezone ( we need to set GMT time )
		$gmt      = get_gmt_from_date( $due_date . ':00' );
		$due_date = strtotime( $gmt );

		$this->add_render_attribute( 'wrap', 'class', 'oew-countdown-wrap' );
		$this->add_render_attribute( 'wrap', 'data-date', $due_date );
		$this->add_render_attribute( 'wrap', 'data-prolong', $prolong_time ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<?php echo $string; ?>
		</div>

		<?php
	}

}
