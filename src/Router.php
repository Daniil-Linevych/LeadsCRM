<?php

namespace Php\LeadsCrmApp;

use Php\LeadsCrmApp\Controllers\UserController;

class Router
{

    public function handleRequest()
    {
        $request_path = $_GET['route'] ?? '';

        $controller = new UserController();

        if (empty($request_path)) {
            $controller->index();
        } else {
            $id = (int)$request_path;
            $controller->show($id);
        }
    }
}
