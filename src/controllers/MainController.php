<?php

namespace Php\LeadsCrmApp\Controllers;

use Php\LeadsCrmApp\Exceptions\NotFoundException;

class MainController extends BaseController
{

    function index()
    {
        $this->render('main', []);
    }

    function error($code, $text)
    {
        $this->render('error', ['code' => $code, 'text' => $text]);
    }
}
