<?php


function mytheme_contact_form_shortcode() {
    ob_start(); 
    ?>

<form id="contact-form" action="" method="post">
    <input type="text" name="name" placeholder="Name">
    <input class="star" type="tel" name="phone" placeholder="Phone Number *" required>
    <input class="star" type="email" name="email" placeholder="E-mail *" required>
    <input type="text" name="interested_in" placeholder="Interested In"> 
    <textarea class="star" name="message" rows="4" placeholder="Message *" required></textarea>
</form>



    <?php
    // Hämta innehållet som genererats i outputbufferten och rensa bufferten
    return ob_get_clean();
}

// Registrera kortkoden med namnet [mytheme_contact_form] och koppla den till funktionen mytheme_contact_form_shortcode
add_shortcode('mytheme_contact_form', 'mytheme_contact_form_shortcode');


function custom_shortcode_output() {
    ob_start(); // Start output buffering
    echo '<h1 class="header">Main Focus/Mission Statement</h1>';
    // Container div
    echo '<div class="custom-container">';
   
    // First child div
    echo '<div class="custom-child">';
    echo '<div class="column_head">';
    echo '<h1>1</h1>';
    echo '</div>';
    echo '<div class="column">';
    echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>';
    echo '</div>';
    echo '</div>';

    // Second child div
    echo '<div class="custom-child">';
    echo '<div class="column_head">';
    echo '<h1>2</h1>';
    echo '</div>';
    echo '<div class="column">';
    echo '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
    Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>';
    echo '</div>';
    echo '</div>';

    echo '</div>'; 

    return ob_get_clean(); // Return the buffered content
}

// Register the shortcode
add_shortcode('custom_shortcode', 'custom_shortcode_output');



?>
