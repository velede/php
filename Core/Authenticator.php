<?php

namespace Core;

use Core\Database;

class Authenticator
{

    public function attempt($email, $password)
    {

        //match the credentials
        $config = require base_path('config.php');
        $db = new Database($config['database']);
        $user = $db->query('select * from users where email = :email', [
            'email' => $email
        ])->find();

        if($user){
            //avem un user si acum vedem daca parola corespunde cu ce avem in DB


            if(password_verify($password, $user['password'])){

                $this->login([
                    'email'=>$email
                ]);


                return true;

            }
        }

        return false;

    }


    public function login($user){
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);

    }

    public function logout(){
        $_SESSION=[];
        session_destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID','', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

}