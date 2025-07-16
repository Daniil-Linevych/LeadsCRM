<?php

namespace Php\LeadsCrmApp\Controllers;

use Php\LeadsCrmApp\Models\User;

class UserController extends BaseController
{

    private const view_prefix = 'user\\';

    function index()
    {
        $ctx = ['users' => User::getAllUsers()];
        $this->render(self::view_prefix . 'index', $ctx);
    }

    function show(int $id)
    {
        $ctx = ['user' => User::getUser($id)];
        $this->render(self::view_prefix . 'show', $ctx);
    }
}
