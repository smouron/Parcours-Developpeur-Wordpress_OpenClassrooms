<?php
namespace owpElementor\Modules\SearchIcon\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class SearchIcon extends Widget_Base {

    public function get_name() {
		return 'oew-search-icon';
	}

	public function get_title() {
		return __( 'Search Icon', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-search';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'oew-search-icon' ];
	}

	public function get_style_depends() {
		return [ 'oew-search-icon' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_search_icon',
			[
				'label' 		=> __( 'Search Icon', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   		=> __( 'Search Style', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'dropdown',
				'options' 		=> [
					'dropdown'  => __( 'Drop Down', 'ocean-elementor-widgets' ),
					'overlay'  	=> __( 'Overlay', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'placeholder',
			[
				'label' 		=> __( 'Placeholder', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Search', 'ocean-elementor-widgets' ),
				'placeholder' 	=> __( 'Search', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'overlay_text',
			[
				'label' 		=> __( 'Input Text', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'default' 		=> __( 'Type your text and hit enter to search', 'ocean-elementor-widgets' ),
				'dynamic' 		=> [ 'active' => true ],
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'source',
			[
				'label' 		=> _x( 'Source', 'Posts Type', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'options' 		=> $this->get_post_types(),
				'default' 		=> 'any',
				'label_block' 	=> true,
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
				'prefix_class' => 'oew%s-align-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' 		=> esc_html__( 'Search Icon', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' 		=> __( 'Font Size', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'default' => [
					'size' => 12,
				],
				'range' => [
					'min' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .oew-search-icon-wrap .oew-search-toggle' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab(
			'tab_icon_normal',
			[
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-search-icon-wrap .oew-search-toggle' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icon_hover',
			[
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'icon_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-search-icon-wrap .oew-search-toggle:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_dropdown_style',
			[
				'label' 		=> esc_html__( 'Drop Down', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label' 		=> __( 'Width', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px' ],
				'default' => [
					'unit' => 'px',
					'size' => 260,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-search-dropdown' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dropdown_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-search-dropdown' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'dropdown_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'selector' 		=> '{{WRAPPER}} .oew-search-dropdown',
				'separator' 	=> 'before',
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-search-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'dropdown_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-search-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay_style',
			[
				'label' 		=> esc_html__( 'Overlay', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_bg',
			[
				'label' 		=> __( 'Background', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-search-{{ID}}' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay_close_style',
			[
				'label' 		=> esc_html__( 'Overlay Close Button', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->start_controls_tabs( 'tabs_overlay_close_style' );

		$this->start_controls_tab(
			'tab_overlay_close_normal',
			[
				'label' 		=> __( 'Normal', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_bg',
			[
				'label' 		=> __( 'Background', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-search-{{ID}} a.oew-search-overlay-close' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-search-{{ID}} a.oew-search-overlay-close span:before, #oew-search-{{ID}}  a.oew-search-overlay-close span:after' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_overlay_close_hover',
			[
				'label' 		=> __( 'Hover', 'ocean-elementor-widgets' ),
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_bg_hover',
			[
				'label' 		=> __( 'Background', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-search-{{ID}} a.oew-search-overlay-close:hover' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->add_control(
			'overlay_close_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'#oew-search-{{ID}} a.oew-search-overlay-close:hover span:before, #oew-search-{{ID}}  a.oew-search-overlay-close:hover span:after' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'overlay',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input_style',
			[
				'label' 		=> esc_html__( 'Input', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_input_style' );

		$this->start_controls_tab(
			'tab_input_normal',
			[
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'input_bg',
			[
				'label' 		=> __( 'Background', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input, #oew-search-{{ID}} form input, #oew-search-{{ID}} form label' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_hover',
			[
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'input_bg_hover',
			[
				'label' 		=> __( 'Background', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input:hover' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color_hover',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input:hover, #oew-search-{{ID}} form input:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_hover',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input:hover, #oew-search-{{ID}} form input:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_input_focus',
			[
				'label' => __( 'Focus', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'input_bg_focus',
			[
				'label' 		=> __( 'Background', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input:focus' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'style' => 'dropdown',
				],
			]
		);

		$this->add_control(
			'input_color_focus',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input:focus, #oew-search-{{ID}} form input:focus, #oew-search-{{ID}} form label:focus' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'input_border_color_focus',
			[
				'label' 		=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} form input:focus, #oew-search-{{ID}} form input:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' 			=> 'input_focus_box_shadow',
				'selector' 		=> '{{WRAPPER}} form input:focus, #oew-search-{{ID}} form input:focus',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'input_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'default' 		=> '1px',
				'selector' 		=> '{{WRAPPER}} form input, #oew-search-{{ID}} form input',
				'separator' 	=> 'before',
			]
		);

		$this->add_control(
			'input_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} form input, #oew-search-{{ID}} form input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'input_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} form input, #oew-search-{{ID}} form input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'input_typo',
				'selector' 		=> '{{WRAPPER}} form input, #oew-search-{{ID}} form input, #oew-search-{{ID}} form label',
				'scheme' 		=> Scheme_Typography::TYPOGRAPHY_1,
			]
		);

		$this->end_controls_section();

	}

	private static function get_post_types( $args = [] ) {
		$post_type_args = [
			'show_in_nav_menus' => true,
		];

		if ( ! empty( $args['post_type'] ) ) {
			$post_type_args['name'] = $args['post_type'];
		}

		$_post_types = get_post_types( $post_type_args , 'objects' );

		$post_types  = [];
		$post_types[ 'any' ]  = esc_html__( 'Any', 'ocean-elementor-widgets' );

		foreach ( $_post_types as $post_type => $object ) {
			$post_types[ $post_type ] = $object->label;
		}

		return $post_types;
	}

	protected function render() {
		$settings 	= $this->get_settings_for_display();
		$id 		= $this->get_id();

		// Style
		$style = $settings['style'];

		$this->add_render_attribute( 'search-icon-wrap', 'class',
			[
				'oew-search-icon-wrap',
				'oew-search-icon-'. $style
			]
		);

		$this->add_render_attribute( 'form-wrap', 'id', 'oew-search-' . esc_attr( $id ) );

		$this->add_render_attribute( 'form-wrap', 'class',
			[
				'oew-search-'. $style,
				'clr'
			]
		);

		// Link
		$this->add_render_attribute( 'link', 'href', '#' );
		$this->add_render_attribute( 'link', 'class', 'oew-search-toggle' );

		if ( ! empty( $style ) ) {
            $this->add_render_attribute( 'link', 'class', 'oew-'. $style .'-link' );
        }

		// Placeholder
		$placeholder = '';
		if ( ! empty( $settings['placeholder'] ) ) {
			$placeholder = ' placeholder="'. $settings['placeholder'] .'"';
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'search-icon-wrap' ); ?>>
			<a <?php echo $this->get_render_attribute_string( 'link' ); ?>><span class="icon-magnifier"></span></a>

			<div <?php echo $this->get_render_attribute_string( 'form-wrap' ); ?>>
				<?php
				if ( 'dropdown' == $style ) { ?>
					<form method="get" class="oew-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<input type="text" class="field" name="s"<?php echo $placeholder; ?>>
						<?php
						if ( ! empty( $settings['source'] ) && 'any' != $settings['source'] ) { ?>
							<input type="hidden" name="post_type" value="<?php echo esc_attr( $settings['source'] ); ?>">
						<?php
						} ?>
					</form>
				<?php
				}

				else if ( 'overlay' == $style ) { ?>
					<div class="container clr">
						<form method="get" class="oew-searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<a href="#" class="oew-search-overlay-close"><span></span></a>
							<input class="oew-search-overlay-input" type="search" name="s" autocomplete="off" value="">
							<?php
							if ( ! empty( $settings['source'] ) && 'any' != $settings['source'] ) { ?>
								<input type="hidden" name="post_type" value="<?php echo esc_attr( $settings['source'] ); ?>">
							<?php
							} ?>
							<label><?php echo esc_attr( $settings['overlay_text'] ); ?><span><i></i><i></i><i></i></span></label>
						</form>
					</div>
				<?php
				} ?>
			</div>
		</div>

	<?php
	}

	// No template because it cause a js error in the edit mode
	protected function _content_template() {}

}