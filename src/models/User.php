<?php

namespace Php\LeadsCrmApp\Models;

use Php\LeadsCrmApp\Models\Model;

class User extends Model
{
    protected const TABLE_NAME = 'users';

    public static function login(string $user_login)
    {
        $_SESSION['user'] = [
            "login" => $user_login,
            "ip" => $_SERVER['REMOTE_ADDR']
        ];
    }

    public function register(array $data)
    {
        $data['password'] = self::encryptPassword($data['password']);
        $this->create($data);
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }

    public static function isAuthorised()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['ip'] === $_SERVER['REMOTE_ADDR'];
    }

    public function getUser(string $login, ?string $password = null)
    {
        /*$sql = "SELECT * FROM users WHERE Login = ?" . ($password ? " AND Password = ?" : "");
        $params = $password ? [$login, self::encryptPassword($password)] : [$login];

        return $this->get_query($sql, $params);*/
        return $this->find(['key' => 'login', 'value' => $login]);
    }

    public static function encryptPassword($pass): string
    {
        return password_hash($pass, PASSWORD_DEFAULT);
    }

    public static function authorisedUserName()
    {
        return $_SESSION['user']['login'];
    }
}
