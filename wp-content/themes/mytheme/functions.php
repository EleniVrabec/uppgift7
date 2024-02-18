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





add_action( 'woocommerce_checkout_before_order_review', 'select_free_shipping_method' );

function select_free_shipping_method() {
    
    $available_methods = WC()->shipping->get_shipping_methods();

    if ( isset( $available_methods['free_shipping'] ) ) {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('input[name="shipping_method[0]"]').filter('[value="free_shipping:1"]').prop('checked', true);
            });
        </script>
        <?php
    }
}

add_action('wp_head', 'hide_hero_container_on_homepage');

function hide_hero_container_on_homepage() {
    if (is_front_page()) {
        echo '<style>.hero-container { display: none; }</style>';
    }
}