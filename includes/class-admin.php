<?php
if (!defined('ABSPATH')) exit;

class MyPlugin_Admin {
    public static function init() {
        add_action('admin_menu', [self::class, 'add_menu']);
    }

    public static function add_menu() {
        add_menu_page(
            'My Plugin',
            'My Plugin',
            'manage_options',
            'my-plugin',
            [self::class, 'render_dashboard'],
            'dashicons-admin-generic',
            25
        );
    }

    public static function render_dashboard() {
        echo '<div class="wrap"><h1>My Plugin Dashboard</h1>';
    
        $contacts = get_option('my_plugin_contacts', []);
    
        if (!empty($contacts)) {
            echo '<h2>Contact Form Submissions</h2>';
            echo '<table class="widefat striped">';
            echo '<thead><tr><th>Name</th><th>Email</th><th>Message</th><th>Submitted At</th></tr></thead><tbody>';
    
            foreach ($contacts as $entry) {
                echo '<tr>';
                echo '<td>' . esc_html($entry['name']) . '</td>';
                echo '<td>' . esc_html($entry['email']) . '</td>';
                echo '<td>' . esc_html($entry['message']) . '</td>';
                echo '<td>' . esc_html($entry['time']) . '</td>';
                echo '</tr>';
            }
    
            echo '</tbody></table>';
        } else {
            echo '<p>No contact form submissions yet.</p>';
        }
    
        echo '</div>';
    }
    
}
