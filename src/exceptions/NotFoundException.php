<?php

namespace Php\LeadsCrmApp\Exceptions;

class NotFoundException extends \RuntimeException
{
    public function __construct(string $message = "Resource not found", int $code = 404, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
