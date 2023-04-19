<?php
namespace owpElementor\Modules\Testimonial\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Testimonial extends Widget_Base {

	public function get_name() {
		return 'oew-testimonial';
	}

	public function get_title() {
		return __( 'Testimonial', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-testimonial';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	public function get_keywords()
	{
        return [
			'testimonial',
			'testimonials',
			'blockquote',
			'testi',
			'review',
			'recommendation',
			'appreciation',
			'feedback',
			'owp'
		];
    }

	public function get_style_depends() {
		return [ 'oew-testimonial' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_testimonial',
			[
				'label' 		=> __( 'Testimonial', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'testimonial_style',
			[
				'label'       		=> __( 'Style', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 			=> 'classic',
				'options' 			=> [
					'classic'  	=> __( 'Classic', 'ocean-elementor-widgets'),
					'inline' 	=> __( 'Inline', 'ocean-elementor-widgets'),
					'bubble' 	=> __( 'Bubble', 'ocean-elementor-widgets'),
				],
			]
		);

		$this->add_control(
			'testimonial_inline_image_position',
			[
				'label' 		=> __( 'Image Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> 'before',
				'options' 		=> [
					'before'    	=> [
						'title' => __( 'Before', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-left',
					],
					'after' 	=> [
						'title' => __( 'After', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'style_transfer' => true,
				'condition' 	=> [
					'testimonial_style' => 'inline',
				],
			]
		);

		$this->add_control(
			'testimonial_symbol',
			[
				'label' 		=> __( 'Display Symbol', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'dynamic' 		=> [
					'active' => true,
				],
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'testimonial_alignment',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'default' 		=> 'center',
				'options' 		=> [
					'left'    	=> [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' 	=> [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' 	=> [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'testimonial_content',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'dynamic' 		=> [
					'active' => true,
				],
				'rows' 			=> '10',
				'default' 		=> __( 'Aliquam dignissim lacinia tristique nulla lobortis nunc ac eros scelerisque varius suspendisse sit amet urna vitae urna semper quis at ligula.', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'testimonial_image',
			[
				'label' 		=> __( 'Choose Image', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::MEDIA,
				'dynamic' 		=> [
					'active' => true,
				],
				'default' 		=> [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' 			=> 'testimonial_image',
				'default' 		=> 'full',
				'separator' 	=> 'none',
			]
		);

		$this->add_control(
			'testimonial_name',
			[
				'label' 		=> __( 'Name', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'dynamic' 		=> [
					'active' => true,
				],
				'default' 		=> __( 'Mark Wolf', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'testimonial_company',
			[
				'label' 		=> __( 'Company', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'dynamic' 		=> [
					'active' => true,
				],
				'default' 		=> __( 'Web Designer', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'link',
			[
				'label' 		=> __( 'Link', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::URL,
				'dynamic' 		=> [
					'active' => true,
				],
				'placeholder' 	=> __( 'https://your-link.com', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'testimonial_image_position',
			[
				'label' 		=> __( 'Image Position', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'aside',
				'options' 		=> [
					'aside' => __( 'Aside', 'ocean-elementor-widgets' ),
					'top' 	=> __( 'Top', 'ocean-elementor-widgets' ),
				],
				'condition' 	=> [
					'testimonial_image[url]!' => '',
					'testimonial_style!' => 'inline',
				],
				'separator' 	=> 'before',
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'testimonial_rating',
			[
				'label' 		=> __( 'Display Rating', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SWITCHER,
				'dynamic' 		=> [
					'active' => true,
				],
				'default' 		=> 'yes',
			]
		);

		$this->add_control(
			'testimonial_rating_number',
			[
				'label'       	=> __( 'Rating Number', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'rating-five',
				'options' 		=> [
					'rating-one'  	=> __( '1', 'ocean-elementor-widgets'),
					'rating-two' 	=> __( '2', 'ocean-elementor-widgets'),
					'rating-three' 	=> __( '3', 'ocean-elementor-widgets'),
					'rating-four' 	=> __( '4', 'ocean-elementor-widgets'),
					'rating-five'   => __( '5', 'ocean-elementor-widgets'),
				],
				'condition' 	=> [
					'testimonial_rating' => 'yes',
				],
			]
		);

        $this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_icon',
			[
				'label' 		=> __( 'Quote Icon', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-symbol path' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-symbol-inner' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-symbol-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-symbol' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'icon_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-symbol-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_content',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'content_typography',
				'selector' 		=> '{{WRAPPER}} .oew-testimonial-content',
			]
		);

		$this->add_control(
			'content_bg',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content:after' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', 'em', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-content, {{WRAPPER}} .oew-testimonial-bubble .oew-testimonial-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_img',
			[
				'label' 		=> __( 'Image', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'img_width',
			[
				'label' 		=> __( 'Image Width', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'default' 		=> [
					'size' => 60,
					'unit' => 'px',
				],
				'range' 		=> [
					'%' => [
						'min' => 0,
						'max' => 100,
					],
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'size_units' 	=> [ '%', 'px' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-image img' => 'width:{{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'img_padding',
			[
				'label' 		=> __( 'Padding', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'body {{WRAPPER}} .oew-testimonial-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' 			=> 'img_border',
				'label' 		=> __( 'Border', 'ocean-elementor-widgets'),
				'selector' 		=> '{{WRAPPER}} .oew-testimonial-image img',
			]
		);


		$this->add_control(
			'img_border_radius',
			[
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-image img' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonial_details',
			[
				'label' 		=> __( 'Details', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_heading',
			[
				'label' 		=> __( 'Name', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'name_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'name_typography',
				'selector' 		=> '{{WRAPPER}} .oew-testimonial-name',
			]
		);

		$this->add_control(
			'company_heading',
			[
				'label' 		=> __( 'Company', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator'		=> 'before'
			]
		);

		$this->add_control(
			'company_color',
			[
				'label' 		=> __( 'Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-company' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'company_typography',
				'selector' 		=> '{{WRAPPER}} .oew-testimonial-company',
			]
		);

		$this->add_control(
			'rating_heading',
			[
				'label' 		=> __( 'Rating', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::HEADING,
				'separator'		=> 'before'
			]
		);

		$this->add_control(
			'rating_spacing',
			[
				'label' 		=> __( 'Spacing', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' 	=> [ 'px', '%', 'em' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-rating li' => 'margin-right: {{SIZE}}{{UNIT}};',
					'body.rtl {{WRAPPER}} .oew-testimonial-rating li' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: 0;',
				],
			]
		);

		$this->add_responsive_control(
			'rating_margin',
			[
				'label' 		=> __( 'Margin', 'ocean-elementor-widgets'),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' 	=> [ 'px', '%' ],
				'selectors' 	=> [
					'{{WRAPPER}} .oew-testimonial-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function testimonial_img() {
		$settings = $this->get_settings_for_display(); ?>

		<div class="oew-testimonial-image">
			<?php
			$image_html = Group_Control_Image_Size::get_attachment_image_html( $settings, 'testimonial_image' );
			if ( ! empty( $settings['link']['url'] ) ) {
				$image_html = '<a ' . $this->get_render_attribute_string( 'link' ) . '>' . $image_html . '</a>';
			}
			echo $image_html; ?>
		</div>

	<?php
	}

	protected function testimonial_meta() {
		$settings 		= $this->get_settings_for_display();
		$style 			= $settings['testimonial_style'];
		$img_position 	= $settings['testimonial_image_position'];
		$has_content 	= ! ! $settings['testimonial_content'];
		$has_image 		= ! ! $settings['testimonial_image']['url'];
		$has_name 		= ! ! $settings['testimonial_name'];
		$has_company 	= ! ! $settings['testimonial_company'];
		$has_rating 	= $settings['testimonial_rating'];

		$this->add_render_attribute( 'meta', 'class', 'oew-testimonial-meta' );

		if ( $settings['testimonial_image']['url'] ) {
			$this->add_render_attribute( 'meta', 'class', 'oew-has-image' );
		}

		if ( $img_position && 'inline' != $style ) {
			$this->add_render_attribute( 'meta', 'class', 'oew-testimonial-image-position-' . $img_position );
		}

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'link', $settings['link'] );
		}

		if ( $has_rating ) {
			$this->add_render_attribute(
	            'rating',
	            [
	                'class' => [
	                    'oew-testimonial-rating',
	                    $settings['testimonial_rating_number'],
	                ],
	            ]
	        );
		} ?>
		<div <?php echo $this->get_render_attribute_string( 'meta' ); ?>>
			<div class="oew-testimonial-meta-inner">
				<?php
				if ( $has_image && 'inline' != $style ) {
					$this->testimonial_img();
				}

				if ( $has_name || $has_company ) { ?>

					<div class="oew-testimonial-details">
						<?php
						if ( $has_name ) {
							$this->add_render_attribute( 'testimonial_name', 'class', 'oew-testimonial-name' );
							$this->add_inline_editing_attributes( 'testimonial_name', 'none' );

							$testimonial_name_html = $settings['testimonial_name'];

							if ( ! empty( $settings['link']['url'] ) ) { ?>
								<a <?php echo $this->get_render_attribute_string( 'testimonial_name' ) . ' ' . $this->get_render_attribute_string( 'link' ); ?>><?php echo $testimonial_name_html; ?></a>
							<?php
							} else { ?>
								<div <?php echo $this->get_render_attribute_string( 'testimonial_name' ); ?>><?php echo $testimonial_name_html; ?></div>
							<?php
							}

						}

						if ( $has_company ) {

							$this->add_render_attribute( 'testimonial_company', 'class', 'oew-testimonial-company' );

							$this->add_inline_editing_attributes( 'testimonial_company', 'none' );

							$testimonial_company_html = $settings['testimonial_company'];

							if ( ! empty( $settings['link']['url'] ) ) { ?>
								<a <?php echo $this->get_render_attribute_string( 'testimonial_company' ) . ' ' . $this->get_render_attribute_string( 'link' ); ?>><?php echo $testimonial_company_html; ?></a>
							<?php
							} else { ?>
								<div <?php echo $this->get_render_attribute_string( 'testimonial_company' ); ?>><?php echo $testimonial_company_html; ?></div>
							<?php
							}

						}

						if ( 'yes' == $has_rating ) { ?>
							<ul <?php echo $this->get_render_attribute_string( 'rating' ); ?>>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
							</ul>
						<?php
						} ?>

					</div>

				<?php
				} ?>

			</div>

		</div>
	<?php
	}

	protected function testimonial_symbol() { ?>
		<div class="oew-testimonial-symbol">
			<div class="oew-testimonial-symbol-inner">
				<svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 40 33"><path d="M29.480315,7.65354331 C27.5485468,10.0682535 26.5826772,12.5144233 26.5826772,14.992126 C26.5826772,16.042 26.7086602,16.9448781 26.9606299,17.7007874 C28.4304535,16.5669235 30.0262381,16 31.7480315,16 C34.0997493,16 36.0629843,16.7453994 37.6377953,18.2362205 C39.2126063,19.7270416 40,21.7322709 40,24.2519685 C40,26.6036863 39.2021077,28.5669213 37.6062992,30.1417323 C36.0104907,31.7165433 34.0577543,32.503937 31.7480315,32.503937 C28.4304296,32.503937 25.8897726,31.1391213 24.1259843,28.4094488 C22.6561606,26.1417209 21.9212598,23.3071036 21.9212598,19.9055118 C21.9212598,15.5800309 23.023611,11.7060539 25.2283465,8.28346457 C27.4330819,4.86087528 30.7611326,2.09974803 35.2125984,0 L36.4094488,2.33070866 C33.7217713,3.4645726 31.4120831,5.23883307 29.480315,7.65354331 Z M7.55905512,7.65354331 C5.62728693,10.0682535 4.66141732,12.5144233 4.66141732,14.992126 C4.66141732,16.042 4.78740031,16.9448781 5.03937008,17.7007874 C6.46719874,16.5669235 8.06298331,16 9.82677165,16 C12.1364945,16 14.0892309,16.7453994 15.6850394,18.2362205 C17.2808479,19.7270416 18.0787402,21.7322709 18.0787402,24.2519685 C18.0787402,25.805782 17.7007912,27.2125921 16.9448819,28.4724409 C16.1889726,29.7322898 15.1811087,30.7191565 13.9212598,31.4330709 C12.661411,32.1469852 11.2965953,32.503937 9.82677165,32.503937 C6.50916976,32.503937 3.96851276,31.1391213 2.20472441,28.4094488 C0.734900787,26.1417209 0,23.3071036 0,19.9055118 C0,15.5800309 1.10235118,11.7060539 3.30708661,8.28346457 C5.51182205,4.86087528 8.83987276,2.09974803 13.2913386,0 L14.488189,2.33070866 C11.8005115,3.4645726 9.49082331,5.23883307 7.55905512,7.65354331 Z"></path></svg>
			</div>
		</div>
	<?php
	}

	protected function render() {
		$settings 		= $this->get_settings_for_display();
		$style 			= $settings['testimonial_style'];
		$align 			= $settings['testimonial_alignment'];
		$img_align 		= $settings['testimonial_inline_image_position'];
		$has_symbol 	= $settings['testimonial_symbol'];
		$has_content 	= ! ! $settings['testimonial_content'];
		$has_image 		= ! ! $settings['testimonial_image']['url'];
		$has_name 		= ! ! $settings['testimonial_name'];
		$has_company 	= ! ! $settings['testimonial_company'];
		$has_rating 	= $settings['testimonial_rating'];

		$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-wrapper' );

		if ( $align ) {
			$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-text-align-' . $align );
		}

		if ( $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-' . $style );
		}

		if ( 'inline' == $style ) {
			$this->add_render_attribute( 'wrapper', 'class', 'oew-testimonial-image-' . $img_align );
		}

		if ( ! $has_content && ! $has_image && ! $has_name && ! $has_company ) {
			return;
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

			<?php
			if ( $has_image && 'inline' == $style && 'before' == $img_align ) {
				$this->testimonial_img();
			}

			if ( 'yes' == $has_symbol && 
				( 'inline' != $style || 'inline' == $style && 'after' == $img_align ) ) {
				$this->testimonial_symbol();
			}

			if ( $has_content ) {
				$this->add_render_attribute( 'testimonial_content_wrapper', 'class', 'oew-testimonial-content' );
				$this->add_render_attribute( 'testimonial_content', 'class', 'oew-testimonial-content-inner' );
				$this->add_inline_editing_attributes( 'testimonial_content' ); ?>

				<div <?php echo $this->get_render_attribute_string( 'testimonial_content_wrapper' ); ?>>
					<div <?php echo $this->get_render_attribute_string( 'testimonial_content' ); ?>>
						<?php echo $settings['testimonial_content']; ?>
					</div>

					<?php
					if ( 'inline' == $style && ( $has_image || $has_name || $has_company ) ) {
						$this->testimonial_meta();
					} ?>
				</div>
			<?php
			}

			if ( 'inline' != $style && ( $has_image || $has_name || $has_company ) ) {
				$this->testimonial_meta();
			}

			if ( 'yes' == $has_symbol && 'inline' == $style && 'before' == $img_align ) {
				$this->testimonial_symbol();
			}

			if ( $has_image && 'inline' == $style && 'after' == $img_align ) {
				$this->testimonial_img();
			} ?>

		</div>

	<?php
	}

	/**
	 * Render Price List widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() { ?>
		<#
		var $style 			= settings.testimonial_style,
			$align 			= settings.testimonial_alignment,
			$img_align 		= settings.testimonial_inline_image_position,
			$has_symbol 	= settings.testimonial_symbol,
			$has_content 	= settings.testimonial_content,
			$has_image 		= settings.testimonial_image.url,
			$has_name 		= settings.testimonial_name,
			$has_company 	= settings.testimonial_company,
			$has_rating 	= settings.testimonial_rating;

		view.addRenderAttribute( 'wrapper', 'class', 'oew-testimonial-wrapper' );

		if ( '' !== $align ) {
			view.addRenderAttribute( 'wrapper', 'class', 'oew-testimonial-text-align-' + $align );
		}

		if ( '' !== $style ) {
			view.addRenderAttribute( 'wrapper', 'class', 'oew-testimonial-' + $style );
		}

		if ( 'inline' == $style ) {
			view.addRenderAttribute( 'wrapper', 'class', 'oew-testimonial-image-' + $img_align );
		} #>

		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

			<#
			if ( '' !== $has_image && 'inline' == $style && 'before' == $img_align ) { #>
				<?php $this->render_testimonial_img(); ?>
			<# }

			if ( 'yes' == $has_symbol && 
				( 'inline' != $style || 'inline' == $style && 'after' == $img_align ) ) { #>
				<?php $this->testimonial_symbol(); ?>
			<# }

			if ( '' !== $has_content ) {
				view.addRenderAttribute( 'testimonial_content_wrapper', 'class', 'oew-testimonial-content' );
				view.addRenderAttribute( 'testimonial_content', 'class', 'oew-testimonial-content-inner' );
				view.addInlineEditingAttributes( 'testimonial_content', 'none' ); #>

				<div {{{ view.getRenderAttributeString( 'testimonial_content_wrapper' ) }}}>
					<div {{{ view.getRenderAttributeString( 'testimonial_content' ) }}}>
						{{{ settings.testimonial_content }}}
					</div>

					<#
					if ( 'inline' == $style && ( '' !== $has_image || '' !== $has_name || '' !== $has_company ) ) { #>
						<?php $this->render_testimonial_meta(); ?>
					<# } #>
				</div>
			<#
			}

			if ( 'inline' != $style && ( '' !== $has_image || '' !== $has_name || '' !== $has_company ) ) { #>
				<?php $this->render_testimonial_meta(); ?>
			<# }

			if ( 'yes' == $has_symbol && 'inline' == $style && 'before' == $img_align ) { #>
				<?php $this->testimonial_symbol(); ?>
			<# }

			if ( '' !== $has_image && 'inline' == $style && 'after' == $img_align ) { #>
				<?php $this->render_testimonial_img(); ?>
			<# } #>

		</div>

	<?php
	}

	protected function render_testimonial_img() { ?>
		<#
		var image = {
				id: settings.testimonial_image.id,
				url: settings.testimonial_image.url,
				size: settings.testimonial_image_size,
				dimension: settings.testimonial_image_custom_dimension,
				model: view.getEditModel()
			};

		var imageUrl = false;

		if ( '' !== settings.testimonial_image.url ) {
			imageUrl = elementor.imagesManager.getImageUrl( image );

			var imageHtml = '<img src="' + imageUrl + '" alt="testimonial" />';
			if ( settings.link.url ) {
				imageHtml = '<a href="' + settings.link.url + '">' + imageHtml + '</a>';
			}
		}

		if ( imageUrl ) { #>
			<div class="oew-testimonial-image">{{{ imageHtml }}}</div>
		<# } #>
	<?php
	}

	protected function render_testimonial_meta() { ?>
		<#
		var $style 			= settings.testimonial_style,
			$img_position 	= settings.testimonial_image_position,
			$has_content 	= settings.testimonial_content,
			$has_image 		= settings.testimonial_image.url,
			$has_name 		= settings.testimonial_name,
			$has_company 	= settings.testimonial_company,
			$has_rating 	= settings.testimonial_rating;

		view.addRenderAttribute( 'meta', 'class', 'oew-testimonial-meta' );

		if ( '' !== $has_image ) {
			view.addRenderAttribute( 'meta', 'class', 'oew-has-image' );
		}

		if ( '' !== $img_position && 'inline' != $style ) {
			view.addRenderAttribute( 'meta', 'class', 'oew-testimonial-image-position-' + $img_position );
		}

		if ( '' !== $has_rating ) {
			view.addRenderAttribute( 'rating', 'class', 'oew-testimonial-rating' );
			view.addRenderAttribute( 'rating', 'class', settings.testimonial_rating_number );
		} #>
		<div {{{ view.getRenderAttributeString( 'meta' ) }}}>
			<div class="oew-testimonial-meta-inner">
				<#
				if ( '' !== $has_image && 'inline' != $style ) { #>
					<?php $this->render_testimonial_img(); ?>
				<# }

				if ( '' !== $has_name || '' !== $has_company ) { #>

					<div class="oew-testimonial-details">
						<#
						if ( '' !== $has_name ) {
							view.addRenderAttribute( 'testimonial_name', 'class', 'oew-testimonial-name' );
							view.addInlineEditingAttributes( 'testimonial_name', 'none' );

							if ( settings.link.url ) { #>
								<a href="{{{ settings.link.url }}}" {{{ view.getRenderAttributeString( 'testimonial_name' ) }}}>{{{ settings.testimonial_name }}}</a>
							<#
							} else { #>
								<div {{{ view.getRenderAttributeString( 'testimonial_name' ) }}}>{{{ settings.testimonial_name }}}</div>
							<#
							}

						}

						if ( '' !== $has_company ) {
							view.addRenderAttribute( 'testimonial_company', 'class', 'oew-testimonial-company' );
							view.addInlineEditingAttributes( 'testimonial_company', 'none' );

							if ( settings.link.url ) { #>
								<a href="{{{ settings.link.url }}}" {{{ view.getRenderAttributeString( 'testimonial_company' ) }}}>{{{ settings.testimonial_company }}}</a>
							<#
							} else { #>
								<div {{{ view.getRenderAttributeString( 'testimonial_company' ) }}}>{{{ settings.testimonial_company }}}</div>
							<#
							}

						}

						if ( 'yes' == $has_rating ) { #>
							<ul {{{ view.getRenderAttributeString( 'rating' ) }}}>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
								<li><i class="fas fa-star" aria-hidden="true"></i></li>
							</ul>
						<#
						} #>

					</div>

				<#
				} #>

			</div>

		</div>
	<?php
	}

}