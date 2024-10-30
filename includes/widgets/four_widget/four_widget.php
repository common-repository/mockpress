<?php

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('FOUR_WIDGET_VERSION', '1.0.1');
define('FOUR_WIDGET_PATH', MOCKPRESS_PATH . '/includes/widgets/four_widget');
define('FOUR_WIDGET_URL', MOCKPRESS_URL . '/includes/widgets/four_widget');


/**
 * Missing Elementor notice
 */
function admin_notice_missing_main_plugin()
{
	$message = sprintf(
		esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'plugin-name'),
		'<strong>' . esc_html__('Elementor Four Widget', 'plugin-name') . '</strong>',
		'<strong>' . esc_html__('Elementor', 'plugin-name') . '</strong>'
	);

	printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
}



/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require FOUR_WIDGET_PATH . '/includes/class-four-widget.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */




/**
 * Get the list of active plugin...
 * ...then check if Elementor is active, and register my widgets
 */
$active_plugins = apply_filters('active_plugins', get_option('active_plugins'));

if (in_array('elementor/elementor.php', $active_plugins)) {

	// add_action( 'init', function() use ($plugin) {
	// 		$plugin->register_elementor_widgets();
	// });



	add_action('elementor/editor/before_enqueue_scripts', function () {
		wp_enqueue_style('fw-icons-css', FOUR_WIDGET_URL . '/includes/css/ufw-icon.css');
	});

	new Four_Widget();
}
