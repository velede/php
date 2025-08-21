<?php

use Core\Database;
use Core\Response;

$config = require base_path("config.php");

$db = new Database($config['database']);


$currentIdUser = 1;



$note = $db->query('select * from notes where id = :id', ['id' => $_GET['id']]) ->fetch();

if(!$note){
    abort();
}


if($note['user_id'] != $currentIdUser){
    abort(Response::FORBIDDEN);
}

view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);