<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include 'format.php';
    
    function buildLoggedInPage($username){
        $contents = array();
        $userData = new Users();
        $user = $userData->getUser($username);
        $contents[] = "<h1> Welcome $user";

        return $contents;
    }

   // echo $_POST['username'];

?>
