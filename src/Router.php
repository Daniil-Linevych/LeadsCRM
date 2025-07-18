<?php

namespace Php\LeadsCrmApp;

use Php\LeadsCrmApp\Controllers\UserController;
use Php\LeadsCrmApp\Controllers\MainController;
use Php\LeadsCrmApp\Controllers\LeadController;
use Php\LeadsCrmApp\Exceptions\NotFoundException;
use Php\LeadsCrmApp\Models\User;

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

            case 'leads':
                if (!User::isAuthorised()) {
                    header("Location: /login ");
                }
                $this->handleLeadsRoute($segments, $method);
                break;
            default:
                throw new NotFoundException();
        }
    }

    protected function handleNotFound(NotFoundException $e)
    {
        http_response_code($e->getCode());
        echo "404 Not Found {$e->getMessage()}";
    }

    protected function handleServerError(\Exception $e)
    {
        http_response_code(500);
        echo "500 Server Error";
        error_log($e->getMessage());
    }

    protected function handleLeadsRoute($segments, $method)
    {
        $id = $segments[1] ?? null;
        $action = $segments[2] ?? null;

        if ($id === null && $method === 'GET') {
            $this->leadController->index();
        } else if (is_numeric($id)) {
            $this->handleLeadAction($action, $id, $method);
        } else if ($id === 'create' && $method === 'GET') {
            $this->leadController->create();
        } else if ($id === null && $method === 'POST') {
            $this->leadController->store();
        } else if ($id !== null && $action !== null && $method === 'POST') {
            $this->handleLeadAction($action, $id, $method);
        } else {
            throw new NotFoundException();
        }
    }

    protected function handleLeadAction($action, $id, $method)
    {
        switch ($method) {
            case 'GET':
                if ($action == null) {
                    $this->leadController->show((int)$id);
                } else if ($action == 'edit') {
                    $this->leadController->edit((int)$id);
                } else {
                    throw new NotFoundException();
                }
                break;
            case 'POST':
                if ($action == 'edit') {
                    $this->leadController->store((int)$id);
                } else if ($action == 'delete') {
                    $this->leadController->delete((int)$id);
                } else {
                    throw new NotFoundException();
                }
                break;
            default:
                throw new NotFoundException();
        }
    }
}
