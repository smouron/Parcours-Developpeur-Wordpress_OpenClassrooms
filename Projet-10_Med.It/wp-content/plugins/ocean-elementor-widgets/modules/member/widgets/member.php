<?php
namespace owpElementor\Modules\Member\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Member extends Widget_Base {

	public function get_name() {
		return 'oew-member';
	}

	public function get_title() {
		return __( 'Member', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-person';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'member',
			'user',
			'team',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-member' );
	}

	public function get_style_depends() {
		return array( 'oew-member' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_member',
			array(
				'label' => __( 'General', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'   => __( 'Image', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'name',
			array(
				'label'   => __( 'Name', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'John Doe', 'ocean-elementor-widgets' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'role',
			array(
				'label'   => __( 'Role', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Co-Founder', 'ocean-elementor-widgets' ),
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'description',
			array(
				'label'   => __( 'Description', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Lorem ipsum dolor sit amet consectetur adipiscing elit integer nec odio praesent libero sed cursus ante dapibus diam.', 'ocean-elementor-widgets' ),
				'rows'    => 10,
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title_html_tag',
			array(
				'label'   => __( 'Name HTML Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h3',
				'options' => oew_get_available_tags(),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_social_links',
			array(
				'label' => __( 'Social Icons', 'ocean-elementor-widgets' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'social_link_title',
			array(
				'label'   => __( 'Title', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Facebook',
			)
		);

		$repeater->add_control(
			'social_link',
			array(
				'label'   => __( 'Link', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '#',
			)
		);

		$repeater->add_control(
			'social_icon',
			array(
				'label'   => __( 'Choose Icon', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::ICONS,
				'default' => array(
					'value'   => '',
					'library' => 'fa-brands',
				),
			)
		);

		$repeater->add_control(
			'icon_background',
			array(
				'label'     => __( 'Icon Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member .oew-member-icons {{CURRENT_ITEM}}' => 'background-color: {{VALUE}}',
				),
			)
		);

		$repeater->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member .oew-member-icons {{CURRENT_ITEM}}' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'social_links',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'social_link'       => '#',
						'social_icon'       => array(
							'value'   => 'fab fa-facebook',
							'library' => 'fa-brands',
						),
						'social_link_title' => 'Facebook',
					),
					array(
						'social_link'       => '#',
						'social_icon'       => array(
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						),
						'social_link_title' => 'Twitter',
					),
					array(
						'social_link'       => '#',
						'social_icon'       => array(
							'value'   => 'fab fa-instagram',
							'library' => 'fa-brands',
						),
						'social_link_title' => 'Instagram',
					),
				),
				'title_field' => '{{{ social_link_title }}}',
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 6,
						'max' => 150,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-member-icons a' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'member_tooltip',
			array(
				'label'   => __( 'Tooltip', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'member_tooltip_position',
			array(
				'label'     => __( 'Tooltip Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'top',
				'options'   => array(
					'top'    => __( 'Top', 'ocean-elementor-widgets' ),
					'bottom' => __( 'Bottom', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'member_tooltip' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Member', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'member_bg',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'member_border',
				'selector' => '{{WRAPPER}} .oew-member-wrap',
			)
		);

		$this->add_responsive_control(
			'member_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);

		$this->add_responsive_control(
			'member_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'member_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'content_heading',
			array(
				'label'     => __( 'Content', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_responsive_control(
			'text_align',
			array(
				'label'     => __( 'Text Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'    => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center'  => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'   => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
					'justify' => array(
						'title' => __( 'Justified', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-justify',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'content_padding',
			array(
				'label'      => __( 'Content Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			array(
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'image_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-member-wrap .oew-member-image',
			)
		);

		$this->add_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);

		$this->add_control(
			'image_spacing',
			array(
				'label'     => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-image' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name',
			array(
				'label' => __( 'Name', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'name_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-name' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'name_typography',
				'selector' => '{{WRAPPER}} .oew-member-wrap .oew-member-name',
			)
		);

		$this->add_responsive_control(
			'name_spacing',
			array(
				'label'     => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_role',
			array(
				'label' => __( 'Role', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'role_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-role' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'role_typography',
				'selector' => '{{WRAPPER}} .oew-member-wrap .oew-member-role',
			)
		);

		$this->add_responsive_control(
			'role_spacing',
			array(
				'label'     => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-role' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			array(
				'label' => __( 'Text', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'text_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-description' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'text_typography',
				'selector' => '{{WRAPPER}} .oew-member-wrap .oew-member-description',
			)
		);

		$this->add_responsive_control(
			'text_spacing',
			array(
				'label'     => __( 'Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_social',
			array(
				'label' => __( 'Social Icon', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'icons_bg',
			array(
				'label'     => __( 'Icons Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'icons_wrap_padding',
			array(
				'label'      => __( 'Icons Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_icons_style' );

		$this->start_controls_tab(
			'tab_icons_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'icons_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icons_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_icons_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'icons_hover_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a:hover' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icons_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a:hover' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'icons_hover_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a:hover' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'icons_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-member-wrap .oew-member-icons a',
				'separator'   => 'before',
			)
		);

		$this->add_control(
			'icons_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'icons_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icons_size',
			array(
				'label'     => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'icons_indent',
			array(
				'label'     => __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => array(
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-member-wrap .oew-member-icons a:first-child' => 'margin-left: 0;',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$title_tag = $settings['title_html_tag'];

		$this->add_render_attribute( 'wrap', 'class', 'oew-member-wrap' ); ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			
			<?php
			if ( ! empty( $settings['image']['url'] ) ) {
				?>
				<div class="oew-member-image">
					<?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'image' ); ?>
				</div>
				<?php
			}
			?>
			
			<div class="oew-member-content">
				<?php
				if ( ! empty( $settings['name'] ) ) {
					?>
					<<?php echo $title_tag; ?> class="oew-member-name">
						<?php echo $settings['name']; ?>
					</<?php echo $title_tag; ?>>
					<?php
				}
				?>

				<?php
				if ( ! empty( $settings['role'] ) ) {
					?>
					<span class="oew-member-role"><?php echo $settings['role']; ?></span>
					<?php
				}
				?>

				<?php
				if ( ! empty( $settings['description'] ) ) {
					?>
					<div class="oew-member-description"><?php echo $settings['description']; ?></div>
					<?php
				}
				?>
			</div>

			<div class="oew-member-icons">
				<?php
				foreach ( $settings['social_links'] as $index => $item ) :
					$link = $this->get_repeater_setting_key( 'links', 'social_links', $index );

					$this->add_render_attribute( $link, 'href', esc_url( $item['social_link'] ) );

					$this->add_render_attribute(
						$link,
						array(
							'class' => array(
								'oew-member-icon',
								'elementor-repeater-item-' . $item['_id'],
							),
						)
					);

					if ( 'yes' == $settings['member_tooltip'] ) {
						$tooltip_position = $settings['member_tooltip_position'];

						$this->add_render_attribute(
							$link,
							array(
								'class'                 => array(
									'oew-member-tooltip',
									'oew-tooltip-' . $tooltip_position,
								),
								'title'                 => $item['social_link_title'],
								'data-tooltip-position' => $tooltip_position,
							)
						);
					}

					$this->add_render_attribute( $link, 'target', '_blank' );
					?>

					<a <?php echo $this->get_render_attribute_string( $link ); ?>>
						<?php \Elementor\Icons_Manager::render_icon( $item['social_icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</a>
					<?php
				endforeach;
				?>
			</div>
		</div>

		<?php
	}
}
