<?php

namespace MockPress;

if (!defined('ABSPATH')) {
	exit;
}

class AJAX {
	public function __construct() {
		add_action('wp_ajax_mockpress_register_template', [$this, 'register_template']);
		add_action('wp_ajax_mockpress_remove_license', [$this, 'remove_license']);
	}

	public function remove_license() {
		if (!check_ajax_referer('mockpress_nonce', 'security')) {
			wp_send_json_error('Invalid security token sent.');
		}

		$license = sanitize_text_field($_REQUEST['license']);
		$pack = sanitize_text_field($_REQUEST['pack']);
		$server = MOCKPRESS_SERVER;

		// mp_set_credentials('donation', 'key', null);
		// mp_set_credentials('donation', 'status', 'inactive');
		// mp_set_credentials('donation', 'expired', null);
		// mp_set_credentials('donation', 'email', "");
		// $success = mp_remove_credentials($pack);

		$domain = str_replace('.', '_', parse_url(get_site_url())['host']);
		$remote = wp_remote_get(
			esc_url($server . '/route/mockpress/v1/templates/deactivate/' . $license . '__' . $domain),
			[
				'timeout' => 30,
				'sslverify' => false,
				'headers' => [
					'Accept' => 'application/json',
				],
			]
		);

		$res = json_decode(wp_remote_retrieve_body($remote), true);

		if ($res['code'] == 200) {
			$success = mp_remove_credentials($pack);
		} else {
			wp_send_json_error($res);
		}

		$response = (($success == true) && ($res['code'] == 200)) ? array('code' => 200, 'pack' => $pack, 'license' => $license) : array('code' => 400, 'succ' => $success, 'res' => $res);

		wp_send_json($response, 200);
	}

	/**
	 * Store Version Update Data to Post Meta.
	 */
	public function register_template() {
		if (!check_ajax_referer('mockpress_nonce', 'security')) {
			wp_send_json_error('Invalid security token sent.');
		}

		$server = MOCKPRESS_SERVER;

		$license_key = sanitize_text_field($_REQUEST['license']);
		$type = sanitize_text_field($_REQUEST['type']);
		$domain = str_replace('.', '_', parse_url(get_site_url())['host']);

		$remote = wp_remote_get(
			esc_url($server . '/route/mockpress/v1/templates/' . $type . '/' . $license_key . '__' . $domain),
			[
				'timeout' => 30,
				'sslverify' => false,
				'headers' => [
					'Accept' => 'application/json',
				],
			]
		);

		$response = json_decode(wp_remote_retrieve_body($remote), true);

		// mp__log($license_key, 'me');
		// mp__log($response, 'me');

		if (isset($response['code']) && isset($response['status'])) {
			$pack_str = str_replace("-", "_", $response['pack']);

			if (esc_attr($response['code']) == 200 && esc_attr($response['status']) == 'active') {
				mp_set_credentials($pack_str, 'pack', $pack_str);
				mp_set_credentials($pack_str, 'title', $response['title']);
				mp_set_credentials($pack_str, 'key', $license_key);
				mp_set_credentials($pack_str, 'status', $response['status']);
				mp_set_credentials($pack_str, 'expired', $response['expired']);
				mp_set_credentials($pack_str, 'email', $response['email']);
				mp_set_credentials($pack_str, 'ID', $response['ID']);

				// $exp = strtotime($expired);
				$timeleft = strtotime($response['expired']) - time();
				$expired_day = floor($timeleft / (60 * 60 * 24));
				mp_set_credentials($pack_str, 'expired_day', $expired_day);
				//
			}

			if (esc_attr($response['code']) == 401) {
				mp_set_credentials($pack_str, 'pack', $pack_str);
				mp_set_credentials($pack_str, 'title', '-');
				mp_set_credentials($pack_str, 'key', null);
				mp_set_credentials($pack_str, 'status', 'inactive');
				mp_set_credentials($pack_str, 'expired', null);
				mp_set_credentials($pack_str, 'email', "");
				mp_set_credentials($pack_str, 'expired_day', '0');
				mp_set_credentials($pack_str, 'ID', '');
			}
			wp_send_json($response, 200);
		} else {
			wp_send_json_error([$type, $domain, $license_key, $response]);
		}

		wp_die();
	}
}
new AJAX();
