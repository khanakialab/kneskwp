<?php
function anchortag_shortcode($atts, $content = null) {
    extract(shortcode_atts(array(
        "url" => '',
        "class" => '',
    ), $atts));
 return '<a class="' . $class . '" href="' . $url . '">' . do_shortcode($content) . '</a>';
}
add_shortcode('anchor', 'anchortag_shortcode');