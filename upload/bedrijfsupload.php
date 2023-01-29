<?php
    include '../config/config.php';
    //login information
    $remote_dir = '../pictures/';
    $src_file =  $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $fileNameNew = uniqid('', true).".".$fileActualExt;
    $dst_file = $remote_dir . $fileNameNew ;
    // remote file path
    $link = mysqli_connect(server, user, password, database);
    mysqli_set_charset($link,"UTF8");
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $provincies = mysqli_real_escape_string($link, $_POST['provincies']);
    $sector = mysqli_real_escape_string($link, $_POST['sector']);
    //echo $src_file;

if (isset($_POST['verzend'])){
    move_uploaded_file($src_file, $dst_file);
    $image = $fileNameNew;
}
//mysql log
setlocale(LC_ALL,'nl_NL');
$sql = "INSERT INTO bedrijven (bedrijfsnaam, image, date, provincie, sector) VALUES ('$title', '$image', now(), '$provincies', '$sector')";
$res = mysqli_query($link, $sql);

if ($res == TRUE){
    echo "goed";
}
header('Location: ../../bedrijfslogger');
