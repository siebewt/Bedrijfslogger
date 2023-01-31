<?php
    include '../config/config.php';
    // remote file path
    $link = mysqli_connect(server, user, password, database);
    mysqli_set_charset($link,"UTF8");
    $notitie = mysqli_real_escape_string($link, $_POST['notitie']);
    $Bid = intval($_POST['Bid']);
    $Cid = intval($_POST['Cid']);

setlocale(LC_ALL,'nl_NL');
$sql = "INSERT INTO notities (notitie, Bid, Cid) VALUES (?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("sii", $notitie, $Bid, $Cid);
$stmt->execute();
//$res = mysqli_query($link, $sql);

if ($res == TRUE){
    echo "goed";
}
header('Location: ../../bedrijfslogger');
?>
