<?php

add_filter('woocommerce_default_address_fields', 'custom_change_address_placeholders');

function custom_change_address_placeholders($fields) {
    
    $fields['address_1']['placeholder'] = __('', 'woocommerce');
    $fields['email']['default'] = '';

    return $fields;
}

add_filter('woocommerce_checkout_fields', 'customize_order_comments_field');

function customize_order_comments_field($fields) {
    // Remove the existing order comments field
    unset($fields['order']['order_comments']);

    // Add a new order comments field as a text input
    $fields['order']['order_comments'] = array(
        'type' => 'text',
        'label' => __('Order Comments', 'woocommerce'),
        'placeholder' => __('Additional information', 'woocommerce'),
        'required' => false,
        'class' => array('form-row-wide'),
        'clear' => true,
    );

    return $fields;
}

//remove the add to cart btn from shop page
add_action( 'woocommerce_after_shop_loop_item', 'remove_add_to_cart_buttons', 1 );

    function remove_add_to_cart_buttons() {
      if( is_shop()) { 
        remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
      }
    }

// hook to wrap the showing results and sorting in shop page
add_action( 'woocommerce_before_shop_loop', 'custom_wrapper_open', 19 );
    function custom_wrapper_open() {
        echo '<div class="custom-wrapper">';
    }
    
 add_action( 'woocommerce_before_shop_loop', 'custom_wrapper_close', 31 );
    function custom_wrapper_close() {
        echo '</div>';
    }

// remove the sidebar and search in the shop page
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );