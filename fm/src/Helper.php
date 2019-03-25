<?php
namespace Knesk\Framework;
Class Helper {
    public static function getVar($var = "", $default = "", $checkempty=false)
    {
        $value = isset($_REQUEST[$var]) ? $_REQUEST[$var] : $default;
        if ($checkempty) {
            $value = empty($value) ? $default : $value;
        }
        return $value;
    }


    public static function getValue($value = "", $default = "", $args=array())
    {
        $args = Helper::shortcode_atts(array(
            'append' => "",
            'prepend' => "",
        ), $args);

        if (empty($value)) {
            return $default;
        }
        if ($args["append"])  $value .= $args["append"];
        if ($args["prepend"])  $value = $args["prepend"].$value;
        return $value;
    }

    /* above function checkvar will not work incase of direct variables for example $demo->name 
        if i have array return empty so there is no name variable now but if i use above function check var it will still gives error "trying to get property of non-object"
        so i created below function
        Undefined Index, Undefined Variable
    */

    public static function getDefault(&$isset, $default="") {
        return isset($isset) ? $isset : $default;
    }


    public static function issetAndNotEmpty($var = "")
    {
        $value = isset($var) ? $var : false;
        $value = empty($value) ? false : true;
        return $value;
        
    }

    public static function shortcode_atts( $pairs, $atts) {
        $atts = (array)$atts;
        $out = array();
        foreach ($pairs as $name => $default) {
            if ( array_key_exists($name, $atts) )
                $out[$name] = $atts[$name];
            else
                $out[$name] = $default;
        }
        return $out;
    }

    // public static function shortcode_atts_empty( $pairs, $atts) {
    //     $atts = (array)$atts;
    //     $out = array();
    //     foreach ($pairs as $name => $default) {
    //         if ( array_key_exists($name, $atts) && !empty($atts[$name]) )
    //             $out[$name] = $atts[$name];
    //         else
    //             $out[$name] = $default;
    //     }
    //     return $out;
    // }
}
