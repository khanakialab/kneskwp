<?php
namespace Knesk\Framework;
class Twig {
    public $dir_views = null;
    public $dir_views_default = null;

    public $instance = null;
    public function __construct ($atts=array()) {
        $atts = Helper::shortcode_atts( array(
            "dirViews" => get_template_directory().'/resources/views',
            "cache" => null,
            'debug' => true
        ), $atts );

        // var_dump($atts);
    	// $this->dir_views = get_template_directory().'/resources/views';
        // $loader = new \Twig_Loader_Filesystem($this->dir_views);
        // $twig = new \Twig_Environment($loader, array(
        //     // 'cache' => '/path/to/compilation_cache',
        // ));
    
        // $this->instance = $twig;

        $loader = new \Twig\Loader\FilesystemLoader($atts['dirViews']);
        $twig = new \Twig\Environment($loader, [
            'cache' => $atts['cache'],
            'debug' => $atts['debug']

        ]);

        $function = new \Twig\TwigFunction('dump', function ($content) {
            if($content) {
                var_dump($content);
            } else {
                var_dump(get_defined_vars());
            }
            return null;
        });
        $twig->addFunction($function);

        
        $this->instance = $twig;
        $this->loader = $loader;
    }
}


?>