<?php

# add checking where file cannot be added if its not included

class Users{
    private $dbconn = NULL;

    public function __construct(){
       $this->dbconn = new SQLite3("experience.db");
    }

    public function __destruct(){
        if(is_null($this->dbconn)) return;
        $this->dbconn->close();
        $this->dbconn = null;
    }

    public function getUser($username){
        $query = 'SELECT * FROM userInfo WHERE username = :uname';
        $stmt = $this->dbconn->prepare($query);
        $stmt->bindValue(':uname', $username);
        $result = $stmt->execute();

        $entry = $result->fetchArray();
        if ($entry){
            $userInfo = array();
            $userInfo['id'] = $entry[0];
            $userInfo['uname'] = $entry[1];
            $userInfo['email'] = $entry[2];
            return $userInfo;
        }
        else{
            return false;
        }
        
    }

    public function createAccount($username, $email, $password){
        $user = $this->getUser($username);
        print_r($user);
        if($user){
            return false;
        }

        $username = strtolower($username);
        $hashed = password_hash($password, PASSWORD_ARGON2I);

        $query = 'INSERT INTO userInfo (username, email) VALUES (:uname, :email)';
        $stmt = $this->dbconn->prepare($query);

        $stmt->bindValue(':uname', $username);
        $stmt->bindValue(':email', $email);
        $result = $stmt->execute();
        print_r($result);

        $user = $this->getUser($username);
        $id = $user['id'];

        $query2 = sprintf("INSERT INTO passwords VALUES (%d, '%s')", $id, $hashed);
        $this->dbconn->exec($query2);

        return true;
    }

    public function verifyPassword($username, $password){
        $username = strtolower($username);
        $user = $this->getUser($username);

        if(!$user){
            return false;
        }

        $id = $user['id'];
        $query = sprintf("SELECT password FROM passwords WHERE user_id = %d", $id);
        $result = $this->dbconn->query($query);

        $entry = $result->fetchArray();
        if(!$entry){
            return false;
        }

        $hashed = $entry[0];
        return password_verify($password, $hashed);
    }
};
?>