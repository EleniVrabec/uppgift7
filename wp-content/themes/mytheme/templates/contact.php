<?php
/*Template name: contact */
?>


<?php get_header(); ?>
<?php
// Include the hero section
get_template_part('hero-section');
?>
    <!-- content -->
    <main class="content">
       <div class="contact-title">
        <h1>Get In Touch With Us</h1>
        <p>For More Information About Our Product 
            & Services. Please Feel Free To Drop Us An Email. Our Staff Always Be There To Help You Out.
             Do Not Hesitate!</p>
       </div>

       <div class="contact-main">
       <div class="contact-info">
       <div class="column">
 
 <p>
                <?php
                $store_address = get_option('store_address');
                $store_phone = get_option('store_phone');
                $store_email = get_option('store_email');

                if (!empty($store_address)) {
                    echo ' <h3><i class="fas fa-map-marker-alt"></i>Address</h3>' . '<label>' . esc_html($store_address) . '</label>'.'<br>';
                }
                if (!empty($store_phone)) {
                    echo ' <h3><i class="fas fa-phone"></i>Phone</h3>' . '<label>' . esc_html($store_phone) . '</label>'.'<br>';
                }
               // Definiera öppettiderna
    $mon_to_fri_open = '09:00';
    $mon_to_fri_close = '22:00';
    $sat_to_sun_open = '09:00';
    $sat_to_sun_close = '21:00';

    // Hämta dagens dag
    $current_day = strtolower(date('l')); // konvertera till gemener

    // Formatera öppettider för vardagar och helger
    $mon_to_fri_hours = 'Monday-Friday: ' . $mon_to_fri_open . '-' . $mon_to_fri_close;
    $sat_to_sun_hours = 'Saturday-Sunday: ' . $sat_to_sun_open . '-' . $sat_to_sun_close;

    // Skriv ut öppettiderna med ikon för svart klocka
    echo '<h3><i class="fas fa-clock"></i>Working Time</h3> ' . '<label>' . $mon_to_fri_hours . '</label>'. '<br>';
    echo '<label>' . $sat_to_sun_hours . '</label>';
                ?>
            </p>


</div>
       </div>
       <div class="contact-form">
       <form id="contact-form" action="" method="post">
    <label for="name">Your name</label>
    <input type="text" name="name" placeholder="Abc">
    <label for="email">Email address</label>
    <input class="star" type="email" name="email" placeholder="Abc@def.com" required>
    <label for="interested_in">Subject</label>
    <input type="text" name="interested_in" placeholder="This is optional"> 
    <label for="message">Message</label>
    <textarea class="star" name="message" rows="4" placeholder="Hi i'd like to ask about" required></textarea>
    <button class="submit-btn">Submit</button>
</form>
    
       </div>
       </div>
    </main>
<?php get_footer(); ?>