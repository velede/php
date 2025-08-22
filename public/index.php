<?php

use Core\Session;
use Core\ValidationExcept;

const BASE_PATH = __DIR__ . "/../";

session_start();



require BASE_PATH . "Core/functions.php";
//require base_path("Database.php");
//require base_path("Response.php");

spl_autoload_register(function ($class) {

    $class = str_replace("\\", DIRECTORY_SEPARATOR, $class);

    require base_path("{$class}.php");
});

$router = new \Core\Router();


$routes = require base_path('routes.php');

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

//$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];

$method = strtoupper($_POST['_method'] ?? $_SERVER["REQUEST_METHOD"]);

try{
    $router->route($uri, $method);
} catch (ValidationExcept $exception) {

    dd($_SERVER);
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    //return redirect('/login');

    return redirect($router->previousUrl());

}

Session::unflash();