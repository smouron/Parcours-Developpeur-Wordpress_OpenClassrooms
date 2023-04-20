<?php
namespace owpElementor\Modules\AnimatedHeading\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class AnimatedHeading extends Widget_Base {

	public function get_name() {
		return 'oew-animated-heading';
	}

	public function get_title() {
		return __( 'Animated Heading', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-animated-headline';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'morphext', 'typed' ];
	}

	public function get_style_depends() {
		return [ 'oew-animated-heading' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_animated_heading',
			[
				'label' 		=> __( 'Heading', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'heading_layout',
			[
				'label'   		=> __( 'Layout', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'animated',
				'options' 		=> [
					'animated' => __( 'Animated', 'ocean-elementor-widgets' ),
					'typed'    => __( 'Typed', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'pre_heading',
			[
				'label'       	=> __( 'Pre Heading', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __( 'This is an', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Enter your prefix heading', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'animated_heading',
			[
				'label'       	=> __( 'Heading', 'ocean-elementor-widgets' ),
				'description' 	=> __( 'Write animated heading here with comma separated. Such as Animated, Morphing, Awesome', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __( 'Animated, Amazing, Awesome', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Enter your animated heading', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'post_heading',
			[
				'label'       	=> __( 'Post Heading', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::TEXTAREA,
				'default'     	=> __( 'Heading', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Enter your suffix heading', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label'       	=> __( 'Link', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::URL,
				'placeholder' 	=> 'http://your-link.com',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   		=> __( 'HTML Tag', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'options' 		=> oew_get_available_tags(),
				'default' 		=> 'h2',
				'condition' 	=> [
					'link[url]' => '',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::CHOOSE,
				'options' 		=> [
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
				'default'      	=> 'center',
				'prefix_class' 	=> 'elementor-align%s-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_animation',
			[
				'label'     	=> __( 'Animation Options', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'heading_animation!' => '',
				],
			]
		);

		$this->add_control(
			'heading_animation',
			[
				'label'       	=> __( 'Animation', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::ANIMATION,
				'default'     	=> 'fadeIn',
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_duration',
			[
				'label'   		=> __( 'Duration', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> '',
				'options' 		=> [
					''     => __( 'Normal', 'ocean-elementor-widgets' ),
					'slow' => __( 'Slow', 'ocean-elementor-widgets' ),
					'fast' => __( 'Fast', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'animated',
				],
			]
		);

		$this->add_control(
			'heading_animation_delay',
			[
				'label'     	=> __( 'Delay (ms)', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 2500,
				'min'       	=> 100,
				'max'       	=> 7000,
				'step'      	=> 100,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'animated',
				],
			]
		);

		$this->add_control(
			'type_speed',
			[
				'label'     	=> __( 'Type Speed', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 50,
				'min'       	=> 10,
				'max'       	=> 100,
				'step'      	=> 5,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'start_delay',
			[
				'label'     	=> __( 'Start Delay', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 1,
				'min'       	=> 1,
				'max'       	=> 100,
				'step'      	=> 1,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'back_speed',
			[
				'label'     	=> __( 'Back Speed', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 30,
				'min'       	=> 0,
				'max'       	=> 100,
				'step'      	=> 2,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'back_delay',
			[
				'label'     	=> __( 'Back Delay', 'ocean-elementor-widgets' ) . ' (ms)',
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 500,
				'min'       	=> 0,
				'max'       	=> 3000,
				'step'      	=> 50,
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'loop',
			[
				'label'     	=> __( 'Loop', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SWITCHER,
				'default'   	=> 'yes',
				'condition' 	=> [
					'heading_animation!' => '',
					'heading_layout' => 'typed',
				],
			]
		);

		$this->add_control(
			'loop_count',
			[
				'label'     	=> __( 'Loop Count', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::NUMBER,
				'default'   	=> 0,
				'min'       	=> 0,
				'condition' 	=> [
					'loop' => 'yes',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_pre_heading',
			[
				'label'     	=> __( 'Pre Heading', 'ocean-elementor-widgets' ),
				'tab'       	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'pre_heading!' => '',
				]
			]
		);

		$this->add_control(
			'pre_heading_color',
			[
				'label'     	=> __( 'Pre Heading Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-heading-wrap .oew-pre-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'pre_heading_typography',
				'scheme'   		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-heading-wrap .oew-pre-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'pre_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-heading-wrap .oew-pre-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_animated_heading',
			[
				'label' 		=> __( 'Animated Heading', 'ocean-elementor-widgets' ),
				'tab'   		=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'animated_heading_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-heading-wrap .oew-heading-tag' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'animated_heading_typography',
				'scheme'   		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-heading-wrap .oew-heading-tag',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'animated_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-heading-wrap .oew-heading-tag',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_post_heading',
			[
				'label'     	=> __( 'Post Heading', 'ocean-elementor-widgets' ),
				'tab'       	=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'post_heading!' => '',
				]
			]
		);

		$this->add_control(
			'post_heading_color',
			[
				'label'     	=> __( 'Post Heading Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-heading-wrap .oew-post-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     		=> 'post_heading_typography',
				'scheme'   		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-heading-wrap .oew-post-heading',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     		=> 'post_heading_shadow',
				'selector' 		=> '{{WRAPPER}} .oew-heading-wrap .oew-post-heading',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings   = $this->get_settings_for_display();
		$id         = $this->get_id();
		$title_tag  = $settings['title_html_tag'];

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
				if ( $settings['pre_heading'] ) { ?>
					<div class="oew-pre-heading"><?php echo $settings['pre_heading']; ?></div>
				<?php
				}

				if ( $settings['animated_heading']
					&& 'animated' == $settings['heading_layout'] ) {
					$animation_duration = ( $settings['heading_animation_duration'] ) ? ' oew-animated-'. $settings['heading_animation_duration'] : ''; ?>
			   		<div class="oew-animated-heading<?php echo esc_attr( $animation_duration ); ?>">
			   			<?php echo rtrim( $settings['animated_heading'], ',' ); ?>
			   		</div>
				<?php
				} else if ( $settings['animated_heading']
					&&  'typed' == $settings['heading_layout'] ) { ?>
					<div class="oew-animated-heading"></div>
				<?php
				}

				if ( $settings['post_heading'] ) { ?>
					<div class="oew-post-heading"><?php echo $settings['post_heading']; ?></div>
				<?php
				} ?>

			</<?php echo $title_tag; ?>>
		</div>

		<?php
		$type_heading = explode( ',', esc_html( $settings['animated_heading'] ) );

		if ( $settings['animated_heading'] ) { ?>
			<script>
				jQuery( document ).ready( function( $ ) {
		    		"use strict";

		    		<?php if ( 'animated' == $settings['heading_layout'] ) { ?>
						$( '#oew-animated-heading-<?php echo esc_attr( $id ); ?> .oew-animated-heading' ).Morphext( {
						    animation 	: '<?php echo esc_attr( $settings['heading_animation'] ); ?>',
						    speed 		: <?php echo esc_attr( $settings['heading_animation_delay'] ); ?>,
						} );
					<?php } else if ( 'typed' == $settings['heading_layout'] ) { ?>
						var typed 		= new Typed( '#oew-animated-heading-<?php echo esc_attr( $id ); ?> .oew-animated-heading', {
							strings 	: <?php echo json_encode( $type_heading ); ?>,
							typeSpeed 	: <?php echo esc_attr( $settings['type_speed'] ); ?>,
							startDelay 	: <?php echo esc_attr( $settings['start_delay'] ); ?>,
							backSpeed 	: <?php echo esc_attr( $settings['back_speed'] ); ?>,
							backDelay 	: <?php echo esc_attr( $settings['back_delay'] ); ?>,
							loop 		: <?php echo ( 'yes' == $settings['loop'] ) ? 'true' : 'false'; ?>,
							loopCount 	: <?php echo ( $settings['loop_count'] ) ? esc_attr( $settings['loop_count'] ) : 0; ?>,
						} );
					<?php } ?>

				} );
			</script>
		<?php
		}

	}
}