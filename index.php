<?php
require __DIR__ . '/vendor/autoload.php';
session_start();
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

use Php\LeadsCrmApp\Router;

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
