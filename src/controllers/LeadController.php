<?php

namespace Php\LeadsCrmApp\Controllers;

use Php\LeadsCrmApp\Models\Lead;
use Php\LeadsCrmApp\Exceptions\NotFoundException;

class LeadController extends BaseController
{
    private const view_prefix = 'leads\\';

    function index()
    {
        $ctx = ['leads' => Lead::getAllLeads()];
        $this->render(self::view_prefix . 'index', $ctx);
    }

    function show(int $id)
    {
        $Lead = Lead::getLead($id);
        if ($Lead == null) {
            throw new NotFoundException();
        }
        $ctx = ['lead' => Lead::getLead($id)];
        $this->render(self::view_prefix . 'show', $ctx);
    }
}
