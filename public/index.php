<?php
/* ToDo remove after test */
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

define('DOCUMENT_ROOT', rtrim($_SERVER['DOCUMENT_ROOT'],"public"));
define('APP_BASE_URL', rtrim($_SERVER['HTTP_HOST'],"public"));
define("APP_SETTINGS", parse_ini_file(__DIR__ . '/../config/app.ini'));
require_once __DIR__ . '/../vendor/autoload.php';
use core\Router;

include_once( __DIR__ . '/../engine/layout/layout.php');

if(session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
try {
    Router::start();
} catch (Throwable $e) {
    /* ToDo remove after test */
    var_dump("msg",$e->getMessage());
    var_dump("line",$e->getLine());
    var_dump("file",$e->getFile());
    Router::ErrorPage404();
}
