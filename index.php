<?php

    

   define('Experience', 1);

   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);
   error_reporting(E_ALL);

   require 'userprocess.php';
   require 'process.php';
   require 'format.php';
   //$contents = array();
   $userAccount = new Users();
   if(isset($_SESSION['user'])){

   }
   else {
        if(isset($_POST['login'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($userAccount->verifyPassword($username, $password)){
                $_SESSION['user'] = $username;
                print("Login Complete");
                //$contents = buildLoggedInPage($username);
            }
            else{
                print("Error!");
            }
        }
        else if(isset($_POST['create'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if($userAccount->createAccount($username, $email, $password)){
                $_SESSION['user'] = $username;
                print("Create Account Complete!");
                //$contents = buildLoggedInPage($username);
            }
            else{
                print("Error");
            }
        }
   }

   $page = buildPage($contents);
   print(implode($page));

   

?>