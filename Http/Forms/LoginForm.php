<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{

    public $errors=[];

    public function validate($email, $password){

        if(!Validator::email($email)){
            $this->errors['email']="scrie un email valid";
        }

        if(!Validator::string($password)){
            $this->errors['password']="parola nu e buna";
        }

        return empty($this->errors);

    }

    public function errors(){
        return $this->errors;
    }

    public function error($field, $message){

        $this->errors[$field] = $message;

    }

}