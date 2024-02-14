<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woo.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}
// Hämta värden från anpassade fält
$size_medium = get_post_meta($post->ID, 'Medium', true);
?>
<div class="woocommerce-product-details__short-description">
	<?php echo $short_description; // WPCS: XSS ok. ?>
</div>

<!-- <div id="size_wrapp">

<div > <p> Select size <span> <?php echo esc_html($size_medium); ?></span></p> <p> Size guide </p> </div>
<div>
	<button>134mm <span><?php echo esc_html($size_medium); ?></span></button>
	<button>134mm <span>Large</span></button>
	<button>134mm <span>Extra Large</span></button>
	
</div>
</div> -->