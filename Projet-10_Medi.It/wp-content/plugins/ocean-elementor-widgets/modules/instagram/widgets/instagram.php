<?php
namespace owpElementor\Modules\Instagram\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Plugin;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Instagram extends Widget_Base {

	public function get_name() {
		return 'oew-instagram';
	}

	public function get_title() {
		return __( 'Instagram', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-instagram-gallery';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'instagram',
			'social',
			'insta',
			'feed',
			'gallery',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-instagram' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_instagram_token',
			array(
				'label' => __( 'Token', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'access_token',
			array(
				'label'       => __( 'Access Token', 'ocean-elementor-widgets' ),
				'description' => __( '<a href="https://docs.oceanwp.org/article/514-get-instagram-access-token" target="_blank">Get Access Token</a>', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			array(
				'label' => __( 'Settings', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'data_cache_limit',
			array(
				'label'       => __( 'Data Cache Time', 'ocean-elementor-widgets' ),
				'description' => __( 'Cache expiration time (Minutes)', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::NUMBER,
				'min'         => 1,
				'default'     => 60,
			)
		);

		$this->add_control(
			'images_count',
			array(
				'label'   => __( 'Images Count', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => array(
					'size' => 12,
				),
				'range'   => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'     => __( 'Columns', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => '5',
				'options'   => array(
					'1'  => '1',
					'2'  => '2',
					'3'  => '3',
					'4'  => '4',
					'5'  => '5',
					'6'  => '6',
					'7'  => '7',
					'8'  => '8',
					'9'  => '9',
					'10' => '10',
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-item' => 'width: calc( 100% / {{VALUE}} );',
				),
			)
		);

		$this->add_control(
			'force_square',
			array(
				'label'        => esc_html__( 'Force Square Image?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			)
		);

		$this->add_responsive_control(
			'square_image_size',
			array(
				'label'     => esc_html__( 'Image Dimension (px)', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 200,
				),
				'range'     => array(
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-insta.oew-insta-square .oew-insta-img' => 'width: 100%; height: {{SIZE}}{{UNIT}}; object-fit: cover;',
				),
				'condition' => array(
					'force_square' => 'yes',
				),
			)
		);

		$this->add_control(
			'header_heading',
			array(
				'label' => __( 'Header', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'header',
			array(
				'label'        => __( 'Display Header', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'avatar',
			array(
				'label'     => __( 'Choose Avatar', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'avatar_img',
				'label'     => __( 'Image Resolution', 'ocean-elementor-widgets' ),
				'default'   => 'thumbnail',
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'username',
			array(
				'label'       => __( 'Username', 'ocean-elementor-widgets' ),
				'description' => __( 'Override your username', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'condition'   => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'bio',
			array(
				'label'     => __( 'Biography', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => __( 'I am text block. Click edit button to change this text.', 'ocean-elementor-widgets' ),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button',
			array(
				'label'        => __( 'Enable Button', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'     => __( 'Button Text', 'ocean-elementor-widgets' ),
				'default'   => __( 'Follow on Instagram', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'header' => 'yes',
					'button' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_target',
			array(
				'label'        => __( 'Open in new window?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'header' => 'yes',
					'button' => 'yes',
				),
			)
		);

		$this->add_control(
			'items_heading',
			array(
				'label' => __( 'Items', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'overlay',
			array(
				'label'        => __( 'Enable Overlay', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'link',
			array(
				'label'        => __( 'Enable Link', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'link_target',
			array(
				'label'        => __( 'Open in new window?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => array(
					'link' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_general',
			array(
				'label' => __( 'General', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'wrap_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'wrap_border',
				'selector' => '{{WRAPPER}} .oew-insta',
			)
		);

		$this->add_responsive_control(
			'wrap_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-insta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'wrap_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-insta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Items', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-insta .oew-insta-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'border',
				'selector' => '{{WRAPPER}} .oew-insta .oew-insta-item-inner',
			)
		);

		$this->add_responsive_control(
			'border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-insta .oew-insta-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header',
			array(
				'label'     => __( 'Header', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_responsive_control(
			'header_img_size',
			array(
				'label'     => __( 'Avatar Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array( 'size' => 75 ),
				'range'     => array(
					'px' => array(
						'min'  => 10,
						'max'  => 300,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-avatar' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'username_title',
			array(
				'label'     => __( 'Username', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'username_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-username, {{WRAPPER}} .oew-insta .oew-insta-username a' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'username_typo',
				'selector'  => '{{WRAPPER}} .oew-insta .oew-insta-username',
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'bio_title',
			array(
				'label'     => __( 'Biography', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'bio_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-desc' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'bio_typo',
				'selector'  => '{{WRAPPER}} .oew-insta .oew-insta-desc',
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_follow',
			array(
				'label'     => __( 'Follow Button', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'button_typo',
				'selector'  => '{{WRAPPER}} .oew-insta .oew-insta-button a',
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'button_shadow',
				'label'     => __( 'Box Shadow', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-insta .oew-insta-button a',
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label'     => __( 'Normal', 'ocean-elementor-widgets' ),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-button a' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-button a' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label'     => __( 'Hover', 'ocean-elementor-widgets' ),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_hover_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-button a:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-button a:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'header' => 'yes',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-insta .oew-insta-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
				'condition'  => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-insta .oew-insta-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header' => 'yes',
				),
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-insta .oew-insta-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'header' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_overlay',
			array(
				'label' => __( 'Overlay', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-item .oew-insta-icon' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-insta .oew-insta-item .oew-insta-icon' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	private function render_items() {
		$settings  = $this->get_settings_for_display();
		$url       = 'https://graph.instagram.com/me';
		$token     = $settings['access_token'];
		$cache     = $settings['data_cache_limit'];
		$info_key  = 'oew_insta_info_' . md5( str_replace( '.', '_', $token ) . $cache );
		$media_key = 'oew_insta_' . md5( str_replace( '.', '_', $token ) . $cache );
		$html      = '';

		// Get info
		if ( get_transient( $info_key ) === false ) {
			$request_args    = array(
				'timeout' => 10,
			);
			$data_info       = wp_remote_retrieve_body( wp_remote_get( $url . '?fields=id,username&access_token=' . $token, $request_args ) );
			$data_info_check = json_decode( $data_info, true );

			if ( ! empty( $data_info_check['data'] ) ) {
				set_transient( $info_key, $data_info, ( $cache * MINUTE_IN_SECONDS ) );
			}
		} else {
			$data_info = get_transient( $info_key );
		}

		// Get media
		if ( get_transient( $media_key ) === false ) {
			$request_args     = array(
				'timeout' => 10,
			);
			$data_media       = wp_remote_retrieve_body( wp_remote_get( $url . '/media/?fields=username,id,caption,media_type,media_url,permalink,thumbnail_url,timestamp&limit=200&access_token=' . $token, $request_args ) );
			$data_media_check = json_decode( $data_media, true );

			if ( ! empty( $data_media_check['data'] ) ) {
				set_transient( $media_key, $data_media, ( $cache * MINUTE_IN_SECONDS ) );
			}
		} else {
			$data_media = get_transient( $media_key );
		}

		$data_info  = json_decode( $data_info, true );
		$data_media = json_decode( $data_media, true );

		if ( empty( $data_media['data'] )
			|| empty( $settings['images_count']['size'] ) ) {
			return;
		}

		// Username
		$username = $settings['username'];
		if ( ! empty( $username ) ) {
			$name = $username;
		} else {
			$name = $data_info['username'];
		}

		// If link
		$link        = '';
		$end_link    = '';
		$link_target = ( $settings['button_target'] ) ? 'target=_blank' : 'target=_self';
		if ( 'yes' === $settings['button'] ) {
			$link     = '<a href="https://www.instagram.com/' . $data_info['username'] . '" ' . esc_attr( $link_target ) . '>';
			$end_link = '</a>';
		}

		if ( $items = $data_media['data'] ) {
			$items = array_splice( $items, ( 0 * $settings['images_count']['size'] ), $settings['images_count']['size'] );

			$icon = '<svg aria-hidden="true" aria-label="Instagram" data-icon="instagram" role="img" viewBox="0 0 448 512"><path fill="currentColor" d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"></path></svg>';

			if ( 'yes' === $settings['header'] ) {
				$html .= '<div class="oew-insta-header">';

					$html .= '<div class="oew-insta-left">';

				if ( ! empty( $settings['avatar']['url'] ) ) {
					$html .= '<div class="oew-insta-avatar">' . $link . Group_Control_Image_Size::get_attachment_image_html( $settings, 'avatar' ) . $end_link . '</div>';
				}

						$html     .= '<div class="oew-insta-details">';
							$html .= '<h3 class="oew-insta-username">' . $link . $name . $end_link . '</h3>';

				if ( ! empty( $settings['bio'] ) ) {
					$html .= '<p class="oew-insta-desc">' . $settings['bio'] . '</p>';
				}
						$html .= '</div>';

					$html .= '</div>';

				if ( 'yes' === $settings['button'] ) {
					$html .= '<div class="oew-insta-button">' . $link . $icon . '<span>' . $settings['button_text'] . '</span>' . $end_link . '</div>';
				}

				$html .= '</div>';
			}

			$html .= '<div class="oew-insta-pictures">';
			foreach ( $items as $item ) {
				if ( 'yes' === $settings['link'] ) {
					$target = ( $settings['link_target'] ) ? 'target=_blank' : 'target=_self';
					$tag    = 'a';
					$link   = ' href="' . $item['permalink'] . '" ' . esc_attr( $target );
				} else {
					$tag  = 'div';
					$link = '';
				}

				$image_src = ( $item['media_type'] == 'VIDEO' ) ? $item['thumbnail_url'] : $item['media_url'];

				$html     .= '<' . $tag . $link . ' class="oew-insta-item">';
					$html .= '<div class="oew-insta-item-inner">';
				if ( $item['media_type'] == 'CAROUSEL_ALBUM' ) {
					$html .= '<div class="oew-insta-gallery-icon"><svg aria-hidden="true" data-icon="clone" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M464 0H144c-26.51 0-48 21.49-48 48v48H48c-26.51 0-48 21.49-48 48v320c0 26.51 21.49 48 48 48h320c26.51 0 48-21.49 48-48v-48h48c26.51 0 48-21.49 48-48V48c0-26.51-21.49-48-48-48zM362 464H54a6 6 0 0 1-6-6V150a6 6 0 0 1 6-6h42v224c0 26.51 21.49 48 48 48h224v42a6 6 0 0 1-6 6zm96-96H150a6 6 0 0 1-6-6V54a6 6 0 0 1 6-6h308a6 6 0 0 1 6 6v308a6 6 0 0 1-6 6z"></path></svg></div>';
				}
						$html .= '<img class="oew-insta-img" src="' . $image_src . '">';
				if ( 'yes' === $settings['overlay'] ) {
					$html .= '<div class="oew-insta-icon">' . $icon . '</div>';
				}
						$html .= '</div>';
						$html .= '</' . $tag . '>';
			}
			$html .= '</div>';
		}

		return $html;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$this->add_render_attribute(
			'insta-wrap',
			array(
				'class' => array(
					'oew-insta',
				),
				'id'    => 'oew-insta-' . $this->get_id(),
			)
		);

		if ( 'yes' == $settings['force_square'] ) {
			$this->add_render_attribute( 'insta-wrap', 'class', 'oew-insta-square' );
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'insta-wrap' ); ?>>
			<?php echo $this->render_items(); ?>
		</div>

		<?php
	}

}
