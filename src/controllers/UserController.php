<?php

namespace Php\LeadsCrmApp\Controllers;

use Php\LeadsCrmApp\Models\User;

class UserController extends BaseController
{
    private const view_prefix = 'user\\';

    public function showLogin()
    {
        $this->render(self::view_prefix . 'login');
    }

    public function login()
    {
        if (User::isAuthorised()) {
            $this->redirect('/');
        }

        $login = $_POST['login'];
        $password = $_POST['password'];
        $error = null;

        $userObj = new User();
        $user = $userObj->getUser($login);

        if (empty($user) || !password_verify($password, $user['password'])) {
            $error = "Wrong login or password!";
        } else {
            User::login($user["login"]);
            $this->redirect("/");
        }

        return $this->render(self::view_prefix . 'login', ['error' => $error]);
    }

    public function showRegister()
    {
        $this->render(self::view_prefix . 'register');
    }

    public function register()
    {
        $errors = [];
        $old = $_POST;

        $login = trim($_POST['login'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordRepeat = $_POST['password_repeat'] ?? '';

        if ($login === '') {
            $errors['login'] = 'Login is required.';
        } else if (strlen($login) < 3) {
            $errors['login'] = 'Login must be at least 3 characters long.';
        } else if ($this->userExist($login)) {
            $errors['login'] = 'This login is already taken.';
        }

        if (strlen($password) < 6) {
            $errors['password'] = 'Password must be at least 6 characters.';
        }

        if ($password !== $passwordRepeat) {
            $errors['password_repeat'] = 'Passwords do not match.';
        }

        if (empty($errors)) {
            $userObj = new User();
            $userObj->register(["login" => $login, "password" => $password]);
            $this->redirect('/login');
        }

        $this->render(self::view_prefix . 'register', ['errors' => $errors, 'old' => $old, 'error' => 'Please fix the errors and try again.']);
    }

    public function logout()
    {
        User::logout();
        $this->redirect('/');
    }

    private function userExist($login): bool
    {
        $userObj = new User();
        $user = $userObj->getUser($login);

        if (empty($user)) {
            return false;
        } else {
            return true;
        }
    }
}
