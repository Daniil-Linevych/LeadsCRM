<?php

namespace Php\LeadsCrmApp;

class Settings
{
    public const SITE_NAME = "Leads CRM";
    public const BASE_PATH = __DIR__ . "\\";

    const DB_HOST = "localhost";
    const DB_NAME = "leads-crm-db";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";

    const STATUSES = ['new', 'no answer', 'wrong number', 'wrong email', 'interested', 'not interested'];

    const RECORDS_ON_PAGE = 5;
}
