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
        var_dump("asdfasdf");
        $layout = "";
        $contentView = __DIR__ . '/../engine/Views/' . $view . '.php';
        if (!file_exists($contentView)) {
            throw new ErrorException('view cannot be found');
        }
        include_once( __DIR__ . '/../engine/layout/layout.php');
    }

}