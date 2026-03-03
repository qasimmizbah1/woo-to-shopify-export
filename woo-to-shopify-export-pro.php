<?php
/*
Plugin Name: Woo to Shopify Export Pro
Description: Professional WooCommerce to Shopify CSV Export Tool
Version: 1.0
Author: Qasim Dev
*/

if (!defined('ABSPATH')) exit;

define('WSE_PATH', plugin_dir_path(__FILE__));
define('WSE_URL', plugin_dir_url(__FILE__));

require_once WSE_PATH . 'includes/admin-page.php';
require_once WSE_PATH . 'includes/exporter.php';

add_action('admin_enqueue_scripts', function($hook){

    if (strpos($hook, 'woo-shopify-export') === false) return;

    wp_enqueue_style('wse-css', WSE_URL . 'assets/admin.css');
    wp_enqueue_script('wse-js', WSE_URL . 'assets/admin.js', ['jquery'], null, true);

    wp_localize_script('wse-js', 'wseData', [
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('wse_nonce')
    ]);
});