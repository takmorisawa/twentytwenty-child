<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', function() {
    $styles = wp_styles();
    $styles->add_data( 'twentytwenty-style', 'after', array() );
}, 20 );

add_action('send_headers', 'cors_http_header');
function cors_http_header() {
    header("Access-Control-Allow-Origin: http://wf.typesquare.com");
}

add_filter('init','flushRules');
function flushRules(){
    global $wp_rewrite;
    $wp_rewrite->flush_rules();
}
add_filter('rewrite_rules_array', 'sg_insert_rewrite_rules');
function sg_insert_rewrite_rules($rules)
{
    $newrules = array();
    $newrules['en'] = 'index.php?lang=en';
    $newrules['([^/]*)/?en/?$'] = 'index.php?pagename=$matches[1]&lang=en';
    return $newrules + $rules;
}

function sg_add_google_fonts() {
   wp_register_style( 'googleFonts', 'https://fonts.googleapis.com/css2?family=Shippori+Mincho&display=swap');
   wp_enqueue_style( 'googleFonts');
}
add_action( 'wp_enqueue_scripts', 'sg_add_google_fonts' );

function sg_add_javascripts() {
    echo '<script type="text/javascript" src="//typesquare.com/3/tsst/script/ja/typesquare.js?6109e6210a344f8590530e37ac1e02e5" charset="utf-8"></script>';
    echo '<script type="text/javascript" src="' . get_stylesheet_directory_uri () . '/assets/js/sg-customize.js" charset="utf-8"></script>';
}
add_action( 'wp_head', 'sg_add_javascripts' );

function add_query_vars_filter( $vars ){
    $vars[] = "lang";
    return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );

//add_action( 'wp_footer', 'sg_switch_language' );
function sg_switch_language() {
    if (get_query_var('lang') == 'en') {
        echo the_content();
    }
}

?>
