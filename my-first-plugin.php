<?php
/**
 * Plugin Name: My First Plugin
 * Description: A custom plugin with frontend form, admin dashboard, and REST API.
 * Version: 1.0
 * Author: Sabira
 * Author URI: https://example.com
 * Text Domain: my-first-plugin
 */

if (!defined('ABSPATH')) exit;

// Load required files
require_once plugin_dir_path(__FILE__) . 'includes/class-frontend.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-admin.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-api.php';

// Initialize plugin components
MyPlugin_Frontend::init();
MyPlugin_Admin::init();
MyPlugin_API::init();

// Handle form submission
add_action('admin_post_my_plugin_save_form', 'my_plugin_handle_form');
add_action('admin_post_nopriv_my_plugin_save_form', 'my_plugin_handle_form');

function my_plugin_handle_form() {
    if (!empty($_POST['my_name'])) {
        $name = sanitize_text_field($_POST['my_name']);
        $saved = get_option('my_plugin_names', []);
        $saved[] = $name;
        update_option('my_plugin_names', $saved);
    }
    wp_redirect(home_url()); // Change this to a thank-you page if needed
    exit;
}
// Handle contact form submissions
add_action('admin_post_my_plugin_save_contact', 'my_plugin_save_contact_form');
add_action('admin_post_nopriv_my_plugin_save_contact', 'my_plugin_save_contact_form');

function my_plugin_save_contact_form() {
    $data = [
        'name' => sanitize_text_field($_POST['contact_name']),
        'email' => sanitize_email($_POST['contact_email']),
        'message' => sanitize_textarea_field($_POST['contact_message']),
        'time' => current_time('mysql'),
    ];

    $all = get_option('my_plugin_contacts', []);
    $all[] = $data;
    update_option('my_plugin_contacts', $all);

    wp_redirect(home_url()); // Redirect after submission
    exit;
}
