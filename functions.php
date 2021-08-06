<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', function() {
    $styles = wp_styles();
    $styles->add_data( 'twentytwenty-style', 'after', array() );
}, 20 );

function sg_add_google_fonts() {
   wp_register_style( 'googleFonts', 'https://fonts.googleapis.com/css2?family=Shippori+Mincho&display=swap');
   wp_enqueue_style( 'googleFonts');
}
add_action( 'wp_enqueue_scripts', 'sg_add_google_fonts' );

function sg_add_typesquare_tag() {
    echo '<script type="text/javascript" src="//typesquare.com/3/tsst/script/ja/typesquare.js?6109e6210a344f8590530e37ac1e02e5" charset="utf-8"></script>';

    $query='<script type="text/javascript">
    function showNextWagashi() {
        var date = new Date();
        var month = date.getMonth();
        var day = date.getDay();
        var next_month = day > (16 - 1) ? month + 1 : month;
        var targets = jQuery("div[class*=sg-monthly]");
        var spacer = jQuery(".sg-next-wagashi");
        if (spacer.length == 0) {
            return;
        }

        target = jQuery(targets[next_month]).clone(true);
        target.appendTo(spacer);

        headers = jQuery(".sg-next-wagashi h3");
        var header= jQuery(headers[0]);
        var title = header.text();
        header.text(title.replace("%s", String(month + 1)));
        headers[1].remove();
    }

    function checkAndShowMonthly() {
        var targets = jQuery(".sg-monthly");
        targets.each(function(index, elm) {
            var margin = 70;
            var target = jQuery(elm);
            var target_top = target.offset().top;
            var win_height = jQuery(window).height();
            var scroll_top = jQuery(window).scrollTop();
            if(scroll_top - margin > target_top - win_height) {
                target.toggleClass("sg-monthly sg-monthly-shown");
            }
        });
    }

    jQuery(window).load(function() {
        showNextWagashi();
        checkAndShowMonthly();
    })
    jQuery(window).scroll(function() { checkAndShowMonthly(); })
</script>';
    echo $query;
}
add_action( 'wp_head', 'sg_add_typesquare_tag' )
?>
