<?php
/* ToDo remove after test */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('DOCUMENT_ROOT', rtrim($_SERVER['DOCUMENT_ROOT'],"public"));
require_once __DIR__ . '/../vendor/autoload.php';

use core\Router;
if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
try {
    Router::start();
} catch (Throwable $e) {
    Router::ErrorPage404();
}
