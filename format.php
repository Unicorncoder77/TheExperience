<?php 

function pageHeader(){
    $header = array();
    $header[] = "<h1>\n";
    $header[] = "The Experience";
    $header[] = "</h1>\n";
    $header[] = "<nav>\n";
        if (isset($_SESSION['user'])){
            $header[] = "<ul>\n";
            /* <li><a href="http://127.0.0.1/HipHop%20Website/index.html"> Home </a></li>
                <li><a href="http://127.0.0.1/HipHop%20Website/about.html"> About Us </a></li>
                <li><a href="http://127.0.0.1/HipHop%20Website/read.html"> Read All About it </a></li>
                <li><a href="http://127.0.0.1/HipHop%20Website/login.html"> Login </a></li>*/
            $header[] = "<li><a href='http://127.0.0.1/HipHop%20Website/index.html'> Home </a></li>\n";
            $header[] = "<li><a href='http://127.0.0.1/HipHop%20Website/about.html'> About </a></li>\n";
            $header[] = "<li><a href='http://127.0.0.1/HipHop%20Website/read.html'> Read </a></li>\n";
            $header[] = "<li><a href='logout.html'> Logout </a><li>\n";
            $header[] = "</ul>\n";
        }
        else{
            $header[] = "<ul>\n";
            $header[] = "<li><a href='index.html'> Home </a></li>\n";
            $header[] = "<li><a href='about.html'> About </a></li>\n";
            $header[] = "<li><a href='read.html'> Read </a></li>\n";
            $header[] = "<li><a href='login.html'> Login </a><li>\n";
            $header[] = "</ul>\n";

        }
    /* <ul>
                <li><a href="index.html"> Home </a></li>
                <li><a href="about.html"> About Us</a></li>
                <li><a href="read.html"> Read All About it</a></li> 
                <li><a href="login.html"> Login</a></li>
            </ul>*/
    $header = "</nav>\n";
    
    return $header;
}

function pageFooter(){
    $header = array();
    $header[] = "<p> Created by Hanna Nash :p </p>\n";
    return $header;
}

function docHeader(){
    $header = array();
    $header[] = "<title> The Experience </title>\n";
    $header[] = "<link rel='stylesheet href='style.css'/>\n";
    $header[] = "<script type='text/javascript' src=script.js'> </script>\n";
    return $header;

}

function buildPage($contents){
    $page = array();
    $page[] = "<html>\n";
    $page[] = "<head>\n";
    $page[] = implode(docHeader());
    $page[] = "</head>\n";
    $page[] = "<body>\n";

    $page[] = "<table> \n";
    $page[] = "<tr><td>\n";
    $page[] = implode(pageHeader());
    $page[] = "</td></tr>";

    $page[] = "<tr><td>\n";
    $page[] = implode($contents);
    $page[] = "</tr></td>\n";

    $page[] = "<tr><td>\n";
    $page[] = implode(pageFooter());
    $page[] = "</tr></td>\n";

    $page[] = "</body>\n";
    $page[] = "</html>\n";

    return $page;
}



?>