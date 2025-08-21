<?php

//1 gaseste nota

//2 autorizare (daca un user poate edita acea nota)

//3 validam formul
//4 daca nu sunt erori la validare, facem update in DB
//5 redirectionarea userului


use Core\Database;
use Core\Response;
use Core\Validator;

$config = require base_path("config.php");

$db = new Database($config['database']);


$currentIdUser = 1;


//1
$note = $db->query('select * from notes where id = :id', ['id' => $_POST['id']]) ->fetch();

//2

if(!$note){
    abort();
}

if($note['user_id'] != $currentIdUser){
    abort(Response::FORBIDDEN);
}

//3 (ar trebui facut in validator verificarea cu nr de caractere)

$errors = [];

if(! Validator::email("vld@yahoo.com")){
    dd('emailul nu e valid');
}

if(strlen($_POST['body']) === 0){

    $errors['body'] = 'A body is required';

}


if(strlen($_POST['body']) > 1000){

    $errors['body'] = 'Prea multe caractere introduse (>1000)';

}


//4

if(count($errors)){

    return view('notes/edit.view.php', [
        'heading' => 'Edit note',
        'errors' => $errors,
        'note' => $note
    ]);

}

$db->query('update notes set body = :body where id = :id', [
    'id'=>$_POST['id'],
    'body'=>$_POST['body']
]);


//5
header('location: notes ');
