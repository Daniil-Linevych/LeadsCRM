<?php

namespace Php\LeadsCrmApp;

use Php\LeadsCrmApp\Controllers\UserController;
use Php\LeadsCrmApp\Controllers\MainController;
use Php\LeadsCrmApp\Controllers\LeadController;
use Php\LeadsCrmApp\Exceptions\NotFoundException;

class Router
{
    protected UserController $userController;
    protected MainController $mainController;
    protected LeadController $leadController;

    public function __construct()
    {
        $this->mainController = new MainController();
        $this->userController = new UserController();
        $this->leadController = new LeadController();
    }

    public function handleRequest()
    {
        $request_path = $_GET['route'] ?? '';
        $request_method = $_SERVER['REQUEST_METHOD'];

        try {
            $this->sanitizePath($request_path);
            $this->dispatch($request_path, $request_method);
        } catch (NotFoundException $e) {
            $this->handleNotFound($e);
        } catch (\Exception $e) {
            $this->handleServerError($e);
        }
    }

    protected function sanitizePath(string &$request_path)
    {
        if ($request_path && $request_path[-1] == '/') {
            $request_path = substr($request_path, 0, strlen($request_path) - 1);
        }
    }

    protected function dispatch(string $path, string $method)
    {

        $segments = explode('/', $path);
        $basePath = $segments[0] ?? '';

        switch ($basePath) {
            case '':
                $this->mainController->index();
                break;

            case 'login':
                if ($method == "GET") {
                    $this->userController->showLogin();
                } elseif ($method == "POST") {
                    $this->userController->login();
                }
                break;

            case 'register':
                if ($method == "GET") {
                    $this->userController->showRegister();
                } elseif ($method == "POST") {
                    $this->userController->register();
                }
                break;

            case 'logout':
                $this->userController->logout();
                break;

            default:
                if (preg_match("/^(\d+)$/", $path) === 1) {
                    $this->leadController->show((int)$path);
                    return;
                }
                throw new NotFoundException();
        }
    }

    protected function handleNotFound(NotFoundException $e)
    {
        http_response_code($e->getCode());
        echo "404 Not Found";
    }

    protected function handleServerError(\Exception $e)
    {
        http_response_code(500);
        echo "500 Server Error";
        error_log($e->getMessage());
    }
}
