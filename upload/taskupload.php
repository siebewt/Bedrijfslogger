<?php
    include '../config/config.php';
    // remote file path
    $link = mysqli_connect(server, user, password, database);
    mysqli_set_charset($link,"UTF8");
    $tasks = mysqli_real_escape_string($link, $_POST['tasks']);
    $Bid = intval($_POST['Bid']);
    $Cid = intval($_POST['Cid']);


setlocale(LC_ALL,'nl_NL');
$sql = "INSERT INTO tasks (tasks, Bid, Cid) VALUES (?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("sii", $tasks, $Bid, $Cid);
$stmt->execute();
//$res = mysqli_query($link, $sql);

if ($res == TRUE){
    echo "goed";
}
header('Location: ../../bedrijfslogger');
