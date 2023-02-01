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
    $bedrijfsnaam = mysqli_real_escape_string($link, $_POST['bedrijfsnaam']);
    $provincies = mysqli_real_escape_string($link, $_POST['provincies']);
    $sector = mysqli_real_escape_string($link, $_POST['sector']);
    //echo $src_file;

if (isset($_POST['verzend'])){
    move_uploaded_file($src_file, $dst_file);
    $image = $fileNameNew;
}

if ($_FILES['file']['name'] == ""){
    $image = $fileName;
}
//mysql log
setlocale(LC_ALL,'nl_NL');
try{
$check = "SELECT bedrijfsnaam FROM bedrijven WHERE bedrijfsnaam='$bedrijfsnaam'";
$res = $link->query($check);
while ($row = $res->fetch_assoc()) {
    if ($row['bedrijfsnaam']=="$bedrijfsnaam"){
        throw new Exception("?name=true");
    }
}
}
catch(Exception $e) {
    header("Location: ../../bedrijfslogger".$e->getMessage()."");
  }
$date = date("Y-m-d H:i:s");
echo $date;
$sql = "INSERT INTO bedrijven (bedrijfsnaam, image, date, provincie, sector) VALUES (?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("sssss", $bedrijfsnaam, $image, $date, $provincies, $sector);
$stmt->execute();

// if ($stmt == TRUE){
//     echo "goed";
// }
header('Location: ../../bedrijfslogger');
