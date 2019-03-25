<?php

    // Class KneskFm {
    //     public function __construct () {
    //         global $knesk_config;
    //         $knesk_config  = require_once (dirname(__FILE__) . '/config.php');
    //         if(file_exists(dirname(__FILE__) . '/../config.php')) {
    //             $custom_config  = require_once (dirname(__FILE__) . '/../config.php');
    //             $knesk_config = array_merge($knesk_config, $custom_config);

    //             var_dump($knesk_config);
    //         }
    //     }

    //     function init() {
    //         do_action('kneskfm_beforeInit');
    //         // var_dump($config);

    //         $template_directory = get_template_directory();
    //         $timber = new Timber\Timber();
    //         $timber::$locations = $knesk_config['dirView'];


    //         add_action( 'wp_enqueue_scripts', 'knesk_scripts' );
    //         function knesk_scripts() {
    //             $template_directory_url = get_template_directory_uri();

    //             if($knesk_config['mode']=='dev') {
    //                 wp_enqueue_style( 'css-vendor', $template_directory_url.'/dist/vendor.css', array(), '' );
    //                 wp_enqueue_style( 'css-main', $template_directory_url.'/dist/main.css', array(), '' );
    //                 // wp_enqueue_style( 'style', $template_directory_url.'/style.css', array(), '' );
                    
    //                 // wp_enqueue_script( "js-react", 'https://unpkg.com/react@16/umd/react.development.js', array(), '' );
    //                 // wp_enqueue_script( "js-reactdom", 'https://unpkg.com/react-dom@16/umd/react-dom.development.js', array(), '' );
    //                 wp_enqueue_script( "js-vendor", $template_directory_url."/dist/vendor.js", array('jquery'), '' );
    //                 wp_enqueue_script( "js-main", $template_directory_url."/dist/main.js", array('jquery'), '' );
    //                 // wp_enqueue_script( "js-custom", $template_directory_url."/resources/assets/js/custom.js", array('jquery'), '', false );
    //             } else {
    //                 wp_enqueue_style( 'css-main', $template_directory_url.'/dist/main.css', array(), '' );
    //                 wp_enqueue_script( "js-main", $template_directory_url."/dist/main.js", array(), '', 1);
    //             }
                
    //         }
    //     }
    
    
    // }


    
   

?>