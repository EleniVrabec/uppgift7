<?php
/*Template name: my template */
?>
<?php
    function mytheme_color_change($color) {
        if($color == "red") {
            return "blue";
        } else {
            return $color;
        }
    }
    //为名为【mytheme_color_filter】的过滤器，添加函数名【mytheme_color_change】
    add_filter("mytheme_color_filter", "mytheme_color_change")
?>


<?php get_header(); ?>
<!-- content -->
<main class="content">
    <?php

        $color = "red";
        // "mytheme_color_filter"：这是过滤器的名称
        // 开发者可以通过添加与此名称匹配的过滤器函数来修改 $color 变量的值。
        $result = apply_filters("mytheme_color_filter", $color);

    ?>

    <div style="width:100px; height:100px; background:<?=$result?>;"></div> 
</main>
<?php get_footer(); ?>  