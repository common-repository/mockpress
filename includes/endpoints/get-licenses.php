<?php

namespace MockPress;

if (!defined('ABSPATH')) exit;

class GET_Licenses
{

    /**
     * Register Template Pack Route
     *
     * @since 0.1
     * @param string $slug
     * @param string $name
     * @param string $version
     * @return void
     */
    public static function register()
    {
        $rest = new self();
        add_action('rest_api_init', [$rest, 'rest']);
    }

    /**
     * Registering REST Route
     * TODO :: Auto Generate REST Route based on Template Pack
     * 
     * @since 0.1
     * @return void
     */
    public function rest()
    {
        // Free
        register_rest_route('mockpress', '/v1/option/licenses', [
            'methods' => \WP_REST_Server::READABLE, //POST
            'callback' => [$this, 'get_licenses'],
            'permission_callback' => '__return_true',
        ]);
    }

    /**
     * Template Free Pack
     * 
     * @since 0.1
     * @return json
     */
    public function get_licenses()
    {
        $credentials = json_decode(mp_get_json_stringify_array_credentials());
        $data = array(
            'licenses' => $credentials,
            'success' => (empty($credentials)) ? false : true
        );

        return new \WP_REST_Response($data);
    }
}
GET_Licenses::register();
