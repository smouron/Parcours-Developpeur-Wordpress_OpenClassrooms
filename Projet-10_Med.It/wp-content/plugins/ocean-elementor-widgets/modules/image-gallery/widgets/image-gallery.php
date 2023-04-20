<?php
namespace owpElementor\Modules\ImageGallery\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class ImageGallery extends Widget_Base {

	public function get_name() {
		return 'oew-image-gallery';
	}

	public function get_title() {
		return __( 'Image Gallery', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		// Upload "eicons.ttf" font via this site: http://bluejamesbond.github.io/CharacterMap/
		return 'oew-icon eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_script_depends() {
		return [ 'oew-image-gallery', 'isotope', 'imagesloaded' ];
	}

	public function get_style_depends() {
		return [ 'oew-image-gallery' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_image_gallery',
			[
				'label' 		=> __( 'Image Gallery', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'gallery_images',
			[
				'label'   		=> __( 'Add Images', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::GALLERY,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'      	=> 'thumbnail',
				'exclude'   	=> [ 'custom' ],
			]
		);

		$this->add_control(
			'masonry',
			[
				'label'     	=> __( 'Masonry', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'item_ratio',
			[
				'label'   		=> __( 'Image Height', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 250,
				],
				'range' 		=> [
					'px' => [
						'min'  => 50,
						'max'  => 500,
						'step' => 5,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-thumbnail img' => 'height: {{SIZE}}px',
				],
				'condition' 	=> [
					'masonry!' => 'yes',
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_gallery_layout',
			[
				'label'     	=> __( 'Layout', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label' 		=> __( 'Columns', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> '4',
				'tablet_default' => '3',
				'mobile_default' => '1',
				'options' 		=> [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'selectors' => [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item' => 'width: calc( 100% / {{VALUE}} );',
				],
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label'   		=> __( 'Column Gap', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery' => 'margin-left: -{{SIZE}}px',
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item' => 'padding-left: {{SIZE}}px',
				],
			]
		);

		$this->add_responsive_control(
			'row_gap',
			[
				'label'   		=> __( 'Row Gap', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 0,
				],
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery' => 'margin-top: -{{SIZE}}px',
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item' => 'margin-top: {{SIZE}}px',
				],
			]
		);

		$this->add_control(
			'add_lightbox',
			[
				'label'   		=> __( 'Add Lightbox', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'add_overlay_icon',
			[
				'label'       	=> __( 'Add Overlay Icon', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::SWITCHER,
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'overlay_icon',
			[
				'label' 		=> __( 'Overlay Icon', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::ICONS,
				'default'		=> [
					'value'   => 'fas fa-search',
					'library' => 'solid',
				],
				'condition' 	=> [
					'add_overlay_icon' => 'yes',
				]
			]
		);

		$this->add_control(
			'icon_size',
			[
				'label' 		=> __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'  		=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 20,
				],
				'range' 		=> [
					'px' => [
						'min' => 5,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'add_overlay_icon' => 'yes',
				]
			]
		);

		$this->add_control(
			'show_caption',
			[
				'label'       	=> __( 'Show Caption', 'ocean-elementor-widgets' ),
				'description' 	=> __( 'Captions needs to be added to your images.', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::SWITCHER,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_additional',
			[
				'label'     	=> __( 'Additional Options', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'overlay_content_alignment',
			[
				'label'   		=> __( 'Overlay Content Alignment', 'ocean-elementor-widgets' ),
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
				'default' 		=> 'center',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'overlay_content_position',
			[
				'label'       	=> __( 'Overlay Content Vertical Position', 'ocean-elementor-widgets' ),
				'type'        	=> Controls_Manager::CHOOSE,
				'options'     	=> [
					'top' => [
						'title' => __( 'Top', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary' => [
					'top'    => 'flex-start',
					'middle' => 'center',
					'bottom' => 'flex-end',
				],
				'default'   	=> 'middle',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => '-webkit-justify-content: {{VALUE}}; justify-content: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_layout',
			[
				'label'     	=> __( 'Items', 'ocean-elementor-widgets' ),
				'tab'       	=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_animation',
			[
				'label'   		=> __( 'Overlay Animation', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::SELECT,
				'default' 		=> 'fade',
				'options' 		=> [
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
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        	=> 'item_border',
				'label'       	=> __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' 	=> '1px',
				'default'     	=> '1px',
				'selector'    	=> '{{WRAPPER}} .oew-image-gallery .oew-gallery-thumbnail',
			]
		);

		$this->add_control(
			'item_border_radius',
			[
				'label'      	=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       	=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors'  	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-thumbnail, {{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_control(
            'overlay_heading',
            [
                'label' 		=> __( 'Overlay', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
				'condition' 	=> [
					'add_lightbox' => 'yes',
				],
            ]
        );

		$this->add_control(
			'overlay_background',
			[
				'label'     	=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'background-color: {{VALUE}};',
				],
				'condition' 	=> [
					'add_lightbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'overlay_icon_color',
			[
				'label'     	=> __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay i' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'add_lightbox' => 'yes',
				],
			]
		);

		$this->add_control(
			'overlay_gap',
			[
				'label' 		=> __( 'Gap', 'ocean-elementor-widgets' ),
				'type'  		=> Controls_Manager::SLIDER,
				'range' 		=> [
					'px' => [
						'min' => 0,
						'max' => 50,
					],
				],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-overlay' => 'margin: {{SIZE}}{{UNIT}};',
				],
				'condition' 	=> [
					'add_lightbox' => 'yes',
				],
			]
		);
        
        $this->add_control(
            'caption_heading',
            [
                'label' 		=> __( 'Caption', 'ocean-elementor-widgets' ),
                'type' 			=> Controls_Manager::HEADING,
                'separator' 	=> 'before',
				'condition' 	=> [
					'show_caption' => 'yes',
				],
            ]
        );

		$this->add_control(
			'caption_color',
			[
				'label'     	=> __( 'Color', 'ocean-elementor-widgets' ),
				'type'      	=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-image-gallery .oew-gallery-item-caption' => 'color: {{VALUE}};',
				],
				'condition' 	=> [
					'show_caption' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      	=> 'caption_typography',
				'label'     	=> __( 'Typography', 'ocean-elementor-widgets' ),
				'scheme'    	=> Scheme_Typography::TYPOGRAPHY_1,
				'selector'  	=> '{{WRAPPER}} .oew-image-gallery .oew-gallery-item-caption',
				'condition' 	=> [
					'show_caption' => 'yes',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_render_attribute( 'wrap', 'class', 'oew-image-gallery' );

		if ( 'yes' == $settings['masonry'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'oew-masonry' );
		}

		if ( 'yes' == $settings['add_lightbox'] ) {
			$this->add_render_attribute( 'wrap', 'class', 'oew-has-lightbox' );
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<?php
			foreach ( $settings['gallery_images'] as $index => $item ) :
				$item_key 		= $this->get_repeater_setting_key( 'gallery-item', 'gallery_images', $index );
				$inner_key 		= $this->get_repeater_setting_key( 'gallery-inner', 'gallery_images', $index );
				$overlay_key 	= $this->get_repeater_setting_key( 'overlay', 'gallery_images', $index );
				$link_key 		= $this->get_repeater_setting_key( 'link', 'gallery_images', $index );
				$tag 			= 'div';
				$image_url 		= Group_Control_Image_Size::get_attachment_image_src( $item['id'], 'thumbnail', $settings );
				$full_image     = wp_get_attachment_image_src( $item['id'], 'full' );
				$image_caption 	= get_post( $item['id'] );

				$this->add_render_attribute( $item_key, 'class', 'oew-gallery-item' );

				if ( 'yes' == $settings['masonry'] ) {
					$this->add_render_attribute( $item_key, 'class', 'isotope-entry' );
				}

				$this->add_render_attribute( $inner_key, 'class', 'oew-gallery-item-inner' );

				if ( $settings['add_lightbox'] ) {
					$tag = 'a';

					if ( ! $full_image ) {
						$this->add_render_attribute( $inner_key, 'href', $item['url'] );
					} else {
						$this->add_render_attribute( $inner_key, 'href', $full_image[0] );
					}

					$this->add_render_attribute( $inner_key, 'class', 'no-lightbox' );
					$this->add_render_attribute( $inner_key, 'data-elementor-open-lightbox', 'no' );
				}

				$this->add_render_attribute( $overlay_key, 'class', 'oew-gallery-overlay' );

				if ( $settings['overlay_animation'] ) {
					$this->add_render_attribute( $overlay_key, 'class', 'oew-gallery-transition-' . $settings['overlay_animation'] );
				} ?>

				<div <?php echo $this->get_render_attribute_string( $item_key ); ?>>
					<<?php echo esc_attr( $tag ); ?> <?php echo $this->get_render_attribute_string( $inner_key ); ?>>
						<div class="oew-gallery-thumbnail">
							<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( Control_Media::get_image_alt( $item ) ); ?>">
						</div>

						<?php
						if ( 'yes' == $settings['add_lightbox'] ) { ?>
							<div <?php echo $this->get_render_attribute_string( $overlay_key ); ?>>
								<?php
								if ( 'yes' == $settings['add_overlay_icon'] ) { ?>
									<div class="oew-gallery-item-icon">
										<?php \Elementor\Icons_Manager::render_icon( $settings['overlay_icon'], [ 'aria-hidden' => 'true' ] ); ?>
									</div>
								<?php
								}

								if ( 'yes' == $settings['show_caption']
									&& ! empty( $image_caption ) ) { ?>
									<div class="oew-gallery-item-caption">
										<?php echo $image_caption->post_excerpt; ?>
									</div>
								<?php
								} ?>
							</div>
						<?php
						} ?>
					</<?php echo esc_attr( $tag ); ?>>
				</div>

			<?php
			endforeach; ?>
		</div>

	<?php
	}
}