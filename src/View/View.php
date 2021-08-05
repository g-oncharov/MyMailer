<?php

namespace App\View;

class View implements ViewInterface
{
    public function render(string $body, string $templateDefault, array $params):string {
        extract($params);
        if (file_exists($templateDefault)) {
            ob_start();
            include_once($body);
            $body = ob_get_clean();
            ob_clean();
            ob_start();
            include_once($templateDefault);
            $output = ob_get_clean();
        }
        else {
            $output = '';
        }
        return $output;
    }
}