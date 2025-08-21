<?php

//dd("submit the form");

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

//

$email = $_POST["email"];
$password = $_POST["password"];


$errors=[];

if(!Validator::email($email)){
    $errors['email']="scrie un email valid";
}

if(!Validator::string($password)){
    $errors['password']="parola nu e buna";
}

if(!empty($errors)){

    return view('session/create.view.php', [
        'errors' => $errors
    ]);

}

//match the credentials
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();



if($user){
    //avem un user si acum vedem daca parola corespunde cu ce avem in DB


    if(password_verify($password, $user['password'])){

        login([
            'email'=>$email
        ]);

        header("location: /");
        exit();

    }
}


//daca !user sau daca verificarea parolei a picat

return view('session/create.view.php', [
    'errors'=>[
        'email'=>'no match for email/password'
    ]
]);

