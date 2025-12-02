<?php
class Signup extends Dbconnection 
{
    private $username;
    private $pwd;

    public function __construct($username,$pwd)
    {
        $this->username = $username;
        $this->pwd = $pwd;
    }

    private function insertUser(){
        $insert_querry = "INSERT INTO users (username,password) VALUES (:name,:pwd);";
        $stmt = $this->connect()->prepare($insert_querry);
        $stmt->bindParam(":name",$this->username);
        $stmt->bindParam(":pwd",$this->pwd);
        $stmt->execute();
    }


    private function isEmptySubmit(){
        if(isset($this->username) && isset($this->pwd)){
         return false;
        }else{
            return true;
        }
    }

    public function signupUser(){
       //Error handlers
       if($this->isEmptySubmit()){
         header("Location: " . $_SERVER['DOCUMENT ROOT'] . 'file_name_for _home_page');
         die();
       }
       //if no errors signup user
      $this->insertUser();
    }
}