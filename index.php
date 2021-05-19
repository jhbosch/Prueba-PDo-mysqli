<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18/5/2021
 * Time: 22:52
 */
session_start();
include __DIR__ . "/env.php";
require __DIR__ . "/LoginService.php";
require_once "vendor/autoload.php";

$action = isset($_POST['action']) ? $_POST['action'] : '';




if(isset($_SESSION['user'])){
    if(isset($_GET['logout']) && $_GET['logout'] == 'true'){
        LoginService::logout();
        require __DIR__ . "/login.html";
    }else{
        include __DIR__ .'/dashboard.php';
    }

}else{
    switch ($action){
        case 'login':

            if(LoginService::login($_POST["username"],$_POST['password'])){
                $_SESSION['user'] = ['user'=>$_POST["username"]];
                echo json_encode(["status"=>"OK"]);
                die();
            }else{
                echo json_encode(["status"=>"FAILS"]);
                die();
            }

            break;
        case '':
        case '/':
        default:
            $captcha = new \Anhskohbo\NoCaptcha\NoCaptcha($secret, $sitekey);
            require __DIR__ . "/login.html";
            break;
    }
}

