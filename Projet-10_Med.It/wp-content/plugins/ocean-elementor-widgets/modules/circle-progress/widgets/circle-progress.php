<?php
namespace owpElementor\Modules\CircleProgress\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Circle_Progress extends Widget_Base {

	public function get_name() {
		return 'oew-circle-progress';
	}

	public function get_title() {
		return __( 'Circle Progress', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-counter-circle';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'pie',
			'charts',
			'circle',
			'progress',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-circle-progress' );
	}

	public function get_style_depends() {
		return array( 'oew-circle-progress' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_circle_progress',
			array(
				'label' => __( 'Circle Progress', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'goal',
			array(
				'label'   => __( 'Percent', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '60',
			)
		);

		$this->add_control(
			'speed',
			array(
				'label'   => __( 'Speed (s)', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'step',
			array(
				'label'   => __( 'Steps', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'delay',
			array(
				'label'   => __( 'Delay', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '1',
			)
		);

		$this->add_control(
			'text_before',
			array(
				'label'       => __( 'Text Before', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_middle',
			array(
				'label'       => __( 'Text Middle', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'text_after',
			array(
				'label'       => __( 'Text After', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content',
			array(
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'content',
			array(
				'label'   => __( 'Content', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::WYSIWYG,
				'default' => __( 'Add your content here', 'ocean-elementor-widgets' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Circle Progress', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'barsize',
			array(
				'label'   => __( 'Bar Size', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '4',
			)
		);

		$this->add_control(
			'barcap',
			array(
				'label'   => __( 'Bar Cap', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'round',
				'options' => array(
					'round'  => __( 'Rounded', 'ocean-elementor-widgets' ),
					'square' => __( 'Square', 'ocean-elementor-widgets' ),
					'butt'   => __( 'Butt', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'circle_outside_color',
			array(
				'label'     => esc_html__( 'Circle Outside Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress svg ellipse' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'circle_inside_color',
			array(
				'label'     => esc_html__( 'Circle Inside Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress svg path' => 'stroke: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'circle_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_before_heading',
			array(
				'label'     => __( 'Text Before', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_before_typography',
				'selector' => '{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-before',
			)
		);

		$this->add_control(
			'text_before_color',
			array(
				'label'     => esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-before' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_before_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_middle_heading',
			array(
				'label'     => __( 'Number/Text Middle', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_middle_typography',
				'selector' => '{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-middle',
			)
		);

		$this->add_control(
			'text_middle_color',
			array(
				'label'     => esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-middle' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_middle_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-middle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'text_after_heading',
			array(
				'label'     => __( 'Text After', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_after_typography',
				'selector' => '{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-after',
			)
		);

		$this->add_control(
			'text_after_color',
			array(
				'label'     => esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-after' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'text_after_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress .oew-circle-progress-label .oew-circle-progress-after' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => __( 'Content', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content',
			)
		);

		$this->add_control(
			'content_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_color',
			array(
				'label'     => esc_html__( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'content_border',
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content',
			)
		);

		$this->add_control(
			'content_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'content_box_shadow',
				'selector' => '{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content',
			)
		);

		$this->add_responsive_control(
			'content_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'content_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-circle-progress-wrap .oew-circle-progress-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'oew-circle-progress-wrap' );

		$this->add_render_attribute(
			'inner',
			'class',
			array(
				'oew-circle-progress',
				'pieProgress',
				'oew-cp-' . $settings['barcap'],
			)
		);

		$this->add_render_attribute( 'inner', 'role', 'progressbar' );

		if ( ! empty( $settings['goal'] ) ) {
			$this->add_render_attribute( 'inner', 'data-goal', $settings['goal'] );
		}

		$this->add_render_attribute( 'inner', 'data-valuemin', '0' );

		if ( ! empty( $settings['speed'] ) ) {
			$this->add_render_attribute( 'inner', 'data-speed', $settings['speed'] * 15 );
		}

		if ( ! empty( $settings['step'] ) ) {
			$this->add_render_attribute( 'inner', 'data-step', $settings['step'] );
		}

		if ( ! empty( $settings['delay'] ) ) {
			$this->add_render_attribute( 'inner', 'data-delay', $settings['delay'] * 1000 );
		}

		if ( ! empty( $settings['barsize'] ) ) {
			$this->add_render_attribute( 'inner', 'data-barsize', intval( $settings['barsize'] ) );
		}

		$this->add_render_attribute( 'inner', 'data-valuemax', '100' );

		$this->add_render_attribute( 'label', 'class', 'oew-circle-progress-label' );
		$this->add_render_attribute( 'before', 'class', 'oew-circle-progress-before' );
		$this->add_render_attribute( 'text', 'class', 'oew-circle-progress-middle' );
		$this->add_render_attribute(
			'number',
			'class',
			array(
				'oew-circle-progress-number',
				'oew-circle-progress-middle',
			)
		);
		$this->add_render_attribute( 'after', 'class', 'oew-circle-progress-after' );
		$this->add_render_attribute( 'content', 'class', 'oew-circle-progress-content' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'inner' ); ?>>
				<div <?php echo $this->get_render_attribute_string( 'label' ); ?>>
					<?php
					if ( $settings['text_before'] ) {
						?>
						<div <?php echo $this->get_render_attribute_string( 'before' ); ?>><?php echo esc_html( $settings['text_before'] ); ?></div>
						<?php
					}

					if ( $settings['text_middle'] ) {
						?>
						<div <?php echo $this->get_render_attribute_string( 'text' ); ?>><?php echo esc_html( $settings['text_middle'] ); ?></div>
						<?php
					} else {
						?>
						<div <?php echo $this->get_render_attribute_string( 'number' ); ?>></div>
						<?php
					}

					if ( $settings['text_after'] ) {
						?>
						<div <?php echo $this->get_render_attribute_string( 'after' ); ?>><?php echo esc_html( $settings['text_after'] ); ?></div>
						<?php
					}
					?>
				</div>
			</div>

			<?php
			if ( $settings['content'] ) {
				?>
				<div <?php echo $this->get_render_attribute_string( 'content' ); ?>><?php echo $settings['content']; ?></div>
				<?php
			}
			?>
					
		</div>

		<?php
	}

}
