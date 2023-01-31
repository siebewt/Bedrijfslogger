<?php 
include '../config/config.php'; 
session_start();
requireValidUser();
    // remote file path
    $link = mysqli_connect(server, user, password, database);
    mysqli_set_charset($link,"UTF8");
    $username = mysqli_real_escape_string($link, $_POST['username']);
    $password = mysqli_real_escape_string($link, $_POST['password']);
    $password = crypt($password , $password );
    if (isset($_POST['admin'])){
    $admin = mysqli_real_escape_string($link, $_POST['admin']);
    }
    else{
        $admin = "";
    }
    //echo $admin;
    //$Bid = intval($_POST['admin']);
    if ($admin == "admin"){
        $admin = 1;
    }
    else{
        $admin = 0;
    }

setlocale(LC_ALL,'nl_NL');
$sql = "INSERT INTO gebruikers (username, password, admin) VALUES (?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("ssi", $username, $password, $admin);
$stmt->execute();
//$res = mysqli_query($link, $sql);

if ($stmt == TRUE){
    echo "goed";
}
header('Location: ../account.php');

?>