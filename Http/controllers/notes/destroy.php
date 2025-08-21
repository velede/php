<?php

use Core\Database;
use Core\Response;

$config = require base_path("config.php");

$db = new Database($config['database']);


$currentIdUser = 1;





    $note = $db->query('select * from notes where id = :id', ['id' => $_POST['id']]) ->fetch();

    if(!$note){
        abort();
    }


    if($note['user_id'] != $currentIdUser){
        abort(Response::FORBIDDEN);
    }

    //delete the current note
    $db->query('delete from notes where id = :id', [

        'id'=>$_GET['id']

    ]);

    header('location: /notes');
    exit();







