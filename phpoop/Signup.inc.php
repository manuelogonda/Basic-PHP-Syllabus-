<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['user_name'];
    $pwd = $_POST['password'];
 require_once 'oopdbconnection.php';
 require_once 'Signupoop.php';
 $Signup = new Signup($username,$pwd);
 $signup->signupUser();
}