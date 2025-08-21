<?php

use Core\Validator;
use Core\Database;

$config = require base_path("config.php");

$db = new Database($config['database']);

$errors = [];


    //$validator = new Validator();

    if(! Validator::email("vld@yahoo.com")){
        dd('emailul nu e valid');
    }

    if(strlen($_POST['body']) === 0){

        $errors['body'] = 'A body is required';

    }


    if(strlen($_POST['body']) > 1000){

        $errors['body'] = 'Prea multe caractere introduse (>1000)';

    }


    if(!empty($errors)){

        //validation issue


        return view("notes/create.view.php", [
            'heading' => 'Create Note',
            'errors' => $errors,
        ]);


    }



        $db->query('INSERT INTO notes (body, user_id) VALUES (:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]);

        header('location: /notes');
        die();

