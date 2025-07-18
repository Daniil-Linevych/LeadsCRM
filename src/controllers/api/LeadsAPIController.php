<?php

namespace Php\LeadsCrmApp\Controllers\Api;

use Php\LeadsCrmApp\Models\Lead;

class LeadsApiController
{
    public function addLeads()
    {
        $apiToken = $_ENV['API_TOKEN'];

        $this->validateApiToken($apiToken);

        $data = $this->processJSON();

        $results = [];
        $lead = new Lead();

        foreach ($data as $leadData) {
            try {
                $lead->create($leadData);
                $results[] = [
                    'success' => true,
                    'data' => $leadData,
                ];
            } catch (\Exception $e) {
                $results[] = [
                    'error' => $e->getMessage(),
                    'data' => $leadData
                ];
            }
        }

        $this->respondSuccess([
            'processed' => count($data),
            'results' => $results
        ]);
    }

    protected function validateApiToken($apiToken)
    {
        $requestToken = $_SERVER['HTTP_X_API_TOKEN'] ?? null;
        if ($requestToken !== $apiToken) {
            $this->respondError("{$apiToken}, {$requestToken}", 401);
        }
    }

    protected function processJSON()
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->respondError('Invalid JSON format');
        }

        if (!is_array($data) || empty($data)) {
            $this->respondError('Empty or invalid leads data');
        }
        return $data;
    }

    private function respondSuccess($data, $statusCode = 200)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $data,
            'timestamp' => time()
        ]);
        exit;
    }

    protected function respondError($message, $statusCode = 400)
    {
        http_response_code($statusCode);
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'error' => $message,
            'timestamp' => time()
        ]);
        exit;
    }
}
