<?php

/**
 * 
 *
 * @package Bussiness buttons
 */

namespace Four_Widget;

// Elementor Classes.
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Repeater;
use Elementor\Widget_Button;
use Elementor\Group_Control_Background;
use Four_Widget\Classes\UFW_Helper;

if (!defined('ABSPATH')) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Buttons.
 */
class Bussiness_Buttons extends Widget_Base
{

	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		//wp_register_script( 'dual-button-handle', 'path/to/file.js', [ 'elementor-frontend' ], '1.0.0', true );
		wp_register_style('dual-button-style-handle', FOUR_WIDGET_URL . 'includes/css/dual-button.min.css');
	}


	// public function get_script_depends() {
	// 	return [];
	// }

	public function get_style_depends()
	{
		return ['dual-button-style-handle'];
	}

	/**
	 * Retrieve Buttons Widget name.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'bussiness-button';
	}

	/**
	 * Retrieve Buttons Widget title.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return 'MP - Click To Chat';
	}

	/**
	 * Retrieve Buttons Widget icon.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'fw fw-mp-logo';
	}

	/**
	 * Retrieve Widget Keywords.
	 *
	 * @since 1.5.1
	 * @access public
	 *
	 * @return string Widget keywords.
	 */
	public function get_keywords()
	{
		return ['button'];
	}

	public function get_categories()
	{
		return ['fourwidget'];
	}

	/**
	 * Retrieve Button sizes.
	 *
	 * @since 0.0.1
	 * @access public
	 *
	 * @return array Button Sizes.
	 */
	public static function get_button_sizes()
	{
		return Widget_Button::get_button_sizes();
	}



	/**
	 * Register Buttons controls.
	 *
	 * @since 1.29.2
	 * @access protected
	 */
	protected function register_controls()
	{

		//$this->register_presets_control( 'Buttons', $this );

		// Content Tab.
		$this->register_buttons_content_controls();

		// Style Tab.
		$this->register_styling_style_controls();
		$this->register_color_content_controls();
		$this->register_spacing_content_controls();
		//	$this->register_helpful_information();
	}

	/**
	 * Register Buttons General Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_buttons_content_controls()
	{

		$this->start_controls_section(
			'section_buttons',
			array(
				'label' => __('MP - Click To Chat', 'four-widget'),
			)
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs('button_repeater');

		$repeater->start_controls_tab(
			'button_general',
			array(
				'label' => __('General', 'four_widget'),
			)
		);

		$repeater->add_control(
			'type_button',
			array(
				'label' => __('Button Type', 'fourwidget'),
				'type' => Controls_Manager::SELECT,
				'default' => 'Whatsapp',
				'options'    => array(
					'Whatsapp'  => __('Whatsapp', 'four_widget'),
					'Telegram' => __('Telegram', 'four_widget'),
					'Email' => __('Email', 'fourwidget'),
				),

			)
		);

		// $repeater->add_control(
		// 	'text',
		// 	array(
		// 		'label'       => __('Title', 'four_widget'),
		// 		'type'        => Controls_Manager::TEXT,
		// 		'default'     => __('', 'four_widget'),
		// 		'placeholder' => __('', 'four_widget'),
		// 		'dynamic'     => array(
		// 			'active' => true,
		// 		),
		// 		'title_field' => '{{{ type_button }}}'
				
		// 	)
		// );

		$repeater->add_control(
			'text_wa',
			array(
				'label'       => __('Phone', 'four_widget'),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('628xxx', 'four_widget'),
				'placeholder' => __('type phone by 628xxx', 'four_widget'),
				'dynamic'     => array(
					'active' => true,
				),
				'condition' => [
					'type_button' => 'Whatsapp'
				]
			)
		);

		$repeater->add_control(
			'text_telegram',
			array(
				'label'       => __('Username', 'four_widget'),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('', 'four_widget'),
				'placeholder' => __('type username without @', 'four_widget'),
				'dynamic'     => array(
					'active' => true,
				),
				'condition' => [
					'type_button' => 'Telegram'
				]
			)
		);

		$repeater->add_control(
			'text_email',
			array(
				'label'       => __('Email To', 'four_widget'),
				'type'        => Controls_Manager::TEXT,
				'default'     => __('', 'four_widget'),
				'placeholder' => __('type email destination', 'four_widget'),
				'dynamic'     => array(
					'active' => true,
				),
				'condition' => [
					'type_button' => 'Email'
				]
			)
		);


		// $repeater->add_control(
		// 	'link',
		// 	array(
		// 		'label'    => __('Link', 'four_widget'),
		// 		'type'     => Controls_Manager::URL,
		// 		'default'  => array(
		// 			'url'         => '#',
		// 			'is_external' => '',
		// 		),
		// 		'dynamic'  => array(
		// 			'active' => true,
		// 		),
		// 		'selector' => '',
		// 	)
		// );



		if (UFW_Helper::is_elementor_updated()) {


			$repeater->add_control(
				'new_icon',
				array(
					'label'            => __('Icon', 'four_widget'),
					'type'             => Controls_Manager::ICONS,
					'fa4compatibility' => 'icon',
					'fa4compatibility' => 'social',
					'default' => [
						'value' => 'fab fa-whatsapp',
						'library' => 'fa-brands',
					],
					'recommended' => [
						'fa-brands' => [
							'telegram',
							'whatsapp',

						],
						'fa-solid' => [
							'envelope',

						],
					],
				)
			);
		} else {

			$repeater->add_control(
				'icon',
				array(
					'label'       => __('Icon', 'four_widget'),
					'type'        => Controls_Manager::ICON,
					'label_block' => true,
					'default'  => 'fab fa-whatsapp'

				)
			);
		}

		$repeater->add_control(
			'icon_align',
			array(
				'label'      => __('Icon Position', 'four_widget'),
				'type'       => Controls_Manager::SELECT,
				'default'    => 'left',
				'options'    => array(
					'left'  => __('Before', 'four_widget'),
					'right' => __('After', 'four_widget'),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => UFW_Helper::get_new_icon_name('icon'),
							'operator' => '!=',
							'value'    => '',
						),
					),
				),
			)
		);

		$repeater->add_control(
			'icon_indent',
			array(
				'label'      => __('Icon Spacing', 'four_widget'),
				'type'       => Controls_Manager::SLIDER,
				'range'      => array(
					'px' => array(
						'max' => 50,
					),
				),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => UFW_Helper::get_new_icon_name('icon'),
							'operator' => '!=',
							'value'    => '',
						),
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$repeater->add_control(
			'css_id',
			array(
				'label'       => __('CSS ID', 'four_widget'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'title'       => __('Add your custom id WITHOUT the # key.', 'four_widget'),
			)
		);

		$repeater->add_control(
			'css_classes',
			array(
				'label'       => __('CSS Classes', 'four_widget'),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'title'       => __('Add space separated custom classes WITHOUT the dot.', 'four_widget'),
			)
		);

		$repeater->end_controls_tab();

		$repeater->start_controls_tab(
			'button_design',
			array(
				'label' => __('Style', 'four_widget'),
			)
		);

		$repeater->add_control(
			'html_message',
			array(
				'type'            => Controls_Manager::RAW_HTML,
				'raw'             => __('Set custom styles that will only affect this specific button.', 'four_widget'),
				'content_classes' => 'elementor-control-field-description',
			)
		);

		$repeater->add_control(
			'color_options',
			array(
				'label'     => __('Normal', 'four_widget'),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'btn_text_color',
			array(
				'label'     => __('Text Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button' => 'color: {{VALUE}};',
				),
			)
		);

		$repeater->add_control(
			'btn_background_color',
			array(
				'label'     => __('Background Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button' => 'background-color: {{VALUE}};',
				),
				'default' => 'green',
			)
		);

		$repeater->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'      => 'btn_border',
				'label'     => __('Border', 'four_widget'),
				'selector'  => '{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button',
				'separator' => 'before',
			)
		);

		$repeater->add_control(
			'btn_border_radius',
			array(
				'label'      => __('Border Radius', 'four_widget'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$repeater->add_control(
			'hover_options',
			array(
				'label' => __('Hover', 'four_widget'),
				'type'  => Controls_Manager::HEADING,
			)
		);

		$repeater->add_control(
			'btn_text_hover_color',
			array(
				'label'     => __('Text Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$repeater->add_control(
			'btn_background_hover_color',
			array(
				'label'     => __('Background Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$repeater->add_control(
			'btn_border_hover_color',
			array(
				'label'     => __('Border Hover Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .elementor-button:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$repeater->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'btn_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button, {{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button .elementor-button-icon i,{{WRAPPER}} {{CURRENT_ITEM}} a.elementor-button .elementor-button-icon svg',
			)
		);

		$repeater->end_controls_tab();

		$repeater->end_controls_tabs();

		$this->add_control(
			'buttons',
			array(
				'label'       => __('Dual Buttons', 'four_widget'),
				'type'        => Controls_Manager::REPEATER,
				'show_label'  => true,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ type_button }}}',
				'default'     => array(
					array(
						'text' => __('', 'four_widget'),

					),

				),
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Register Buttons Spacing Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_spacing_content_controls()
	{
		$this->start_controls_section(
			'general_spacing',
			array(
				'label' => __('Spacing', 'four_widget'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'gap',
			array(
				'label'      => __('Space between buttons', 'four_widget'),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array('px', 'em', 'rem'),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 1000,
					),
				),
				'default'    => array(
					'size' => 10,
					'unit' => 'px',
				),
				'selectors'  => array(
					'{{WRAPPER}} .ufw-dual-button-wrap .ufw-button-wrapper' => 'margin-right: calc( {{SIZE}}{{UNIT}} / 2) ; margin-left: calc( {{SIZE}}{{UNIT}} / 2);',
					'{{WRAPPER}}.ufw-button-stack-none .ufw-dual-button-wrap' => 'margin-right: calc( -{{SIZE}}{{UNIT}} / 2) ; margin-left: calc( -{{SIZE}}{{UNIT}} / 2);',
					'(desktop){{WRAPPER}}.ufw-button-stack-desktop .ufw-dual-button-wrap .ufw-button-wrapper'  => 'margin-bottom: calc( {{SIZE}}{{UNIT}} / 2 ); margin-top: calc( {{SIZE}}{{UNIT}} / 2 ); margin-right: 0; margin-left: 0;',
					'(desktop){{WRAPPER}}.ufw-button-stack-desktop .ufw-dual-button-wrap .ufw-button-wrapper:last-child' => 'margin-bottom: 0;',
					'(desktop){{WRAPPER}}.ufw-button-stack-desktop .ufw-dual-button-wrap .ufw-button-wrapper:first-child' => 'margin-top: 0;',
					'(tablet){{WRAPPER}}.ufw-button-stack-tablet .ufw-dual-button-wrap .ufw-button-wrapper'        => 'margin-bottom: calc( {{SIZE}}{{UNIT}} / 2 ); margin-top: calc( {{SIZE}}{{UNIT}} / 2 ); margin-right: 0; margin-left: 0;',
					'(tablet){{WRAPPER}}.ufw-button-stack-tablet .ufw-dual-button-wrap .ufw-button-wrapper:last-child' => 'margin-bottom: 0;',
					'(tablet){{WRAPPER}}.ufw-button-stack-tablet .ufw-dual-button-wrap .ufw-button-wrapper:first-child' => 'margin-top: 0;',
					'(mobile){{WRAPPER}}.ufw-button-stack-mobile .ufw-dual-button-wrap .ufw-button-wrapper'        => 'margin-bottom: calc( {{SIZE}}{{UNIT}} / 2 ); margin-top: calc( {{SIZE}}{{UNIT}} / 2 ); margin-right: 0; margin-left: 0;',
					'(mobile){{WRAPPER}}.ufw-button-stack-mobile .ufw-dual-button-wrap .ufw-button-wrapper:last-child' => 'margin-bottom: 0;',
					'(mobile){{WRAPPER}}.ufw-button-stack-mobile .ufw-dual-button-wrap .ufw-button-wrapper:first-child' => 'margin-top: 0;',
				),
			)
		);

		$this->add_control(
			'stack_on',
			array(
				'label'        => __('Stack on', 'four_widget'),
				'description'  => __('Choose on what breakpoint where the buttons will stack.', 'four_widget'),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'none',
				'options'      => array(
					'none'    => __('None', 'four_widget'),
					'desktop' => __('Desktop', 'four_widget'),
					'tablet'  => __('Tablet', 'four_widget'),
					'mobile'  => __('Mobile', 'four_widget'),
				),
				'prefix_class' => 'ufw-button-stack-',
			)
		);

		$this->end_controls_section();
	}

	// /**
	//  * Helpful Information.
	//  *
	//  * @since 1.1.0
	//  * @access protected
	//  */
	// protected function register_helpful_information()
	// {

	// 	$link = ufw_DOMAIN . 'docs/multi-buttons-widget/?utm_source=ufw-pro-dashboard&utm_medium=ufw-editor-screen&utm_campaign=ufw-pro-plugin';

	// 	if (parent::is_internal_links()) {
	// 		$this->start_controls_section(
	// 			'section_helpful_info',
	// 			array(
	// 				'label' => __('Helpful Information', 'four_widget'),
	// 			)
	// 		);

	// 		$this->add_control(
	// 			'help_doc_1',
	// 			array(
	// 				'type'            => Controls_Manager::RAW_HTML,
	// 				/* translators: %1$s doc link */
	// 				'raw'             => sprintf(__('%1$s Getting started article » %2$s', 'four_widget'), '<a href=' . $link . ' target="_blank" rel="noopener">', '</a>'),
	// 				'content_classes' => 'ufw-editor-doc',
	// 			)
	// 		);

	// 		$this->add_control(
	// 			'help_doc_2',
	// 			array(
	// 				'type'            => Controls_Manager::RAW_HTML,
	// 				/* translators: %1$s doc link */
	// 				'raw'             => sprintf(__('%1$s Getting started video » %2$s', 'four_widget'), '<a href="https://www.youtube.com/watch?v=Izbr-oO0VkU&list=PL1kzJGWGPrW_7HabOZHb6z88t_S8r-xAc&index=13" target="_blank" rel="noopener">', '</a>'),
	// 				'content_classes' => 'ufw-editor-doc',
	// 			)
	// 		);

	// 		$this->end_controls_section();
	// 	}
	// }

	/**
	 * Register Buttons Colors Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_color_content_controls()
	{

		$this->start_controls_section(
			'general_colors',
			array(
				'label' => __('Styling', 'four_widget'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->start_controls_tabs('_button_style');

		$this->start_controls_tab(
			'_button_normal',
			array(
				'label' => __('Normal', 'four_widget'),
			)
		);

		$this->add_control(
			'all_text_color',
			array(
				'label'     => __('Text Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} a.elementor-button' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'all_background_color',
			array(
				'label'     => __('Background Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_ACCENT,
				),
				'selectors' => array(
					'{{WRAPPER}} a.elementor-button' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'     => 'all_border',
				'label'    => __('Border', 'four_widget'),
				'selector' => '{{WRAPPER}} .elementor-button',
			)
		);

		$this->add_control(
			'all_border_radius',
			array(
				'label'      => __('Border Radius', 'four_widget'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'all_button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'all_button_hover',
			array(
				'label' => __('Hover', 'four_widget'),
			)
		);

		$this->add_control(
			'all_hover_color',
			array(
				'label'     => __('Text Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} a.elementor-button:hover' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'all_background_hover_color',
			array(
				'label'     => __('Background Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'global'    => array(
					'default' => Global_Colors::COLOR_ACCENT,
				),
				'selectors' => array(
					'{{WRAPPER}} a.elementor-button:hover' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'all_border_hover_color',
			array(
				'label'     => __('Border Hover Color', 'four_widget'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} a.elementor-button:hover' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'      => 'all_button_hover_box_shadow',
				'selector'  => '{{WRAPPER}} .elementor-button:hover',
				'separator' => 'after',
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Buttons Styling Controls.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function register_styling_style_controls()
	{

		$this->start_controls_section(
			'section_styling',
			array(
				'label' => __('Style', 'four_widget'),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_control(
			'size',
			array(
				'label'       => __('Size', 'four_widget'),
				'type'        => Controls_Manager::SELECT,
				'default'     => 'sm',
				'label_block' => true,
				'options'     => self::get_button_sizes(),
			)
		);

		$this->add_responsive_control(
			'padding',
			array(
				'label'      => __('Padding', 'four_widget'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array('px', 'em', '%'),
				'selectors'  => array(
					'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'all_typography',
				'global'   => array(
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				),
				'selector' => '{{WRAPPER}} a.elementor-button,{{WRAPPER}} a.elementor-button svg',
			)
		);

		$this->add_responsive_control(
			'align',
			array(
				'label'        => __('Alignment', 'four_widget'),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => array(
					'left'    => array(
						'title' => __('Left', 'four_widget'),
						'icon'  => 'fa fa-align-left',
					),
					'center'  => array(
						'title' => __('Center', 'four_widget'),
						'icon'  => 'fa fa-align-center',
					),
					'right'   => array(
						'title' => __('Right', 'four_widget'),
						'icon'  => 'fa fa-align-right',
					),
					'justify' => array(
						'title' => __('Justify', 'four_widget'),
						'icon'  => 'fa fa-align-justify',
					),
				),
				'default'      => 'center',
				'toggle'       => false,
				'prefix_class' => 'ufw%s-button-halign-',
			)
		);

		$this->add_control(
			'hover_animation',
			array(
				'label' => __('Hover Animation', 'four_widget'),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			)
		);

		$this->end_controls_section();
	}

	/**
	 * Render button widget text.
	 *
	 * @param array $button The item settings array.
	 * @param int   $i The index id.
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render_button_text($button, $i)
	{

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('content-wrapper', 'class', 'elementor-button-content-wrapper');
		$this->add_render_attribute('content-wrapper', 'class', 'ufw-buttons-icon-' . $button['icon_align']);

		$this->add_render_attribute('icon-align_' . $i, 'class', 'elementor-align-icon-' . $button['icon_align']);
		$this->add_render_attribute('icon-align_' . $i, 'class', 'elementor-button-icon');

		$this->add_render_attribute('btn-text_' . $i, 'class', 'elementor-button-text');
		$this->add_render_attribute('btn-text_' . $i, 'class', 'elementor-inline-editing');

		$text_key = $this->get_repeater_setting_key('text', 'buttons', $i);
		$this->add_inline_editing_attributes($text_key, 'none');
?>
		<span <?php echo wp_kses_post($this->get_render_attribute_string('content-wrapper')); ?>>
			<?php if (UFW_Helper::is_elementor_updated()) { ?>
				<?php if (!empty($button['icon']) || !empty($button['new_icon'])) : ?>
					<span <?php echo wp_kses_post($this->get_render_attribute_string('icon-align_' . esc_attr($i))); ?>>
						<?php
						$migrated = isset($button['__fa4_migrated']['new_icon']);
						$is_new   = !isset($button['icon']) && \Elementor\Icons_Manager::is_migration_allowed();
						if ($is_new || $migrated) {

							\Elementor\Icons_Manager::render_icon($button['new_icon'], array('aria-hidden' => 'true'));
						} elseif (!empty($button['icon'])) {
						?>
							<i class="<?php echo esc_attr($button['icon']); ?>" aria-hidden="true"></i>
						<?php } ?>
					</span>
				<?php endif; ?>
			<?php } elseif (!empty($button['icon'])) { ?>
				<span <?php echo wp_kses_post($this->get_render_attribute_string('icon-align_' . esc_attr($i))); ?>>
					<i class="<?php echo esc_attr($button['icon']); ?>" aria-hidden="true"></i>
				</span>
			<?php } ?>
			<span <?php echo wp_kses_post($this->get_render_attribute_string('btn-text_' . esc_attr($i))); ?> data-elementor-setting-key="<?php echo esc_attr($text_key); ?>" data-elementor-inline-editing-toolbar="none"><?php echo wp_kses_post($button['type_button']); ?></span>
		</span>
	<?php
	}

	/**
	 * Render Buttons output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 0.0.1
	 * @access protected
	 */
	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$node_id  = $this->get_id();
		$count    = count($settings['buttons']);
		ob_start();
	?>

		<div class="ufw-dual-button-outer-wrap">
			<div class="ufw-dual-button-wrap">
				<?php
				for ($i = 0; $i < $count; $i++) :
					if (!is_array($settings['buttons'][$i])) {
						continue;
					}
					$button = $settings['buttons'][$i];

					$this->add_render_attribute('button_wrap_' . $i, 'class', 'ufw-button-wrapper elementor-button-wrapper ufw-dual-button');
					$this->add_render_attribute('button_wrap_' . $i, 'class', 'elementor-repeater-item-' . $button['_id']);
					$this->add_render_attribute('button_wrap_' . $i, 'class', 'ufw-dual-button-' . $i);

					$this->add_render_attribute('button_' . $i, 'class', 'elementor-button-link elementor-button');

					if ('' !== $button['css_classes']) {
						$this->add_render_attribute('button_' . $i, 'class', $button['css_classes']);
					}

					if ('' !== $settings['size']) {
						$this->add_render_attribute('button_' . $i, 'class', 'elementor-size-' . $settings['size']);
					}

					if ('' !== $button['css_id']) {
						$this->add_render_attribute('button_' . $i, 'id', $button['css_id']);
					}

					if (!empty($button['type_button'])) {
						$mylink = array();
						$mytext = "";
						switch ($button['type_button']) {
							case 'Whatsapp':
								$mytext = $button['text_wa'];
								$mylink['url'] = "https://wa.me/$mytext";
								break;
							case 'Telegram':
								$mytext = $button['text_telegram'];
								$mylink['url'] = "https://t.me/$mytext";
								break;
							case 'Email':
								$mytext = $button['text_wa'];	
								$mylink['url'] = "mailto:$mytext";

								break;
						}

						$this->add_link_attributes('button_' . $i, $mylink);

						$this->add_render_attribute('button_' . $i, 'class', 'elementor-button-link');
					}

					if ($settings['hover_animation']) {
						$this->add_render_attribute('button_' . $i, 'class', 'elementor-animation-' . $settings['hover_animation']);
					}
				?>
					<div <?php echo wp_kses_post($this->get_render_attribute_string('button_wrap_' . esc_attr($i))); ?>>
						<a <?php echo wp_kses_post($this->get_render_attribute_string('button_' . esc_attr($i))); ?>>
							<?php $this->render_button_text($button, $i); ?>
						</a>
					</div>
				<?php endfor; ?>
			</div>
		</div>
	<?php
		$html = ob_get_clean();
		echo $html; //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Render button widgets output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.22.1
	 * @access protected
	 */
	protected function content_template()
	{
	?>

		<div class="ufw-dual-button-outer-wrap">
			<div class="ufw-dual-button-wrap">
				<# var iconsHTML={}; if ( settings.buttons ) { var counter=1; _.each( settings.buttons, function( item, index ) { var button_wrap='elementor-repeater-item-' + item._id + ' ufw-dual-button-' + counter; var button_class='elementor-size-' + settings.size + ' ' + item.css_classes; var buttonContentKey=view.getRepeaterSettingKey( 'text' , 'buttons' , index ); view.addRenderAttribute(buttonContentKey, 'class' , 'elementor-button-text' ); view.addInlineEditingAttributes( buttonContentKey, 'advanced' ); button_wrap +=' elementor-animation-' + settings.hover_animation; var new_icon_align='' ; var icon_align='' ; #>
					<div class="ufw-button-wrapper elementor-button-wrapper ufw-dual-button {{ button_wrap }}">

						<a id="{{ item.css_id }}" href="#" class="elementor-button-link elementor-button {{ button_class }}">
							<# new_icon_align=' ufw-buttons-icon-' + item.icon_align; #>
								<span class="elementor-button-content-wrapper{{ new_icon_align }}">
									<?php if (UFW_Helper::is_elementor_updated()) { ?>
										<# if ( item.icon || item.new_icon ) { icon_align='elementor-align-icon-' + item.icon_align; #>
											<span class="elementor-button-icon {{ icon_align }}">
												<# iconsHTML[ index ]=elementor.helpers.renderIcon( view, item.new_icon, { 'aria-hidden' : true }, 'i' , 'object' ); migrated=elementor.helpers.isIconMigrated( item, 'new_icon' ); #>
													<# if ( ( ! item.icon || migrated ) && iconsHTML[ index ] && iconsHTML[ index ].rendered ) { #>
														{{{ iconsHTML[ index ].value }}}
														<# } else { #>

															<i class="{{ item.icon }}" aria-hidden="true"></i>
															<# } #>
											</span>
											<# } #>
											<?php } else { ?>
												<# if ( item.icon ) { icon_align='elementor-align-icon-' + item.icon_align; #>
													<span class="elementor-button-icon {{ icon_align }}">
														<i class="{{ item.icon }}" aria-hidden="true"></i>
													</span>
													<# } #>
													<?php } ?>
													<span {{{ view.getRenderAttributeString( buttonContentKey ) }}}>{{ item.type_button }}</span>
								</span>
						</a>
					</div>
					<# counter++; }); } #>
			</div>
		</div>
<?php
	}
}
