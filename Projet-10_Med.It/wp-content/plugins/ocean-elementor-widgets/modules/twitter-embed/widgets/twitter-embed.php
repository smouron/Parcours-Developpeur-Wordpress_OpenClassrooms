<?php
namespace owpElementor\Modules\TwitterEmbed\Widgets;

// Elementor Classes
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class TwitterEmbed extends Widget_Base {
	public function get_name() {
		return 'oew-twitter-embed';
	}

	public function get_title() {
		return __( 'NEW Twitter Embed', 'ocean-elementor-widgets' );
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
			'embed',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-twitter' );
	}

	public function is_reload_preview_required() {
		return true;
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_twitter_embed',
			array(
				'label' => __( 'Twitter Embed', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'tweet_url',
			array(
				'label'   => __( 'Tweet URL', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '',
			)
		);

		$this->add_control(
			'tweet_theme',
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
			'tweet_cards',
			array(
				'label'       => __( 'Cards', 'ocean-elementor-widgets' ),
				'description' => __( 'When set to hidden, links in a Tweet are not expanded to photo, video, or link previews.', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'visible',
				'options'     => array(
					'visible' => __( 'Visible', 'ocean-elementor-widgets' ),
					'hidden'  => __( 'Hidden', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_responsive_control(
			'tweet_align',
			array(
				'label'     => __( 'Alignment', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => array(
					'left'   => __( 'Left', 'ocean-elementor-widgets' ),
					'center' => __( 'Center', 'ocean-elementor-widgets' ),
					'right'  => __( 'Right', 'ocean-elementor-widgets' ),
				),
				'default'   => 'center',
			)
		);

		$this->add_control(
			'tweet_width',
			array(
				'label'      => __( 'Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => array(
					'unit' => 'px',
				),
				'size_units' => array( 'px' ),
				'range'      => array(
					'px' => array(
						'min' => 250,
						'max' => 1000,
					),
				),
			)
		);

		$this->end_controls_section();

	}


	protected function render() {
		$settings  = $this->get_settings_for_display();
		$tweet_url = $settings['tweet_url'];

		$attributes = array();
		$attribute  = ' ';

		$attributes['data-theme'] = $settings['tweet_theme'];
		$attributes['data-align'] = $settings['tweet_align'];
		$attributes['data-cards'] = $settings['tweet_cards'];
		$attributes['data-lang']  = get_locale();

		if ( ! empty( $settings['tweet_width'] ) ) {
			$attributes['data-width'] = $settings['tweet_width']['size'];
		}

		foreach ( $attributes as $key => $value ) {
			$attribute .= $key;
			if ( ! empty( $value ) ) {
				$attribute .= '="' . $value . '"';
			}

			$attribute .= ' ';
		}
		?>

		<div class="oew-twitter-embed" <?php echo $attribute; ?>>
			<blockquote class="twitter-tweet" <?php echo $attribute; ?>><a href="<?php echo esc_url( $tweet_url ); ?>"></a></blockquote>
		</div>
	
		<?php
	}

}
