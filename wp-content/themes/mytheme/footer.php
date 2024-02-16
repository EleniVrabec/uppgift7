
<footer>
    <section class="container">
    <div class="column">
 
    Sätt in hooks för adress här


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
 <div class="social-icons">
      
 <a href="#" target="_blank"><i class="fab fa-facebook social_media_icon"></i></a>
 <a href="#" target="_blank"><i class="fab fa-twitter social_media_icon"></i></a>
 <a href="#" target="_blank"><i class="fab fa-pinterest social_media_icon"></i></a>

 <a href="#" target="_blank"><i class="fab fa-linkedin social_media_icon"></i></a>


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