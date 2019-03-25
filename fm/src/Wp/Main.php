<?php
namespace Knesk\Framework\Wp;
Class Main {

    public function __construct () {

        // ## Load Config file
        global $knesk_config;
        $template_directory = get_template_directory();
        $knesk_config  = require_once ($template_directory . '/fm/config.php');
        if(file_exists($template_directory . '/config.php')) {
            $custom_config  = require_once ($template_directory . '/config.php');
            $knesk_config = array_merge($knesk_config, $custom_config);
        }
    }

    function init() {
        do_action('kneskfm_beforeInit');
        
        
        global $knesk_config;
        global $timber;
        $timber = new \Timber\Timber();
        $timber::$locations = $knesk_config['dirViews'];


        add_action( 'wp_enqueue_scripts', array($this, 'knesk_scripts') );
    }
    
    function knesk_scripts() {
        global $knesk_config;
        $template_directory_url = get_template_directory_uri();

        if($knesk_config['mode']=='dev') {
            wp_enqueue_style( 'css-vendor', $template_directory_url.'/dist/vendor.css', array(), '' );
            wp_enqueue_style( 'css-main', $template_directory_url.'/dist/main.css', array(), '' );
            wp_enqueue_style( 'style', $template_directory_url.'/style.css', array(), '' );
            // wp_enqueue_script( "js-react", 'https://unpkg.com/react@16/umd/react.development.js', array(), '' );
            // wp_enqueue_script( "js-reactdom", 'https://unpkg.com/react-dom@16/umd/react-dom.development.js', array(), '' );

            wp_enqueue_script( "js-vendor", $template_directory_url."/dist/vendor.js", array('jquery'), '' );
            wp_enqueue_script( "js-main", $template_directory_url."/dist/main.js", array('jquery'), '' );
        } else {
            wp_enqueue_style( 'css-main', $template_directory_url.'/dist/main.css', array(), '' );
            wp_enqueue_style( 'style', $template_directory_url.'/style.css', array(), '' );
            wp_enqueue_script( "js-main", $template_directory_url."/dist/main.js", array(), '', 1);
        }       

        foreach($knesk_config['scripts'] as $script) {
            $this->loadScript($script);
        }

        foreach($knesk_config['styles'] as $style) {
            $this->loadStyle($style);
        }
    }


    function loadScript($script=array()) {
        $atts = \Knesk\Framework\Helper::shortcode_atts(array(
            'handle' => uniqid(), // if any otherwise it will generate automatically random
            'src' => '',
            'deps' => array(),
            'ver' => false,
            'in_footer' => true,
            'mode' => array('dev', 'prod')
        ), $script);

        // var_dump($atts);
        // wp_die()

        wp_enqueue_script( $atts['handle'], $atts['src'], $atts['deps'], $atts['ver'], $atts['in_footer'] );
        // if(file_exists($atts['src'])) {
        // }
        
    }

    function loadStyle($script=array()) {
        $atts = \Knesk\Framework\Helper::shortcode_atts(array(
            'handle' => uniqid(), // if any otherwise it will generate automatically random
            'src' => '',
            'deps' => array(),
            'ver' => false,
            'media' => true,
            'mode' => array('dev', 'prod')
        ), $script);

        // var_dump($atts);
        // wp_die()

        wp_enqueue_style( $atts['handle'], $atts['src'], $atts['deps'], $atts['ver'], $atts['media'] );
        // if(file_exists($atts['src'])) {
        // }
        
    }
}
