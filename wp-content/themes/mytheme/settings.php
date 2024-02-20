<?php 


if(!is_admin()) {
    return;
}

//lägger till ett menu alternative i dashboard settings
function mytheme_add_settings() {
    // global $submenu;

    add_submenu_page(
        "options-general.php",
        "Butik",              //page title
        "Butik",
        "edit_pages",
        "butik",
        "mytheme_add_setting_callback"
    );
}

function mytheme_add_setting_callback() {
    ?>
        <div class="wrap">
            <h2>Butiksinställningar</h2>
            <form action="options.php" method="post">
                <?php
                    settings_fields("butik");
                    do_settings_sections("butik");
                    submit_button();
                ?>
            </form>
        </div>
    <?php
}

add_action('admin_menu', 'mytheme_add_settings');

//registrerar inställningar tillgängliga på sidan "Butik"
function mytheme_add_settings_init() {
    add_settings_section(
        'butik_general',
        'General',
        'mytheme_add_settings_section_general',
        'butik'
    );

    //------------------
    //message
    //------------------
    register_setting(
        "butik",
        "store_message"
    );

    add_settings_field(
        "store_message",           //id
        "Store Message",           //title(will be shown on setting-butik page)
        "mytheme_section_setting", //callback function
        "butik",                   //page
        "butik_general",           //section
        array(                     //multiple parameter
            "option_name" => "store_message",
            "option_type" => "text"
        )
    );

    //------------------
    // open hours
    //------------------
    register_setting(
        "butik",
        "store_open"
    );

    add_settings_field(
        "store_open",             
        "Open Time",               
        "mytheme_section_setting", 
        "butik",                   
        "butik_general",          
        array(                     
            "option_name" => "store_open",
            "option_type" => "time"
        )
    );

    
// Funktion för att rendera öppettidsinställningsfältet
function mytheme_section_setting_opening_hours() {
    $option_name = "store_opening_hours";
    $option_value = get_option($option_name);

    echo '<input type="time" id="monday_open" name="' . $option_name . '[monday_open]" value="' . esc_attr($option_value['monday_open']) . '"> - ';
    echo '<input type="time" id="monday_close" name="' . $option_name . '[monday_close]" value="' . esc_attr($option_value['monday_close']) . '"><br>';
    // Upprepa för andra dagar...
}


    //------------------
    // open hours
    //------------------
    register_setting(
        "butik",
        "store_show_message"
    );

    add_settings_field(
        "show_message",          
        "Show Message",           
        "mytheme_section_setting", 
        "butik",                   
        "butik_general",           
        array(                    
            "option_name" => "store_show_message",
            "option_type" => "checkbox"
        )
    );

    //------------------
    // Adress
    // -----------------
    register_setting(
        'butik',
        'store_address'
    );

    add_settings_field(
        'store_address',
        'Store Address',
        'mytheme_section_setting',
        'butik',
        'butik_general',
        array(
            'option_name' => 'store_address',
            'option_type' => 'text'
        )
        );
        //------------------
    // Telefonnummer
    //------------------
    register_setting(
        "butik",
        "store_phone"
    );

    add_settings_field(
        "store_phone",
        "Store Phone",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_phone",
            "option_type" => "tel"
        )
    );

    //------------------
    // E-post
    //------------------
    register_setting(
        "butik",
        "store_email"
    );

    add_settings_field(
        "store_email",
        "Store Email",
        "mytheme_section_setting",
        "butik",
        "butik_general",
        array(
            "option_name" => "store_email",
            "option_type" => "email"
        )
    );
    
}
add_action('admin_init', 'mytheme_add_settings_init');

// Ritar ut sektionen "general"s beskrivning 
function mytheme_add_settings_section_general() {
    echo "<p> Generella inställningar för butiken</p>";
}

// Ritar ut inställningsfältet
function mytheme_section_setting($args) {
    $option_name = $args["option_name"];
    $option_type = $args["option_type"];
    $option_value = get_option($args["option_name"]);
    //skriv in i DB
    
    echo '<input type="' . $option_type .'" 
                 id="' . $option_name . '" 
                 name="' . $option_name . '" 
                 value="'. $option_value. '"
          />';
}