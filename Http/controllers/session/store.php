<?php

//dd("submit the form");

use Core\Authenticator;
use Http\Forms\LoginForm;


$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password']
]);

$signedIn = (new Authenticator)->attempt($attributes['email'], $attributes['password']);

if(!$signedIn) {

    $form->error('email', 'no match for email/password') ->throw();

}

redirect('/');




