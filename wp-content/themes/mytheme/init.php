<?php
require_once('settings.php');
require_once('shortcodes.php');

// Enqueue Font Awesome stylesheet
function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

// Enqueue Roboto font
function enqueue_roboto_font() {
    wp_enqueue_style('roboto-font', 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap', array(), null);
}
add_action('wp_enqueue_scripts', 'enqueue_roboto_font');


function mytheme_enqueue(){
    $theme_directory = get_template_directory_uri();
    wp_enqueue_style('mystyle', $theme_directory . '/style.css');
    wp_enqueue_style('product-style', $theme_directory . './style/product_style.css', array('mystyle'), '1.0', 'all');
     wp_enqueue_script('app', $theme_directory . '/app.js');


     //praka data ili variabli vo app vo javascript
     $data = array();
     $data['myoption'] = get_option('myoption');
     $data['color'] = 'blue';
     $data['name'] = 'Eleni';
     $data['testDB'] = get_option('blogdescription');
     wp_localize_script('app', 'myvariables', $data);
 }

add_action('wp_enqueue_scripts', 'mytheme_enqueue');

function mytheme_init(){
    $menus = array(
        'huvudmeny' => 'huvudmeny' ,
        'cart-meny' => 'cart-meny' ,
        'footer_menu_1' => 'Footer Menu 1',
        'footer_menu_2' => 'Footer Menu 2',
        'footer_menu_3' => 'Footer Menu 3',
        'footer_menu_4' => 'Footer Menu 4'
    );
register_nav_menus($menus);
}
add_action('after_setup_theme', 'mytheme_init');

