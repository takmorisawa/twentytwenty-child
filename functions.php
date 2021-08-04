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
}
add_action( 'wp_head', 'sg_add_typesquare_tag' )
?>
