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

/* *******SHOP******* */

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


// add sort by label 

add_action( 'wp_footer', 'custom_catalog_ordering_label_script' );

function custom_catalog_ordering_label_script() {
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('.woocommerce-ordering').prepend('<label for="orderby">Sort by </label>');
        });
    </script>
    <?php
}

// Change 'Next' text
add_filter( 'woocommerce_pagination_args', 'change_next_pagination_text' );

function change_next_pagination_text( $args ) {
    $args['next_text'] = __( 'Next', 'woocommerce' ); 
    return $args;
}


// remove the sidebar and search in the shop page
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );


/* *******CART******* */

//change text on proceed to checkout btn
function woocommerce_button_proceed_to_checkout() {
	
    $new_checkout_url = WC()->cart->get_checkout_url();
    ?>
    <a href="<?php echo $new_checkout_url; ?>" class="checkout-button button alt wc-forward">
    
    <?php _e( 'Check Out', 'woocommerce' ); ?></a>
    
<?php
}

//removes shipping 
    add_filter( 'woocommerce_cart_needs_shipping', 'filter_cart_needs_shipping' );
    function filter_cart_needs_shipping( $needs_shipping ) {
        if ( is_cart() ) {
            $needs_shipping = false;
        }
        return $needs_shipping;
    }

    function change_breadcrumb_delimiter( $defaults ) {
        // Ändra delimitern till >
        $defaults['delimiter'] = '<span class="breadcrumb-icon"> > </span> ';
    
        return $defaults;
    }
    add_filter( 'woocommerce_breadcrumb_defaults', 'change_breadcrumb_delimiter' );
    



// Funktion för att lägga till bilder från media library till WordPress-meny
function add_menu_icons($items, $args) {
    // Kontrollera om det är huvudmenyn och om vi är i adminläge
    if ($args->theme_location == 'cart-meny' && !is_admin()) {
        // Ersätt menytext med bilder från media library
        $items = str_replace('My account', get_menu_image_html('user'), $items);
        $items = str_replace('About', get_menu_image_html('search'), $items);
        $items = str_replace('Checkout', get_menu_image_html('liked'), $items);
        $items = str_replace('Cart', get_menu_image_html('cart'), $items);
    }
    return $items;
}

// Lägg till hook för att köra funktionen
add_filter('wp_nav_menu_items', 'add_menu_icons', 10, 2);

// Funktion för att hämta HTML för bild från media library baserat på titel
function get_menu_image_html($title) {
    // Hämta ID för bild baserat på titel
    $image_id = attachment_url_to_postid(get_menu_image_url($title));

    // Kontrollera om det finns en giltig bild
    if ($image_id) {
        // Hämta bildens HTML
        $image_html = wp_get_attachment_image($image_id, 'full', false, array('class' => 'menu-image'));
        return $image_html;
    }
    return ''; // Returnera tom sträng om ingen bild hittades
}

// Funktion för att hämta URL till bild från media library baserat på titel
function get_menu_image_url($title) {
    $args = array(
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'post_status'    => 'inherit',
        'posts_per_page' => 1,
        'title'          => $title,
    );

    $attachments = get_posts($args);

    if ($attachments) {
        return wp_get_attachment_url($attachments[0]->ID);
    }

    return ''; // Returnera tom sträng om ingen bild hittades
}

