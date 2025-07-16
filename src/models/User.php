<?php

namespace Php\LeadsCrmApp\Models;

class User{

    const Data = [
        [
            "id" => "0",
            "login" => "user1",
            "password" => "123123"
        ],
        [
            "id" => "1",
            "login" => "user2",
            "password" => "abc456"
        ],
        [
            "id" => "2",
            "login" => "admin",
            "password" => "securePW!2024"
        ],
        [
            "id" => "3",
            "login" => "guest",
            "password" => "tempPass123"
        ]
    ];

    public static function getUser($id){
        return self::Data[$id];
    }

    public static function getAllUsers(){
        return self::Data;
    }
}