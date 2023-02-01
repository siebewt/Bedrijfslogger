<?php
    include '../config/config.php';
    $link = mysqli_connect(server, user, password, database);
    mysqli_set_charset($link,"UTF8");
    $naam = mysqli_real_escape_string($link, $_POST['naam']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $Bid = intval($_POST['Bid']);
    $Cid = intval($_POST['Cid']);
    $location = mysqli_real_escape_string($link, $_POST['bedrijf']);

setlocale(LC_ALL,'nl_NL');
$sql = "INSERT INTO contactspersoon (naam, email, Bid, Cid) VALUES (?, ?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("ssii", $naam, $email, $Bid, $Cid);
$stmt->execute();
//$res = mysqli_query($link, $sql);
echo $location;
header("Location: ../../bedrijfslogger?bedrijf=$location");
?>
