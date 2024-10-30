<?php

/**
 * 
 *
 * @package stage process
 */

namespace Four_Widget;

// Elementor Classes.

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;


if (!defined('ABSPATH')) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Stage
 */
class Stage_Process extends Widget_Base
{

	public function __construct($data = [], $args = null)
	{
		parent::__construct($data, $args);
		// wp_register_script( 'stage-process-js-handle', FOUR_WIDGET_URL . 'includes/main.min.js', [ 'elementor-frontend' ], '1.0.0', true );
		// wp_register_style('stage-process-style-handle', FOUR_WIDGET_URL . 'includes/helper-parts.min.css');
		// wp_register_style('stage-process-grid-style-handle', FOUR_WIDGET_URL . 'includes/grid.min.css');
		// wp_register_style('stage-process-main-style-handle', FOUR_WIDGET_URL . 'includes/main.min.css');
		wp_register_style('sp-custom-css', FOUR_WIDGET_URL . '/includes/css/spcustom.css');
	}

	// public function get_script_depends() {
	// 	return ['stage-process-js-handle'];
	// }

	public function get_style_depends()
	{
		return ['sp-custom-css'];
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
		return 'stage-process';
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
		return 'MP - Stage Process';
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
		return 'fw eicon-counter';
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
		return ['process'];
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
		include_once 'class-option-stage.php';
		$option_class = new Option_Stage();
		$option_class->create_controls($this);
	}



	protected function render()
	{

		$settings = $this->get_settings_for_display();
		//$node_id  = $this->get_id();
		//$count    = count($settings['children']);

?>


		<div class="qodef-shortcode qodef-m  qodef-qi-process  qodef-qi--has-appear qodef-qi-grid qodef-layout--qi-columns  qodef-col-num--3  qodef-item-layout--horizontal qodef-responsive--predefined">
			<div class="qodef-grid-inner">
				<?php
				$i = 1;
				foreach ($settings['children'] as $key) {
				?>
					<div class="qodef-e qodef-process-item qodef-grid-item elementor-repeater-item-<?= $key['_id']; ?>">
						<div class="qodef-e-inner">
							<div class="qodef-e-content">
								<div class="sp-custom-e-icon-holder qodef-e-icon-holder">

									<div class="sp-custom-e-icon qodef-e-icon">
										<span class="qodef-e-item-icon-text">
											<?php echo $i++ . '.'; ?>
										</span>
									</div>

									<div class="sp-custom-e-line qodef-e-line">
										<div class="sp-custom-e-line-inner qodef-e-line-inner"></div>
									</div>

								</div>
								<h5 class="qodef-e-title">
									<?php echo $key['item_title']; ?></h5>
								<p class="qodef-e-text">
									<?php echo $key['item_text']; ?></p>

							</div>
						</div>
					</div>

				<?php
				}
				?>
			</div>
		</div>

<?php
	}
}
