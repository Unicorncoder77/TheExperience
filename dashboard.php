<?php 
session_start();
require 'config.php';
require 'loginConn.php';

if (!isset($_SESSION['user'])){
    header("Location: loginPage.php");
    exit();
}

$username = $_SESSION['user'];

$user = $userAccounts->getUserInfo($username);
$userID = $user['id'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> <?php echo $_POST['username'];?>'s Page</title>
    </head>
    <body>
         <h1> The Experience </h1>
            <nav class="homeNav" id="navigation-bar">
                <a href="index.php">Home</a>
                <a href="#">About</a>
                <a href="#">Articles</a>
                <a href="#">Reviews</a>
                
                <a href="#">Contact</a>
                <a href="#">Logout</a>
                <a href="#">Your Reviews</a>
                <a href="#">Your Saved Articles</a>
                <div class="search">
                    <form action="#">
                        <input type="text" placeholder="Search" name="search">
                        <button type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
                <div class="settings">
                    <button class="darkModeToggle" id="darkModeToggle" onclick="darkMode()">
                        <i class="fa fa-moon-o fa-2x" ></i>
                    </button>
                </div>
            </nav>

            <h1> Welcome Back <?php echo $_POST['username']; ?></h1>
    </body>
</html>