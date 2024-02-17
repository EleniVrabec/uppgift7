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
    



/* function wrap_cart_table_with_div() {
    echo '<div class="tbody-wrapper">';
}
add_action( 'woocommerce_before_cart_table', 'wrap_cart_table_with_div', 5 );

function close_div_wrapper() {
    echo '</div>';
}
add_action( 'woocommerce_after_cart_table', 'close_div_wrapper', 5 );
 */

/* function custom_change_additional_information_tab_title( $title, $key ) {
    if ( 'additional_information' === $key ) {
        // Change the text for the Additional Information tab
        $title = 'Shipping';
    }

    return $title;
} */

/* function custom_change_reviews_tab_title( $title, $key ) {
    if ( 'reviews' === $key ) {
        // Change the text for the Reviews tab
        $title = 'Size Guide';
    }

    return $title;
} */


/* add_filter( 'woocommerce_product_additional_information_tab_title', 'custom_change_additional_information_tab_title', 10, 2 );
add_filter( 'woocommerce_product_reviews_tab_title', 'custom_change_reviews_tab_title', 10, 2 );
 */

add_action('wp_enqueue_scripts', 'enqueue_woocommerce_scripts');

function enqueue_woocommerce_scripts() {
    if (function_exists('is_woocommerce') && is_woocommerce()) {
        wp_enqueue_script('wc-add-to-cart-variation');
    }
}



/* 
function remove_update_cart_button_from_cart() {
    // Remove the "Update cart" button
    remove_action('woocommerce_cart_actions', 'woocommerce_cart_totals', 5);
}

add_action('woocommerce_cart_actions', 'remove_update_cart_button_from_cart');
 */


/* function wrap_tbody_with_div_before_cart_table() {
    echo '<div class="cart-tbody-wrapper">';
}

function wrap_tbody_with_div_after_cart_table() {
    echo '</div><!-- .cart-tbody-wrapper -->';
}

add_action('woocommerce_before_cart_contents', 'wrap_tbody_with_div_before_cart_table', 5);
add_action('woocommerce_after_cart_table', 'wrap_tbody_with_div_after_cart_table', 5);
 */


/* ------------------------------------ */
/* function convert_drowpdown_variables_to_buttons_woocommerce() {
    add_action( 'wp_print_footer_scripts', function() {
 
        
        
    });
};
add_action( 'woocommerce_variable_add_to_cart', 'convert_drowpdown_variables_to_buttons_woocommerce' );
 */


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

