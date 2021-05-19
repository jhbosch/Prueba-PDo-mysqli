<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/5/2021
 * Time: 00:50
 */
require_once __DIR__ . '/Conn.php';

class LoginService
{

    public static function login($user,$password){
        return Conn::getInstance()->login($user,$password);
    }

    public static function logout(){
        session_destroy();
    }


}