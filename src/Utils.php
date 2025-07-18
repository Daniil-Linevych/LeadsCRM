<?php

namespace Php\LeadsCrmApp;

use Php\LeadsCrmApp\Settings;

class Utils
{
    public static function get_fragment_path(string $fragment): string
    {
        return Settings::BASE_PATH . 'templates\\' . $fragment . '.inc.php';
    }

    public static function filterByNameOrEmail($allLeads, $search)
    {
        return array_filter($allLeads, function ($lead) use ($search) {
            if ($search === '') return true;

            return stripos($lead['name'], $search) !== false ||
                stripos($lead['email'], $search) !== false;
        });
    }
}
