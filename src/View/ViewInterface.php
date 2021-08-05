<?php

namespace App\View;

interface ViewInterface{

    /**
     * @param string $body
     * @param string $templateDefault
     * @param array $params
     * @return string
     */
    public function render(string $body, string $templateDefault, array $params):string;
}