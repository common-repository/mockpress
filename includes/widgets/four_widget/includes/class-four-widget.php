<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://
 * @since      1.0.0
 *
 * @package    four_widget
 * @subpackage four_widget/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    four_widget
 * @subpackage four_widget/includes
 * @author     aikhacode <aikhacomp@gmail.com>
 */



class Four_Widget
{

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('FOUR_WIDGET_VERSION')) {
			$this->version = FOUR_WIDGET_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'four-widget';

		$this->init_elementor_widgets_class();

		add_action('wp_enqueue_scripts', function () {
			$this->load_depedency();
		});
	}

	private function load_depedency()
	{

		wp_register_style('four-widget-css-one', FOUR_WIDGET_URL . '/includes/css/grid.min.css');
		wp_register_style('fw-icons-css', FOUR_WIDGET_URL . '/includes/css/ufw-icon.css');

		//wp_register_style('four-widget-css-two',FOUR_WIDGET_URL . 'includes/helper-parts.min.css');
		//wp_register_style('four-widget-css-three',FOUR_WIDGET_URL . 'includes/main.min.css');
		//wp_register_script('four-widget-js',FOUR_WIDGET_URL . 'includes/main.min.js',['jquery']);
		//wp_register_style('four-widget-css-one',FOUR_WIDGET_URL . 'includes/css/bootstrap-grid.min.css');

		wp_enqueue_style('four-widget-css-one');
		wp_enqueue_style('fw-icons-css');
		// wp_enqueue_style('four-widget-css-two');
		// wp_enqueue_style('four-widget-css-three');
		//wp_enqueue_script('four-widget-js');


	}

	/**
	 * Load the required wigdets...
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function init_elementor_widgets_class()
	{
		//register category elementor
		add_action('elementor/elements/categories_registered', function ($elements_manager) {

			$elements_manager->add_category(
				'fourwidget',
				[
					'title' => __('MP - Widget', 'fourwidget'),
					'icon' => 'fa fa-plug',
				]
			);
		});

		// include and register require class widget
		add_action('elementor/widgets/widgets_registered', function ($widgets_manager) {
			require_once FOUR_WIDGET_PATH . '/includes/class-helper.php';

			require_once FOUR_WIDGET_PATH . '/elementor-widgets/class-dual-button.php';
			require_once FOUR_WIDGET_PATH . '/elementor-widgets/class-autoplay.php';
			require_once FOUR_WIDGET_PATH . '/elementor-widgets/class-bussiness-button.php';
			require_once FOUR_WIDGET_PATH . '/elementor-widgets/class-stage.php';



			$widgets_manager->register_widget_type(new Four_Widget\Dual_Buttons());
			$widgets_manager->register_widget_type(new Four_Widget\Autoplay_Button());
			$widgets_manager->register_widget_type(new Four_Widget\Bussiness_Buttons());
			$widgets_manager->register_widget_type(new Four_Widget\Stage_Process());
		});
	}





	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
