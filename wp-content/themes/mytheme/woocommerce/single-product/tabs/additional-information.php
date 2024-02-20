<?php
/**
 * Additional Information tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/additional-information.php.
 *
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$heading = apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'woocommerce' ) );

?>

<?php if ( $heading ) : ?>
    <h2><?php echo esc_html( $heading ); ?></h2>
<?php endif; ?>

<div class="woocommerce-product-details__additional-information">
    <ul class="product-additional-info">
        <li><span class="info-label">SKU</span>:          <?php echo $product->get_sku(); ?></li>
        <li><span class="info-label">Category</span>:          <?php echo wc_get_product_category_list( $product->get_id(), ', ', '', '' ); ?></li>
        <li><span class="info-label">Tags</span>:          <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '', '' ); ?></li>
        <li class="share-icons">
            <span class="info-label">Share</span>:          
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.linkedin.com/shareArticle?url=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
        </li>
    </ul>

    <?php
    // DEFINES THE IMAGE TITLE
    $heart_image_title = "Heart";

    // GETS THE ATTACHMENT ID
    global $wpdb;
    $heart_image_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'attachment'", $heart_image_title ) );
    ?>

    <div class="heart">
        <?php
        // SHOWS THE HEART IMAGE IF IT EXISTS
        if ($heart_image_id) {
            
            echo wp_get_attachment_image($heart_image_id, 'thumbnail', false, array('alt' => 'Like Button'));
        }
        ?>
    </div>

</div>