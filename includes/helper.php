<?php

/**
 * Get MockPress Credential Based on Pack
 *
 * @since 1.0.0
 * @param string $pack
 * @param string $key
 * @return string
 */
function mp_get_credentials($pack, $key) {
	$credentials = get_option('mockpress_credentials') != null ? get_option('mockpress_credentials') : array();

	if (!$credentials) {
		return false;
	}

	if ($key == 'expired_day') {
		// $exp = strtotime($expired);
		$timeleft = strtotime($credentials[$pack]['expired']) - time();
		$expired_day = floor($timeleft / (60 * 60 * 24));
		mp_set_credentials($pack, 'expired_day', $expired_day);
		return esc_attr($credentials[$pack]['expired_day']);
	}

	return isset($credentials[$pack][$key]) ? esc_attr($credentials[$pack][$key]) : "";
}

function mp_get_all_credentials() {
	return get_option('mockpress_credentials') != null ? get_option('mockpress_credentials') : false;
}

function mp_get_json_stringify_array_credentials() {
	$credentials = mp_get_all_credentials();
	if ($credentials) {
		foreach ($credentials as $key => $val) {
			$expired_day = mp_get_credentials($key, 'expired_day');
		}
		$credentials = mp_get_all_credentials();
	}

	return ($credentials == false) ? json_encode([]) : json_encode($credentials);
}

/**
 * Set MockPress Credentials
 *
 * @since 1.0.0
 * @param string $pack
 * @param string $key
 * @param string $value
 * @return void
 */
function mp_set_credentials($pack, $key, $value) {
	$credentials = get_option('mockpress_credentials') != null ? get_option('mockpress_credentials') : array();
	$credentials[$pack][$key] = sanitize_text_field($value);
	update_option('mockpress_credentials', $credentials);
}

/**
 * Get Premium Pack List
 *
 * @return array
 */
function mp_get_premium_packs() {
	return ['mockpress_donation'];
}

/**
 * Get Pack ID
 *
 * @since 1.0.0
 * @param string $license
 * @return string
 */
function mp_get_pack_ID($license) {
	return str_replace('mockpress_', '', $license);
}

/**
 * Generate Log
 *
 * @since 1.0.0
 * @param string $file_name
 * @param string $path
 * @param string $message
 * @return void
 */
function mp_generate_log($file_name, $path, $message) {
	if ($_SERVER['HTTP_HOST'] == 'wpmock.test') {
		if (is_array($message)) {
			$message = json_encode($message);
		}
		file_put_contents(MOCKPRESS_PATH . '/log-' . $file_name . '.txt', date('Y-m-d H:i:s', current_time('timestamp', 0)) . " :: " . $message . PHP_EOL, FILE_APPEND);
	}
}

function mp__log($message, $id = '') {
	if ($_SERVER['HTTP_HOST'] == 'wpmock.test') {

		if (is_array($message)) {
			$message = json_encode($message);
		}

		file_put_contents(MOCKPRESS_PATH . '/log-mock' . '.log', $id . " : " . $message . PHP_EOL, FILE_APPEND);
	}
}

function mp_get_credentials_exist() {
	$credentials = get_option('mockpress_credentials') != null ? get_option('mockpress_credentials') : array();

	if (!$credentials) {
		return false;
	}

	return true;
}

function mp_remove_credentials($pack) {
	$credentials = get_option('mockpress_credentials') != null ? get_option('mockpress_credentials') : array();

	if (!$credentials) {
		return false;
	}

	unset($credentials[$pack]);
	if (!empty($credentials)) {
		update_option('mockpress_credentials', $credentials);
	} else {
		delete_option('mockpress_credentials');
	}

	return true;
}
