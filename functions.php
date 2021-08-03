<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', function() {
    $styles = wp_styles();
    $styles->add_data( 'twentytwenty-style', 'after', array() );
}, 20 );
?>
