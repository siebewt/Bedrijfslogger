<?php
    include '../config/config.php';
    // remote file path
    $link = mysqli_connect(server, user, password, database);
    mysqli_set_charset($link,"UTF8");
    $notitie = mysqli_real_escape_string($link, $_POST['notitie']);
    $Bid = mysqli_real_escape_string($link, $_POST['Bid']);


setlocale(LC_ALL,'nl_NL');
$sql = "INSERT INTO notities (notitie, Bid) VALUES ('$notitie', '$Bid')";
$res = mysqli_query($link, $sql);

if ($res == TRUE){
    echo "goed";
}
header('Location: ../../bedrijfslogger');
