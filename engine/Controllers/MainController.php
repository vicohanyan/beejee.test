<?php

namespace engine\Controllers;

use core\Controller;
use core\View;
use engine\Models\Task;
use ErrorException;
use Exception;

final class MainController extends Controller
{
    /**
     * item view limit for pagination
     */
    private int $itemLimit = 3;

    /**
     * @throws ErrorException
     * @throws Exception
     */
    function actionIndex(){
        $page = 0;
        $tasks = Task::getAll(className: Task::class, page: $page, orders: ["username"=>"DESC"], limit: $this->itemLimit);
        $pageCount = Task::getPageCount(Task::class,limit: 3);
        View::render("start",[
            "tasks"     => $tasks,
            "pageCount" => $pageCount,
            "page"      => $page,
        ]);
    }
}