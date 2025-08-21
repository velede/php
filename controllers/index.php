<?php


//echo $_SERVER["REQUEST_URI"] === "/" ? "bg-gray-900 text-white" : "bg-gray-300";

//$_SESSION['user'] = [
//    'name' => 'vld'
//];

$_SESSION['name']='vld';

view("index.view.php", [
    'heading' => 'Home'
]);