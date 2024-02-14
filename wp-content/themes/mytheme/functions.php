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


// functions.php eller ditt anpassade temats funktioner-fil

function min_anpassade_knapp() {
    echo '<p> or </p>';
    echo '<a href="#" class="min-anpassade-knapp button">Try at home</a>';
}

add_action('woocommerce_after_add_to_cart_button', 'min_anpassade_knapp', 20);

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


function custom_change_additional_information_tab_title( $title, $key ) {
    if ( 'additional_information' === $key ) {
        // Change the text for the Additional Information tab
        $title = 'Shipping';
    }

    return $title;
}

function custom_change_reviews_tab_title( $title, $key ) {
    if ( 'reviews' === $key ) {
        // Change the text for the Reviews tab
        $title = 'Size Guide';
    }

    return $title;
}


add_filter( 'woocommerce_product_additional_information_tab_title', 'custom_change_additional_information_tab_title', 10, 2 );
add_filter( 'woocommerce_product_reviews_tab_title', 'custom_change_reviews_tab_title', 10, 2 );


add_action('wp_enqueue_scripts', 'enqueue_woocommerce_scripts');

function enqueue_woocommerce_scripts() {
    if (function_exists('is_woocommerce') && is_woocommerce()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}





/* ------------------------------------ */
/* function convert_drowpdown_variables_to_buttons_woocommerce() {
    add_action( 'wp_print_footer_scripts', function() {
 
        
        
    });
};
add_action( 'woocommerce_variable_add_to_cart', 'convert_drowpdown_variables_to_buttons_woocommerce' );
 */