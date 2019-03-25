<?php
require_once( __DIR__ . '/vendor/autoload.php' ); // Include Composer

// Knesk\Framework\Wp\Helper::es_add_body_class('sdfds');
$kneskWpMain = new Knesk\Framework\Wp\Main();

add_action('kneskfm_beforeInit', function() {
    //## Add your custom action or overrides
    global $knesk_config;

    // You can alos change config by adding config.php file in theme root dir
    // $knesk_config['dirView'] = '\test\views';
    
});

$kneskWpMain->init();

require_once (dirname(__FILE__) . '/app/includes/index.php');

// require_once (dirname(__FILE__) . '/components/twig/scrollback/index.php');

// $scb = new ScrollBack();
// $scb = new \Knesk\Comp\Twig\Scrollback\Main();
// echo $scb->render();


// $twig = new \Knesk\Framework\Twig([
//     'debug' => true
// ]);
// $template = $twig->instance->load('website/article.twig');

// echo $template->render(array(
//     'content' => 'dsfadsfdsa'
// ));