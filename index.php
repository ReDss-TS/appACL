<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
//session_destroy();
include_once 'config/autoload/autoloadClasses.php';

$CoreExceptionHandler = new CoreExceptionHandler();
set_exception_handler([$CoreExceptionHandler, 'handle']);

//call Router;
$router = new CoreRouter();
$router->start();
