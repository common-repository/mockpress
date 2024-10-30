<?php

namespace MockPress;

/**
 * This plugin incorporates codes from:
 *
 * 1) Elementor
 * Copyright Elementor
 * GPL v3 license
 * @link https://github.com/elementor/elementor
 *
 * 2) JetThemeCore
 * Copyright Zemez
 * GPL v2 license
 * @link https://crocoblock.com/plugins/jetthemecore/
 *
 * 3) LandingPress
 * Copyright LandingPress
 * GPL v3 license
 * @link https://www.landingpress.net
 *
 * 4) MockPress
 * Copyright MockPress
 * GPL v3 license
 * @link https://mockpress.id
 *
 */
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('MockPress_Elementor')) {

	class MockPress_Elementor
	{
		public static $mockpress_api = MOCKPRESS_SERVER;

		private static $instance;

		public static function get_instance()
		{
			return null === self::$instance ? (self::$instance = new self) : self::$instance;
		}

		public function __construct()
		{
			add_action('elementor/editor/before_enqueue_scripts', array($this, 'editor_scripts'), 0);
			add_action('elementor/editor/after_enqueue_styles', array($this, 'editor_styles'));

			add_action('elementor/editor/footer', array($this, 'print_templates'));
			add_action('elementor/preview/enqueue_styles', array($this, 'preview_styles'));

			add_action('elementor/ajax/register_actions', array($this, 'register_ajax_actions'), 20);
			add_action('wp_ajax_mockpress_get_templates', array($this, 'get_templates')); // AJAX Get Templates

		}

		public function editor_scripts()
		{
			wp_enqueue_script(
				'mockpress-editor',
				MOCKPRESS_URL . 'includes/elementor-kit/assets/js/editornew.js',
				array('jquery', 'underscore', 'backbone-marionette'),
				MOCKPRESS_VERSION,
				true
			);

			// Localize Data with Filter
			$domain = str_replace('.', '_', $_SERVER['HTTP_HOST']);
			wp_localize_script('mockpress-editor', 'MockPressData', apply_filters(
				'mockpress/assets/editor/localize',
				array(
					'modalRegions' => array(
						'modalHeader' => '.dialog-header',
						'modalContent' => '.dialog-message',
					),
					'tabs' => $this->get_tabs(),
					'apiSuspended' => MOCKPRESS_SERVER . '/route/lsd/v1/license/status/' . $domain,
					// 'tabs' => [],
					'defaultTab' => 'mockpress_free',
				),
			));
		}

		public function editor_styles()
		{
			wp_enqueue_style(
				'mockpress-editor',
				MOCKPRESS_URL . 'includes/elementor-kit/assets/css/editor.css',
				array(),
				'1.0.0'
			);
		}

		public function print_templates()
		{
			foreach (glob(MOCKPRESS_PATH . 'includes/elementor-kit/templates/*.php') as $file) {
				include_once $file;
			}
		}

		public function preview_styles()
		{
			wp_enqueue_style(
				'mockpress-preview',
				MOCKPRESS_URL . 'includes/elementor-kit/assets/css/preview.css',
				array(),
				'1.0.0'
			);
		}

		/**
		 * Getting Templates From Server
		 * Request by AJAX
		 *
		 * @return void
		 */
		public function get_templates()
		{

			if (!current_user_can('edit_posts')) {
				wp_send_json_error();
			}

			// wp_send_json_error();

			if (isset($_GET['tab'])) {
				$tab = sanitize_text_field($_GET['tab']);
			} else {
				$tab = "mockpress_free";
			}

			$tabs = $this->get_tabs();
			// $tabs = [];

			$result = array(
				'templates' => array(),
				'categories' => array(),
				'keywords' => array(),
			);

			// Calling Library Data
			$library_data = $this->get_library_data();
			// mp_generate_log('gt', MOCKPRESS_PATH, $library_data);
			// mp_generate_log('tabs', MOCKPRESS_PATH, $tab);

			/**
			 * Filtering System
			 */
			$templates = array();
			$categories = array();
			$keywords = array();

			if (!empty($library_data['templates'])) {

				// Looping Template Exist
				foreach ($library_data['templates'] as $template_data) {
					$template_data['template_id'] = $template_data['id'];
					$template_data['source'] = 'mockpress-api';

					if (!isset($template_data['categories']) && isset($template_data['subtype']) && $template_data['subtype']) {
						$template_data['categories'] = is_array($template_data['subtype']) ? $template_data['subtype'] : array($template_data['subtype']);
					}
					$template_data['subtype'] = $template_data['type'];

					// Tab Filtering
					if ($tab == 'mockpress_free' && $template_data['type'] == 'page' && in_array("free", $template_data['tags'])) {
						$template_data['type'] = 'mockpress_free';
						$templates[] = $template_data;
					} elseif ($tab == 'mockpress_donation' && $template_data['type'] == 'page' && in_array("donation", $template_data['tags'])) {
						$template_data['type'] = 'mockpress_donation';
						$templates[] = $template_data;
					} elseif (in_array($tab, $template_data['tags'])) {
						$template_data['type'] = $tab;
						$templates[] = $template_data;
					}
				}
			}

			if ($tab == 'mockpress_free') {
				if (isset($library_data['categories_page'])) {
					$categories = $library_data['categories_page'];
				}
				if (isset($library_data['keywords_page'])) {
					$keywords = $library_data['keywords_page'];
				}
			} elseif ($tab == 'mockpress_donation') {
				if (isset($library_data['categories_page'])) {
					$categories = $library_data['categories_page'];
				}
				if (isset($library_data['keywords_page'])) {
					$keywords = $library_data['keywords_page'];
				}
			} else {
				if (isset($library_data['categories_page'])) {
					$categories = $library_data['categories_page'];
				}
				if (isset($library_data['keywords_page'])) {
					$keywords = $library_data['keywords_page'];
				}
			}

			if (!empty($templates)) {
				$result['templates'] = array_merge($result['templates'], $templates);
			}

			if (!empty($categories)) {
				$result['categories'] = array_merge($result['categories'], $categories);
			}

			if (!empty($keywords)) {
				$result['keywords'] = array_merge($result['keywords'], $keywords);
			}

			wp_send_json_success($result);
		}

		public function register_ajax_actions($ajax)
		{
			if (!isset($_POST['actions'])) {
				return;
			}

			// Elementor Json Template
			$actions = json_decode(stripslashes($_REQUEST['actions']), true);
			// $actions = array_map('sanitize_text_field', $actions );

			$data = false;
			foreach ($actions as $id => $action_data) {
				if (!isset($action_data['get_template_data'])) {
					$data = $action_data;
				}
			}

			if (!$data) {
				return;
			}

			if (!isset($data['data'])) {
				return;
			}

			if (!isset($data['data']['source'])) {
				return;
			}

			if ($data['data']['source'] != 'mockpress-api') {
				return;
			}

			$ajax->register_ajax_action('get_template_data', function ($data) {
				return $this->get_template_data_array($data);
			});
		}

		private function get_tabs()
		{
			// New Series = New Update Plugin
			$tabs = array(
				'mockpress_free' => array(
					'title' => 'Gratis',
					'data' => array(),
					'sources' => array('mockpress-api'),
					'settings' => array(
						'show_title' => true,
						'show_keywords' => true,
					),
				),
			);

			// Checking Donation License
			if (mp_get_credentials('mockpress_donation', 'key')) {
				$tabs['mockpress_donation'] = array(
					'title' => 'Donasi',
					'data' => array(),
					'sources' => array('mockpress-api'),
					'settings' => array(
						'show_title' => true,
						'show_keywords' => true,
					),
				);
			}

			// Checking PRemium add on License
			$res = wp_remote_get(self::$mockpress_api . '/route/mockpress/v1/templates/premiumaddontabs', ['sslverify' => false]);
			if (!is_wp_error($res)) {
				$premium_add_on_tabs = json_decode(wp_remote_retrieve_body($res), true);
				// if (mp_get_credentials('donation', 'key')) {
				foreach ($premium_add_on_tabs as $key => $value) {

					// Checking  License
					if (mp_get_credentials('mockpress_' . strtolower($value), 'key')) {
						$tabs['mockpress_' . strtolower($value)] = array(
							'title' => $value,
							'data' => array(),
							'sources' => array('mockpress-api'),
							'settings' => array(
								'show_title' => true,
								'show_keywords' => true,
							),
						);
					}
				}
				// }
			}

			if (has_filter('mockpress_elementor_tab_pack')) {
				$tabs = apply_filters('mockpress_elementor_tab_pack', $tabs);
			}

			return $tabs;
		}

		/**
		 * Remote Get Data Packs From Server
		 * Caching System
		 *
		 * @param string $mode
		 * @param boolean $force_update
		 * @return void
		 */
		public static function get_info_data($force_update = false)
		{
			$cache_key = 'elementor_mockpress_cache_' . ELEMENTOR_VERSION;
			$cache_data = get_transient($cache_key);

			// Deleting Cache on Argument True
			if ($force_update || false === $cache_data) {
				$timeout = ($force_update) ? 25 : 3;
				delete_transient($cache_key);
			}

			// Query Endpoints
			if (empty($cache_data)) :
				$templates = array();

				// Free Pack
				// $response = wp_remote_get(self::$mockpress_api . 'mockpress/v1/templates/free', [
				//     'timeout' => $timeout,
				//     'body' => [
				//         'api_version' => ELEMENTOR_VERSION, // Version
				//         'site_lang' => get_bloginfo('language'),
				//     ],
				// ]);

				$response = wp_remote_get(self::$mockpress_api . '/route/mockpress/v1/templates/free', ['sslverify' => false]);
				if (!is_wp_error($response)) {
					$free_pack = json_decode(wp_remote_retrieve_body($response), true);
					mp_generate_log('info-data', MOCKPRESS_PATH, $response);
				} else {
					mp_generate_log('info-data', MOCKPRESS_PATH, $response->get_error_messages());
				}

				// mp_generate_log('info-data',MOCKPRESS_PATH,'test');
				// mp_generate_log('info-data',MOCKPRESS_PATH,self::$mockpress_api . 'mockpress/v1/templates/free');
				// mp_generate_log('info-data',MOCKPRESS_PATH,$response['body']);
				// mp_generate_log('info-data',MOCKPRESS_PATH,WP_Error::get_error_messages());

				// Premium Packs
				$packs = mp_get_premium_packs(); // [ 'donation' ]
				foreach ($packs as $pack) {

					// Checking License
					// if (mp_get_credentials($pack, 'key')) {

					$response = wp_remote_get(self::$mockpress_api . '/route/mockpress/v1/templates/donation', [
						'sslverify' => false,
						'timeout' => $timeout,
						'body' => [
							'api_version' => ELEMENTOR_VERSION, // Version
							'site_lang' => get_bloginfo('language'),
						],
					]);

					// mp_generate_log( "mockpress", MOCKPRESS_PATH, json_encode($response) );

					if (is_wp_error($response) || 200 !== (int) wp_remote_retrieve_response_code($response)) {
						continue;
					}

					$template_data = json_decode(wp_remote_retrieve_body($response), true);

					// mp_generate_log('info-data',MOCKPRESS_PATH,$template_data);

					// Empty Data -> 2 Hours Cache
					if (empty($template_data) || !is_array($template_data)) {
						// set_transient($cache_key, [], 2 * HOUR_IN_SECONDS);
						// return false;
						continue;
					}
					// }

					$templates = array_merge_recursive($templates, $template_data);
				}

				// Premium Add On Packs
				$res = wp_remote_get(self::$mockpress_api . '/route/mockpress/v1/templates/premiumaddonslug', ['sslverify' => false]);
				if (!is_wp_error($res)) {
					$premium_add_on_slug = json_decode(wp_remote_retrieve_body($res), true);
					// if (mp_get_credentials('donation', 'key')) {

					$templatesaddon = [];
					$packs = $premium_add_on_slug;
					foreach ($packs as $pack => $slug) {

						// Checking License
						// if (mp_get_credentials($pack, 'key')) {

						$response = wp_remote_get(self::$mockpress_api . '/route/mockpress/v1/templates/premiumaddon?slug=' . $slug, [
							'sslverify' => false,
							'timeout' => $timeout,
							'body' => [
								'api_version' => ELEMENTOR_VERSION, // Version
								'site_lang' => get_bloginfo('language'),
							],
						]);

						// mp_generate_log( "mockpress", MOCKPRESS_PATH, json_encode($response) );

						if (is_wp_error($response) || 200 !== (int) wp_remote_retrieve_response_code($response)) {
							continue;
						}

						$template_data = json_decode(wp_remote_retrieve_body($response), true);

						// mp_generate_log('info-data',MOCKPRESS_PATH,$template_data);

						// Empty Data -> 2 Hours Cache
						if (empty($template_data) || !is_array($template_data)) {
							// set_transient($cache_key, [], 2 * HOUR_IN_SECONDS);
							// return false;
							continue;
						}
						// }

						$templatesaddon = array_merge_recursive($templatesaddon, $template_data);
					}
				}

				$templates = !is_array($templates) ? array() : $templates;
				$templates = array_merge_recursive($templates, $free_pack, $templatesaddon);

				// mp_generate_log('tpl1', MOCKPRESS_PATH, $templates);
				// mp_generate_log('tpl2', MOCKPRESS_PATH, $templatesaddon);

				// Set Templates Data to Option
				if (isset($templates['templates'])) {
					update_option('mockpress_elementor_templates_data', json_encode($templates), 'no');
					// unset($cache_data);
				}

				// OK -> Caching 12 Hours
				set_transient($cache_key, $templates, 12 * HOUR_IN_SECONDS);
			endif;

			// Return Cache when Exist
			if ($cache_data) {
				return $cache_data;
			} else {
				return $templates;
			}
		}

		/**
		 * Getting JSON Data from Option
		 * Or Injecting New Update if has filter
		 *
		 * @param boolean $force_update
		 * @return void
		 */
		public static function get_library_data($force_update = false)
		{
			self::get_info_data(true);
			// self::get_info_data($force_update); // Set On for Production

			$library_data = json_decode(get_option('mockpress_elementor_templates_data'), true);

			if (empty($library_data)) {
				return [];
			}

			$library_data = apply_filters('mockpress/elementor/templates', $library_data);

			return $library_data;
		}

		private function get_template_data_array($data)
		{

			if (!current_user_can('edit_posts')) {
				return false;
			}

			if (empty($data['template_id'])) {
				return false;
			}

			$source_name = isset($data['source']) ? esc_attr($data['source']) : '';

			if (!$source_name) {
				return false;
			}

			if ($source_name != 'mockpress-api') {
				return false;
			}

			if (empty($data['tab'])) {
				return false;
			}

			$template = $this->get_item($data['template_id'], $data['tab']);

			return $template;
		}

		/**
		 * Elementor Get Real Template
		 *
		 * @param [type] $template_id
		 * @return void
		 */
		private function get_item($template_id, $pack)
		{
			$template_content = apply_filters('mockpress/elementor/templates/content', null, $template_id);

			if ($template_content === null) {

				// $template_pack = mp_get_pack_ID($pack);
				$template_pack = $pack;
				mp__log($pack, 'get_item:pack');
				mp__log($template_pack, 'get_item:template_pack');
				$headers = array(
					'Content-Type' => 'application/json',
				);

				$data = array(
					'template_id' => $template_id,
					'template_license' => mp_get_credentials($template_pack, 'key'),
					'version' => ELEMENTOR_VERSION,
					'site_lang' => get_bloginfo('language'),
					'site_url' => home_url('/'),
				);

				// mp_generate_log("mockpress", MOCKPRESS_PATH, $data );

				$payload = array(
					'method' => 'POST',
					'timeout' => 30,
					'headers' => $headers,
					'httpversion' => '1.0',
					'sslverify' => false,
					'body' => json_encode($data),
					'cookies' => array(),

				);

				$response = wp_remote_post(self::$mockpress_api . '/route/mockpress/v1/templates/content', $payload);
				// mp_generate_log('imp', MOCKPRESS_PATH, $response);

				if (is_wp_error($response)) {
					return $response;
				}

				$response_code = (int) wp_remote_retrieve_response_code($response);

				if (200 !== $response_code) {
					return new \WP_Error('response_code_error', sprintf('The request returned with a status code of %s.', $response_code));
				}

				$template_content = json_decode(wp_remote_retrieve_body($response), true);
				mp_generate_log('imp', MOCKPRESS_PATH, $template_content);

				if (isset($template_content['error'])) {
					return new \WP_Error('response_error', $template_content['error']);
				}

				if (empty($template_content['data'])) {
					return new \WP_Error('template_data_error', 'An invalid data was returned.');
				}

				if (!empty($template_content['data'])) {
					$template_content['content'] = $template_content['data']['content'];
					unset($template_content['data']);
				}
			}

			$content = isset($template_content['content']) ? $template_content['content'] : '';
			$type = isset($template_content['type']) ? $template_content['type'] : '';
			$page_settings = isset($template_content['page_settings']) ? $template_content['page_settings'] : array();

			if (!empty($content)) {
				$content = $this->replace_elements_ids($content);
				$content = $this->process_export_import_content($content, 'on_import');
			}

			return array(
				'page_settings' => $page_settings,
				'type' => $type,
				'content' => $content,
			);
		}

		private function replace_elements_ids($content)
		{
			return \Elementor\Plugin::$instance->db->iterate_data($content, function ($element) {
				$element['id'] = dechex(rand());
				return $element;
			});
		}

		private function process_export_import_content($content, $method)
		{
			return \Elementor\Plugin::$instance->db->iterate_data(
				$content,
				function ($element_data) use ($method) {
					$element = \Elementor\Plugin::$instance->elements_manager->create_element_instance($element_data);

					// If the widget/element isn't exist, like a plugin that creates a widget but deactivated
					if (!$element) {
						return null;
					}

					return $this->process_element_export_import_content($element, $method);
				}
			);
		}

		private function process_element_export_import_content($element, $method)
		{

			$element_data = $element->get_data();

			if (method_exists($element, $method)) {
				// TODO: Use the internal element data without parameters.
				$element_data = $element->{$method}($element_data);
			}

			foreach ($element->get_controls() as $control) {
				$control_class = \Elementor\Plugin::$instance->controls_manager->get_control($control['type']);

				// If the control isn't exist, like a plugin that creates the control but deactivated.
				if (!$control_class) {
					return $element_data;
				}

				if (method_exists($control_class, $method)) {
					$element_data['settings'][$control['name']] = $control_class->{$method}($element->get_settings($control['name']), $control);
				}
			}

			return $element_data;
		}
	}
}
MockPress_Elementor::get_instance();
