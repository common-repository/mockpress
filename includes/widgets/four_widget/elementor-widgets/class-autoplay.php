<?php

/**
 * 
 *
 * @package Autoplay buttons
 */

namespace Four_Widget;

if (!defined('ABSPATH')) {
	exit;   // Exit if accessed directly.
}

use Elementor;
use Elementor\Widget_Base;
use Elementor\Widget_Button;
use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Icons_Manager;

/**
 * Class Autoplay Buttons.
 */
class Autoplay_Button extends Widget_Base
{

	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		wp_register_script('autoplay-js', FOUR_WIDGET_URL . '/includes/js/autoplay.js', ['jquery']);
		wp_register_style('autoplay-css', FOUR_WIDGET_URL . '/includes/css/autoplay.css');
	}

	public function get_script_depends()
	{
		return ['autoplay-js'];
	}

	public function get_style_depends()
	{
		return ['autoplay-css'];
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
		return 'autoplay-button';
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
		return 'MP - Button Play Music';
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
		return 'fw eicon-headphones';
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
		$this->register_content_control();
		$this->register_style_control();
	}

	protected function register_content_control()
	{
		$this->start_controls_section(
			'section_button',
			[
				'label' => esc_html__('MP - Play Music', 'elementor'),
			]
		);

		$this->add_control(
			'button_type',
			[
				'label' => esc_html__('Type', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__('Default', 'elementor'),
					'info' => esc_html__('Info', 'elementor'),
					'success' => esc_html__('Success', 'elementor'),
					'warning' => esc_html__('Warning', 'elementor'),
					'danger' => esc_html__('Danger', 'elementor'),
				],
				'prefix_class' => 'elementor-button-',
			]
		);

		$this->add_control(
			'text',
			[
				'label' => esc_html__('Text', 'elementor'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => esc_html__('Click here', 'elementor'),
				'placeholder' => esc_html__('Click here', 'elementor'),
			]
		);

		$this->add_control(
			'link',
			[
				'label' => esc_html__('Link / Anchor', 'elementor'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('https://your-link.com', 'elementor'),
				'default' => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'link_music',
			[
				'label' => esc_html__('Link Music', 'elementor'),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => esc_html__('https://your-link.com', 'elementor'),
				'default' => [
					'url' => 'https://audio.jukehost.co.uk/7W8uvAEA8hs1Sl2gYFj6H2kVa0yIWFn4',
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'elementor'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
						'title' => esc_html__('Left', 'elementor'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'elementor'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'elementor'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justified', 'elementor'),
						'icon' => 'eicon-text-align-justify',
					],

				],
				'default' => 'left',
				'prefix_class' => 'elementor%s-align-',


			]
		);

		$this->add_control(
			'size',
			[
				'label' => esc_html__('Size', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'xl',
				'options' => self::get_button_sizes(),
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__('Icon', 'elementor'),
				'type' => Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				// 'skin' => 'inline',
				'label_block' => true,
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__('Icon Position', 'elementor'),
				'type' => Controls_Manager::SELECT,
				'default' => 'left',
				'options' => [
					'left' => esc_html__('Before', 'elementor'),
					'right' => esc_html__('After', 'elementor'),
				],
				'condition' => [
					'selected_icon[value]!' => '',
				],
			]
		);

		$this->add_control(
			'icon_indent',
			[
				'label' => esc_html__('Icon Spacing', 'elementor'),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button .elementor-align-icon-right' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .elementor-button .elementor-align-icon-left' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'view',
			[
				'label' => esc_html__('View', 'elementor'),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->add_control(
			'button_css_id',
			[
				'label' => esc_html__('Button ID', 'elementor'),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => '',
				'title' => esc_html__('Add your custom id WITHOUT the Pound key. e.g: my-id', 'elementor'),
				'description' => sprintf(
					/* translators: 1: Code open tag, 2: Code close tag. */
					esc_html__('Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows %1$sA-z 0-9%2$s & underscore chars without spaces.', 'elementor'),
					'<code>',
					'</code>'
				),
				'separator' => 'before',

			]
		);

		$this->end_controls_section();
	}

	protected function register_style_control()
	{
		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__('Style', 'elementor'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'global' => [
					'default' => Global_Typography::TYPOGRAPHY_ACCENT,
				],
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'text_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => esc_html__('Normal', 'elementor'),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'fill: {{VALUE}}; color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__('Background', 'elementor'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .elementor-button',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => 'green',
						// 'global' => [
						// 	 'default' => Global_Colors::COLOR_PRIMARY,

						// ],
					],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => esc_html__('Hover', 'elementor'),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label' => esc_html__('Text Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-button:hover svg, {{WRAPPER}} .elementor-button:focus svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'button_background_hover',
				'label' => esc_html__('Background', 'elementor'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label' => esc_html__('Border Color', 'elementor'),
				'type' => Controls_Manager::COLOR,
				'condition' => [
					'border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button:hover, {{WRAPPER}} .elementor-button:focus' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__('Hover Animation', 'elementor'),
				'type' => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .elementor-button',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label' => esc_html__('Border Radius', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				// 'default' => [
				// 	'top' => '50',
				// 	'right' => '50',
				// 	'bottom' => '50',
				// 	'left' => '50',
				// 	'unit' => '%',
				// 	'isLinked' => true,
				// ],
				'size_units' => ['px', '%', 'em'],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'button_box_shadow',
				'selector' => '{{WRAPPER}} .elementor-button',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label' => esc_html__('Padding', 'elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'default' => [
					'top' => '10',
					'right' => '10',
					'bottom' => '10',
					'left' => '10',
					'unit' => 'px',
					'isLinked' => true,
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{

		$settings = $this->get_settings_for_display();

		$this->add_render_attribute('wrapper', 'class', 'elementor-button-wrapper myaudio-bullet');

		if (!empty($settings['link']['url'])) {
			$this->add_link_attributes('button', $settings['link']);
			$this->add_render_attribute('button', 'class', 'elementor-button-link');
		}

		$this->add_render_attribute('button', 'class', 'elementor-button');
		$this->add_render_attribute('button', 'role', 'button');

		if (!empty($settings['button_css_id'])) {
			$this->add_render_attribute('button', 'id', $settings['button_css_id']);
		}

		if (!empty($settings['size'])) {
			$this->add_render_attribute('button', 'class', 'elementor-size-' . $settings['size']);
		}

		if ($settings['hover_animation']) {
			$this->add_render_attribute('button', 'class', 'elementor-animation-' . $settings['hover_animation']);
		}

?>




		<div <?php $this->print_render_attribute_string('wrapper'); ?>>
			<a hasclick="0" id="myAudioClick" <?php $this->print_render_attribute_string('button'); ?>>
				<?php $this->render_text(); ?>
			</a>
		</div>
		<audio id="myAudio">
			<source src="<?= $settings['link_music']['url']; ?>">
		</audio>


	<?php
	}

	/**
	 * Render button text.
	 *
	 * Render button widget text.
	 *
	 * @since 1.5.0
	 * @access protected
	 */
	protected function render_text()
	{
		$settings = $this->get_settings_for_display();

		$migrated = isset($settings['__fa4_migrated']['selected_icon']);
		$is_new = empty($settings['icon']) && Icons_Manager::is_migration_allowed();

		if (!$is_new && empty($settings['icon_align'])) {
			// @todo: remove when deprecated
			// added as bc in 2.6
			//old default
			$settings['icon_align'] = $this->get_settings('icon_align');
		}

		$this->add_render_attribute([
			'content-wrapper' => [
				'class' => 'elementor-button-content-wrapper',
			],
			'icon-align' => [
				'class' => [
					'elementor-button-icon',
					'elementor-align-icon-' . $settings['icon_align'],
				],
			],
			'text' => [
				'class' => 'elementor-button-text',
			],
		]);

		$this->add_inline_editing_attributes('text', 'none');
	?>
		<span <?php $this->print_render_attribute_string('content-wrapper'); ?>>
			<?php if (!empty($settings['icon']) || !empty($settings['selected_icon']['value'])) : ?>
				<span <?php $this->print_render_attribute_string('icon-align'); ?>>
					<?php if ($is_new || $migrated) :
						Icons_Manager::render_icon($settings['selected_icon'], ['aria-hidden' => 'true']);
					else : ?>
						<i class="<?php echo esc_attr($settings['icon']); ?>" aria-hidden="true"></i>
					<?php endif; ?>
				</span>
			<?php endif; ?>
			<span <?php $this->print_render_attribute_string('text'); ?>><?php $this->print_unescaped_setting('text'); ?></span>
		</span>
		<script>
			jQuery(document).ready(function($) {
				var x = $("audio#myAudio");
				if (x.length) {
					// window.scrollTo(0, 0);
					// disableScroll();
				}
				$("a#myAudioClick").click(function(e) {
					// e.preventDefault();

					var c = $(this).attr("hasclick");
					if (c === "0") {
						c = "1";
						// enableScroll();
						x.trigger("play");
						$('.dialog-widget').hide()
					} else if (c === "1") {
						c = "0";

						x.trigger("pause");
					}

					$(this).attr("hasclick", c);
				});



			});
		</script>
	<?php
	}




	/**
	 * Render button widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 2.9.0
	 * @access protected
	 */
	protected function content_template()
	{
	?>
		<# view.addRenderAttribute( 'text' , 'class' , 'elementor-button-text' ); view.addInlineEditingAttributes( 'text' , 'none' ); var iconHTML=elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden' : true }, 'i' , 'object' ), migrated=elementor.helpers.isIconMigrated( settings, 'selected_icon' ); #>
			<div class="elementor-button-wrapper">
				<a hasclick="0" id="myAudioClick {{ settings.button_css_id }}" class="elementor-button elementor-size-{{ settings.size }} elementor-animation-{{ settings.hover_animation }}" href="{{ settings.link.url }}" role="button">
					<span class="elementor-button-content-wrapper">
						<# if ( settings.icon || settings.selected_icon ) { #>
							<span class="elementor-button-icon elementor-align-icon-{{ settings.icon_align }}">
								<# if ( ( migrated || ! settings.icon ) && iconHTML.rendered ) { #>
									{{{ iconHTML.value }}}
									<# } else { #>
										<i class="{{ settings.icon }}" aria-hidden="true"></i>
										<# } #>
							</span>
							<# } #>
								<span {{{ view.getRenderAttributeString( 'text' ) }}}>{{{ settings.text }}}</span>
					</span>
				</a>
			</div>
	<?php
	}



	public function on_import($element)
	{
		return Icons_Manager::on_import_migration($element, 'icon', 'selected_icon');
	}
}
