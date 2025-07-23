<?php
//if (!defined('theExperienceWebApp')) exit();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*require 'config.php';
require 'loginPage.php';*/


class UserAccount {
    private $dbconn = NULL;

    public function __construct(){
        require_once __DIR__ . '/../hiphop_website/private/config.php';
        global $config;
        $this->dbconn = new PDO($config['db']['dsn'],
        $config['db']['user'],
        $config['db']['pass']
    );
    }

    public function __destruct(){
        if(is_null($this->dbconn)) return;
        $this->dbconn = null;
        $this->dbconn = null;
    }

    public function getUserInfo($username){
        $query = 'SELECT * FROM users WHERE username = :uname';
        $stmt = $this->dbconn->prepare(($query));  
        $stmt->bindValue(':uname', $username);
        $result = $stmt->execute();

        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        if($entry){
            $userInfo = array();
            $userInfo['id'] = $entry['id'];
            $userInfo['uname'] = $entry['username'];
            $userInfo['email'] = $entry['email'];
            return $userInfo;
        }
        else {
            return false;
        }
    }

   
    public function createAccount($username, $email, $passwd){
        $user = $this->getUserInfo($username);
        print_r($user);
        if($user)
            return false;

        
        $username = strtolower($username);
        $hashed = password_hash($passwd, PASSWORD_ARGON2I);

        $query = 'INSERT INTO users (username, email) VALUES (:uname, :email)';
        $stmt = $this->dbconn->prepare($query);
        
        $stmt->bindValue(':uname', $username, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $result = $stmt->execute();
        print_r($result);

        $user = $this->getUserInfo($username);
        $id = $user['id'];

        $query2 = sprintf("INSERT INTO passwords VALUES (%d, '%s')", $id, $hashed);
        $this->dbconn->exec($query2);

        return true; 

    }

    public function verifyPassword($username, $passwd){
        $username = strtolower($username);
        $user = $this->getUserInfo($username);

        if(!$user)
            return false;

        $id = $user['id'];
        $query = sprintf("SELECT password FROM passwords WHERE user_id = %d", $id);
        $result = $this->dbconn->query($query);

        $entry = $result->fetch(PDO::FETCH_ASSOC);
        if(!$entry)
            return false;

        $hashed = $entry['password'];

        return password_verify($passwd, $hashed);
    }
}



?>