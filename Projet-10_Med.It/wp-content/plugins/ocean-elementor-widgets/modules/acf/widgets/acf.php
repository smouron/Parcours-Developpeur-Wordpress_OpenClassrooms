<?php
/**
 * Ocean Elementor Widgets: ACF Widget
 *
 * @package Ocean_Elementor_Widgets
 * @author  OceanWP
 */

namespace owpElementor\Modules\ACF\Widgets;

// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * OEW ACF Widget
 */
class ACF extends Widget_Base {

	/**
	 * OEW Widget name
	 */
	public function get_name() {
		return 'oew-acf';
	}

	/**
	 * OEW Widget title
	 */
	public function get_title() {
		return __( 'ACF', 'ocean-elementor-widgets' );
	}

	/**
	 * OEW Widget icon
	 */
	public function get_icon() {
		return 'oew-icon eicon-post';
	}

	/**
	 * OEW Widget category
	 */
	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

	/**
	 * OEW Widget keywords
	 */
	public function get_keywords() {
		return [
			'advanced custom fields',
			'field',
			'fields',
			'acf',
			'owp',
			'oceanwp',
		];
	}

	/**
	 * OEW Widget register controls
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_acf',
			[
				'label' => __( 'ACF', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'field_name',
			[
				'label'   => __( 'Field Name', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'field_type',
			[
				'label'   => __( 'Field Type', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text',
				'options' => [
					'text' => __( 'Text', 'ocean-elementor-widgets' ),
					'link' => __( 'Link', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'link_text',
			[
				'label'     => __( 'Link Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'field_type' => 'link',
				],
				'dynamic'   => [ 'active' => true ],
			]
		);

		$this->add_control(
			'link_target',
			[
				'label'     => __( 'Link Target', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'self',
				'options'   => [
					'self'  => __( 'Self', 'ocean-elementor-widgets' ),
					'blank' => __( 'Blank', 'ocean-elementor-widgets' ),
				],
				'condition' => [
					'field_type' => 'link',
				],
			]
		);

		$this->add_control(
			'link_nofollow',
			[
				'label'     => __( 'Add Nofollow', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SWITCHER,
				'condition' => [
					'field_type' => 'link',
				],
			]
		);

		$this->add_control(
			'field_label',
			[
				'label'   => __( 'Label', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'icon',
			[
				'label'   => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::ICON,
				'default' => '',
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'     => __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => [
					'left'  => __( 'Before', 'ocean-elementor-widgets' ),
					'right' => __( 'After', 'ocean-elementor-widgets' ),
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label'     => __( 'Icon Spacing', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'condition' => [
					'icon!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .oew-acf .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-acf .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'  => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .oew-acf' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Field', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'field_typography',
				'selector' => '{{WRAPPER}} .oew-acf .oew-acf-field',
			]
		);

		$this->add_control(
			'field_color',
			[
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .oew-acf .oew-acf-field' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			[
				'label'     => __( 'Label', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'field_label!' => '',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'label_typography',
				'selector'  => '{{WRAPPER}} .oew-acf .oew-acf-label',
				'condition' => [
					'field_label!' => '',
				],
			]
		);

		$this->add_control(
			'label_color',
			[
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .oew-acf .oew-acf-label' => 'color: {{VALUE}};',
				],
				'condition' => [
					'field_label!' => '',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			[
				'label'     => __( 'Icon', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .oew-acf .oew-acf-icon' => 'color: {{VALUE}};',
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label' => __( 'Size', 'ocean-elementor-widgets' ),
				'type'     => Controls_Manager::SLIDER,
				'range'    => [
					'px' => [
						'min' => 5,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .oew-acf .oew-acf-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'icon!' => '',
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * OEW Widget render
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$type     = $settings['field_type'];

		$this->add_render_attribute( 'wrap', 'class', 'oew-acf' );

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute( 'icon', 'class', [
				'oew-acf-icon',
				'elementor-align-icon-' . $settings['icon_align'],
			] );
		}

		$this->add_render_attribute( 'label', 'class', 'oew-acf-label' );
		$this->add_render_attribute( 'field', 'class', 'oew-acf-field' );

		$this->add_render_attribute( 'link', 'class', 'oew-acf-field' );
		$this->add_render_attribute( 'link', 'href', esc_url( get_field( $settings['field_name'] ) ) );
		$this->add_render_attribute( 'link', 'target', '_' . $settings['link_target'] );

		if ( true === $settings['link_nofollow'] ) {
			$this->add_render_attribute( 'link', 'rel', 'nofollow' );
		}
		?>

		<div <?php echo $this->get_render_attribute_string( 'wrap' ); ?>>
			<?php
			if ( ! empty( $settings['icon'] ) && 'left' === $settings['icon_align'] ) {
				?>

				<span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				</span>

				<?php
			}
			?>

			<?php
			if ( ! empty( $settings['field_label'] ) ) {
				?>

				<span <?php echo $this->get_render_attribute_string( 'label' ); ?>>
					<?php echo esc_attr( $settings['field_label'] ); ?>
				</span>

				<?php
			}
			?>

			<?php
			if ( 'text' === $type ) {
				?>

				<span <?php echo $this->get_render_attribute_string( 'field' ); ?>>
					<?php echo do_shortcode( get_field( $settings['field_name'] ) ); ?>
				</span>

				<?php
			} elseif ( 'link' === $type ) {
				?>

				<a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
					<?php
					if ( ! empty( $settings['link_text'] ) ) {
						echo esc_attr( $settings['link_text'] );
					} else {
						echo do_shortcode( get_field( $settings['field_name'] ) );
					}
					?>

				</a>

				<?php
			}
			?>

			<?php
			if ( ! empty( $settings['icon'] ) && 'right' === $settings['icon_align'] ) {
				?>

				<span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
					<i class="<?php echo esc_attr( $settings['icon'] ); ?>" aria-hidden="true"></i>
				</span>

				<?php
			}
			?>

		</div>

		<?php
	}
}
