<?php

namespace Php\LeadsCrmApp;

class Settings
{
    public const SITE_NAME = "Leads CRM";
    public const BASE_PATH = __DIR__ . "\\";

    public const STATUSES = ['new', 'no answer', 'wrong number', 'wrong email', 'interested', 'not interested'];

    public const RECORDS_ON_PAGE = 5;
}
