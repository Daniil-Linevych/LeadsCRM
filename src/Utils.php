<?php

namespace Php\LeadsCrmApp;

use Php\LeadsCrmApp\Settings;

class Utils
{
    public static function get_fragment_path(string $fragment): string
    {
        return Settings::BASE_PATH . 'templates\\' . $fragment . '.inc.php';
    }
}
