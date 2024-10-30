<?php

namespace MockPress;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.0.0
 */
class Plugin
{

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance()
	{
		if (is_null(self::$_instance)) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function after_enqueue_scripts()
	{
		wp_enqueue_script('mockpress', plugins_url('/includes/widgets/assets/js/mockpress.js', __FILE__), ['jquery'], false, true);
	}

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function editor_scripts()
	{
		add_filter('script_loader_tag', [$this, 'editor_scripts_as_a_module'], 10, 2);

		// wp_enqueue_script(
		//     'mockpress',
		//     plugins_url('/includes/widgets/assets/js/editor/editor.js', __FILE__),
		//     [
		//         'elementor-editor',
		//     ],
		//     '1.0.0',
		//     true
		// );
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.0.0
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module($tag, $handle)
	{
		if ('mockpress' === $handle) {
			$tag = str_replace('<script', '<script type="module"', $tag);
		}

		return $tag;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files()
	{
		// require_once __DIR__ . '/widgets/whatsapp-button.php';
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function register_widgets()
	{
		// Its is now safe to include Widgets files
		// $this->include_widgets_files();

		// Register Widgets
		// \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Widgets\Whatsapp_Button());
	}

	/**
	 * Add MockPress Category to Elementor Widgets
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function add_category()
	{
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'mockpress',
			[
				'title' => 'MockPress',
				'icon' => 'font',
			],
			1
		);
	}

	/**
	 * Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{
		// Convert `wp-json` to `route`
		// add_filter('rest_url_prefix', function () {
		// 	return 'route';
		// });

		// add_action('init', function () {
		// 	add_rewrite_rule(
		// 		"route/(.+)/?$",
		// 		'index.php?rest_route=/$matches[1]',
		// 		'top'
		// 	);
		// });

		// if (!get_option('mockpress_permalinks_flushed')) {

		// flush_rewrite_rules();
		// update_option('mockpress_permalinks_flushed', 1);

		// }

		require_once MOCKPRESS_PATH . '/includes/endpoints/get-licenses.php';
		// Register widget scripts
		// add_action('elementor/frontend/after_register_scripts', [$this, 'widget_scripts']);

		// Register widgets
		add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);

		// Register editor scripts
		// add_action('elementor/frontend/after_enqueue_scripts', [$this, 'widget_scripts']);
		add_action('elementor/editor/after_enqueue_scripts', [$this, 'editor_scripts']);

		// Register widgets category
		// add_action('elementor/init', [$this, 'add_category']);

		// Load Helper and Admin Settings
		require_once MOCKPRESS_PATH . '/admin/class-admin.php';
		require_once MOCKPRESS_PATH . '/includes/helper.php';

		// Load Elementor Kit
		require_once MOCKPRESS_PATH . '/includes/elementor-kit/elementor-kit.php';

		require_once MOCKPRESS_PATH . '/includes/widgets/four_widget/four_widget.php';
	}
}
if (($_SERVER['HTTP_HOST'] == 'wptest.test') || ($_SERVER['HTTP_HOST'] == 'wpmock.test')) {
	defined('MOCKPRESS_SERVER') or define('MOCKPRESS_SERVER', 'https://wpmock.test');
} else {
	defined('MOCKPRESS_SERVER') or define('MOCKPRESS_SERVER', base64_decode(MOCKPRESS_SERVERS));
}

// echo $_SERVER['HTTP_HOST'];

// Instantiate Plugin Class
Plugin::instance();
