<?php

/**
 * Plugin Name: Slider Salvador
 * Plugin URI: https://wordpress.org/slider-salvador
 * Description: Plugin de Slides
 * Version: 0.0.1
 * Requires at least: 5.6
 * Author: Salvador Egito
 * Author URI: sevosports.com
 * Licence: GPL v2 or later
 * Licence URI: https://www.gnu.org/licences/gpl-2.0.html
 * Text Domain: slider-salvador
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('SSalvador')) {
    class SSalvador
    {
        function __construct()
        {
            $this->define_constantes();

            require_once(SS_PATH . 'cpt/class-slider-salvador-cpt.php');
            $Slider_Salvador_Post_Type = new Slider_Salvador_Post_Type();
        }

        public function define_constantes()
        {
            define('SS_PATH', plugin_dir_path(__FILE__));
            define('SS_URL', plugin_dir_url(__FILE__));
            define('SS_VERSION', '0.0.1');
        }

        public static function activate()
        {
            update_option('rewrite_rules', '');
        }

        public static function deactivate()
        {
            flush_rewrite_rules();
            unregister_post_type('slider-salvador');
        }

        public static function uninstall()
        {
        }
    }
}

if (class_exists('SSalvador')) {
    register_activation_hook(__FILE__, array('SSalvador', 'activate'));
    register_deactivation_hook(__FILE__, array('SSalvador', 'deactivate'));
    register_uninstall_hook(__FILE__, array('SSalvador', 'uninstall'));
    $ssalvador = new SSalvador();
}
