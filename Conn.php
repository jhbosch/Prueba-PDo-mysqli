<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 19/5/2021
 * Time: 00:20
 */

class Conn
{
    private $host = "127.0.0.1";
    private $userDB = "root";
    private $passwordDB = "";
    private $nameDB = "task_register";

    private  $conn;
    private $error;
    private static $instance;


    function __construct()
    {
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->nameDB", $this->userDB, $this->passwordDB);
    }


    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    public function login($user,$password){

        $result = $this->conn->query("SELECT * FROM usuario WHERE username = '$user' AND password = '$password'");
        $error = $this->conn->errorInfo();

        if($error[0] === "00000"){
            $result->execute();
            if($result->rowCount() > 0){
                return true;
            }
        }else{
            $this->error = $error;
            return false;
        }



    }









}