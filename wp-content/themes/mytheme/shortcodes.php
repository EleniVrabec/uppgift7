<?php
   /*  // 1. Lägg till shortcodes.php i init.php
    // 2. Lägg till kortkoden i en sida och använd "[mytheme_box]" som kortkod
    // 3. Kan använda shortcode för att implementera funktioner som swish, klana, etc.

    // Funktion för att rita en ruta med kortkoden [mytheme_box] */
    //function mytheme_shortcode_draw_box($attr) {
       /*  // När kortkoden [mytheme_box] används i en sida, kommer första värdet att vara standardvärdet
        // Om parametern [$attr] inte är specificerad används innehållet i denna array som standard
        // Om parametern [$attr] är specificerad, används den på följande sätt: [mytheme_box color="lime" size="5"]
        // Då används användarens specificerade innehåll */
      //  $attr = shortcode_atts(
          //  array(
             //   "color" => "green",
             //   "size" => 1
          //  ),
           // $attr,
          //  "mytheme_box"
       // );

       /*  // Generera HTML för en ruta med specifik färg och storlek */
       // return '<div style="width:100px; height:100px; background:' . $attr["color"] . '"></div>';
  //  }

  /*   // Registrera kortkoden med namnet [mytheme_box] och koppla den till funktionen mytheme_shortcode_draw_box */
   // add_shortcode("mytheme_box", "mytheme_shortcode_draw_box");
    
   // shortcodes.php

function mytheme_contact_form_shortcode() {
    ob_start(); /* // Starta outputbuffring - ob_start() är en PHP-funktion
     som startar en outputbuffert. 
     En outputbuffert används för att fånga allt utskrivet innehåll 
    och hålla det i minnet utan att skicka det direkt till webbläsaren. */
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
