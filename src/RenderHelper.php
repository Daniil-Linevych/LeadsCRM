<?php

namespace Php\LeadsCrmApp;

use Php\LeadsCrmApp\Settings;

class RenderHelper
{

    public function render(string $view, array $context)
    {

        extract($context);
        ob_start();
        require Settings::BASE_PATH . 'views\\' . $view . '.php';
        return ob_get_clean();
    }

    public function renderWithLayout(string $view, array $context, string $layout = 'layout'): void
    {
        $context['content'] = $this->render($view, $context);

        extract($context);
        require Settings::BASE_PATH . 'templates\\' . $layout . '.php';
    }

    function get_fragment_path(string $fragment): string
    {

        return Settings::BASE_PATH . 'templates\\' . $fragment . '.inc.php';
    }
}
