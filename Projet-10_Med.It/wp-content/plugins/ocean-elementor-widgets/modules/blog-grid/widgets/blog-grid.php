<?php
namespace owpElementor\Modules\BlogGrid\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Blog_Grid extends Widget_Base {

	public function get_name() {
		return 'oew-blog-grid';
	}

	public function get_title() {
		return __( 'Blog Grid', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-posts-grid';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'post',
			'blog post',
			'blog',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-blog-grid' );
	}

	public function get_style_depends() {
		return array( 'oew-blog-grid' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_blog_grid',
			array(
				'label' => __( 'Blog Grid', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'count',
			array(
				'label'       => __( 'Post Per Page', 'ocean-elementor-widgets' ),
				'description' => __( 'You can enter "-1" to display all posts.', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => __( 'Grid Columns', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				),
			)
		);

		$this->add_control(
			'grid_style',
			array(
				'label'   => __( 'Grid Style', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'fit-rows',
				'options' => array(
					'fit-rows' => __( 'Fit Rows', 'ocean-elementor-widgets' ),
					'masonry'  => __( 'Masonry', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'grid_equal_heights',
			array(
				'label'     => __( 'Equal Heights', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'condition' => array(
					'grid_style' => 'fit-rows',
				),
			)
		);

		$this->add_control(
			'pagination',
			array(
				'label'   => __( 'Pagination', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
			)
		);

		$this->add_control(
			'pagination_position',
			array(
				'label'       => __( 'Pagination Position', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => array(
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
				'selectors'   => array(
					'{{WRAPPER}} ul.page-numbers' => 'text-align: {{VALUE}};',
				),
				'default'     => 'center',
				'condition'   => array(
					'pagination' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_query',
			array(
				'label' => __( 'Query', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'post_type',
			array(
				'label'   => __( 'Post Type', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => oew_get_available_post_types(),
			)
		);

		$this->add_control(
			'offset',
			array(
				'label' => esc_html__( 'Post Offset', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::NUMBER,
				'default' => '0'
			)
		);

		$this->add_control(
			'order',
			array(
				'label'   => __( 'Order', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''     => __( 'Default', 'ocean-elementor-widgets' ),
					'DESC' => __( 'DESC', 'ocean-elementor-widgets' ),
					'ASC'  => __( 'ASC', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'orderby',
			array(
				'label'   => __( 'Order By', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''              => __( 'Default', 'ocean-elementor-widgets' ),
					'date'          => __( 'Date', 'ocean-elementor-widgets' ),
					'title'         => __( 'Title', 'ocean-elementor-widgets' ),
					'name'          => __( 'Name', 'ocean-elementor-widgets' ),
					'modified'      => __( 'Modified', 'ocean-elementor-widgets' ),
					'author'        => __( 'Author', 'ocean-elementor-widgets' ),
					'rand'          => __( 'Random', 'ocean-elementor-widgets' ),
					'ID'            => __( 'ID', 'ocean-elementor-widgets' ),
					'comment_count' => __( 'Comment Count', 'ocean-elementor-widgets' ),
					'menu_order'    => __( 'Menu Order', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'include_categories',
			array(
				'label'       => __( 'Include Categories', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => wp_list_pluck( get_terms( 'category' ), 'name', 'term_id' ),
				'multiple'    => true,
				'default'     => array(),
				'condition'   => array(
					'post_type' => 'post',
				),
			)
		);

		$this->add_control(
			'post__not_in',
			array(
				'label'       => __( 'Exclude', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT2,
				'label_block' => true,
				'options'     => oew_get_post_list(),
				'multiple'    => true,
				'post_type'   => '',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_elements',
			array(
				'label' => __( 'Elements', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'image_size',
			array(
				'label'   => __( 'Image Size', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'medium',
				'options' => oew_get_img_sizes(),
			)
		);

		$this->add_control(
			'readmore_text',
			array(
				'label'       => __( 'Learn More Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Learn More', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'     => __( 'Display Title', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'ocean-elementor-widgets' ),
				'label_off' => __( 'Hide', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'     => __( 'Title Tag', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'h2',
				'description' => __( 'H2 is recommended.', 'ocean-elementor-widgets' ),
				'options'   => array(
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
				'condition' => array(
					'title' => 'yes',
				),
			)
		);

		$this->add_control(
			'author',
			array(
				'label'     => __( 'Display Author', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'ocean-elementor-widgets' ),
				'label_off' => __( 'Hide', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'comments',
			array(
				'label'     => __( 'Display Comments', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'ocean-elementor-widgets' ),
				'label_off' => __( 'Hide', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'cat',
			array(
				'label'     => __( 'Display Categories', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'ocean-elementor-widgets' ),
				'label_off' => __( 'Hide', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'excerpt',
			array(
				'label'     => __( 'Display Excerpt', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'label_on'  => __( 'Show', 'ocean-elementor-widgets' ),
				'label_off' => __( 'Hide', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'excerpt_length',
			array(
				'label'   => __( 'Excerpt Length', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '15',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_grid',
			array(
				'label' => __( 'Grid', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'grid_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-inner' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'grid_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-inner' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Overlay Button', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typo',
				'selector' => '{{WRAPPER}} .oew-blog-grid .oew-grid-media .overlay-btn',
			)
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			array(
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_background_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-media .overlay-btn' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-media .overlay-btn' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-media .overlay-btn' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			array(
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_background_color_hover',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-media .overlay-btn:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_color_hover',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-media .overlay-btn:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_border_color_hover',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-media .overlay-btn:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tab();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_avatar',
			array(
				'label' => __( 'Author Avatar', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'avatar_border_color',
			array(
				'label'     => __( 'Border Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-media .entry-author-link' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			array(
				'label' => __( 'Title', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-details .oew-grid-title a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'title_hover_color',
			array(
				'label'     => __( 'Color: Hover', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-details .oew-grid-title a:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'title_typo',
				'selector' => '{{WRAPPER}} .oew-blog-grid .oew-grid-details .oew-grid-title',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_excerpt',
			array(
				'label' => __( 'Excerpt', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'excerpt_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-details .oew-grid-excerpt' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'excerpt_typo',
				'selector' => '{{WRAPPER}} .oew-blog-grid .oew-grid-details .oew-grid-excerpt',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_meta',
			array(
				'label' => __( 'Meta', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'meta_bg',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-meta' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'meta_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-blog-grid .oew-grid-meta, {{WRAPPER}} .oew-blog-grid .oew-grid-meta li a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .oew-blog-grid .oew-grid-meta li .owp-icon use' => 'stroke: {{VALUE}};',
				),
			)
		);

				$this->add_control(
					'meta_color_hover',
					array(
						'label'     => __( 'Color: Hover', 'ocean-elementor-widgets' ),
						'type'      => Controls_Manager::COLOR,
						'selectors' => array(
							'{{WRAPPER}} .oew-blog-grid .oew-grid-meta li a:hover' => 'color: {{VALUE}};',
							'{{WRAPPER}} .oew-blog-grid .oew-grid-meta li:hover .owp-icon use' => 'stroke: {{VALUE}};',
						),
					)
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					array(
						'name'     => 'meta_typo',
						'selector' => '{{WRAPPER}} .oew-blog-grid .oew-grid-meta',
					)
				);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Vars.
		$post_type      = $settings['post_type'];
		$post_type      = $post_type ? $post_type : 'post';
		$posts_per_page = $settings['count'];
		$order          = $settings['order'];
		$orderby        = $settings['orderby'];
		$include        = $settings['include_categories'];
		$exclude        = $settings['post__not_in'];
		$pagination     = $settings['pagination'];
		$offset         = isset( $settings['offset'] ) ? $settings['offset'] : '';

		// Paged.
		global $paged;
		if ( get_query_var( 'paged' ) ) {
			$paged = get_query_var( 'paged' );
		} elseif ( get_query_var( 'page' ) ) {
			$paged = get_query_var( 'page' );
		} else {
			$paged = 1;
		}

		$offset = ( $paged - 1 ) * $posts_per_page + (int)$offset;

		$args = array(
			'post_type'      => $post_type,
			'posts_per_page' => $posts_per_page,
			'paged'          => $paged,
			'order'          => $order,
			'orderby'        => $orderby,
			'offset'         => $offset,
		);

		// Include category
		if ( ! empty( $include ) ) {

			$args['tax_query'] = array();

			$args['tax_query'][] = array(
				'taxonomy' => 'category',
				'field'    => 'term_id',
				'terms'    => $include,
			);

			if ( ! empty( $args['tax_query'] ) ) {
				$args['tax_query']['relation'] = 'AND';
			}
		}

		// Exclude
		if ( ! empty( $exclude ) ) {
			$args['post__not_in'] = $exclude;
		}

		// Build the WordPress query
		$oew_query = new \WP_Query( $args );

		// Output posts
		if ( $oew_query->have_posts() ) :

			// Vars
			$grid_style    = $settings['grid_style'];
			$equal_heights = $settings['grid_equal_heights'];
			$readmore      = $settings['readmore_text'];
			$title         = $settings['title'];
			$title_tag     = isset ( $settings['title_tag'] ) ? $settings['title_tag'] : 'h2';
			$excerpt       = $settings['excerpt'];
			$author        = $settings['author'];
			$comments      = $settings['comments'];
			$cat           = $settings['cat'];

			// Image size
			$img_size = $settings['image_size'];
			$img_size = $img_size ? $img_size : 'medium';

			// Wrapper classes
			$wrap_classes    = array( 'oew-blog-grid', 'clr' );
			$wrap_attributes = array();

			if ( 'masonry' == $grid_style ) {
				$wrap_classes[]    = 'oew-masonry';
				$wrap_attributes[] = 'data-columns';
			}

			$wrap_attributes[] = 'data-desktop-columns=' . $settings['columns'];
			$wrap_attributes[] = isset($settings['columns_tablet']) ? 'data-tablet-columns=' . $settings['columns_tablet'] : null;
			$wrap_attributes[] = isset($settings['columns_mobile']) ? 'data-mobile-columns=' . $settings['columns_mobile']: null;

			if ( 'yes' == $equal_heights ) {
				$wrap_classes[] = 'match-height-grid';
			}

			if ( 'yes' == $author ) {
				$wrap_classes[] = 'has-avatar';
			}

			$wrap_classes    = implode( ' ', $wrap_classes );
			$wrap_attributes = implode( ' ', $wrap_attributes ); ?>

			<div class="<?php echo esc_attr( $wrap_classes ); ?>" <?php echo $wrap_attributes; ?>>

				<?php
				// Start loop
				while ( $oew_query->have_posts() ) :
					$oew_query->the_post();

					// Inner classes
					$inner_classes = array( 'oew-grid-entry', 'clr' );

					if ( 'masonry' == $grid_style ) {
						$inner_classes[] = 'isotope-entry';
					}

					$inner_classes = implode( ' ', $inner_classes );

					// If equal heights
					$details_class = '';
					if ( 'yes' == $equal_heights ) {
						$details_class = ' match-height-content';
					}

					// Meta class
					$meta_class = '';
					if ( 'false' == $comments
						|| 'false' == $cat ) {
						$meta_class = ' oew-center';
					}

					// Create new post object.
					$post = new \stdClass();

					// Get post data
					$get_post = get_post();

					// Post Data
					$post->ID        = $get_post->ID;
					$post->permalink = get_the_permalink( $post->ID );
					$post->title     = $get_post->post_title;

					// Only display carousel item if there is content to show
					if ( has_post_thumbnail()
						|| 'yes' == $title
						|| 'yes' == $excerpt
					) {
						?>

						<article id="post-<?php the_ID(); ?>" <?php post_class( $inner_classes ); ?>>

							<?php
							// Open details if the elements are yes
							if ( 'yes' == $title
								|| 'yes' == $excerpt
							) {
								?>

								<div class="oew-grid-inner clr">

									<?php

									$video = oceanwp_get_post_video_html();

									if ( $video && ! post_password_required() ) {
										?>

										<div class="blog-entry-media thumbnail clr">

											<div class="blog-entry-video">

												<?php echo $video; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

											</div><!-- .blog-entry-video -->

										</div><!-- .blog-entry-media -->

										<?php

										// Else display post thumbnail.
									} elseif ( has_post_thumbnail() ) {
										?>

										<div class="oew-grid-media clr">

											<a href="<?php echo $post->permalink; ?>" title="<?php the_title(); ?>" class="oew-grid-img">

												<?php
												// Display post thumbnail
												the_post_thumbnail(
													$img_size,
													array(
														'alt' => get_the_title(),
														'itemprop' => 'image',
													)
												);
												?>

												<span class="overlay">
													<?php
													// Display read more
													if ( '' != $readmore ) {
														?>
														<span class="overlay-btn">
															<?php echo $readmore; ?>
														</span>
													<?php } ?>
												</span>

											</a>

											<?php if ( 'yes' == $author ) { ?>
												<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php esc_attr_e( 'Visit Author Page', 'ocean-elementor-widgets' ); ?>" class="entry-author-link" rel="author" >
													<?php
													// Display author avatar
													echo get_avatar( get_the_author_meta( 'user_email' ), 100 );
													?>
												</a>
											<?php } ?>

										</div><!-- .oew-grid-media -->

									<?php } ?>

									<?php
									// Open details element if the title or excerpt are yes
									if ( 'yes' == $title
										|| 'yes' == $excerpt
									) {
										?>

										<div class="oew-grid-details<?php echo esc_attr( $details_class ); ?> clr">

											<?php
											// Display title if $title is yes and there is a post title
											if ( 'yes' == $title ) {
												?>

												<<?php echo $title_tag; ?> class="oew-grid-title entry-title">
													<a href="<?php echo $post->permalink; ?>" title="<?php the_title(); ?>"><?php echo $post->title; ?></a>
												</<?php echo $title_tag; ?>>

											<?php } ?>

											<?php
											// Display excerpt if $excerpt is yes
											if ( 'yes' == $excerpt ) {
												?>

												<div class="oew-grid-excerpt clr">
													<?php oew_excerpt( $settings['excerpt_length'] ); ?>
												</div>

											<?php } ?>

										</div><!-- .oew-grid-details -->

									<?php } ?>

									<?php

									// Display meta
									if ( 'yes' == $comments
										|| 'yes' == $cat ) {
										?>

										<ul class="oew-grid-meta<?php echo esc_attr( $meta_class ); ?> clr">

											<?php if ( 'yes' == $comments && comments_open() && ! post_password_required() ) { ?>
												<li class="meta-comments"><?php oew_svg_icon( 'comment' ); ?><?php comments_popup_link( esc_html__( '0 Comments', 'ocean-elementor-widgets' ), esc_html__( '1 Comment', 'ocean-elementor-widgets' ), esc_html__( '% Comments', 'ocean-elementor-widgets' ), 'comments-link' ); ?></li>
											<?php } ?>

											<?php if ( 'yes' == $cat ) { ?>
												<li class="meta-cat"><?php oew_svg_icon( 'category' ); ?><?php the_category( ' / ', get_the_ID() ); ?></li>
											<?php } ?>

										</ul>

									<?php } ?>

								</div>

							<?php } ?>

						</article>

					<?php } ?>

					<?php
					// End entry loop
				endwhile;
				?>

			</div><!-- .oew-blog-grid -->

			<?php
			// Display pagination if enabled
			if ( 'yes' == $pagination ) {
				oceanwp_pagination( $oew_query );
			}
			?>

			<?php
			// Reset the post data to prevent conflicts with WP globals
			wp_reset_postdata();
			wp_reset_query();

			// If no posts are found display message
		else :
			?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'ocean-elementor-widgets' ); ?></p>

			<?php
			// End post check
		endif;
		?>

		<?php
	}
}
