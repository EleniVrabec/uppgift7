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
        <li>SKU: <?php echo $product->get_sku(); ?></li>
        <li>Category: <?php echo wc_get_product_category_list( $product->get_id(), ', ', '', '' ); ?></li>
        <li>Tags: <?php echo wc_get_product_tag_list( $product->get_id(), ', ', '', '' ); ?></li>
        <li>
            Share:
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><i class="fab fa-facebook"></i></a>
            <a href="https://www.linkedin.com/shareArticle?url=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo esc_url( get_permalink() ); ?>" target="_blank"><i class="fab fa-twitter"></i></a>
        </li>
    </ul>

    <div class="heart">
        <img src="additional-info-image-url" alt="likebutton">
    </div>

</div>