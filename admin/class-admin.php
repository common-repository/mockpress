<?php

namespace MockPress;



if (!defined('ABSPATH')) exit;

class Admin
{
    /**
     * The current version of the plugin
     *
     * @since 1.0.0
     * @access protected
     * @var string $version the current version of the plugin.
     */
    protected $version;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $slug    The string used to uniquely identify this plugin.
     */
    protected $slug;

    /**
     * The Name of Plugin
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $name    The string used to uniquely identify this plugin.
     */
    protected $name;


    /**
     * Register the admin page class with all the appropriate WordPress hooks.
     *
     */
    public static function register()
    {
        $admin = new self('mockpress', 'MockPress', MOCKPRESS_VERSION);

        add_action('admin_menu', [$admin, 'admin_menu']);
        add_action('admin_init', [$admin, 'admin_init']);
        add_action('admin_enqueue_scripts', [$admin, 'enqueue_styles']);
        add_action('admin_enqueue_scripts', [$admin, 'enqueue_scripts']);
    }



    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        wp_enqueue_style('mockpress', MOCKPRESS_URL . 'admin/assets/css/admin.css', array(), MOCKPRESS_VERSION, 'all');

        if (isset($_GET['page'])) {
            if ($_GET['page'] == 'mockpress' || strpos($_GET['page'], 'mockpress') !== false) {
                wp_enqueue_style('mockpress-bases', MOCKPRESS_URL . 'admin/assets/css/bases.css', array(), MOCKPRESS_VERSION, 'all');
                wp_enqueue_style('mockpress-home', MOCKPRESS_URL . 'admin/assets/css/home.css', array(), MOCKPRESS_VERSION, 'all');
                wp_enqueue_style('mockpress-license', MOCKPRESS_URL . 'admin/assets/css/license.css', array(), MOCKPRESS_VERSION, 'all');
                wp_enqueue_style('mockpress-responsive', MOCKPRESS_URL . 'admin/assets/css/responsive.css', array(), MOCKPRESS_VERSION, 'all');
                wp_enqueue_style('mockpress-w3', MOCKPRESS_URL . 'admin/assets/css/w3.css');
            }
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {
        wp_enqueue_script('mockpress-admin', MOCKPRESS_URL . 'admin/assets/js/mockpress-admin.js', array('jquery'), MOCKPRESS_VERSION, false);
        wp_localize_script('mockpress-admin', 'mp_admin', array(
            'ajax_url' => esc_js(admin_url('admin-ajax.php')),
            'ajax_nonce' => esc_js(wp_create_nonce('mockpress_nonce')),
            'plugin_url' => esc_url(MOCKPRESS_URL),
        ));


        // wp_enqueue_script('petite-vue', 'https://unpkg.com/petite-vue', array(), MOCKPRESS_VERSION, false);
    }

    /**
     * Javascript Translation Stack
     *
     * @return array
     */
    public function admin_init()
    {
        require_once MOCKPRESS_PATH . 'admin/class-ajax.php';
    }

    /**
     * Register Menu in Admin Area
     *
     * LSDDonation Settings
     * Programs
     * Reports
     *
     * @since 1.0.0
     * @return void
     */
    public function admin_menu()
    {
        add_menu_page(
            __('MockPress', 'mockpress'),
            __('MockPress', 'mockpress'),
            'manage_options',
            'mockpress',
            [$this, 'walkthrough'],
            MOCKPRESS_URL . 'admin/assets/img/mockpress.svg',
            3
        );

        // add_submenu_page(
        //     'edit.php?post_type=product',
        //     __( 'Product Grabber' ),
        //     __( 'Grab New' ),
        //     'manage_woocommerce', // Required user capability
        //     'ddg-product',
        //     'generate_grab_product_page'
        // );
    }

    /**
     * Including settings LSDDonation page
     * when clikcing menu LSDDOnation
     *
     * @return void
     */
    public function walkthrough()
    {
        require_once MOCKPRESS_PATH . 'admin/manager/walkthrough.php';
    }
}
Admin::register();
