<?php

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
$method = $_POST['_method'] ?? $_SERVER["REQUEST_METHOD"];

$router->route($uri, $method);





//$id = $_GET['id'];
//
//$query = "SELECT * FROM posts WHERE id = ?";
//
//$posts = $db->query($query, [$id]) -> fetch();
//dd($posts);