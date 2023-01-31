<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    header('Location: ../login');
}
?>
<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Anek+Tamil:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

<?php
//ini_set("display_errors", 1);
if (isset($_SESSION['loggedin'])) {
include 'config/config.php';
$link = mysqli_connect(server, user, password, database);
mysqli_set_charset($link,"UTF8");

    $id = $_GET['id'];
    $table = $_GET['table'];
    $location = $_GET['location'];
    $image = ("pictures/".$_GET['image']);
    unlink($image);

    $result = mysqli_query($link, "DELETE FROM $table WHERE id=$id");

    if($result == TRUE){
       header("Location: $location");
    }
    else{
        header("Location: $location");
    }
}
else {
    header('Location: ../login.php');
}
?>
