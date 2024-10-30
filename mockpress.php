<?php

/**
 * @wordpress-plugin
 *
 * Plugin Name:       Mockpress - Landing Page Template Elementor
 * Plugin URI:        https://mockpress.id
 * Description:       Template Elementor Indonesia
 * Version:           1.0.7
 * Author:            MockPress
 * Author URI:        https://mockpress.id/
 * License:           GPL-3.0+
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 *
 */

defined('MOCKPRESS_BASE') or define('MOCKPRESS_BASE', plugin_basename(__FILE__));
defined('MOCKPRESS_PATH') or define('MOCKPRESS_PATH', plugin_dir_path(__FILE__));
defined('MOCKPRESS_URL') or define('MOCKPRESS_URL', plugin_dir_url(__FILE__));
defined('MOCKPRESS_VERSION') or define('MOCKPRESS_VERSION', '1.0.7');
defined('MOCKPRESS_SERVERS') or define('MOCKPRESS_SERVERS', 'aHR0cHM6Ly90ZW1wbGF0ZXMubW9ja3ByZXNzLmlk');
defined('MOCKPRESS_REQUIRED_ELEMENTOR') or define('MOCKPRESS_REQUIRED_ELEMENTOR', '3.2.2');

// Requirement System
if (!version_compare(PHP_VERSION, '7.4', '>=')) {
	// PHP Version 7.3
	add_action('admin_notices', 'mockpress_fail_php_version');
	// } elseif (!version_compare(PHP_VERSION, '7.5', '<=')) {
	//     // PHP Version 7.4
	//     add_action('admin_notices', 'mockpress_fail_php_version');
} elseif (!version_compare(get_bloginfo('version'), '5.6', '>=')) {
	// WordPress Version
	add_action('admin_notices', 'mockpress_fail_wp_version');
} elseif (!version_compare(ELEMENTOR_VERSION, MOCKPRESS_REQUIRED_ELEMENTOR, '>=')) {
	// Elementor Version
	add_action('admin_notices', 'mockpress_fail_elementor_version');
} else {

	add_filter('jwt_auth_whitelist', function ($endpoints) {
		$your_endpoints = array(
			'/wp-json/mockpress/v1/option/*',

		);
		return array_unique(array_merge($endpoints, $your_endpoints));
	});

	require_once MOCKPRESS_PATH . 'includes/plugin.php';
}

// Elementor Checker
function mockpress_elementor_check()
{
	if (!did_action('elementor/loaded')) {
		deactivate_plugins(plugin_basename(__FILE__));

		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}
		return;
	}
}
add_action('admin_init', 'mockpress_elementor_check');

function mockpress_fail_elementor_version()
{
	$message = sprintf(esc_html__('MockPress membutuhkan Elementor versi %s, silahkan aktifkan Elementor terlebih dahulu.', 'mockpress'), '3.2.2');
	$html_message = sprintf('<div class="error">%s</div>', wpautop($message));
	echo wp_kses_post($html_message);
}

function mockpress_fail_php_version()
{
	$message = sprintf(esc_html__('MockPress membutuhkan PHP versi %s, silahkan update versi PHP telebih dahulu.', 'mockpress'), '> 7.3 ');
	$html_message = sprintf('<div class="error">%s</div>', wpautop($message));
	echo wp_kses_post($html_message);
}

function mockpress_fail_wp_version()
{
	$message = sprintf(esc_html__('MockPress membutuhkan WordPress versi %s+. silahkan update WordPress terlebih dahulu.', 'mockpress'), '5.7');
	$html_message = sprintf('<div class="error">%s</div>', wpautop($message));
	echo wp_kses_post($html_message);
}
