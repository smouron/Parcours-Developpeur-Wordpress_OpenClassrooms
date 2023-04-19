<?php
namespace owpElementor\Modules\AnimatedHeading\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class AnimatedHeading extends Widget_Base {

	public function get_name() {
		return 'oew-animated-heading';
	}

	public function get_title() {
		return __( 'Animated Heading', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-animated-headline';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'animated heading',
			'heading',
			'title',
			'animated',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-animated-heading' );
	}

	public function get_style_depends() {
		return array( 'oew-animated-heading' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_animated_heading',
			array(
				'label' => __( 'Heading', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'heading_layout',
			array(
				'label'              => __( 'Layout', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SELECT,
				'default'            => 'animated',
				'options'            => array(
					'animated' => __( 'Animated', 'ocean-elementor-widgets' ),
					'typed'    => __( 'Typed', 'ocean-elementor-widgets' ),
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'pre_heading',
			array(
				'label'       => __( 'Pre Heading', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'This is an', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Enter your prefix heading', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'animated_heading',
			array(
				'label'              => __( 'Heading', 'ocean-elementor-widgets' ),
				'description'        => __( 'Write animated heading here with comma separated. Such as Animated, Morphing, Awesome', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::TEXTAREA,
				'default'            => __( 'Animated, Amazing, Awesome', 'ocean-elementor-widgets' ),
				'placeholder'        => __( 'Enter your animated heading', 'ocean-elementor-widgets' ),
				'dynamic'            => array( 'active' => true ),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'post_heading',
			array(
				'label'       => __( 'Post Heading', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Heading', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'Enter your suffix heading', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => 'http://your-link.com',
			)
		);

		$this->add_control(
			'title_html_tag',
			array(
				'label'     => __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => oew_get_available_tags(),
				'default'   => 'h2',
				'condition' => array(
					'link[url]' => '',
				),
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'        => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::CHOOSE,
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
				'default'      => 'center',
				'prefix_class' => 'elementor-align%s-',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			array(
				'label'     => __( 'Animation Options', 'ocean-elementor-widgets' ),
				'condition' => array(
					'heading_animation!' => '',
				),
			)
		);

		$this->add_control(
			'heading_animation',
			array(
				'label'              => __( 'Animation', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::ANIMATION,
				'default'            => 'fadeIn',
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				),
				'frontend_available' => true,
				'render_type'        => 'template',
			)
		);

		$this->add_control(
			'heading_animation_delay',
			array(
				'label'              => __( 'Delay (ms)', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 2500,
				'min'                => 100,
				'max'                => 7000,
				'step'               => 100,
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'animated',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'type_speed',
			array(
				'label'              => __( 'Type Speed', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 50,
				'min'                => 10,
				'max'                => 100,
				'step'               => 5,
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'start_delay',
			array(
				'label'              => __( 'Start Delay', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 1,
				'min'                => 1,
				'max'                => 100,
				'step'               => 1,
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'back_speed',
			array(
				'label'              => __( 'Back Speed', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 30,
				'min'                => 0,
				'max'                => 100,
				'step'               => 2,
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'back_delay',
			array(
				'label'              => __( 'Back Delay', 'ocean-elementor-widgets' ) . ' (ms)',
				'type'               => Controls_Manager::NUMBER,
				'default'            => 500,
				'min'                => 0,
				'max'                => 3000,
				'step'               => 50,
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'loop',
			array(
				'label'              => __( 'Loop', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'yes',
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
				),
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'loop_count',
			array(
				'label'              => __( 'Loop Count', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 0,
				'min'                => 0,
				'condition'          => array(
					'heading_animation!' => '',
					'heading_layout'     => 'typed',
					'loop'               => 'yes',
				),
				'frontend_available' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pre_heading',
			array(
				'label'     => __( 'Pre Heading', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'pre_heading!' => '',
				),
			)
		);

		$this->add_control(
			'pre_heading_color',
			array(
				'label'     => __( 'Pre Heading Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-heading-wrap .oew-pre-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'pre_heading_typography',
				'selector' => '{{WRAPPER}} .oew-heading-wrap .oew-pre-heading',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'pre_heading_shadow',
				'selector' => '{{WRAPPER}} .oew-heading-wrap .oew-pre-heading',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animated_heading',
			array(
				'label' => __( 'Animated Heading', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'animated_heading_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-heading-wrap .oew-heading-tag' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'animated_heading_typography',
				'selector' => '{{WRAPPER}} .oew-heading-wrap .oew-heading-tag',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'animated_heading_shadow',
				'selector' => '{{WRAPPER}} .oew-heading-wrap .oew-heading-tag',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_post_heading',
			array(
				'label'     => __( 'Post Heading', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'post_heading!' => '',
				),
			)
		);

		$this->add_control(
			'post_heading_color',
			array(
				'label'     => __( 'Post Heading Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-heading-wrap .oew-post-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'post_heading_typography',
				'selector' => '{{WRAPPER}} .oew-heading-wrap .oew-post-heading',
			)
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			array(
				'name'     => 'post_heading_shadow',
				'selector' => '{{WRAPPER}} .oew-heading-wrap .oew-post-heading',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$id        = $this->get_id();
		$title_tag = $settings['title_html_tag'];

		$this->add_render_attribute( 'heading', 'class', 'oew-heading-tag' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_render_attribute( 'heading', 'href', $settings['link']['url'] );

			if ( $settings['link']['is_external'] ) {
				$this->add_render_attribute( 'heading', 'target', '_blank' );
			}

			if ( ! empty( $settings['link']['nofollow'] ) ) {
				$this->add_render_attribute( 'heading', 'rel', 'nofollow' );
			}

			$title_tag = 'a';
		} ?>

		<div id="oew-animated-heading-<?php echo esc_attr( $id ); ?>" class="oew-heading-wrap">
			<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string( 'heading' ); ?>>

				<?php
				if ( $settings['pre_heading'] ) {
					?>
					<div class="oew-pre-heading"><?php echo $settings['pre_heading']; ?></div>
					<?php
				}

				if ( $settings['animated_heading']
					&& 'animated' == $settings['heading_layout'] ) {
					?>
					   <div class="oew-animated-heading">
						<?php echo rtrim( $settings['animated_heading'], ',' ); ?>
					   </div>
					<?php
				} elseif ( $settings['animated_heading']
					&& 'typed' == $settings['heading_layout'] ) {
					?>
					<div class="oew-animated-heading typed"></div>
					<?php
				}

				if ( $settings['post_heading'] ) {
					?>
					<div class="oew-post-heading"><?php echo $settings['post_heading']; ?></div>
					<?php
				}
				?>

			</<?php echo $title_tag; ?>>
		</div>

		<?php
	}
}
