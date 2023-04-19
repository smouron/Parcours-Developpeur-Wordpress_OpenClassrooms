<?php
namespace owpElementor\Modules\MagazineHero\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\WP_Query;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Magazine_Hero extends Widget_Base {

	public function get_name() {
		return 'oew-magazine-hero';
	}

	public function get_title() {
		return __( 'Magazine Hero', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-single-post';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'post',
			'blog post',
			'blog',
			'hero',
			'owp',
		);
	}

	public function get_style_depends() {
		return array( 'oew-magazine-hero' );
	}

	/**
	 * Get Posts List
	 *
	 * @access protected
	 * @return string
	 */
	protected function get_posts_list() {
		$options = array();
		$posts   = get_posts(
			array(
				'post_type'   => 'post',
				'numberposts' => -1,
			)
		);
		foreach ( $posts as $post ) {
			$options[ $post->ID ] = $post->post_title;
		}
		return $options;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'post_source',
			array(
				'name'    => 'post_source',
				'label'   => __( 'Select Post Source', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'category',
				'options' => array(
					'category' => __( 'Latest from Category', 'ocean-elementor-widgets' ),
					'custom'   => __( 'Custom', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'selected_category',
			array(
				'label'       => __( 'Select Category', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => wp_list_pluck( get_terms( 'category' ), 'name', 'term_id' ),
				'multiple'    => false,
				'default'     => array(),
				'condition'   => array(
					'post_source' => 'category',
				),
			)
		);

		$this->add_control(
			'manual_post_selection',
			array(
				'label'       => esc_html__( 'Select the Post manually', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => $this->get_posts_list(),
				'label_block' => true,
				'multiple'    => false,
				'condition'   => array(
					'post_source' => 'custom',
				),
			)
		);

		$this->add_control(
			'image_source',
			array(
				'name'    => 'image_source',
				'label'   => __( 'Select Source', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post_image',
				'options' => array(
					'post_image' => __( 'Post Image', 'ocean-elementor-widgets' ),
					'custom'     => __( 'Custom', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'image',
			array(
				'label'     => __( 'Image', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'dynamic'   => array( 'active' => true ),
				'condition' => array(
					'image_source' => 'custom',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label'     => __( 'Image Size', 'ocean-elementor-widgets' ),
				'default'   => 'full',
				'condition' => array(
					'image_source' => 'custom',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'post_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
				'label'     => __( 'Post Image Size', 'ocean-elementor-widgets' ),
				'default'   => 'full',
				'condition' => array(
					'image_source' => 'post_image',
				),
			)
		);

		$this->add_control(
			'show_category',
			array(
				'label'        => __( 'Category', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
				'separator'    => 'before',
			)
		);

		$this->add_control(
			'show_date',
			array(
				'label'        => __( 'Date', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'yes',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'show_author',
			array(
				'label'        => __( 'Author', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'div'  => 'div',
					'span' => 'span',
					'p'    => 'p',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_items_style',
			array(
				'label' => __( 'Items', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'items_spacing',
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
					'{{WRAPPER}} .oew-magazine-hero-post-info'  => 'margin: {{SIZE}}{{UNIT}} 0;',
				),
			)
		);

		$this->add_control(
			'align_horizontal',
			array(
				'label'     => __( 'Horizontal Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-left',
					),
					'center' => array(
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-center',
					),
					'right'  => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-content-inner' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'align_vertical',
			array(
				'label'     => __( 'Vertical Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'flex-start' => array(
						'title' => __( 'Top', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-top',
					),
					'center'     => array(
						'title' => __( 'Middle', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-middle',
					),
					'flex-end'   => array(
						'title' => __( 'Bottom', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-v-align-bottom',
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-content-inner' => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Image', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'image_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-image img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'image_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .oew-magazine-hero-post-image img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'image_border',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-image img',
			)
		);

		$this->add_responsive_control(
			'image_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-image img',
			)
		);

		$this->add_control(
			'image_overlay_color',
			array(
				'label'     => __( 'Overlay Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-bg-overlay' => 'background: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'image_overlay_color_hover',
			array(
				'label'     => __( 'Overlay Color on Hover', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-item:hover .oew-magazine-hero-bg-overlay' => 'background: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_category_style',
			array(
				'label' => __( 'Category', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'category_typography',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-info-category a',
			)
		);

		$this->add_control(
			'category_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-category a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'category_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5e27a1',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-category' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'category_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'category_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .oew-magazine-hero-post-info-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'category_border',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-info-category',
			)
		);

		$this->add_responsive_control(
			'category_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'category_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-info-category',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-title',
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_color_hover',
			array(
				'label'     => __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-item:hover .oew-magazine-hero-post-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#FFFFFF',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-title' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'title_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .oew-magazine-hero-post-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'title_border',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-title',
			)
		);

		$this->add_responsive_control(
			'title_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'title_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_date_style',
			array(
				'label' => __( 'Date / Author', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'date_typography',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-info-date a',
			)
		);

		$this->add_control(
			'date_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#999999',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-date a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'date_color_hover',
			array(
				'label'     => __( 'Hover Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-item:hover .oew-magazine-hero-post-info-date a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'date_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-date' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'date_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'date_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}}  .oew-magazine-hero-post-info-date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'date_border',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-info-date',
			)
		);

		$this->add_responsive_control(
			'date_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( '%', 'px' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-magazine-hero-post-info-date' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'date_box_shadow',
				'selector' => '{{WRAPPER}} .oew-magazine-hero-post-info-date',
			)
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings          = $this->get_settings_for_display();
		$selected_category = $settings['selected_category'];
		$title_tag         = isset( $settings['title_tag'] ) ? $settings['title_tag'] : 'h1';

		if ( 'custom' == $settings['post_source'] ) {
			$args = array(
				'post_type' => 'post',
				'p'         => $settings['manual_post_selection'],
			);
		} else {
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => 1,
				'order'          => 'DESC',
				'orderby'        => 'date',
			);
		}

		if ( ! empty( $selected_category ) ) {

			$args['tax_query'] = array();

			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $selected_category,
			);

		}

		?>

		<?php $query = new \WP_Query( $args ); ?>

		<?php
		while ( $query->have_posts() ) :
			$query->the_post();
			$post_category = get_the_category( get_the_ID() );
			?>

		<div class="oew-magazine-hero-post-item">
			<div class="oew-magazine-hero-post-item-inner">
			<div class="oew-magazine-hero-bg-overlay"></div>
				<div class="oew-magazine-hero-post-image">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">

					<?php
					if ( 'custom' == $settings['image_source'] ) {
						echo Group_Control_Image_Size::get_attachment_image_html( $settings );
					} else {
						if ( 'full' !== $settings['post_image_size'] ) {
							$image_id = get_post_thumbnail_id( get_the_ID() );
							echo '<img src="' . Group_Control_Image_Size::get_attachment_image_src( $image_id, 'post_image', $settings ) . '">';
						} else {
							echo get_the_post_thumbnail( get_the_ID(), 'full' );
						}
					}

					?>
					</a>
				</div>
				<div class="oew-magazine-hero-post-content">
					<div class="oew-magazine-hero-post-content-wrapper">
						<div class="oew-magazine-hero-post-content-inner">
							<div class="oew-magazine-hero-post-info oew-magazine-hero-post-info-top">
							<?php if ( 'yes' == $settings['show_category'] ) : ?>
								<div class="oew-magazine-hero-post-info-category">
								<?php
								foreach ( $post_category as $key => $value ) {
									echo '<a href="' . esc_url( get_category_link( $value->term_id ) ) . '">' . $value->name . '</a>';
								}
								?>
								</div>
							<?php endif; ?>
							</div>
							<div class="oew-magazine-hero-post-info oew-magazine-hero-post-info-center">
								<<?php echo $title_tag; ?> class="oew-magazine-hero-post-title">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
								</<?php echo $title_tag; ?>>
							</div>
							<div class="oew-magazine-hero-post-info oew-magazine-hero-post-info-bottom">
								<div class="oew-magazine-hero-post-info-date">
									<?php if ( 'yes' == $settings['show_date'] ) : ?>
										<a href="#"><?php echo get_the_date(); ?></a>
									<?php endif; ?>
									<?php if ( 'yes' == $settings['show_author'] ) : ?>
										<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php echo esc_html( get_the_author() ); ?></a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<a class="oew-magazine-hero-post-item-link" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"></a>
			</div>
		</div>
			<?php
		endwhile;
		wp_reset_postdata();

	}

}
