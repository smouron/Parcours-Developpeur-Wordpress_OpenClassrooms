<?php
namespace owpElementor\Modules\ImageGallery\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Control_Media;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class ImageGallery extends Widget_Base {

	public function get_name() {
		return 'oew-image-gallery';
	}

	public function get_title() {
		return __( 'Image Gallery', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-gallery-grid';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'image',
			'gallery',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-image-gallery' );
	}

	public function get_style_depends() {
		return array( 'oew-photoswipe', 'oew-image-gallery' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_image_gallery',
			array(
				'label' => __( 'Image Gallery', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'gallery_images',
			array(
				'label'   => __( 'Add Images', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::GALLERY,
				'dynamic' => array( 'active' => true ),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'    => 'thumbnail',
				'exclude' => array( 'custom' ),
			)
		);

		$this->add_control(
			'masonry',
			array(
				'label' => __( 'Masonry', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$this->add_responsive_control(
			'item_ratio',
			array(
				'label'     => __( 'Image Height', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 250,
				),
				'range'     => array(
					'px' => array(
						'min'  => 50,
						'max'  => 500,
						'step' => 5,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-thumbnail img' => 'height: {{SIZE}}px',
				),
				'condition' => array(
					'masonry!' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_gallery_layout',
			array(
				'label' => __( 'Layout', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Columns', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '4',
				'tablet_default' => '3',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
				'selectors'      => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item' => 'width: calc( 100% / {{VALUE}} );',
					'{{WRAPPER}} .oew-image-gallery .oew-column' => 'width: calc( 100% / {{VALUE}} );',
				),
			)
		);

		$this->add_responsive_control(
			'item_gap',
			array(
				'label'     => __( 'Column Gap', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 0,
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery' => 'margin-left: -{{SIZE}}px',
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item' => 'padding-left: {{SIZE}}px',
				),
			)
		);

		$this->add_responsive_control(
			'row_gap',
			array(
				'label'     => __( 'Row Gap', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 0,
				),
				'range'     => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery' => 'margin-top: -{{SIZE}}px',
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item' => 'margin-top: {{SIZE}}px',
				),
			)
		);

		$this->add_control(
			'add_lightbox',
			array(
				'label'   => __( 'Add Lightbox', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'add_overlay_icon',
			array(
				'label'   => __( 'Add Overlay Icon', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			)
		);

		$this->add_control(
			'overlay_icon',
			array(
				'label'     => __( 'Overlay Icon', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => array(
					'value'   => 'fas fa-search',
					'library' => 'solid',
				),
				'condition' => array(
					'add_overlay_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 20,
				),
				'range'     => array(
					'px' => array(
						'min' => 5,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'add_overlay_icon' => 'yes',
				),
			)
		);

		$this->add_control(
			'show_caption',
			array(
				'label'       => __( 'Show Caption', 'ocean-elementor-widgets' ),
				'description' => __( 'Captions needs to be added to your images.', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SWITCHER,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			array(
				'label' => __( 'Additional Options', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'overlay_content_alignment',
			array(
				'label'     => __( 'Overlay Content Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
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
				'default'   => 'center',
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'overlay_content_position',
			array(
				'label'                => __( 'Overlay Content Vertical Position', 'ocean-elementor-widgets' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => array(
					'top'    => array(
						'title' => __( 'Top', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-top',
					),
					'middle' => array(
						'title' => __( 'Middle', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'bottom' => array(
						'title' => __( 'Bottom', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors_dictionary' => array(
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				),
				'default'              => 'middle',
				'selectors'            => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_layout',
			array(
				'label' => __( 'Items', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'overlay_animation',
			array(
				'label'   => __( 'Overlay Animation', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fade',
				'options' => array(
					''                    => __( 'None', 'ocean-elementor-widgets' ),
					'fade'                => __( 'Fade', 'ocean-elementor-widgets' ),
					'slide-top'           => __( 'Slide Top', 'ocean-elementor-widgets' ),
					'slide-bottom'        => __( 'Slide Bottom', 'ocean-elementor-widgets' ),
					'slide-left'          => __( 'Slide Left', 'ocean-elementor-widgets' ),
					'slide-right'         => __( 'Slide Right', 'ocean-elementor-widgets' ),
					'slide-top-medium'    => __( 'Slide Top Medium', 'ocean-elementor-widgets' ),
					'slide-bottom-medium' => __( 'Slide Bottom Medium', 'ocean-elementor-widgets' ),
					'slide-left-medium'   => __( 'Slide Left Medium', 'ocean-elementor-widgets' ),
					'slide-right-medium'  => __( 'Slide Right Medium', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'item_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-image-gallery .oew-gallery-thumbnail',
			)
		);

		$this->add_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-thumbnail, {{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'overlay_heading',
			array(
				'label'     => __( 'Overlay', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'overlay_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'overlay_icon_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay i' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'overlay_gap',
			array(
				'label'     => __( 'Gap', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'margin: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'add_lightbox' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_heading',
			array(
				'label'     => __( 'Caption', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => array(
					'show_caption' => 'yes',
				),
			)
		);

		$this->add_control(
			'caption_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item-caption' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'show_caption' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'caption_typography',
				'label'     => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-image-gallery .oew-gallery-item-caption',
				'condition' => array(
					'show_caption' => 'yes',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'oew-image-gallery' );

		if ( 'yes' == $settings['masonry'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'oew-masonry' );
			$this->add_render_attribute( 'wrap', 'data-columns', '' );
			$this->add_render_attribute( 'wrap', 'data-desktop-columns', $settings['columns'] );
			$this->add_render_attribute( 'wrap', 'data-tablet-columns', isset( $settings['columns_tablet'] ) ? $settings['columns_tablet'] : null );
			$this->add_render_attribute( 'wrap', 'data-mobile-columns', isset( $settings['columns_mobile'] ) ? $settings['columns_mobile'] : null );
		}

		if ( 'yes' == $settings['add_lightbox'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'oew-has-lightbox' );
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<?php
			foreach ( $settings['gallery_images'] as $index => $item ) :
				$item_key      = $this->get_repeater_setting_key( 'gallery-item', 'gallery_images', $index );
				$inner_key     = $this->get_repeater_setting_key( 'gallery-inner', 'gallery_images', $index );
				$overlay_key   = $this->get_repeater_setting_key( 'overlay', 'gallery_images', $index );
				$link_key      = $this->get_repeater_setting_key( 'link', 'gallery_images', $index );
				$tag           = 'div';
				$image_url     = Group_Control_Image_Size::get_attachment_image_src( $item['id'], 'thumbnail', $settings );
				$full_image    = wp_get_attachment_image_src( $item['id'], 'full' );
				$image_caption = get_post( $item['id'] );

				$this->add_render_attribute( $item_key, 'class', 'oew-gallery-item' );

				if ( 'yes' == $settings['masonry'] ) {
					$this->add_render_attribute( $item_key, 'class', 'isotope-entry' );
				}

				$this->add_render_attribute( $inner_key, 'class', 'oew-gallery-item-inner' );

				if ( $settings['add_lightbox'] ) {
					$tag = 'a';

					if ( ! $full_image ) {
						$this->add_render_attribute( $inner_key, 'href', $item['url'] );
						$this->add_render_attribute( $inner_key, 'data-width', 1920 );
						$this->add_render_attribute( $inner_key, 'data-height', 1200 );
					} else {
						$this->add_render_attribute( $inner_key, 'href', $full_image[0] );
						$this->add_render_attribute( $inner_key, 'data-width', $full_image[1] );
						$this->add_render_attribute( $inner_key, 'data-height', $full_image[2] );
					}

					$this->add_render_attribute( $inner_key, 'class', 'no-lightbox' );
					$this->add_render_attribute( $inner_key, 'data-elementor-open-lightbox', 'no' );
				}

				$this->add_render_attribute( $overlay_key, 'class', 'oew-gallery-overlay' );

				if ( $settings['overlay_animation'] ) {
					$this->add_render_attribute( $overlay_key, 'class', 'oew-gallery-transition-' . $settings['overlay_animation'] );
				}
				?>

				<div <?php echo $this->get_render_attribute_string( $item_key ); ?>>
					<<?php echo esc_attr( $tag ); ?> <?php echo $this->get_render_attribute_string( $inner_key ); ?>>
						<div class="oew-gallery-thumbnail">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( Control_Media::get_image_alt( $item ) ); ?>">
						</div>

						<?php
						if ( 'yes' == $settings['add_lightbox'] ) {
							?>
							<div <?php echo $this->get_render_attribute_string( $overlay_key ); ?>>
								<?php
								if ( 'yes' == $settings['add_overlay_icon'] ) {
									?>
									<div class="oew-gallery-item-icon">
										<?php \Elementor\Icons_Manager::render_icon( $settings['overlay_icon'], array( 'aria-hidden' => 'true' ) ); ?>
									</div>
									<?php
								}

								if ( 'yes' == $settings['show_caption']
									&& ! empty( $image_caption ) ) {
									?>
									<div class="oew-gallery-item-caption">
										<?php echo $image_caption->post_excerpt; ?>
									</div>
									<?php
								}
								?>
							</div>
							<?php
						}
						?>
					</<?php echo esc_attr( $tag ); ?>>
				</div>

				<?php
			endforeach;
			?>
		</div>

		<?php
	}
}
