<?php
$template_directory = get_template_directory();
$template_directory_url = get_template_directory_uri();
return [
    'mode' => 'dev',
    'dirView' => $template_directory.'/resources/views',
    'scripts' => [
        array(
            // 'handle' => '', // if any otherwise it will generate automatically random
            'src' => $template_directory_url.'/resources/assets/js/custom.js',
            // 'deps' => array(),
            'ver' => false,
            'in_footer' => false,
            'mode' => array('dev', 'prod')
        )
    ],
    // 'styles' => [
    //     array(
    //         'handle' => 'css-demooo', // if any otherwise it will generate automatically random
    //         'src' => $template_directory_url.'/demo.css',
    //         // 'deps' => array(),
    //         'ver' => false,
    //         'mode' => array('dev', 'prod')
    //     )
    // ]
];