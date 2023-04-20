<?php
namespace owpElementor\Modules\LinkEffects\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Link_Effects extends Widget_Base {

	public function get_name() {
		return 'oew-link-effects';
	}

	public function get_title() {
		return __( 'Link Effects', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-anchor';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_style_depends() {
		global $settings;
        if ( ! \Elementor\Plugin::$instance->editor->is_edit_mode() && ! \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
            $settings = $this->get_settings();
		}

		$link_effect = null;
		if(isset($settings['effect'])) {
			$link_effect = $settings['effect'];
		}

		return [ 'oew-link-effects', 'oew-'. $link_effect ];

	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_link_effects',
			[
				'label' 		=> __( 'Link Effects', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'text',
			[
				'label' 		=> __( 'Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Click me', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Click me', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'second_text',
			[
				'label' 		=> __( 'Secondary Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Click me', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Click me', 'ocean-elementor-widgets' ),
                'condition' 	=> [
                    'effect' => 'effect-9',
                ],
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::URL,
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default' 		=> [
					'url' => '#',
				],
			]
		);

        $this->add_control(
            'effect',
            [
                'label' 		=> __( 'Effect', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::SELECT,
                'options' 		=> [
                   'effect-1'  => __( 'Brackets', 'ocean-elementor-widgets' ),
                   'effect-2'  => __( '3D rolling links', 'ocean-elementor-widgets' ),
                   'effect-3'  => __( 'Bottom line slides/fades in', 'ocean-elementor-widgets' ),
                   'effect-4'  => __( 'Bottom border enlarge', 'ocean-elementor-widgets' ),
                   'effect-5'  => __( 'Same word slide in', 'ocean-elementor-widgets' ),
                   'effect-6'  => __( 'Same word slide in and border bottom', 'ocean-elementor-widgets' ),
                   'effect-7'  => __( 'Second border slides up', 'ocean-elementor-widgets' ),
                   'effect-8'  => __( 'Border slight translate', 'ocean-elementor-widgets' ),
                   'effect-9'  => __( 'Second text and borders', 'ocean-elementor-widgets' ),
                   'effect-10' => __( 'Reveal, push out', 'ocean-elementor-widgets' ),
                   'effect-11' => __( 'Text Fill', 'ocean-elementor-widgets' ),
                   'effect-12' => __( 'Circle', 'ocean-elementor-widgets' ),
                   'effect-13' => __( 'Three circles', 'ocean-elementor-widgets' ),
                   'effect-14' => __( 'Border switch', 'ocean-elementor-widgets' ),
                   'effect-15' => __( 'Scale down, reveal', 'ocean-elementor-widgets' ),
                   'effect-16' => __( 'Fall down', 'ocean-elementor-widgets' ),
                   'effect-17' => __( 'Move up fade out, push border', 'ocean-elementor-widgets' ),
                   'effect-18' => __( 'Cross', 'ocean-elementor-widgets' ),
                   'effect-19' => __( '3D side', 'ocean-elementor-widgets' ),
                   'effect-20' => __( '3D panel', 'ocean-elementor-widgets' ),
                   'effect-21' => __( 'Borders slight translate', 'ocean-elementor-widgets' ),
                ],
                'default' 		=> 'effect-1',
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
					'justify' => [
						'title' => __( 'Justified', 'ocean-elementor-widgets' ),
						'icon' 	=> 'fa fa-align-justify',
					],
				],
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-link-wrap' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> __( 'Link Effects', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'typography',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_4,
				'selector' 		=> '{{WRAPPER}} .oew-link-wrap a',
			]
		);

		$this->add_control(
			'width',
			[
				'label' 		=> __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
                'default' 		=> [
                    'size' => 200,
                ],
				'range' 		=> [
					'px' => [
						'step'  => 1,
					],
				],
                'size_units'	=> [ 'px', '%' ],
                'selectors' 	=> [
                    '{{WRAPPER}} .oew-effect-19 a' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .oew-effect-19 a span' => 'transform-origin: 50% 50% calc(-{{SIZE}}{{UNIT}}/2); -webkit-transform-origin: 50% 50% calc(-{{SIZE}}{{UNIT}}/2); -moz-transform-origin: 50% 50% calc(-{{SIZE}}{{UNIT}}/2);',
                ],
				'condition' 	=> [
					'effect' => 'effect-19',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_link_style' );

		$this->start_controls_tab(
			'tab_link_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-link-wrap a, {{WRAPPER}} .oew-effect-15 a::before, {{WRAPPER}} .oew-effect-17 a::before, body {{WRAPPER}} .oew-effect-20 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_second_text_color',
			[
				'label' 		=> __( 'Second Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-effect-9 a span:last-child' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => 'effect-9',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-effect-2 a span, {{WRAPPER}} .oew-effect-10 a span, {{WRAPPER}} .oew-effect-19 a span, {{WRAPPER}} .oew-effect-20 a span' => 'background: {{VALUE}};',
					'{{WRAPPER}} .oew-effect-2 a span::before, {{WRAPPER}} .oew-effect-19 a span::before, {{WRAPPER}} .oew-effect-20 a:hover span, {{WRAPPER}} .oew-effect-20 a:focus span' => 'background: #616161;',
				],
				'condition' 	=> [
					'effect' => [ 'effect-2', 'effect-10', 'effect-19', 'effect-20' ],
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-effect-6 a::before, {{WRAPPER}} .oew-effect-6 a::after, {{WRAPPER}} .oew-effect-7 a::before, {{WRAPPER}} .oew-effect-7 a::after, {{WRAPPER}} .oew-effect-9 a::before, {{WRAPPER}} .oew-effect-9 a::after, {{WRAPPER}} .oew-effect-14 a::before, {{WRAPPER}} .oew-effect-14 a::after, {{WRAPPER}} .oew-effect-17 a::after, {{WRAPPER}} .oew-effect-18 a::before, {{WRAPPER}} .oew-effect-18 a::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .oew-effect-8 a::before, {{WRAPPER}} .oew-effect-8 a::after, {{WRAPPER}} .oew-effect-11 a' => 'border-color: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'effect-6', 'effect-7', 'effect-8', 'effect-9', 'effect-11', 'effect-14', 'effect-17', 'effect-18' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_link_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link_hover_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-link-wrap a:hover, {{WRAPPER}} .oew-effect-10 a::before, {{WRAPPER}} .oew-effect-11 a::before, {{WRAPPER}} .oew-effect-16 a::before, {{WRAPPER}} .oew-effect-20 a span::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_hover_background_color',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-effect-2 a:hover span::before, {{WRAPPER}} .oew-effect-2 a:focus span::before, {{WRAPPER}} .oew-effect-10 a::before, {{WRAPPER}} .oew-effect-19 a:hover span::before, {{WRAPPER}} .oew-effect-19 a:focus span::before, {{WRAPPER}} .oew-effect-20 a span::before' => 'background: {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'effect-2', 'effect-10', 'effect-19', 'effect-20' ],
				],
			]
		);

		$this->add_control(
			'link_hover_border_color',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-effect-3 a::after, {{WRAPPER}} .oew-effect-4 a::after, {{WRAPPER}} .oew-effect-21 a::before, {{WRAPPER}} .oew-effect-21 a::after' => 'background: {{VALUE}};',
					'{{WRAPPER}} .oew-effect-8 a::after, {{WRAPPER}} .oew-effect-11 a::before, {{WRAPPER}} .oew-effect-12 a::before, {{WRAPPER}} .oew-effect-12 a::after' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .oew-effect-13 a:hover::before, {{WRAPPER}} .oew-effect-13 a:focus::before' => 'color: {{VALUE}}; text-shadow: 10px 0 {{VALUE}}, -10px 0 {{VALUE}};',
				],
				'condition' 	=> [
					'effect' => [ 'effect-3', 'effect-4', 'effect-8', 'effect-11', 'effect-12', 'effect-13', 'effect-21' ],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_section();

	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();
		$text 			= $settings['text'];
        $second_text 	= $settings['second_text'];
        $link 			= $settings['link'];
        $effect 		= $settings['effect'];

		$this->add_render_attribute( 'link-wrap', 'class', 'oew-link-wrap' );
        
		if ( ! empty( $effect ) ) {
            $this->add_render_attribute( 'link-wrap', 'class', 'oew-'. $effect );
        }

		if ( ! empty( $link['url'] ) ) {
			$this->add_render_attribute( 'link', 'href', $link['url'] );

			if ( $link['is_external'] ) {
				$this->add_render_attribute( 'link', 'target', '_blank' );
			}

			if ( $link['nofollow'] ) {
				$this->add_render_attribute( 'link', 'rel', 'nofollow' );
			}
		}

		$this->add_render_attribute( 'link', 'class', 'oew-link' );
        
        if ( 'effect-10' == $effect
        	|| 'effect-11' == $effect
        	|| 'effect-15' == $effect
        	|| 'effect-16' == $effect
        	|| 'effect-17' == $effect
        	|| 'effect-18' == $effect ) {
            $this->add_render_attribute( 'hover-text', 'data-hover', $text );
        }
        
        if ( 'effect-2' == $effect
        	|| 'effect-4' == $effect
        	|| 'effect-5' == $effect
        	|| 'effect-19' == $effect
        	|| 'effect-20' == $effect ) {
            $this->add_render_attribute( 'text', 'data-hover', $text );
        } ?>

		
		<div <?php echo $this->get_render_attribute_string( 'link-wrap' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'link' ); ?><?php echo $this->get_render_attribute_string( 'hover-text' ); ?>>
				<span <?php echo $this->get_render_attribute_string( 'text' ); ?>>
	                <?php echo esc_attr( $text ); ?>
	            </span>
	            <?php
	            if ( 'effect-9' == $effect
	            	&& ! empty( $second_text ) ) { ?>
	                <span><?php echo esc_attr( $second_text ); ?></span>
	            <?php
	        	} ?>
			</a>
		</div>

	<?php
	}

}