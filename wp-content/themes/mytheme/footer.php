<footer>
    <section class="footer2">
        <div class="column">
            <h1>Free Delivery</h1>
            <p>For all orders over $50, consectetur adipiscing elit.</p>
        </div>
        <div class="column">
            <h2>90 Days Return</h2>
            <p>If goods have problems, consectetur adipiscing elit.</p>
        </div>
        <div class="column">
            <h2>Secure Payment</h2>
            <p>100% secure payment, consectetur adipiscing elit.</p>
        </div>
    </section>
</footer>

<!-- Din befintliga footer fortsätter här -->
<footer>
    <section class="container">
        <div class="footercolumn1">
            <?php
            // Hämta butiksadress, stad, postnummer och land
            $store_address = get_option('woocommerce_store_address');
            $store_city = get_option('woocommerce_store_city');
            $store_postcode = get_option('woocommerce_store_postcode');
            $store_country = get_option('woocommerce_store_country');
            
            // Skriv ut adressen med korrekt formatering
            echo esc_html($store_address) . '';
            echo esc_html($store_city) . ',<br>';
            echo 'FL ' . $store_postcode . ' USA';
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
            <div class="column-51">
    
                <?php 
                $menu = array(
                    'menu' => 'Footer', // Ange namnet på den menyn du vill visa
                    'menu_id' => 'footermeny',
                    'container' => 'nav',
                    'theme_location' => 'Footer Menu 1',
                    'container_class' => 'Footer_Menu_1' // Observera att det är bättre att använda en klassnamn utan mellanslag
                );

                wp_nav_menu($menu);
                ?>
                
            <!--   <button class="hamburger">&#9776;</button>      -->
            </div>
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