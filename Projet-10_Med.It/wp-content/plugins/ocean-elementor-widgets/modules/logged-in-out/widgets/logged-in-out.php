<?php
namespace owpElementor\Modules\LoggedInOut\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Logged_In_Out extends Widget_Base {

	public function get_name() {
		return 'oew-logged-in-out';
	}

	public function get_title() {
		return __( 'Logged In/Out', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-lock-user';
	}

	public function get_categories() {
		return [ 'oceanwp-elements' ];
	}

    public function get_keywords() {
        return [
            'user',
            'login',
            'logged',
            'owp',
        ];
    }

	public function get_style_depends() {
		return [ 'oew-logged-in-out' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_logged_in',
			[
				'label' 		=> __( 'Logged In', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'logged_in_nav',
			[
				'label' 		=> __( 'Select Menu', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'no',
				'options' 		=> $this->menus(),
			]
		);

		$this->add_control(
			'logged_in_content',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Enter your content', 'ocean-elementor-widgets' ),
				'default' 		=> '',
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'logged_in_position',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-login-link.in' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logged_out',
			[
				'label' 		=> __( 'Logged Out', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'logged_out_nav',
			[
				'label' 		=> __( 'Select Menu', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::SELECT,
				'default' 		=> 'no',
				'options' 		=> $this->menus(),
			]
		);

		$this->add_control(
			'logged_out_content',
			[
				'label' 		=> __( 'Content', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::TEXTAREA,
				'placeholder' 	=> __( 'Enter your content', 'ocean-elementor-widgets' ),
				'default' 		=> '',
				'dynamic' 		=> [ 'active' => true ],
			]
		);

		$this->add_responsive_control(
			'logged_out_position',
			[
				'label' 		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::CHOOSE,
				'options' 		=> [
					'left' => [
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default' 		=> '',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-login-link.out' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_logged_in_out',
			[
				'label' 		=> __( 'Styling', 'ocean-elementor-widgets' ),
				'tab' 			=> Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_logged_in_links_style' );

		$this->start_controls_tab(
			'tab_logged_in_out_links_normal',
			[
				'label' => __( 'Normal', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'logged_in_out_links_color',
			[
				'label' 		=> __( 'Links Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-login-link a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'logged_in_out_links_hover',
			[
				'label' => __( 'Hover', 'ocean-elementor-widgets' ),
			]
		);

		$this->add_control(
			'logged_in_out_links_hover_color',
			[
				'label' 		=> __( 'Links Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-login-link a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'logged_in_out_text_color',
			[
				'label' 		=> __( 'Text Color', 'ocean-elementor-widgets' ),
				'type' 			=> Controls_Manager::COLOR,
				'selectors' 	=> [
					'{{WRAPPER}} .oew-login-link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' 			=> 'logged_in_out_typo',
				'selector' 		=> '{{WRAPPER}} .oew-login-link',
			]
		);

		$this->end_controls_section();

	}

	public static function menus() {
		$get_menus 	 = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		$menus['no'] = esc_html__( 'No Menu', 'ocean-elementor-widgets' );
		foreach ( $get_menus as $menu) {
			$menus[$menu->term_id] = $menu->name;
		}
		return $menus;
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( is_user_logged_in() ) {
			$class 	 = 'in';
			$menu 	 = $settings['logged_in_nav'];
			$content = $settings['logged_in_content'];
		} else {
			$class 	 = 'out';
			$menu 	 = $settings['logged_out_nav'];
			$content = $settings['logged_out_content'];
		}

		$menu_args = array(
			'menu' 			 => $menu,
			'container'      => false,
			'fallback_cb'    => false,
			'menu_class'     => 'oew-login-ul navigation dropdown-menu sf-menu clr',
			'link_before'    => '<span class="text-wrap">',
			'link_after'     => '</span>',
			'walker'         => new \OceanWP_Custom_Nav_Walker(),
		); ?>

		<div class="oew-login-link <?php echo esc_attr( $class ); ?>">
			<?php
			// If content
			if ( ! empty( $content ) ) { ?>
				 <span class="oew-login-content"><?php echo do_shortcode( $content ); ?></span>
			<?php }

			// If menu
			if ( ! empty( $menu ) && 'no' != $menu ) {
				wp_nav_menu( $menu_args );
			} ?>
		</div>

	<?php
	}

}