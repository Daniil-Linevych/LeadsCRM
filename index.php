<?php
require __DIR__ . '/vendor/autoload.php';

use Php\LeadsCrmApp\Settings;
use Php\LeadsCrmApp\Router;

$settings = new Settings();
$router = new Router();

$router->handleRequest();


/*$base_path = __DIR__ . '\\';
require_once $base_path . 'modules\settings.php';

function app_autoloader(string $class_name){
    global $base_path;
    require_once $base_path . $class_name . '.php';
}
spl_autoload_register('app_autoloader');

require_once $base_path . 'modules\router.php';*/
