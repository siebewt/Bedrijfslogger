<?php 
define("server","localhost");
define("user","root");
define("password","");
define("database","Bedrijven");

function isAdmin() {
    return isset($_SESSION['user']['admin']) && $_SESSION['user']['admin'] === 1; 
}

function requireValidUser() {
    if ($_SESSION['loggedin'] != TRUE) {
        header('Location: login.php');
    } 
}
?>