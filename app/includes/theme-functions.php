<?php

function oyetheme_setup() {
    // This theme styles the visual editor with editor-style.css to match the theme style.
    add_editor_style();

    // This theme supports a variety of post formats.
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

    // This theme uses wp_nav_menu() in one location.
    register_nav_menu( 'primary', __( 'Primary Menu', 'oye' ) );

}
add_action( 'after_setup_theme', 'oyetheme_setup' );

// add featured Image
add_theme_support( 'post-thumbnails' );



function es_add_body_class( $new_classes ) {
    // Turn the input into an array we can loop through
    if ( ! is_array( $new_classes ) )
        $new_classes = explode( ' ', $new_classes );

        // Add a filter on the fly
    add_filter( 'body_class', function( $classes ) use( $new_classes ) {
        foreach( $new_classes as $new_class )
        $classes[] = $new_class;

        return $classes;
    });
}


// Allow File Extension Upload Support
add_filter('upload_mimes', 'my_myme_types', 1, 1);
function my_myme_types($mime_types){
   $mime_types['eps']  = 'application/eps';
   $mime_types['svg']  = 'image/svg+xml';
   return $mime_types;
}

// Function to use for wp_mail as html
function set_html_content_type() {
    return 'text/html';
}

// Remove tags support from posts
function myprefix_unregister_tags() {
    unregister_taxonomy_for_object_type('post_tag', 'post');
}
add_action('init', 'myprefix_unregister_tags');


// Remove wordpress Embedded script from Frontend
add_action( 'wp_footer', 'my_deregister_scripts' );
function my_deregister_scripts(){
  wp_deregister_script( 'wp-embed' );
}

// Disable Contact Form 7 Js ad CSS from all pages
// add_filter( 'wpcf7_load_js', '__return_false' );
// add_filter( 'wpcf7_load_css', '__return_false' );

// REMOVE UNECESSARY CODE IN HEADER
remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); 
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' ); 
remove_action( 'wp_print_styles', 'print_emoji_styles' ); 
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_action('wp_head', 'rsd_link'); //removes EditURI/RSD (Really Simple Discovery) link.
remove_action('wp_head', 'wlwmanifest_link'); //removes wlwmanifest (Windows Live Writer) link.
remove_action('wp_head', 'wp_generator'); //removes meta name generator.
remove_action('wp_head', 'wp_shortlink_wp_head'); //removes shortlink.
remove_action( 'wp_head', 'feed_links', 2 ); //removes feed links.
remove_action('wp_head', 'feed_links_extra', 3 );  //removes comments feed. 

function disable_embeds_code_init() {

    // Remove the REST API endpoint.
    // remove_action( 'rest_api_init', 'wp_oembed_register_route' );
   
    // Turn off oEmbed auto discovery.
    // add_filter( 'embed_oembed_discover', '__return_false' );
   
    // // Don't filter oEmbed results.
    // remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );
   
    // // Remove oEmbed discovery links.
    // remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
   
    // // Remove oEmbed-specific JavaScript from the front-end and back-end.
    // remove_action( 'wp_head', 'wp_oembed_add_host_js' );
    // add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );
   
    // // Remove all embeds rewrite rules.
    // add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
   
    // // Remove filter of the oEmbed result before any HTTP requests are made.
    // remove_filter( 'pre_oembed_result', 'wp_filter_pre_oembed_result', 10 );
}
   
add_action( 'init', 'disable_embeds_code_init', 9999 );


// Disable use XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );
// Hide xmlrpc.php in HTTP response headers
add_filter( 'wp_headers', function( $headers ) {
    unset( $headers[ 'X-Pingback' ] );
    return $headers;
} ); 

// Disable X-Pingback to header
add_filter( 'wp_headers', 'disable_x_pingback' );
function disable_x_pingback( $headers ) {
    unset( $headers['X-Pingback'] );
    return $headers;
}

// REMOVE /wp-json/ api
// remove_action( 'init', 'rest_api_init' );  // turns off everything
// remove_action( 'parse_request', 'rest_api_loaded' ); // silently turns off output of user info

// remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
// remove_action( 'template_redirect', 'rest_output_link_header', 11 );
// remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );

// add_action( 'init', 'disable_rest_api_load_textdomain' );
// function disable_rest_api_load_textdomain() {
// 	load_plugin_textdomain( 'disable-json-api', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
// }



// the_content filter to use in TWIG Templates example {{description | the_content}}
function theme_add_twig_filters( $twig ){
    $twig->addFilter( 'the_content', new Twig_Filter_Function( function( $content ) {
        return apply_filters( 'the_content', $content );
    } ) );


    $twig->addFilter( 'base64_image_url', new Twig_Filter_Function( function( $url ) {

        $sandboxMode = get_field('sandbox_mode', 'option');
        if($sandboxMode) return $url;

        $image_path = preg_replace('/^.*?wp-content\/uploads\//i', '', $url);
        if(($uploads = wp_get_upload_dir()) && (false === $uploads['error']) && (0 !== strpos($image_path, $uploads['basedir']))) {
            if(false !== strpos($image_path, 'wp-content/uploads')) $image_path = trailingslashit($uploads['basedir'].'/'._wp_get_attachment_relative_path($image_path)).basename($image_path);
            else $image_path = $uploads['basedir'].'/'.$image_path;
        }
        
        
        //echo '[['.$max_size.' vs '.filesize($image_path).']]';
        if(file_exists($image_path)) {
            $filetype = wp_check_filetype($image_path);
            // Read image path, convert to base64 encoding
            $imageData = base64_encode(file_get_contents($image_path));
            // Format the image SRC:  data:{mime};base64,{data};
            $img_url = 'data:image/'.$filetype['ext'].';base64,'.$imageData;
            return $img_url;
        }

        return $url;
    
    } ) );


    return $twig;
}
add_action( 'twig_apply_filters', 'theme_add_twig_filters' );



/**
 * Logs messages/variables/data to browser console from within php
*/
function logconsole($data) {
    echo "<script>console.log(".json_encode($data).");</script>";
}


// add_action( 'admin_init', 'hide_editor' );
// function hide_editor() {
//     remove_post_type_support('page', 'editor');
// }