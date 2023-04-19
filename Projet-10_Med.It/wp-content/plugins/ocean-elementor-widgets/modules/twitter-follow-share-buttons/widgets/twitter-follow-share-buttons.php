<?php
namespace owpElementor\Modules\TwitterFollowShareButtons\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TwitterFollowShareButtons extends Widget_Base {

	public function get_name() {
		return 'oew-twitter-follow-share-buttons';
	}

	public function get_title() {
		return __( 'NEW Twitter Follow&Share Buttons', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-twitter';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'twitter',
			'follow',
			'share',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-twitter' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_twitter_buttons',
			array(
				'label' => __( 'Twitter Follow&Share Buttons', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button',
			[
				'label'   => __( 'Button Type', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'share',
				'options' => [
					'share'		=> __( 'Share', 'ocean-elementor-widgets' ),
					'follow' 	=> __( 'Follow', 'ocean-elementor-widgets' ),
				],
			]
		);

		$this->add_control(
			'twitter_username',
			[
				'label'   => __( 'Username Profile URL ', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'condition' => [
					'button'    => 'follow',
				],
			]
		);

		$this->add_control(
			'via',
			[
				'label'     => __( 'Via (twitter handler)', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'button'   => 'share',
				],
			]
		);

		$this->add_control(
			'share_text',
			[
				'label'     => __( 'Your Share Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'button'   => 'share',
				],
			]
		);

		$this->add_control(
			'share_url',
			[
				'label'     => __( 'Your Share URL', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => [
					'button'   => 'share',
				],
			]
		);

		$this->add_control(
			'button_show_count',
			[
				'label'        => __( 'Show Count', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition' => [
					'button'   => 'follow',
				],
			]
		);

		$this->add_control(
			'button_large',
			[
				'label' => __( 'Large Button', 'ocean-elementor-widgets' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off' => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   		=> __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'    		=> Controls_Manager::CHOOSE,
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
				'default' 		=> 'left',
				'prefix_class' 	=> 'elementor-align%s-',
			]
		);
		$this->end_controls_section();

	}


	protected function render() {
		$settings    = $this->get_settings_for_display();
		$button_type = $settings['button'];
		$username    = $settings['twitter_username'];

		$attributes = array();
		$attribute = ' ';

		$attributes['data-lang'] = get_locale();
		$attributes['data-size'] = ( 'yes' == $settings['button_large'] ) ? 'large' : '';

		if ( 'share' == $button_type ) {
			$attributes['data-via']  = $settings['via'];
			$attributes['data-text'] = $settings['share_text'];
			$attributes['data-url']  = $settings['share_url'];
		}
	
		if ( 'follow' == $button_type ) {
			$attributes['data-show-count'] 	= ( 'yes' == $settings['button_show_count'] ) ? 'true' : 'false';
		}

		foreach ( $attributes as $key => $value ) {
			$attribute .= $key;
			if ( ! empty( $value ) ) {
				$attribute .= '="' . $value . '"';
			}

			$attribute .= ' ';
		}
		?>
		<div class="oew-twitter-follow-share-buttons">
			<?php if ( 'share' == $button_type ) { ?>
				<a href="https://twitter.com/share" class="twitter-share-button" <?php echo $attribute; ?>>Share</a>
			<?php } else { ?>
				<a href="https://twitter.com/<?php echo $username; ?>" class="twitter-follow-button" <?php echo $attribute; ?>>Follow</a>
			<?php } ?>
		</div>
		<?php
	}
}
