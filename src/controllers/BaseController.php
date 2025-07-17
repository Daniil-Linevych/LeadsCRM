<?php

namespace Php\LeadsCrmApp\Controllers;

use Php\LeadsCrmApp\RenderHelper;

class BaseController
{

    protected RenderHelper $renderHelper;

    public function __construct()
    {
        $this->renderHelper = new RenderHelper();
    }

    protected function render(string $template, array $context = [])
    {

        $this->renderHelper->renderWithLayout($template, $context);
    }

    protected function redirect($path)
    {
        header("Location: {$path}");
        die();
    }
}
