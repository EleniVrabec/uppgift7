<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?=get_option('blogname');?></title>
    <!-- //loads everything in head  -->
    <?php wp_head();?>
</head>
<body>
    
    <?php wp_body_open(); ?>
   
    <header>
        <div class="column-50">
                
        </div>
        <div class="column-51">
        
            <?php 
            $menu = array(
                'theme_location' => 'huvudmeny',
                'menu_id' => 'primary-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            
            wp_nav_menu($menu); ?>    
          <!--   <button class="hamburger">&#9776;</button>      -->
        </div>
        <div class="column-51">
        
            <?php 
            $menu = array(
                'theme_location' => 'cart-meny',
                'menu_id' => 'cart-menu',
                'container' => 'nav',
                'container_class' => 'menu'
            );
            
            wp_nav_menu($menu); ?>    
          <!--   <button class="hamburger">&#9776;</button>      -->
        </div>
    </header>