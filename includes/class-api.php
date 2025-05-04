<?php
if (!defined('ABSPATH')) exit;

class MyPlugin_API {
    public static function init() {
        add_action('rest_api_init', [self::class, 'register_routes']);
    }

    public static function register_routes() {
        register_rest_route('myplugin/v1', '/message', [
            'methods' => 'GET',
            'callback' => [self::class, 'get_message'],
            'permission_callback' => '__return_true',
        ]);
    }

    public static function get_message() {
        return rest_ensure_response(['message' => 'Hello from My Plugin API!']);
    }
}
