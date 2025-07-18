<?php

namespace Php\LeadsCrmApp\Controllers;

use Php\LeadsCrmApp\Models\Lead;
use Php\LeadsCrmApp\Exceptions\NotFoundException;
use Php\LeadsCrmApp\Settings;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use Php\LeadsCrmApp\Utils;

class LeadController extends BaseController
{
    private const view_prefix = 'leads\\';

    function index()
    {
        $lead = new Lead();
        $allLeads = $lead->getAllLeads();

        $search = $_GET['search'] ?? '';

        $filtered = Utils::filterByNameOrEmail($allLeads, $search);

        $adapter = new ArrayAdapter(array_values($filtered));
        $pagerfanta = new Pagerfanta($adapter);

        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $pagerfanta->setMaxPerPage(Settings::RECORDS_ON_PAGE);
        $pagerfanta->setCurrentPage($currentPage);


        $ctx = ['leads' => $pagerfanta->getCurrentPageResults(), 'pager' => $pagerfanta];
        $this->render(self::view_prefix . 'index', $ctx);
    }

    function show(int $id)
    {
        $leadObj = new Lead();
        $lead = $leadObj->getLead($id);
        if ($lead == null) {
            throw new NotFoundException();
        }
        $ctx = ['lead' => $lead];
        $this->render(self::view_prefix . 'show', $ctx);
    }

    function edit(int $id)
    {
        $leadObj = new Lead();
        $lead = $leadObj->getLead($id);
        if ($lead == null) {
            throw new NotFoundException();
        }
        $allowedStatuses = Settings::STATUSES;
        $this->render(self::view_prefix . 'create', [
            'old' => $lead,
            'allowedStatuses' => $allowedStatuses,
            'isEditing' => true,
        ]);
    }


    function create()
    {
        $allowedStatuses = Settings::STATUSES;
        $this->render(self::view_prefix . 'create', ['allowedStatuses' => $allowedStatuses, 'isEditing' => false]);
    }

    function delete($id)
    {
        $leadObj = new Lead();
        $leadObj->delete(['id' => $id]);
        $this->redirect('/leads');
    }

    function store($id = null)
    {
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $status = trim($_POST['status'] ?? '');

        $allowedStatuses = Settings::STATUSES;

        $errors = [];
        $old = compact('name', 'email', 'phone', 'status');
        if ($id !== null) {
            $old['id'] = $id;
        }

        if ($name === '') {
            $errors['name'] = 'Name is required.';
        } else if (strlen($name) < 3) {
            $errors['name'] = 'Name must be at least 3 characters long.';
        } else if (strlen($name) > 255) {
            $errors['name'] = 'Name cannot exceed 255 characters.';
        }

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Valid email is required.';
        } else if (strlen($email) > 255) {
            $errors['email'] = 'Email cannot exceed 255 characters.';
        }

        $phoneRegex = '/^\+?[0-9]{1,4}?[-. ]?\(?[0-9]{1,3}?\)?[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,4}[-. ]?[0-9]{1,9}$/';
        if (!preg_match($phoneRegex, $phone)) {
            $errors['phone'] = 'Please enter a valid phone number.';
        } else if (strlen($phone) > 20) {
            $errors['phone'] = 'Phone number cannot exceed 20 characters.';
        }


        if (!in_array($status, $allowedStatuses)) {
            $errors['status'] = 'Invalid status selected.';
        }

        if (!empty($errors)) {
            $this->render(self::view_prefix . 'create', [
                'errors' => $errors,
                'old' => $old,
                'allowedStatuses' => $allowedStatuses,
                'isEditing' => $id !== null
            ]);
            return;
        }

        $leadObj = new Lead();
        if ($id !== null) {
            $leadObj->update([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'status' => $status,
                'date_updated' => date('Y-m-d'),
            ], ['id' => $id]);
        } else {
            $leadObj->create([
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'status' => $status,
                'date_created' => date('Y-m-d'),
                'date_updated' => date('Y-m-d'),
            ]);
        }

        $this->redirect('/leads');
    }
}
