<?php

namespace Controllers;
require_once $base_path . 'modules\helpers.php';

class BaseController{

    protected function render(string $template, array $context){
        
       \Helpers\render($template, $context);
    }
}