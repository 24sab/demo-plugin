<?php
if (!defined('ABSPATH')) exit;

class MyPlugin_Frontend {
    public static function init() {
        add_shortcode('my_plugin_form', [self::class, 'render_form']);
        add_shortcode('my_plugin_contact_form', [self::class, 'render_contact_form']);
    }

    public static function render_form() {
        ob_start();
        include plugin_dir_path(__FILE__) . '/../templates/form.php';
        return ob_get_clean();
    }


    public static function render_contact_form() {
        ob_start();
        include plugin_dir_path(__FILE__) . '/../templates/contact-form.php';
        return ob_get_clean();
    }
}

