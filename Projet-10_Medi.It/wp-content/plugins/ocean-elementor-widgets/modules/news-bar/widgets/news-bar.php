<?php
namespace owpElementor\Modules\NewsBar\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class NewsBar extends Widget_Base {

	public function get_name() {
		return 'oew-news-bar';
	}

	public function get_title() {
		return __( 'NEW News Bar', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-posts-ticker';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'news',
			'bar',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-news-bar' );
	}

	public function get_script_depends() {
		return array(
			'oew-news-bar',
			'jquery-swiper',
		);
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_newsbar',
			array(
				'label' => __( 'News Bar', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'header',
			array(
				'label'   => __( 'Heading Text', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Trending Now', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'selected_icon',
			array(
				'label'            => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'heading_icon',
				'default'          => array(
					'value'   => 'fas fa-bolt',
					'library' => 'fa-solid',
				),
			)
		);

		$this->add_control(
			'heading_icon_position',
			array(
				'label'       => __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'toggle'      => false,
				'default'     => 'left',
				'options'     => array(
					'left'  => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'newsbar_title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => false,
				'separator'   => 'before',
				'dynamic'     => array( 'active' => true ),
			)
		);

		$repeater->add_control(
			'item_link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'dynamic'     => array( 'active' => true ),
				'placeholder' => 'https://www.your-link.com',
				'default'     => array(
					'url' => '',
				),
			)
		);

		$repeater->add_control(
			'show_image',
			array(
				'label'        => __( 'Show Image', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$repeater->add_control(
			'image',
			array(
				'label'     => __( 'Choose Image', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'show_image' => 'yes',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image',
				'exclude'   => array( 'custom' ),
				'include'   => array(),
				'default'   => 'large',
				'condition' => array(
					'show_image' => 'yes',
				),
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => __( 'Items', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'newsbar_title' => __( 'News #1', 'ocean-elementor-widgets' ),
					),
					array(
						'newsbar_title' => __( 'News #2', 'ocean-elementor-widgets' ),
					),
					array(
						'newsbar_title' => __( 'News #3', 'ocean-elementor-widgets' ),
					),
				),
				'title_field' => '{{{ newsbar_title }}}',
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'Div',
					'span' => 'Span',
					'p'    => 'Paragraph',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_settings',
			array(
				'label' => __( 'Slider Settings', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'slider_speed',
			array(
				'label'       => __( 'Slider Speed', 'ocean-elementor-widgets' ),
				'description' => __( 'Duration between slides (in ms)', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SLIDER,
				'default'     => array( 'size' => 500 ),
				'range'       => array(
					'px' => array(
						'min'  => 100,
						'max'  => 3000,
						'step' => 1,
					),
				),
				'size_units'  => '',
			)
		);

		$this->add_control(
			'autoplay',
			array(
				'label'              => __( 'Autoplay', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::SWITCHER,
				'default'            => 'no',
				'label_on'           => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'          => __( 'No', 'ocean-elementor-widgets' ),
				'return_value'       => 'yes',
				'frontend_available' => true,
			)
		);

		$this->add_control(
			'autoplay_speed',
			array(
				'label'              => __( 'Autoplay Speed', 'ocean-elementor-widgets' ),
				'type'               => Controls_Manager::NUMBER,
				'default'            => 3000,
				'min'                => 500,
				'max'                => 5000,
				'step'               => 1,
				'frontend_available' => true,
				'condition'          => array(
					'autoplay' => 'yes',
				),
			)
		);

		$this->add_control(
			'arrows',
			array(
				'label'        => __( 'Arrows', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_heading_style',
			array(
				'label' => esc_html__( 'Heading', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-text',
			)
		);

		$this->add_control(
			'heading_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'heading_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-heading' => 'background: {{VALUE}}',
					'{{WRAPPER}} .oew-news-bar-container' => 'background: {{VALUE}}',
					'{{WRAPPER}} .oew-news-bar-heading::after' => 'border-left-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'heading_icon_style',
			array(
				'label'     => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'heading_icon_size',
			array(
				'label'      => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array( 'size' => '15' ),
				'range'      => array(
					'px' => array(
						'min'  => 15,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'heading_icon_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'heading_icon_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'heading_icon_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-icon',
			)
		);

		$this->add_control(
			'heading_icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'heading_icon_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-heading .oew-news-bar-heading-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_style',
			array(
				'label' => esc_html__( 'Content', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-news-bar-content .oew-news-bar-item-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Title Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-content .oew-news-bar-item-title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'item_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-wrap' => 'background: {{VALUE}}',
					'{{WRAPPER}} .oew-news-bar-navigation' => 'background: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'container_border',
				'selector' => '{{WRAPPER}} .oew-news-bar-container',
			)
		);

		$this->add_responsive_control(
			'container_border_radius',
			array(
				'label'      => __( 'Container Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_arrow_style',
			array(
				'label'     => esc_html__( 'Arrows', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'arrows' => 'yes',
				),
			)
		);

		$this->add_control(
			'select_arrow',
			array(
				'label'                  => __( 'Choose Arrow', 'ocean-elementor-widgets' ),
				'type'                   => Controls_Manager::ICONS,
				'fa4compatibility'       => 'arrow',
				'label_block'            => false,
				'default'                => array(
					'value'   => 'fas fa-angle-right',
					'library' => 'fa-solid',
				),
				'skin'                   => 'inline',
				'exclude_inline_options' => 'svg',
				'recommended'            => array(
					'fa-regular' => array(
						'arrow-alt-circle-right',
						'caret-square-right',
						'hand-point-right',
					),
					'fa-solid'   => array(
						'angle-right',
					),
				),
			)
		);

		$this->add_responsive_control(
			'arrows_size',
			array(
				'label'      => __( 'Arrows Size', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array( 'size' => '22' ),
				'range'      => array(
					'px' => array(
						'min'  => 15,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-navigation .swiper-button-next, {{WRAPPER}} .oew-news-bar-navigation .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'arrows_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-navigation .swiper-button-next, {{WRAPPER}} .oew-news-bar-navigation .swiper-button-prev' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'arrows_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-news-bar-navigation .swiper-button-next, {{WRAPPER}} .oew-news-bar-navigation .swiper-button-prev' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'arrows_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-news-bar-navigation .swiper-button-next, {{WRAPPER}} .oew-news-bar-navigation .swiper-button-prev',
			)
		);

		$this->add_control(
			'arrows_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-navigation .swiper-button-next, {{WRAPPER}} .oew-news-bar-navigation .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'arrows_spacing',
			array(
				'label'      => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array( 'size' => '' ),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'size_units' => array( 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-navigation .swiper-button-prev' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_responsive_control(
			'arrows_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-news-bar-navigation .swiper-button-next, {{WRAPPER}} .oew-news-bar-navigation .swiper-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$header    = $settings['header'];
		$title_tag = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'h4';

		$this->add_render_attribute( 'content-newsbar', 'class', array( 'oew-news-bar', 'oew-swiper-slider' ) );

		// Slider Options.
		$slider_options = array(
			'speed'    		=> ( $settings['slider_speed']['size'] !== '' ) ? $settings['slider_speed']['size'] : 3000,
			'effect'   		=> 'slide',
			'loop'     		=> 'true',
			'slidesPerView' => 'auto',
			'autoplay' 		=> ( 'yes' === $settings['autoplay'] ),
		);

		if ( 'yes' === $settings['autoplay'] && ! empty( $settings['autoplay_speed'] ) ) {
			$autoplay_speed = $settings['autoplay_speed'];
		} else {
			$autoplay_speed = 999999;
		}

		$slider_options['autoplay'] = array(
			'delay' => $autoplay_speed,
		);

		// Heading Icons.
		if ( ! isset( $settings['heading_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default.
			$settings['heading_icon'] = 'fa fa-bolt';
		}

		$has_icon = ! empty( $settings['heading_icon'] );

		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['heading_icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}

		if ( ! $has_icon && ! empty( $settings['selected_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
		$is_new   = ! isset( $settings['heading_icon'] ) && Icons_Manager::is_migration_allowed();

		// Arrow Icons.
		$migration_allowed = Icons_Manager::is_migration_allowed();

		if ( ! isset( $settings['arrow'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default.
			$settings['arrow'] = 'fa fa-angle-right';
		}

		$has_icon = ! empty( $settings['arrow'] );

		if ( ! $has_icon && ! empty( $settings['select_arrow']['value'] ) ) {
			$has_icon = true;
		}

		$migrated = isset( $settings['__fa4_migrated']['select_arrow'] );
		$is_new   = ! isset( $settings['arrow'] ) && $migration_allowed;

		if ( 'yes' === $settings['arrows'] ) {
			$slider_options['navigation'] = array(
				'nextEl' => '.swiper-button-next-' . esc_attr( $this->get_id() ),
				'prevEl' => '.swiper-button-prev-' . esc_attr( $this->get_id() ),
			);
			if ( $has_icon ) {
				if ( $is_new || $migrated ) {
					$pa_next_arrow = str_replace( 'left', 'right', $settings['select_arrow']['value'] );
					$pa_prev_arrow = str_replace( 'right', 'left', $settings['select_arrow']['value'] );
				} else {
					$pa_next_arrow = $settings['arrow'];
					$pa_prev_arrow = str_replace( 'right', 'left', $settings['arrow'] );
				}
			} else {
				$pa_next_arrow = 'fa fa-angle-right';
				$pa_prev_arrow = 'fa fa-angle-left';
			}
		}

		$this->add_render_attribute(
			'content-newsbar',
			array(
				'data-slider-settings' => wp_json_encode( $slider_options ),
			)
		);

		?>

		<div class="oew-news-bar-container oew-news-bar-heading-arrow">
			<div class="oew-news-bar-heading">
					<?php if ( $has_icon ) { ?>
						<?php
							$this->add_render_attribute(
								'heading-icon',
								'class',
								'oew-news-bar-heading-icon'
							);

						if ( 'right' === $settings['heading_icon_position'] ) {
							$this->add_render_attribute( 'heading-icon', 'class', 'oew-news-bar-heading-icon-' . $settings['heading_icon_position'] );
						}
						?>
						<span <?php echo $this->get_render_attribute_string( 'heading-icon' ); ?>>
							<?php
							if ( $is_new || $migrated ) {
								Icons_Manager::render_icon( $settings['selected_icon'], array( 'aria-hidden' => 'true' ) );
							} elseif ( ! empty( $settings['heading_icon'] ) ) {
								?>
								<i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i>
								<?php
							}
							?>
						</span>
					<?php } ?>
				<span class="oew-news-bar-heading-text"><?php echo esc_attr( $header ); ?></span>
			</div>
			<div class="oew-news-bar-wrap swiper-container-wrap">
				<div <?php echo $this->get_render_attribute_string( 'content-newsbar' ); ?>>
					<div class="swiper-wrapper">
					<?php
					if ( $settings['items'] ) {
						foreach ( $settings['items'] as $index => $item ) {

							$item_key  = $this->get_repeater_setting_key( 'item', 'items', $index );
							$title_key = $this->get_repeater_setting_key( 'newsbar_title', 'items', $index );
							$link      = $item['item_link'];
							$this->add_render_attribute( $title_key, 'class', 'oew-news-bar-item-title' );

							$this->add_render_attribute(
								$item_key,
								'class',
								array(
									'oew-news-bar-item',
									'swiper-slide',
									'elementor-repeater-item-' . esc_attr( $item['_id'] ),
								)
							);

							?>
							<div <?php echo $this->get_render_attribute_string( $item_key ); ?>>
								<?php
								if ( ! empty( $link['url'] ) ) {
									$link_key = 'link_' . $index;

									$this->add_render_attribute( $link_key, 'href', $link['url'] );

									if ( $link['is_external'] ) {
										$this->add_render_attribute( $link_key, 'target', '_blank' );
									}

									if ( $link['nofollow'] ) {
										$this->add_render_attribute( $link_key, 'rel', 'nofollow' );
									}

									$this->add_render_attribute( $link_key, 'class', 'oew-news-bar-link' );

									echo '<a ' . $this->get_render_attribute_string( $link_key ) . '>';
								}
								?>
									<div class="oew-news-bar-content">
										<?php if ( 'yes' === $item['show_image'] && ! empty( $item['image']['url'] ) ) { ?>
											<div class="oew-news-bar-image">
												<?php echo Group_Control_Image_Size::get_attachment_image_html( $item ); ?>
											</div>
										<?php } ?>
										<?php
										if ( $item['newsbar_title'] ) {
											?>
											<<?php echo $title_tag; ?> <?php echo $this->get_render_attribute_string( $title_key ); ?>>
												<?php echo esc_attr( $item['newsbar_title'] ); ?>
											</<?php echo $title_tag; ?>>
											<?php
										}
										?>
									</div>
									<?php if ( ! empty( $link['url'] ) ) : ?>
										</a>
									<?php endif; ?>
								<?php if ( $link['is_external'] ) : ?>
									<span class="screen-reader-text"><?php _e( 'Opens in a new tab', 'ocean-elementor-widgets' ); ?></span>
								<?php endif; ?>
							</div>						
							<?php
						}
					}
					?>
					</div>
				</div>
			</div>
			<div class="oew-news-bar-navigation">
				<?php if ( ! empty( $settings['arrow'] ) || ( ! empty( $settings['select_arrow']['value'] ) && $is_new ) ) { ?>
					<div class="swiper-button-prev swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
						<i aria-hidden="true" class="<?php echo esc_attr( $pa_prev_arrow ); ?>"></i>
					</div>
					<div class="swiper-button-next swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
						<i aria-hidden="true" class="<?php echo esc_attr( $pa_next_arrow ); ?>"></i>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php
	}
}
