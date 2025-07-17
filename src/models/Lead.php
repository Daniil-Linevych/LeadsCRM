<?php

namespace Php\LeadsCrmApp\Models;

use Php\LeadsCrmApp\Models\Model;

class Lead extends Model
{
    protected const TABLE_NAME = '';

    const Data = [
        [
            "id" => "0",
            "login" => "Lead1",
            "password" => "123123"
        ],
        [
            "id" => "1",
            "login" => "Lead2",
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

    public static function getLead($id)
    {
        return self::Data[$id];
    }

    public static function getAllLeads()
    {
        return self::Data;
    }
}
