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
    <div class="banner"><p>Shipping is free for all UK orders, and on all international orders £125/175/$200 or above.</p></div>
    <header>
        <div class="column-50">
            <!--  <div class="column"> -->
 
                 <a href="/">
                    <h1>KJOERG</h1>
                    <!-- <img class="logo" src="<?=get_template_directory_uri() . '/assets/images/logo_black.png';?>" alt="logo"> -->
                </a>
            <!--  </div>   -->        
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