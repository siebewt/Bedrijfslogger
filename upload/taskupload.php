<?php
    include '../config/config.php';
    // remote file path
    $link = mysqli_connect(server, user, password, database);
    mysqli_set_charset($link,"UTF8");
    $tasks = mysqli_real_escape_string($link, $_POST['tasks']);
    $Bid = mysqli_real_escape_string($link, $_POST['Bid']);


setlocale(LC_ALL,'nl_NL');
$sql = "INSERT INTO tasks (tasks, Bid) VALUES ('$tasks', '$Bid')";
$res = mysqli_query($link, $sql);

if ($res == TRUE){
    echo "goed";
}
header('Location: ../../bedrijfslogger');
