<?php

if(!defined('ABSPATH')){
    exit;
}
require_once('vite.php');
//initialize theme
require_once(get_template_directory() . '/init.php');

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


add_action('wp_enqueue_scripts', 'enqueue_woocommerce_scripts');

function enqueue_woocommerce_scripts() {
    if (function_exists('is_woocommerce') && is_woocommerce()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}

add_filter('woocommerce_package_rates', 'restrict_shipping_options', 10, 2);

function restrict_shipping_options($rates, $package) {
    
    $free_shipping_available = false;
    foreach ($rates as $rate) {
        if ($rate->method_id === 'free_shipping') {
            $free_shipping_available = true;
            break;
        }
    }

    if ($free_shipping_available) {
        foreach ($rates as $key => $rate) {
            if ($rate->method_id !== 'free_shipping') {
                unset($rates[$key]);
            }
        }
    }

    return $rates;
}

add_action('wp_head', 'hide_hero_container_on_homepage');

function hide_hero_container_on_homepage() {
    if (is_front_page()) {
        echo '<style>.hero-container { display: none; }</style>';
    }
}

