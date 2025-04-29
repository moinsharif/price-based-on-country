<?php
/**
 * Plugin Name: WooCommerce Price Based Country
 * Description: A WooCommerce plugin that changes prices based on the user's country.
 * Version: 1.0
 * Author: Md. Rakibuzzaman
 * Author URI: https://lead-academy.org/
 * Text Domain: woocommerce-price-based-country
 * Domain Path: /languages
 * License: GPL2
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'WOOCOMMERCE_PRICE_BASED_COUNTRY_VERSION', '1.0' );

// Include necessary files
include_once( 'includes/class-price-geolocation.php' );
include_once( 'includes/class-price-handler.php' );
include_once( 'includes/class-exchange-rate.php' );

// Initialize the plugin
function wpcb_initialize() {
    // Initialize geolocation and pricing handler
    Price_Geolocation::get_instance();
    Price_Handler::get_instance();
}
add_action( 'plugins_loaded', 'wpcb_initialize' );
