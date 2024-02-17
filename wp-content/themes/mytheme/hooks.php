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