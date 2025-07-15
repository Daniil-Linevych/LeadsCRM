<?php

use \Controllers\UserController;

$request_path = $_GET['route'];
if ($request_path == ""){
    $controller = new UserController();
    $controller->index();
} else {
    $id = (integer)$request_path;
    $controller = new UserController();
    $controller->show($id);
}