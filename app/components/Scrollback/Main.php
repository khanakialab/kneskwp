<?php
namespace Knesk\App\Comp\Scrollback;
Class Main {
    public function __construct ($args=[]) {
        $this->twig = new \Knesk\Framework\Twig([
            'dirViews' => dirname(__FILE__).'/views'
        ]);
    }

    function render($atts=[]) {
        $atts = shortcode_atts( array(
            'id' => 'a'.uniqid(),
            'file' => 'default.twig'
        ), $atts );

        $template = $this->twig->instance->load($atts['file']);
        return $template->render(array(
            'id' => $atts['id']
        ));
    }
}
