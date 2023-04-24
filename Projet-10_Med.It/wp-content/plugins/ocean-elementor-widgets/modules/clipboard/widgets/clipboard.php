<?php
namespace owpElementor\Modules\Clipboard\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Clipboard extends Widget_Base {

	public function get_name() {
		return 'oew-clipboard';
	}

	public function get_title() {
		return __( 'NEW Clipboard', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-copy';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'clipboard',
			'copy',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-clipboard' );
	}

	public function get_style_depends() {
		return array( 'oew-clipboard' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_clipboard',
			array(
				'label' => __( 'Clipboard', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'text',
			array(
				'label'       => __( 'Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'I am the content. Copy me.', 'ocean-elementor-widgets' ),
				'placeholder' => __( 'I am the content. Copy me.', 'ocean-elementor-widgets' ),
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'heading_button',
			array(
				'label'     => __( 'Button', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$this->add_control(
			'button_position',
			array(
				'label'   => __( 'Button Position', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'top',
				'options' => array(
					'top'    => __( 'Top', 'ocean-elementor-widgets' ),
					'bottom' => __( 'Bottom', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'   => __( 'Button Text', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( 'Copy the content', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'icon',
			array(
				'label'       => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => array(
					'value'   => 'far fa-clipboard',
					'library' => 'regular',
				),
			)
		);

		$this->add_control(
			'button_size',
			array(
				'label'   => __( 'Size', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'md',
				'options' => array(
					'sm' => __( 'Small', 'ocean-elementor-widgets' ),
					'md' => __( 'Medium', 'ocean-elementor-widgets' ),
					'lg' => __( 'Large', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'icon_align',
			array(
				'label'     => __( 'Icon Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'left',
				'options'   => array(
					'left'  => __( 'Left', 'ocean-elementor-widgets' ),
					'right' => __( 'Right', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'icon!' => '',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			array(
				'label' => __( 'Button', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'button_text_align',
			array(
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
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
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .elementor-button-text' => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .elementor-button-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-clipboard-wrapper .elementor-button-text',
			)
		);

		$this->add_control(
			'button_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .elementor-button-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-button' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'button_icon_color',
			array(
				'label'     => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .elementor-button-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'button_border',
				'selector'  => '{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-button',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_textare_style',
			array(
				'label' => __( 'Textarea', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'textarea_height',
			array(
				'label' 		=> __( 'Height', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default' => array(
					'unit' => 'px',
					'size' => 80,
				),
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 1000,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-value' => 'min-height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'textarea_typography',
				'label'    => __( 'Typography', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-value',
			)
		);

		$this->add_control(
			'textarea_text_color',
			array(
				'label'     => __( 'Text Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-value' => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_control(
			'textarea_bg_color',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-value' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'textarea_border',
				'selector'  => '{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-value',
				'separator' => 'before',
			)
		);

		$this->add_control(
			'textarea_border_radius',
			array(
				'label' 		=> __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors' => array(
					'{{WRAPPER}} .oew-clipboard-wrapper .oew-clipboard-value' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		
		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$text     = $settings['text'];

		$this->add_render_attribute(
			'clipboard-button',
			'class',
			array(
				'oew-clipboard-button',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
				'button-position-' . $settings['button_position'],
			)
		);

		$this->add_render_attribute(
			'clipboard-value',
			'class',
			array(
				'oew-clipboard-value',
				'elementor-field-textual',
				'elementor-size-sm',
			)
		);
		$this->add_render_attribute( 'clipboard-value', 'id', 'oew-clipboard-value' );
		$this->add_render_attribute( 'clipboard-value', 'readonly', '' );
		$this->add_render_attribute( 'clipboard-value', 'data-clipboard-target', $text );

		if ( ! empty( $settings['icon'] ) ) {
			$this->add_render_attribute(
				'icon',
				'class',
				array(
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				)
			);
		}

		?>

		<div class="oew-clipboard-wrapper oew-clipboard-wrapper-textarea">
			<button id="copybtn" aria-label="<?php esc_attr( oew_lang_strings( 'oew-string-copy-label' ) ); ?>" <?php echo $this->get_render_attribute_string( 'clipboard-button' ); ?>>
				<span class="elementor-button-content-wrapper">
				<?php
				if ( ! empty( $settings['icon'] ) ) {
					?>
					<span <?php echo $this->get_render_attribute_string( 'icon' ); ?>>
						<?php Icons_Manager::render_icon( $settings['icon'], array( 'aria-hidden' => 'true' ) ); ?>
					</span>
					<?php
				}
				?>
					<span class="elementor-button-text"><?php echo esc_attr( $settings['button_text'] ); ?></span>
				</span>
			</button>
			<textarea id="copyvalue" aria-labelledby="copybtn copyvalue" <?php echo $this->get_render_attribute_string( 'clipboard-value' ); ?>><?php echo esc_attr( $settings['text'] ); ?></textarea>
		</div>
		<?php
	}
}
