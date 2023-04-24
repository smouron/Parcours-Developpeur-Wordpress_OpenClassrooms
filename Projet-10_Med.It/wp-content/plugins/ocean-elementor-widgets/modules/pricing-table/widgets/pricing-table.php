<?php
namespace owpElementor\Modules\PricingTable\Widgets;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Pricing_Table extends Widget_Base {

	public function get_name() {
		return 'oew-pricing-table';
	}

	public function get_title() {
		return __( 'NEW: Pricing Table', 'ocean-elementor-widgets' );
	}

	public function get_icon() {
		return 'oew-icon eicon-price-table';
	}

	public function get_categories() {
		return array( 'oceanwp-elements' );
	}

	public function get_keywords() {
		return array(
			'price',
			'table',
			'price table',
			'pricing table',
			'owp',
		);
	}

	public function get_script_depends() {
		return array( 'oew-pricing-table' );
	}

	public function get_style_depends() {
		return array( 'oew-pricing-table', 'tippy', 'tippy-arrow' );
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_pricing',
			array(
				'label' => __( 'Table', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'style',
			array(
				'label'   => __( 'Table Style', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-1',
				'options' => array(
					'style-1' => __( 'Default', 'ocean-elementor-widgets' ),
					'style-2' => __( 'Pricing Style 2', 'ocean-elementor-widgets' ),
					'style-3' => __( 'Pricing Style 3', 'ocean-elementor-widgets' ),
				),
			)
		);

		$this->add_control(
			'selected_table_icon',
			array(
				'label'            => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'table_icon',
				'default'          => array(
					'value'   => 'far fa-gem',
					'library' => 'fa-regular',
				),
				'condition'        => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'selected_table_img',
			array(
				'label'     => __( 'Choose Image', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::MEDIA,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => array(
					'url' => Utils::get_placeholder_image_src(),
				),
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			array(
				'name'      => 'selected_table_img',
				'label'     => __( 'Image Resolution', 'ocean-elementor-widgets' ),
				'default'   => 'large',
				'condition' => array(
					'style' => 'style-3',
				),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'       => __( 'Title', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Standard', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array( 'active' => true ),
			)
		);

		$this->add_control(
			'sub_title',
			array(
				'label'   => __( 'Description', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Enter your description', 'ocean-elementor-widgets' ),
				'dynamic' => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'title_tag',
			array(
				'label'   => __( 'Title HTML Tag', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
				'default' => 'h3',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_price',
			array(
				'label' => __( 'Price', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'price',
			array(
				'label'   => __( 'Price', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array(
					'active' => true,
				),
				'default' => __( '79', 'ocean-elementor-widgets' ),
			)
		);
		$this->add_control(
			'onsale',
			array(
				'label'        => __( 'On Sale?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'default'      => 'no',
				'label_on'     => __( 'Yes', 'ocean-elementor-widgets' ),
				'label_off'    => __( 'No', 'ocean-elementor-widgets' ),
				'return_value' => 'yes',
			)
		);
		$this->add_control(
			'onsale_price',
			array(
				'label'     => __( 'Sale Price', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array(
					'active' => true,
				),
				'default'   => __( '59', 'ocean-elementor-widgets' ),
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_control(
			'currency_symbol',
			array(
				'label'   => __( 'Currency Symbol', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::SELECT,
				'options' => array(
					''             => __( 'None', 'ocean-elementor-widgets' ),
					'dollar'       => '&#36; ' . _x( 'Dollar', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'euro'         => '&#128; ' . _x( 'Euro', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'baht'         => '&#3647; ' . _x( 'Baht', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'franc'        => '&#8355; ' . _x( 'Franc', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'guilder'      => '&fnof; ' . _x( 'Guilder', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'krona'        => 'kr ' . _x( 'Krona', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'lira'         => '&#8356; ' . _x( 'Lira', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'peseta'       => '&#8359 ' . _x( 'Peseta', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'peso'         => '&#8369; ' . _x( 'Peso', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'pound'        => '&#163; ' . _x( 'Pound Sterling', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'real'         => 'R$ ' . _x( 'Real', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'ruble'        => '&#8381; ' . _x( 'Ruble', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'rupee'        => '&#8360; ' . _x( 'Rupee', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'indian_rupee' => '&#8377; ' . _x( 'Rupee (Indian)', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'shekel'       => '&#8362; ' . _x( 'Shekel', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'yen'          => '&#165; ' . _x( 'Yen/Yuan', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'won'          => '&#8361; ' . _x( 'Won', 'Currency Symbol', 'ocean-elementor-widgets' ),
					'custom'       => __( 'Custom', 'ocean-elementor-widgets' ),
				),
				'default' => 'dollar',
			)
		);

		$this->add_control(
			'currency_symbol_custom',
			array(
				'label'     => __( 'Custom Symbol', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'condition' => array(
					'currency_symbol' => 'custom',
				),
			)
		);

		$this->add_control(
			'currency_position',
			array(
				'label'   => __( 'Currency Position', 'elementor-pro' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'before',
				'options' => array(
					'before' => array(
						'title' => __( 'Before', 'elementor-pro' ),
						'icon'  => 'eicon-h-align-left',
					),
					'after'  => array(
						'title' => __( 'After', 'elementor-pro' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
			)
		);

		$this->add_control(
			'period',
			array(
				'label'   => __( 'Period', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => __( 'month', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'separator',
			array(
				'label'   => __( 'Period Separator', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::TEXT,
				'dynamic' => array( 'active' => true ),
				'default' => __( '/', 'ocean-elementor-widgets' ),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'table_features',
			array(
				'label' => __( 'Features', 'ocean-elementor-widgets' ),
			)
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'item_text',
			array(
				'label'       => __( 'Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'default'     => __( 'List Item', 'ocean-elementor-widgets' ),
			)
		);

		$repeater->add_control(
			'disable_item',
			array(
				'label'        => __( 'Disable Item?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
			)
		);

		$default_icon = array(
			'value'   => 'far fa-check-circle',
			'library' => 'fa-regular',
		);

		$repeater->add_control(
			'selected_item_icon',
			array(
				'label'            => __( 'Icon', 'ocean-elementor-widgets' ),
				'type'             => Controls_Manager::ICONS,
				'fa4compatibility' => 'item_icon',
				'default'          => $default_icon,
			)
		);

		$repeater->add_control(
			'item_icon_color',
			array(
				'label'   => __( 'Icon Color', 'ocean-elementor-widgets' ),
				'type'    => Controls_Manager::COLOR,
				'default' => '#3fc893',
				'selectors' 	=> [
					'{{WRAPPER}} .oew-pricing-table {{CURRENT_ITEM}} svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .oew-pricing-table {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
				],
			)
		);

		$repeater->add_control(
			'item_tooltip',
			array(
				'label' => __( 'Tooltip', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::SWITCHER,
			)
		);

		$repeater->add_control(
			'item_tooltip_position',
			array(
				'label'     => __( 'Tooltip Position', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 's',
				'options'   => array(
					'n'      => __( 'Top', 'ocean-elementor-widgets' ),
					'ne-alt' => __( 'Top Start', 'ocean-elementor-widgets' ),
					'ne'     => __( 'Top End', 'ocean-elementor-widgets' ),
					'e'      => __( 'Right', 'ocean-elementor-widgets' ),
					'se-alt' => __( 'Right Start', 'ocean-elementor-widgets' ),
					'se'     => __( 'Right End', 'ocean-elementor-widgets' ),
					's'      => __( 'Bottom', 'ocean-elementor-widgets' ),
					'sw-alt' => __( 'Bottom Start', 'ocean-elementor-widgets' ),
					'sw'     => __( 'Bottom End', 'ocean-elementor-widgets' ),
					'w'      => __( 'Left', 'ocean-elementor-widgets' ),
					'nw-alt' => __( 'Left Start', 'ocean-elementor-widgets' ),
					'nw'     => __( 'Left End', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'item_tooltip' => 'yes',
				),
			)
		);

		$repeater->add_control(
			'item_tooltip_content',
			array(
				'label'       => __( 'Tooltip Content', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => array( 'active' => true ),
				'label_block' => true,
				'default'     => __( 'Add your tooltip content here', 'ocean-elementor-widgets' ),
				'condition'   => array(
					'item_tooltip' => 'yes',
				),
			)
		);

		$this->add_control(
			'items',
			array(
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => array(
					array(
						'item_text'          => __( 'List Item #1', 'ocean-elementor-widgets' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #2', 'ocean-elementor-widgets' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #3', 'ocean-elementor-widgets' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #4', 'ocean-elementor-widgets' ),
						'selected_item_icon' => $default_icon,
					),
					array(
						'item_text'          => __( 'List Item #5', 'ocean-elementor-widgets' ),
						'selected_item_icon' => $default_icon,
					),
				),
				'title_field' => '{{{ item_text }}}',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button',
			array(
				'label' => __( 'Button', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'button_text',
			array(
				'label'       => __( 'Button Text', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Buy Now', 'ocean-elementor-widgets' ),
				'label_block' => true,
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'link',
			array(
				'label'       => __( 'Link', 'ocean-elementor-widgets' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'ocean-elementor-widgets' ),
				'default'     => array(
					'url' => '#',
				),
				'dynamic'     => array(
					'active' => true,
				),
			)
		);

		$this->add_control(
			'footer_additional_info',
			array(
				'label'     => __( 'Additional Info', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXTAREA,
				'default'   => __( 'This is text element', 'ocean-elementor-widgets' ),
				'rows'      => 3,
				'dynamic'   => array(
					'active' => true,
				),
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon',
			array(
				'label' => __( 'Ribbon', 'ocean-elementor-widgets' ),
			)
		);

		$this->add_control(
			'ribbon',
			array(
				'label'        => __( 'Featured?', 'ocean-elementor-widgets' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'ribbon_style',
			array(
				'label'     => __( 'Ribbon Style', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'ribbon-1',
				'options'   => array(
					'ribbon-1' => __( 'Style 1', 'ocean-elementor-widgets' ),
					'ribbon-2' => __( 'Style 2', 'ocean-elementor-widgets' ),
					'ribbon-3' => __( 'Style 3', 'ocean-elementor-widgets' ),
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_title',
			array(
				'label'     => __( 'Ribbon Text', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::TEXT,
				'dynamic'   => array( 'active' => true ),
				'default'   => __( 'Popular', 'ocean-elementor-widgets' ),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_alignment',
			array(
				'label'          => __( 'Ribbon Alignment', 'ocean-elementor-widgets' ),
				'type'           => Controls_Manager::CHOOSE,
				'default'        => 'right',
				'options'        => array(
					'left'  => array(
						'title' => __( 'Left', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => __( 'Right', 'ocean-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'style_transfer' => true,
				'condition'      => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_table',
			array(
				'label' => __( 'Pricing Table', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'table_background',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'table_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'table_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_margin',
			array(
				'label'      => __( 'margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'table_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-header' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} 0 0;',
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-footer' => 'border-radius: 0 0 {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'table_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-pricing-table',
			)
		);

		$this->add_control(
			'table_alignment',
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
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table' => 'text-align: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_icon_style',
			array(
				'label'     => __( 'Icon Box', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_size',
			array(
				'label'     => __( 'Icon Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 30,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon svg' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_box_width',
			array(
				'label'      => __( 'Icon Box Width', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%' ),
				'default'    => array(
					'size' => 80,
					'unit' => 'px',
				),
				'range'      => array(
					'px' => array(
						'max' => 300,
					),
					'%'  => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon' => 'width: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_box_height',
			array(
				'label'     => __( 'Icon Box Height', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 80,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 200,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon' => 'height: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'icon_shadow',
				'label'     => __( 'Box Shadow', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon',
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->start_controls_tabs( 'icon_style' );

		$this->start_controls_tab(
			'icon_normal',
			array(
				'label'     => __( 'Normal', 'ocean-elementor-widgets' ),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'icon_hover',
			array(
				'label'     => __( 'Hover', 'ocean-elementor-widgets' ),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_hover_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon:hover' => 'background-color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon:hover' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style' => 'style-2',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'icon_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style-2',
				),
			)
		);

		$this->add_control(
			'icon_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style' => 'style-2',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_header',
			array(
				'label' => __( 'Header', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'header_background',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-header' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'header_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-header .oew-pricing-table-heading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'header_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-header' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'header_margin',
			array(
				'label'      => __( 'margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-header' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'header_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-header',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'header_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-header .oew-pricing-table-heading',
			)
		);

		$this->add_control(
			'sub_heading_title',
			array(
				'label' => __( 'Sub Heading', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'sub_heading_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-subheading' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'sub_heading_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-subheading',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_price',
			array(
				'label' => __( 'Price', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'price_background',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-prices' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'price_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-prices, {{WRAPPER}} .oew-pricing-table.oew-pricing-table-style-2 .oew-pricing-table-original-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'price_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-prices' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'price_margin',
			array(
				'label'      => __( 'margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-prices' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'price_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-prices .oew-pricing-table-price',
			)
		);

		$this->add_control(
			'onsale_title',
			array(
				'label'     => __( 'On Sale Price', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_control(
			'onsale_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-onsale-price' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'onsale_typo',
				'selector'  => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-onsale-price',
				'condition' => array(
					'onsale' => 'yes',
				),
			)
		);

		$this->add_control(
			'period_title',
			array(
				'label' => __( 'Period', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_control(
			'period_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-details' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'period_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-details',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_features_list',
			array(
				'label' => __( 'Features List', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'features_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'features_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'features_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_margin',
			array(
				'label'      => __( 'margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'features_border',
				'label'       => __( 'Border', 'ocean-elementor-widgets' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list',
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'features_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list',
			)
		);

		$this->add_control(
			'features_icons_size',
			array(
				'label'     => __( 'Icons Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 20,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_space_between',
			array(
				'label'     => __( 'Space Between', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 5,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list li' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'features_between_border_color',
			array(
				'label'     => __( 'Border Color Between', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-list li' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_footer_style',
			array(
				'label' => __( 'Footer', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'footer_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-footer' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'footer_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-footer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'footer_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-footer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_title',
			array(
				'label' => __( 'Button', 'ocean-elementor-widgets' ),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'button_typo',
				'selector' => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button',
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'button_shadow',
				'label'    => __( 'Box Shadow', 'ocean-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button',
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
			'button_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button' => 'color: {{VALUE}};',
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
			'button_hover_bg',
			array(
				'label'     => __( 'Background', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'button_hover_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'button_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'  => 'before',
			)
		);

		$this->add_control(
			'button_margin',
			array(
				'label'      => __( 'Margin', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'button_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'additional_info_title',
			array(
				'label'     => __( 'Additional Info', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'      => 'additional_info_typo',
				'selector'  => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-additional-info',
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->add_control(
			'additional_info_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-additional-info' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->add_control(
			'additional_info_padding',
			array(
				'label'      => __( 'Padding', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-additional-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'condition'  => array(
					'style!' => 'style-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_ribbon_style',
			array(
				'label'     => __( 'Ribbon', 'ocean-elementor-widgets' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_size',
			array(
				'label'     => __( 'Font Size', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 10,
					'unit' => 'px',
				),
				'range'     => array(
					'px' => array(
						'max' => 50,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-ribbon' => 'font-size: {{SIZE}}{{UNIT}};',
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-ribbon' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_control(
			'ribbon_bg',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-ribbon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .oew-pricing-table .oew-pricing-table-ribbon.oew-pricing-table-ribbon-2:after' => 'border-bottom-color: {{VALUE}};',
				),
				'condition' => array(
					'ribbon' => 'yes',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'ribbon_shadow',
				'label'     => __( 'Shadow', 'ocean-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .oew-pricing-table .oew-pricing-table-ribbon.oew-pricing-table-ribbon-1',
				'condition' => array(
					'ribbon'       => 'yes',
					'ribbon_style' => 'ribbon-1',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_tooltips_style',
			array(
				'label' => __( 'Tooltips', 'ocean-elementor-widgets' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'tooltips_typo',
				'selector' => 'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_control(
			'tooltips_background',
			array(
				'label'     => __( 'Background Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box' => 'background-color: {{VALUE}};',
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box > .tippy-svg-arrow' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'tooltips_color',
			array(
				'label'     => __( 'Color', 'ocean-elementor-widgets' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'tooltips_border',
				'label'    => __( 'Border', 'ocean-elementor-widgets' ),
				'selector' => 'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->add_responsive_control(
			'tooltips_border_radius',
			array(
				'label'      => __( 'Border Radius', 'ocean-elementor-widgets' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'tooltips_box_shadow',
				'selector' => 'div[id*="tippy-"].oew-hotspot-powertip-{{ID}} .tippy-box',
			)
		);

		$this->end_controls_section();

	}

	private function render_currency_symbol( $symbol, $location ) {
		$currency_position = $this->get_settings( 'currency_position' );
		$location_setting  = ! empty( $currency_position ) ? $currency_position : 'before';

		if ( ! empty( $symbol ) && $location === $location_setting ) {
			echo '<span class="oew-pricing-table-currency oew-currency-' . $location . '">' . $symbol . '</span>';
		}
	}

	private function get_currency_symbol( $symbol_name ) {
		$symbols = array(
			'dollar'       => '&#36;',
			'euro'         => '&#128;',
			'franc'        => '&#8355;',
			'pound'        => '&#163;',
			'ruble'        => '&#8381;',
			'shekel'       => '&#8362;',
			'baht'         => '&#3647;',
			'yen'          => '&#165;',
			'won'          => '&#8361;',
			'guilder'      => '&fnof;',
			'peso'         => '&#8369;',
			'peseta'       => '&#8359',
			'lira'         => '&#8356;',
			'rupee'        => '&#8360;',
			'indian_rupee' => '&#8377;',
			'real'         => 'R$',
			'krona'        => 'kr',
		);

		return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
	}

	protected function render() {
		$settings     = $this->get_settings_for_display();
		$style        = $settings['style'];
		$bg_image     = '';
		$title_tag    = $settings['title_tag'];
		$currency     = $settings['currency_symbol'];
		$symbol       = '';
		$features     = $settings['items'];
		$ribbon       = $settings['ribbon'];
		$ribbon_style = $settings['ribbon_style'];
		$ribbon_title = $settings['ribbon_title'];

		if ( ! empty( $currency ) ) {
			if ( 'custom' !== $currency ) {
				$symbol = $this->get_currency_symbol( $currency );
			} else {
				$symbol = $settings['currency_symbol_custom'];
			}
		}

		$this->add_render_attribute(
			'wrapper',
			'class',
			array(
				'oew-pricing-table',
				'oew-pricing-table-' . $style,
			)
		);

		if ( 'ribbon-2' != $ribbon_style && 'yes' === $ribbon && ! empty( $ribbon_title ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'featured' );
		}

		$this->add_render_attribute( 'button', 'class', 'oew-pricing-table-button' );

		if ( ! empty( $settings['link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['link'] );
		}

		$this->add_render_attribute( 'header', 'class', 'oew-pricing-table-header' );
		$this->add_render_attribute( 'title', 'class', 'oew-pricing-table-heading' );
		$this->add_render_attribute( 'sub_title', 'class', 'oew-pricing-table-subheading' );
		$this->add_render_attribute( 'period', 'class', 'oew-pricing-table-period' );
		$this->add_render_attribute( 'footer_additional_info', 'class', 'oew-pricing-table-additional-info' );
		$this->add_render_attribute( 'ribbon_title', 'class', 'oew-pricing-table-ribbon-inner' );

		$this->add_inline_editing_attributes( 'title', 'none' );
		$this->add_inline_editing_attributes( 'sub_heading', 'none' );
		$this->add_inline_editing_attributes( 'period', 'none' );
		$this->add_inline_editing_attributes( 'footer_additional_info' );
		$this->add_inline_editing_attributes( 'button_text' );
		$this->add_inline_editing_attributes( 'ribbon_title' );

		if ( 'style-3' === $style ) {
			if ( ! empty( $settings['selected_table_img']['id'] ) ) {
				$bg_image = Group_Control_Image_Size::get_attachment_image_src( $settings['selected_table_img']['id'], 'selected_table_img', $settings );
			} elseif ( ! empty( $settings['selected_table_img']['url'] ) ) {
				$bg_image = $settings['selected_table_img']['url'];
			}

			$this->add_render_attribute(
				'header',
				'style',
				array(
					'background-image: url(' . $bg_image . ');',
				)
			);
		} ?>

		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>

			<?php
			// Icon
			if ( 'style-2' === $style && ( ! empty( $settings['table_icon'] ) || ! empty( $settings['selected_table_icon'] ) ) ) :
				?>
				<div class="oew-pricing-table-icon">
					<?php
					$migrated = isset( $settings['__fa4_migrated']['selected_table_icon'] );
					$is_new   = ! isset( $settings['table_icon'] ) && Icons_Manager::is_migration_allowed();

					if ( $is_new || $migrated ) :
						Icons_Manager::render_icon( $settings['selected_table_icon'], array( 'aria-hidden' => 'true' ) );
					else :
						?>
						<i class="<?php echo esc_attr( $settings['table_icon'] ); ?>" aria-hidden="true"></i>
						<?php
					endif;
					?>
				</div>
				<?php
			endif;

			// Heading
			if ( $settings['title'] || $settings['sub_title'] ) :
				?>
				<div <?php echo $this->get_render_attribute_string( 'header' ); ?>>
					<?php
					if ( ! empty( $settings['title'] ) ) :
						?>
						<<?php echo $title_tag . ' ' . $this->get_render_attribute_string( 'title' ); ?>><?php echo $settings['title'] . '</' . $title_tag; ?>>
						<?php
					endif;
					?>

					<?php
					if ( ! empty( $settings['sub_title'] ) ) :
						?>
						<span <?php echo $this->get_render_attribute_string( 'sub_title' ); ?>><?php echo $settings['sub_title']; ?></span>
						<?php
					endif;
					?>
				</div>
				<?php
			endif;
			?>

			<div class="oew-pricing-table-prices">

				<?php
				if ( ! empty( $settings['price'] ) ) :
					?>
					<div class="oew-pricing-table-price">
						<?php
						if ( 'yes' === $settings['onsale'] && ! empty( $settings['onsale_price'] ) ) :
							?>
							<span class="oew-pricing-table-onsale-price">
								<?php
								$this->render_currency_symbol( $symbol, 'before' );
								echo $settings['onsale_price'];
								$this->render_currency_symbol( $symbol, 'after' );
								?>
							</span>
							<?php
						endif;
						?>

						<span class="oew-pricing-table-original-price">
							<?php
							$this->render_currency_symbol( $symbol, 'before' );
							echo $settings['price'];
							$this->render_currency_symbol( $symbol, 'after' );
							?>
						</span>
					</div>
					<?php
				endif;

				if ( ! empty( $settings['period'] ) ) :
					?>
					<div class="oew-pricing-table-details">
						<?php
						if ( ! empty( $settings['separator'] ) ) :
							?>
							<span class="oew-pricing-table-period-separator"><?php echo $settings['separator']; ?></span>
							<?php
						endif;
						?>

						<span <?php echo $this->get_render_attribute_string( 'period' ); ?>><?php echo $settings['period']; ?></span>
					</div>
					<?php
				endif;
				?>
			</div>

			<?php
			// Features
			if ( ! empty( $features ) ) :
				?>
				<ul class="oew-pricing-table-list">
					<?php
					foreach ( $features as $index => $item ) :
						$key = $this->get_repeater_setting_key( 'item_li', 'items', $index );
						$this->add_render_attribute( $key, 'class', 'elementor-repeater-item-' . $item['_id'] );

						if ( 'yes' === $item['disable_item'] ) {
							$this->add_render_attribute( $key, 'class', 'disable-item' );
						}

						$tooltip    = $item['item_tooltip'];
						$tooltipKey = $this->get_repeater_setting_key( 'tooltip', 'items', $index );

						if ( 'yes' == $tooltip ) {
							$this->add_render_attribute(
								$tooltipKey,
								array(
									'class' => array(
										'oew-pricing-table-tooltip',
										'oew-tooltip-' . $item['item_tooltip_position'],
									),
									'title' => $this->parse_text_editor( $item['item_tooltip_content'] ),
								)
							);
						}

						$repeater_setting_key = $this->get_repeater_setting_key( 'item_text', 'items', $index );
						$this->add_inline_editing_attributes( $repeater_setting_key );

						$migrated = isset( $item['__fa4_migrated']['selected_item_icon'] );
						$is_new   = ! isset( $item['item_icon'] ) && Icons_Manager::is_migration_allowed();
						?>

						<li <?php echo $this->get_render_attribute_string( $key ); ?>>
							<?php
							if ( 'yes' == $tooltip ) {
								?>
								<span <?php echo $this->get_render_attribute_string( $tooltipKey ); ?>>
								<?php
							}

							if ( ! empty( $item['item_icon'] ) || ! empty( $item['selected_item_icon'] ) ) :

								if ( $is_new || $migrated ) :
									Icons_Manager::render_icon( $item['selected_item_icon'], array( 'aria-hidden' => 'true' ) );
								else :
									?>
									<i class="<?php echo esc_attr( $item['item_icon'] ); ?>" aria-hidden="true"></i>
									<?php
								endif;

							endif;

							if ( ! empty( $item['item_text'] ) ) :
								?>

								<span <?php echo $this->get_render_attribute_string( $repeater_setting_key ); ?>>
									<?php echo $item['item_text']; ?>
								</span>

								<?php
							else :
								echo '&nbsp;';
							endif;

							if ( 'yes' == $tooltip ) {
								?>
								</span>
								<?php
							}
							?>
						</li>
						<?php
					endforeach;
					?>
				</ul>
				<?php
			endif;

			// Button
			if ( ! empty( $settings['button_text'] ) || ! empty( $settings['footer_additional_info'] ) ) :
				?>
				<div class="oew-pricing-table-footer">
					<?php
					if ( ! empty( $settings['button_text'] ) ) :
						?>
						<a <?php echo $this->get_render_attribute_string( 'button' ); ?>><?php echo $settings['button_text']; ?></a>
						<?php
					endif;

					if ( 'style-1' != $settings['style'] && ! empty( $settings['footer_additional_info'] ) ) :
						?>
						<div <?php echo $this->get_render_attribute_string( 'footer_additional_info' ); ?>><?php echo $settings['footer_additional_info']; ?></div>
						<?php
					endif;
					?>
				</div>
				<?php
			endif;

			// Ribbon
			if ( 'yes' === $ribbon && ! empty( $ribbon_title ) ) :
				$this->add_render_attribute(
					'ribbon-wrapper',
					'class',
					array(
						'oew-pricing-table-ribbon',
						'oew-pricing-table-' . $ribbon_style,
						'oew-pricing-table-ribbon-' . $settings['ribbon_alignment'],
					)
				);
				?>

				<div <?php echo $this->get_render_attribute_string( 'ribbon-wrapper' ); ?>>
					<div <?php echo $this->get_render_attribute_string( 'ribbon_title' ); ?>><?php echo $settings['ribbon_title']; ?></div>
				</div>
				<?php
			endif;
			?>

		</div>

		<?php
	}

	/**
	 * Render Price Table widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template() {
		?>
		<#
			var symbols = {
				dollar: '&#36;',
				euro: '&#128;',
				franc: '&#8355;',
				pound: '&#163;',
				ruble: '&#8381;',
				shekel: '&#8362;',
				baht: '&#3647;',
				yen: '&#165;',
				won: '&#8361;',
				guilder: '&fnof;',
				peso: '&#8369;',
				peseta: '&#8359;',
				lira: '&#8356;',
				rupee: '&#8360;',
				indian_rupee: '&#8377;',
				real: 'R$',
				krona: 'kr'
			};

			var symbol 			= '',
				iconsHTML 		= {},
				$bg_image 		= '',
				iconHTML 		= elementor.helpers.renderIcon( view, settings.selected_table_icon, { 'aria-hidden': true }, 'i' , 'object' ),
				migrated 		= elementor.helpers.isIconMigrated( settings, 'selected_table_icon' );

			if ( settings.currency_symbol ) {
				if ( 'custom' !== settings.currency_symbol ) {
					symbol = symbols[ settings.currency_symbol ] || '';
				} else {
					symbol = settings.currency_symbol_custom;
				}
			}

			view.addRenderAttribute( 'wrapper', 'class', ['oew-pricing-table', 'oew-pricing-table-' + settings.style] );

			if ( 'ribbon-2' != settings.ribbon_style && 'yes' === settings.ribbon && ! _.isEmpty( settings.ribbon_title ) ) {
				view.addRenderAttribute( 'wrapper', 'class', 'featured' );
			}

			view.addRenderAttribute( 'button', 'class', 'oew-pricing-table-button' );

			if ( ! _.isEmpty( settings.link.url ) ) {
				view.addRenderAttribute( 'button', settings.link );
			}

			view.addRenderAttribute( 'header', 'class', 'oew-pricing-table-header' );
			view.addRenderAttribute( 'title', 'class', 'oew-pricing-table-heading' );
			view.addRenderAttribute( 'sub_title', 'class', 'oew-pricing-table-subheading' );
			view.addRenderAttribute( 'period', 'class', 'oew-pricing-table-period' );
			view.addRenderAttribute( 'footer_additional_info', 'class', 'oew-pricing-table-additional-info' );
			view.addRenderAttribute( 'ribbon_title', 'class', 'oew-pricing-table-ribbon-inner' );

			view.addInlineEditingAttributes( 'title', 'none' );
			view.addInlineEditingAttributes( 'sub_heading', 'none' );
			view.addInlineEditingAttributes( 'period', 'none' );
			view.addInlineEditingAttributes( 'footer_additional_info' );
			view.addInlineEditingAttributes( 'button_text' );
			view.addInlineEditingAttributes( 'ribbon_title' );

			if ( 'style-3' === settings.style ) {
				if ( '' !== settings.selected_table_img.url ) {
					var bg_image = {
						id: settings.selected_table_img.id,
						url: settings.selected_table_img.url,
						size: settings.selected_table_img_size,
						dimension: settings.selected_table_img_custom_dimension,
						model: view.getEditModel()
					};

					var bgImageUrl = elementor.imagesManager.getImageUrl( bg_image );
				}

				view.addRenderAttribute( 'header', 'style', 'background-image: url(' + bgImageUrl + ');' );
			}
		#>

		<div {{{ view.getRenderAttributeString( 'wrapper' ) }}}>

			<#
			if ( 'style-2' === settings.style && ( ! _.isEmpty( settings.table_icon ) || ! _.isEmpty( settings.selected_table_icon ) ) ) { #>
				<div class="oew-pricing-table-icon">
					<#
					if ( iconHTML && iconHTML.rendered && ( ! settings.table_icon || migrated ) ) { #>
						{{{ iconHTML.value }}}
					<# } else { #>
						<i class="{{ settings.table_icon }}"></i>
					<#
					} #>
				</div>
			<#
			}

			if ( settings.title || settings.sub_title ) { #>
				<div {{{ view.getRenderAttributeString( 'header' ) }}}>
					<#
					if ( ! _.isEmpty( settings.title ) ) { #>
						<{{ settings.title_tag }} {{{ view.getRenderAttributeString( 'title' ) }}}>{{{ settings.title }}}</{{ settings.title_tag }}>
					<#
					}

					if ( ! _.isEmpty( settings.sub_title ) ) { #>
						<span {{{ view.getRenderAttributeString( 'sub_title' ) }}}>{{{ settings.sub_title }}}</span>
					<#
					} #>
				</div>
			<#
			} #>

			<div class="oew-pricing-table-prices">

				<#
				if ( ! _.isEmpty( settings.price ) ) { #>
					<div class="oew-pricing-table-price">
						<#
						if ( 'yes' === settings.onsale && ! _.isEmpty( settings.onsale_price ) ) { #>
							<span class="oew-pricing-table-onsale-price">
								<# if ( ! _.isEmpty( symbol ) && 'before' == settings.currency_position ) { #>
									<span class="oew-pricing-table-currency oew-currency-before">{{{ symbol }}}</span>
								<# } #>
								{{{ settings.onsale_price }}}
								<# if ( ! _.isEmpty( symbol ) && 'after' == settings.currency_position ) { #>
									<span class="oew-pricing-table-currency oew-currency-after">{{{ symbol }}}</span>
								<# } #>
							</span>
						<#
						} #>

						<span class="oew-pricing-table-original-price">
							<# if ( ! _.isEmpty( symbol ) && 'before' == settings.currency_position ) { #>
								<span class="oew-pricing-table-currency oew-currency-before">{{{ symbol }}}</span>
							<# } #>
							{{{ settings.price }}}
							<# if ( ! _.isEmpty( symbol ) && 'after' == settings.currency_position ) { #>
								<span class="oew-pricing-table-currency oew-currency-after">{{{ symbol }}}</span>
							<# } #>
						</span>
					</div>
				<#
				}

				if ( ! _.isEmpty( settings.period ) ) { #>
					<div class="oew-pricing-table-details">
						<#
						if ( ! _.isEmpty( settings.separator ) ) { #>
							<span class="oew-pricing-table-period-separator">{{{ settings.separator }}}</span>
						<#
						} #>

						<span {{{ view.getRenderAttributeString( 'period' ) }}}>{{{ settings.period }}}</span>
					</div>
				<#
				} #>
			</div>

			<#
			if ( ! _.isEmpty( settings.items ) ) { #>
				<ul class="oew-pricing-table-list">
					<# _.each( settings.items, function( item, index ) {
						var key = view.getRepeaterSettingKey( 'item_li', 'items', index );

						view.addRenderAttribute( key, 'class', 'elementor-repeater-item-' + item._id );

						if ( item.disable_item ) {
							view.addRenderAttribute( key, 'class', 'disable-item' );
						}

						var tooltip 	= item.item_tooltip,
							tooltipKey 	= view.getRepeaterSettingKey( 'tooltip', 'items', index );

						if ( 'yes' == tooltip ) {
							view.addRenderAttribute( tooltipKey, 'class', 'oew-pricing-table-tooltip' );
							view.addRenderAttribute( tooltipKey, 'class', 'oew-tooltip-' + item.item_tooltip_position );
							view.addRenderAttribute( tooltipKey, 'title', item.item_tooltip_content );
						}

						var featureKey = view.getRepeaterSettingKey( 'item_text', 'items', index ),
							migrated = elementor.helpers.isIconMigrated( item, 'selected_item_icon' );

						view.addInlineEditingAttributes( featureKey ); #>

						<li {{{ view.getRenderAttributeString( key ) }}}>
							<# if ( 'yes' == tooltip ) { #>
								<span {{{ view.getRenderAttributeString( tooltipKey ) }}}>
							<# }

							if ( item.item_icon  || item.selected_item_icon ) {
								iconsHTML[ index ] = elementor.helpers.renderIcon( view, item.selected_item_icon, { 'aria-hidden': 'true' }, 'i', 'object' );
								if ( ( ! item.item_icon || migrated ) && iconsHTML[ index ] && iconsHTML[ index ].rendered ) { #>
									{{{ iconsHTML[ index ].value }}}
								<# } else { #>
									<i class="{{ item.item_icon }}" aria-hidden="true"></i>
								<# }
							} #>

							<# if ( ! _.isEmpty( item.item_text.trim() ) ) { #>
								<span {{{ view.getRenderAttributeString( featureKey ) }}}>{{{ item.item_text }}}</span>
							<# } else { #>
								&nbsp;
							<# }

							if ( 'yes' == tooltip ) { #>
								</span>
							<# } #>
						</li>
					<# } ); #>
				</ul>
			<#
			}
			
			if ( ! _.isEmpty( settings.button_text ) || ! _.isEmpty( settings.footer_additional_info ) ) { #>
				<div class="oew-pricing-table-footer">
					<#
					if ( ! _.isEmpty( settings.button_text ) ) { #>
						<a {{{ view.getRenderAttributeString( 'button' ) }}}>{{{ settings.button_text }}}</a>
					<#
					}

					if ( 'style-1' != settings.style && ! _.isEmpty( settings.footer_additional_info ) ) { #>
						<div {{{ view.getRenderAttributeString( 'footer_additional_info' ) }}}>{{{ settings.footer_additional_info }}}</div>
					<#
					} #>
				</div>
			<#
			}

			if ( 'yes' === settings.ribbon && ! _.isEmpty( settings.ribbon_title ) ) {
				view.addRenderAttribute( 'ribbon-wrapper', 'class', [
					'oew-pricing-table-ribbon',
					'oew-pricing-table-' + settings.ribbon_style,
					'oew-pricing-table-ribbon-' + settings.ribbon_alignment,
				] ); #>

				<div {{{ view.getRenderAttributeString( 'ribbon-wrapper' ) }}}>
					<div {{{ view.getRenderAttributeString( 'ribbon_title' ) }}}>{{{ settings.ribbon_title }}}</div>
				</div>
			<#
			} #>

		</div>

		<?php
	}

}
