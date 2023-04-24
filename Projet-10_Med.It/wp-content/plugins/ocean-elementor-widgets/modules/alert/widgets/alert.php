<?php
namespace owpElementor\Modules\Alert\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Alert extends Widget_Base {

	public function get_name() {
		return 'oew-alert';
	}

	public function get_title() {
		return __( 'Alert', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-alert';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'alert',
            'notice',
            'owp',
        ];
    }

	public function get_script_depends() {
		return [ 'oew-alert' ];
	}

	public function get_style_depends() {
		return [ 'oew-alert' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_alert',
			[
				'label' 		=> __( 'Alert', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'type',
			[
				'label' 		=> __( 'Type', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'notice',
				'options' 		=> [
					'notice' 	=> __( 'Notice', 'ocean-elementor-widgets' ),
					'error' 	=> __( 'Error', 'ocean-elementor-widgets' ),
					'warning' 	=> __( 'Warning', 'ocean-elementor-widgets' ),
					'success' 	=> __( 'Success', 'ocean-elementor-widgets' ),
					'info' 		=> __( 'Info', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' 		=> __( 'Title & Description', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXT,
				'placeholder' 	=> __( 'Your Title', 'ocean-elementor-widgets' ),
				'default' 		=> __( 'This is Alert Message', 'ocean-elementor-widgets' ),
				'label_block' 	=> true,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'content',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Your Description', 'ocean-elementor-widgets' ),
				'default' 		=> __( 'Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel.', 'ocean-elementor-widgets' ),
				'separator' 	=> 'none',
				'show_label' 	=> false,
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_control(
			'show_dismiss',
			[
				'label' 		=> __( 'Dismiss Button', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'show',
				'options' 		=> [
					'show' 		=> __( 'Show', 'ocean-elementor-widgets' ),
					'hide' 		=> __( 'Hide', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' 		=> __( 'View', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::HIDDEN,
				'default' 		=> 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_type',
			[
				'label' 		=> __( 'Alert Type', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style',
			[
				'label' 		=> __( 'Style', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'small',
				'options' 		=> [
					'small' 	=> __( 'Small', 'ocean-elementor-widgets' ),
					'big' 		=> __( 'Big', 'ocean-elementor-widgets' ),
					'minimal' 	=> __( 'Minimal', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'background',
			[
				'label' 		=> __( 'Background Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-alert' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label'		 	=> __( 'Border Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-alert' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title',
			[
				'label' 		=> __( 'Title', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-alert-heading' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'alert_title',
				'selector' 		=> '{{WRAPPER}} .oew-alert-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_description',
			[
				'label' 		=> __( 'Description', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-alert-content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'alert_content',
				'selector' 		=> '{{WRAPPER}} .oew-alert-content',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper classes
		$wrap_classes = array( 'oew-alert', 'clr' );
		if ( ! empty( $settings['type'] ) ) {
			$wrap_classes[] = 'oew-alert-' . $settings['type'];
		}
		if ( ! empty( $settings['style'] ) ) {
			$wrap_classes[] = 'oew-alert-' . $settings['style'];
		}

		// Turn wrap classes into a string
		$wrap_classes = implode( ' ', $wrap_classes );

		// Alert icon
		if ( 'notice' == $settings['type'] ) {
			if ( 'minimal' == $settings['style'] ) {
				$alert_icon = 'fa fa-bell';
			} else {
				$alert_icon = 'icon-bell';
			}
		} else if ( 'error' == $settings['type'] ) {
			if ( 'minimal' == $settings['style'] ) {
				$alert_icon = 'fa fa-times';
			} else {
				$alert_icon = 'icon-close';
			}
		} else if ( 'warning' == $settings['type'] ) {
			$alert_icon = 'fa fa-exclamation';
		} else if ( 'success' == $settings['type'] ) {
			if ( 'minimal' == $settings['style'] ) {
				$alert_icon = 'fa fa-check';
			} else {
				$alert_icon = 'icon-check';
			}
		} else if ( 'info' == $settings['type'] ) {
			$alert_icon = 'fa fa-info';
		} ?>

		<div class="<?php echo esc_attr( $wrap_classes ); ?>" role="alert">

			<div class="oew-alert-content-wrap clr">

				<div class="oew-alert-icon"><i class="<?php echo esc_attr( $alert_icon ); ?>"></i></div>
				
				<?php
				// Display heading if defined
				if ( ! empty( $settings['title'] ) && 'small' != $settings['style'] ) { ?>

					<h2 class="oew-alert-heading">
						<?php echo esc_attr( $settings['title'] ); ?>
					</h2>

				<?php } ?>

				<?php
				// Display content if defined
				if ( ! empty( $settings['content'] ) ) { ?>

					<div class="oew-alert-content clr">
						<?php echo do_shortcode( $settings['content'] ); ?>
					</div><!-- .oew-alert-content -->

				<?php } ?>

				<?php
				// Display close button if defined
				if ( ! empty( $settings['show_dismiss'] ) && 'show' === $settings['show_dismiss'] ) { ?>

					<div class="oew-alert-close-btn"><i class="icon-close"></i></div>

				<?php } ?>

			</div><!-- .oew-alert-content -->

		</div><!-- .oew-alert -->

	<?php
	}

	protected function content_template() { ?>
		<#
			var wrap_classes = 'oew-alert clr',
				alert_icon = '';

			if ( '' !== settings.type ) {
				wrap_classes += ' oew-alert-' + settings.type;
			}
			if ( '' !== settings.style ) {
				wrap_classes += ' oew-alert-' + settings.style;
			}

			if ( 'notice' === settings.type ) {
				if ( 'minimal' === settings.style ) {
					alert_icon = 'fa fa-bell';
				} else {
					alert_icon = 'icon-bell';
				}
			} else if ( 'error' === settings.type ) {
				if ( 'minimal' === settings.style ) {
					alert_icon = 'fa fa-times';
				} else {
					alert_icon = 'icon-close';
				}
			} else if ( 'warning' === settings.type ) {
				alert_icon = 'fa fa-exclamation';
			} else if ( 'success' === settings.type ) {
				if ( 'minimal' === settings.style ) {
					alert_icon = 'fa fa-check';
				} else {
					alert_icon = 'icon-check';
				}
			} else if ( 'info' === settings.type ) {
				alert_icon = 'fa fa-info';
			}
		#>

		<div class="{{ wrap_classes }}" role="alert">

			<div class="oew-alert-content-wrap clr">

				<div class="oew-alert-icon"><i class="{{ alert_icon }}"></i></div>

				<# if ( settings.title && 'small' !== settings.style ) { #>
					<h2 class="oew-alert-heading">{{{ settings.title }}}</h2>
				<# } #>

				<# if ( settings.content ) { #>
					<div class="oew-alert-content clr">{{{ settings.content }}}</div>
				<# } #>

				<# if ( settings.show_dismiss && 'show' === settings.show_dismiss ) { #>
					<div class="oew-alert-close-btn"><i class="icon-close"></i></div>
				<# } #>

			</div>

		</div>
	<?php
	}
}