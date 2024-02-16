<!-- Hero Section -->
<?php
// Get the uploads directory URL
$uploads_dir = wp_upload_dir();

// Get the base URL of the uploads directory
$uploads_base_url = $uploads_dir['baseurl'];

// Specify the relative path to your image within the uploads directory
$image_path = '/2024/02/Rectangle-1.png';

// Combine the uploads base URL with the image path to get the full image URL
$image_url = $uploads_base_url . $image_path;
?>

<div class="hero-container" style="background-image: url('<?php echo esc_url($image_url); ?>');">
    <!-- Logo -->
    <div class="logo">
        <img src="<?php echo get_stylesheet_directory_uri() . '/resources/images/Meubel House_Logos-05.png'; ?>" alt="Logo">
    </div>
    
    <!-- Page Title -->
    <h1 class="woocommerce-products-header__title page-title">
        <?php
        if ( is_shop() ) {
            echo 'Shop'; // Display "Shop" as the title for the shop page
        } else {
            the_title(); // Display the page title for other pages
        }
        ?>
    </h1>

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <?php woocommerce_breadcrumb(); ?>
    </div>
</div>
