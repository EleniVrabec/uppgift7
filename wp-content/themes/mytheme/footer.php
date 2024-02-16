<footer>
    <section class="footer2">
        <div class="column">
            <h1>Free Delivery</h1>
            <p>For all oders over $50, consectetur adipim scing elit.</p>
        </div>
        <div class="column">
            <h2>90 Days Return</h2>
            <p>If goods have problems, consectetur adipim scing elit.</p>
        </div>
        <div class="column">
            <h2>Secure Payment</h2>
            <p>100% secure payment, consectetur adipim scing elit.</p>
        </div>
    </section>
</footer>

<!-- Din befintliga footer fortsätter här -->
<footer>
    <section class="container">
        <div class="column">
            <?php
            $store_address = get_option('woocommerce_store_address');
            $store_address .= get_option('woocommerce_store_city');
            $store_address .= get_option('woocommerce_store_postcode');
            $store_address .= get_option('woocommerce_store_country');
            
            echo esc_html($store_address);
            ?>
        </div>
        <div class="column">
            <span class="category">Links</span>
            <?php
            $menu_about_us = array(
                'theme_location' => 'huvudmeny',
                'menu_id' => 'footermeny',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            wp_nav_menu($menu_about_us);
            ?>
        </div>
        <div class="column">
            <span class="category">Help</span>
            <p>
                <?php
                $store_address = get_option('store_address');
                $store_phone = get_option('store_phone');
                $store_email = get_option('store_email');

                if (!empty($store_address)) {
                    echo '<i class="fas fa-map-marker-alt"></i>    ' . esc_html($store_address) . '<br>';
                }
                if (!empty($store_phone)) {
                    echo '<i class="fas fa-phone"></i>    ' . esc_html($store_phone) . '<br>';
                }
                if (!empty($store_email)) {
                    echo '<i class="far fa-envelope"></i>    ' . esc_html($store_email) . '<br>';
                }
                ?>
            </p>
        </div>
        <div class="column">
            <span class="category">Newsletter</span>
            <div class="newsletter-form">
                <input type="email" placeholder="Enter Your Email Address">
                <button type="submit">SUBSCRIBE</button>
            </div>
        </div>
    </section>
    <div class="copyright">
        <p>&copy; <?php echo date("Y"); ?> All rights reserved</p>
    </div>
</footer>




    <?php 
wp_footer();
?>
</body>
</html>