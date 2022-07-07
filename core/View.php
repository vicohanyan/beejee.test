<?php

namespace core;

use ErrorException;

class View
{
    /**
     * @param string $view
     * @param array $data
     * @return void
     * @throws ErrorException
     */
    public static function render(string $view, array $data = []): void
    {
        $viewPath = __DIR__ . '/../Views/' . $view . '.php';
        if (!file_exists($viewPath)) {
            throw new ErrorException('view cannot be found');
        }
        include($viewPath);
    }

}