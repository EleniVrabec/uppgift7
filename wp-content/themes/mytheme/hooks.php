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

$filter_image_title = "Filter"; 
$grid_image_title = "Gridfilter"; 
$list_image_title = "Listview"; 
$line_image_title = "Line"; 

// Hämta bildernas ID baserat på deras titlar
global $wpdb;
$filter_image_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", $filter_image_title ) );
$grid_image_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", $grid_image_title ) );
$list_image_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", $list_image_title ) );
$line_image_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", $line_image_title ) );

// Hook för att öppna anpassad wrapper för produktsidan
add_action( 'woocommerce_before_shop_loop', 'custom_wrapper_open', 19 );
function custom_wrapper_open() {
    global $filter_image_id, $grid_image_id, $list_image_id, $line_image_id;

    echo '<div class="custom-wrapper">';
    
    // Visa formulär för antal produkter att visa
    ?>
    <form class="custom-products-per-page" action="" method="GET">
        <div class="custom-products-per-page-wrapper">
            <label for="custom-products-per-page"><?php _e( 'Show', 'text-domain' ); ?></label>
            <input type="number" name="custom-products-per-page" id="custom-products-per-page" value="<?php echo isset( $_GET['custom-products-per-page'] ) ? esc_attr( $_GET['custom-products-per-page'] ) : ''; ?>" placeholder="<?php _e( '16', 'text-domain' ); ?>" class="custom-products-per-page-input">
        </div>
    </form>
    <?php
    
    // Lägg till ikon för filter från media library
    echo '<div class="filter-icon">';
    if ( $filter_image_id ) {
        echo wp_get_attachment_image( $filter_image_id, 'full', false, array( 'alt' => 'Filter Image' ) ); 
    }
    echo '</div>';

    // Lägg till ikon för gridfilter från media library
    echo '<div class="gridfilter-icon">';
    if ( $grid_image_id ) {
        echo wp_get_attachment_image( $grid_image_id, 'full', false, array( 'alt' => 'Grid Filter Image' ) ); 
    }
    echo '</div>';

    // Lägg till ikon för listvy från media library
    echo '<div class="listview-icon">';
    if ( $list_image_id ) {
        echo wp_get_attachment_image( $list_image_id, 'full', false, array( 'alt' => 'List View Image' ) ); 
    }
    echo '</div>';

    // Lägg till ikon för line från media library
    echo '<div class="line-icon">';
    if ( $line_image_id ) {
        echo wp_get_attachment_image( $line_image_id, 'full', false, array( 'alt' => 'Line Image' ) ); 
    }
    echo '</div>';
}

// Hook för att stänga anpassad wrapper för produktsidan
add_action( 'woocommerce_before_shop_loop', 'custom_wrapper_close', 31 );
function custom_wrapper_close() {
    echo '</div>'; // Stäng den anpassade wrapper
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


// ADDS ADDITIONAL INFO-TAB AFTER CART-BTN
add_action( 'woocommerce_single_product_summary', 'custom_additional_information_after_add_to_cart', 30 );

function custom_additional_information_after_add_to_cart() {
    global $product;
    ob_start();
    include get_theme_file_path( 'woocommerce/single-product/tabs/additional-information.php' );
    $additional_info_content = ob_get_clean();
    echo '<div class="custom-additional-information">' . $additional_info_content . '</div>';

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



/* --------rewuew stars----------------- */
// Remove default WooCommerce action for product rating
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

// Add custom function to display your content in place of the product rating
add_action( 'woocommerce_single_product_summary', 'mytheme_woocommerce_single_product_summary', 10 );

function mytheme_woocommerce_single_product_summary(){

    global $product;
    $rating = $product->get_average_rating();
    $width = ($rating / 5) * 100;

    echo'<div class="rating">
    <div class="fill" style="width:'. $width .'%;"> </div>
     </div>';
   
}


/* ------------------------------------ */


add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );
function custom_woocommerce_catalog_orderby( $options ) {
    $options['menu_order'] = 'Default';
    $options['popularity'] = 'Popularity';
    $options['rating'] = 'Average rating';
    $options['date'] = 'Latest';
    $options['price'] = 'Price: low to high';
    $options['price-desc'] = 'Price: high to low';
    return $options;
}



/* ''''''''''''''SINGLE PAGE''''''''''''''''''' */

/* plus/minus buttons */

add_action( 'wp_footer', 'ts_quantity_plus_minus' );
function ts_quantity_plus_minus() {
    if ( ! is_product() ) return;
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($){   
            $('form.cart').on('click', 'button.plus, button.minus', function() {
                let qty = $( this ).closest( 'form.cart' ).find( '.qty' );
                let val   = parseFloat(qty.val());
                let max = parseFloat(qty.attr( 'max' ));
                let min = parseFloat(qty.attr( 'min' ));
                let step = parseFloat(qty.attr( 'step' ));
                
                if ( $( this ).is( '.plus' ) ) {
                    if ( max && ( max <= val ) ) {
                        qty.val( max );
                    } else {
                        qty.val( val + step );
                    }
                } else {
                    if ( min && ( min >= val ) ) {
                        qty.val( min );
                    } else if ( val > 1 ) {
                        qty.val( val - step );
                    }
                }
                
            });
            
            // Modify the quantity input field to include plus and minus buttons
            $('form.cart .quantity').prepend('<button type="button" class="minus" >-</button>');
            $('form.cart .quantity').append('<button type="button" class="plus" >+</button>');
        });
    </script>
    <?php
}

function hide_footer_on_single_product_page() {
    // CHECKS IF ITS PRODUCTSITE
    if ( is_product() ) {
        // HIDES USP ON PRODUCTSITE
        echo '<style>.footer2 { display: none; }</style>';
    }
}
add_action( 'wp_head', 'hide_footer_on_single_product_page' );



/* ''''''''''''''LOAD MORE''''''''''''''''' */

add_filter( 'woocommerce_product_loop_end', 'bbloomer_related_products_load_more_button' );
  
function bbloomer_related_products_load_more_button( $html ) {
 
   // ONLY TARGET THE RELATED PRODUCTS LOOP
   if ( wc_get_loop_prop( 'name' ) === 'related' ) {
    
      // SHOW BUTTON
        $html .= '<div class="view-more-wrapper">';
        $html .= '<a class="button loadmore">View More</a>';
        $html .= '</div>';

 
      // TRIGGER AJAX 'loadmore' ACTION ON CLICK
      // AND APPEND MORE RELATED PRODUCTS 
      wc_enqueue_js( "
         var page = 2;
         var ajaxurl = '" . admin_url( 'admin-ajax.php' ) . "';
         $('body').on('click', '.loadmore', function(evt) {
            var data = {
               'action': 'loadmore',
               'page': page,
               'product_id': " . get_queried_object_id() . ",
            };
            $.post(ajaxurl, data, function(response) {
               if(response != '') {
                  $('.related .products ').append(response);
                  page++;
               }
            });
         });
      " );
   }
   return $html;
}
 
// DEFINE WHAT HAPPENS WHEN 'loadmore' ACTION TRIGGERS
add_action( 'wp_ajax_nopriv_loadmore', 'bbloomer_related_products_load_more_event' );
add_action( 'wp_ajax_loadmore', 'bbloomer_related_products_load_more_event' );
 
function bbloomer_related_products_load_more_event() {
 
   // GET PARAMETERS FROM POSTED DATA
   $paged = $_POST['page'];
   $product_id = $_POST['product_id'];
 
   // DEFINE USEFUL QUERY ARGS:
   // 1. CURRENT PRODUCT
   $product = wc_get_product( $product_id );
 
   // 2. PAGINATION AND SORTING
   $args = array(
      'posts_per_page' => 4,
      'paged' => $paged,
      'orderby' => 'id',
      'order' => 'desc',
   );
 
   // 3. IDS TO EXCLUDE: ON LOAD MORE, WE DONT WANT THE FIRST 3 RELATED PRODUCTS AGAIN
   // SO WE APPLY AN OFFSET TO GET THE "NEXT 3" PRODUCTS
   $exclude = array_slice( array_map( 'absint', array_values( wc_get_related_products( $product->get_id(), -1 ) ) ), 0 , $args['posts_per_page'] * ( $paged - 1 ) );
 
   // LETS CALCULATE AND SORT RELATED PRODUCTS
   $related_products = array_filter( array_map( 'wc_get_product', wc_get_related_products( $product->get_id(), $args['posts_per_page'], $exclude + $product->get_upsell_ids() ) ), 'wc_products_array_filter_visible' );
   $related_products = wc_products_array_orderby( $related_products, $args['orderby'], $args['order'] );
 
   // LETS DISPLAY THEM
   foreach ( $related_products as $related_product ) {
      $post_object = get_post( $related_product->get_id() );
      setup_postdata( $GLOBALS['post'] =& $post_object );
      wc_get_template_part( 'content', 'product' );
   }  
   wp_die();
 
}


// --- COPYRIGHT ----
function modify_copyright_year($year) {
    // CHANGE YEAR TO 2022
    return '2022';
}

add_filter('copyright_year', 'modify_copyright_year');