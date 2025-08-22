<?php

namespace Http\Forms;

use Cassandra\Exception\ValidationException;
use Core\ValidationExcept;
use Core\Validator;

class LoginForm
{


    public $errors = [];

    public function __construct(public array $attributes){


        if(!Validator::email($attributes['email'])){
            $this->errors['email']="scrie un email valid";
        }

        if(!Validator::string($attributes['password'])){
            $this->errors['password']="parola nu e buna";
        }

    }

    public static function validate($attributes){

        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;

        if($instance->failed()){

            $instance->throw();


        }

        return $instance;

    }


    public function throw()
    {

        ValidationExcept::throw($this->errors(), $this->attributes);

    }



    public function failed(){
        return count($this->errors);
    }

    public function errors(){
        return $this->errors;
    }

    public function error($field, $message){

        $this->errors[$field] = $message;

        return $this;

    }

}