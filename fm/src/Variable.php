<?php
namespace Knesk\Framework;

class Variable {
    public $variables = [];
    public $theme_opt_new = null;

    public function __construct ($args=[]) {
       // $this->init();
    }

    public function init() {
        // add_action('init', array( $this, '_processPublicThemeOptions'),0);

        // add_action('wp_head', array( $this, 'process_head'),0);
    }

    function process() {
        // var_dump($this->variables);
        $output = "<script type=\"text/javascript\">\n";
        foreach ($this->variables as $key => $variable) {
            $value = $variable['value'];
            $value = is_array($value) || is_bool($value) ? json_encode($value) : $value;
            $value = $variable['string'] ? "'" . $value . "'" : $value;
            $output .= 'var '.$variable['key'].' = '.$value.";\n";
        }
        $output .= "</script>\n";
        echo $output;
    }


    function add_var($key, $value, $string=true) {
        $this->variables[] = [
            'key' => $key,
            'value' => $value,
            'string' => $string,
        ];
    }
   
}


?>