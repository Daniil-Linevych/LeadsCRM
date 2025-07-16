<?php

namespace Php\LeadsCrmApp\Helpers {
     
    function render(string $view, array $context){

        global $base_path;

        extract($context);
        require $base_path . 'views\\' . $view . '.php';
    }

    function get_fragment_path(string $fragment):string {
        
        global $base_path;

        return $base_path . 'templates\\' . $fragment . '.inc.php';
    }
}

