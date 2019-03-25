<?php
namespace Knesk\Framework\Wp;
Class Helper {

    public static function es_add_body_class( $new_classes ) {
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
}
