<?php get_header();?>
<?php
    // Include the hero section
    get_template_part('hero-section');
    ?>
<!-- CONTENT -->
<main class="content">

        <?= the_content() ?>
        <?php
            do_action("mytheme_page_content_loaded");
        
        ?>

    </main>
<?php get_footer();?>