<?php
namespace owpElementor\Modules\TwitterTimeline\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TwitterTimeline extends Widget_Base {

	public function get_name() {
		return 'oew-twitter-timeline';
	}

	public function get_title() {
		return __( 'NEW Twitter Timeline', 'ocean-elementor-widgets' );
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
			'timeline',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-twitter' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_twitter_timeline',
			array(
				'label' => __( 'Twitter Timeline', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'timeline_user',
			array(
				'label'   => __( 'Twitter Username', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'timeline_appearence',
			array(
				'label'    => __( 'Appearence', 'ocean-elementor-widgets' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => '',
				'multiple' => true,
				'options'  => array(
					'noheader'    => __( 'No Header', 'ocean-elementor-widgets' ),
					'nofooter'    => __( 'No Footer', 'ocean-elementor-widgets' ),
					'noborders'   => __( 'No Borders', 'ocean-elementor-widgets' ),
					'transparent' => __( 'Transparent', 'ocean-elementor-widgets' ),
					'noscrollbar' => __( 'No Scroll Bar', 'ocean-elementor-widgets' ),
				),

			)
		);

		$this->add_control(
			'timeline_theme',
			array(
				'label'   => __( 'Theme', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'light',
				'options' => array(
					'light' => __( 'Light', 'ocean-elementor-widgets' ),
					'dark'  => __( 'Dark', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'timeline_tweet_limit',
			array(
				'label' => __( 'Tweet Limit', 'powerpack' ),
				'type'  => Controls_Manager::NUMBER,
			)
		);

		$this->add_responsive_control(
			'timeline_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 250,
						'max' => 1000,
					),
				),
			)
		);

		$this->add_responsive_control(
			'timeline_height',
			array(
				'label'      => __( 'Height', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 100,
						'max' => 1000,
					),
				),
				'condition'  => array(
					'!timeline_tweet_limit' => '',
				),
			)
		);

		$this->end_controls_section();

	}


	protected function render() {
		$settings = $this->get_settings_for_display();
		$username = $settings['timeline_user'];

		$attributes = array();
		$attribute  = ' ';

		$attributes['data-theme'] = $settings['timeline_theme'];
		$attributes['data-lang']  = get_locale();

		if ( isset( $settings['timeline_appearence'] ) && ! empty( $settings['timeline_appearence'] ) ) {
			$attributes['data-chrome'] = implode( ' ', $settings['timeline_appearence'] );
		}

		if ( ! empty( $settings['timeline_tweet_limit'] ) && absint( $settings['timeline_tweet_limit'] ) ) {
			$attributes['data-tweet-limit'] = absint( $settings['timeline_tweet_limit'] );
		}

		if ( ! empty( $settings['timeline_width'] ) ) {
			$attributes['data-width'] = $settings['timeline_width']['size'];
		}

		if ( ! empty( $settings['timeline_height'] ) ) {
			$attributes['data-height'] = $settings['timeline_height']['size'];
		}

		foreach ( $attributes as $key => $value ) {
			$attribute .= $key;
			if ( ! empty( $value ) ) {
				$attribute .= '="' . $value . '"';
			}

			$attribute .= ' ';
		}
		?>

		<div class="oew-twitter-timeline" <?php echo $attribute; ?>>
			<a class="twitter-timeline" href="https://twitter.com/<?php echo $username; ?>" <?php echo $attribute; ?>><?php _e( 'Tweets by', 'ocean-elementor-widgets' ); ?> <?php echo $username; ?></a>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<#
			view.addRenderAttribute( 'atts', {
				'data-theme': settings.timeline_theme,
				'data-width': settings.timeline_width.size,
				'data-height': settings.timeline_height.size,
				'data-chrome': settings.timeline_appearence,
				'data-tweet-limit': settings.timeline_tweet_limit,
			});
		#>
		<div class="oew-twitter-timeline" {{{ view.getRenderAttributeString( 'atts' ) }}}>
			<a class="twitter-timeline" href="https://twitter.com/{{ settings.timeline_user }}" {{{ view.getRenderAttributeString( 'atts' ) }}}>Tweets by <# {{ settings.timeline_user }} #></a>
		</div>
		<?php
	}

}
