<?php

namespace Php\LeadsCrmApp\Models;

use Php\LeadsCrmApp\Models\Model;

class Lead extends Model
{
    protected const TABLE_NAME = 'leads';

    public function getLead($id)
    {
        return $this->find(['key' => 'id', 'value' => $id]);
    }

    public function getAllLeads()
    {
        return $this->all();
    }
}
