<?php

use Core\Database;
use Core\Validator;

$config = require base_path('config.php');
$db = new Database($config['database']);

//

$email = $_POST["email"];
$password = $_POST["password"];

//1 validam inputul formului

//2verific daca contul exista
    //daca da, redirect to login page
    //daca nu, salveaza in DB, apoi userul se conecteaza, apoi redirect


//1

$errors=[];

if(!Validator::email($email)){
    $errors['email']="scrie un email valid";
}

if(!Validator::string($password, 7, 255)){
    $errors['password']="parola nu e buna (min 7 caractere)";
}

if(!empty($errors)){
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}
$user = $db->query('select * from users where email = :email', [
    'email' => $email
]) -> fetch();

if($user){
    //cineva are contul cu acelasi email
    header('location: /');
} else {
    $db -> query('insert into users (email, password) values (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    //userul s a logat

    login($user);

    header('location: /');
    exit(); // ne asiguram ca scriptul nu se executa dupa header

}

