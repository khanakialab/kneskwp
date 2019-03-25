<?php
namespace Knesk\App\Helpers;

class CommonHelper {
    public function __construct() {
        
    }

    public static function getRecentPosts(){
        $args = array(
            'numberposts' => 6,
            'orderby'          => 'post_date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
        );
        $recent_posts = wp_get_recent_posts( $args, ARRAY_A );
        return $recent_posts;
    
    }
}