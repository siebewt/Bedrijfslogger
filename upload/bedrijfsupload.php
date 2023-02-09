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
    $bedrijfsnaam = strip_tags(mysqli_real_escape_string($link, $_POST['bedrijfsnaam']));
    $provincies = strip_tags(mysqli_real_escape_string($link, $_POST['provincies']));
    $sector = strip_tags(mysqli_real_escape_string($link, $_POST['sector']));
    $notitie = strip_tags(mysqli_real_escape_string($link, $_POST['notitie']));
    $Cid = intval($_POST['Cid']);


    
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
    error_log(date("Y-m-d H:i:s") . "\tUploaded naam bestaat al!\n", 3, "../errors.log");
  }
  try{
    if(!$_POST['notitie'] == ""){
        $link->begin_transaction();
        $link->autocommit(FALSE);
        $date = date("Y-m-d H:i:s");
        $sql = "INSERT INTO bedrijven (bedrijfsnaam, image, date, provincie, sector) VALUES (?, ?, ?, ?, ?)";
        $stmt = $link->prepare($sql);
        $stmt->bind_param("sssss", $bedrijfsnaam, $image, $date, $provincies, $sector);
        $stmt->execute();
        $id = mysqli_insert_id($link);
        
        $sql2 = "INSERT INTO notities (notitie, Bid, Cid) VALUES (?, ?, ?)";
        $stmt = $link->prepare($sql2);
        $stmt->bind_param("sii", $notitie, $id, $Cid);
        $stmt->execute();
        $link->commit();
        // $sql1 = "INSERT INTO bedrijven (bedrijfsnaam, image, date, provincie, sector) VALUES (?, ?, ?, ?, ?)";
        // $stmt = $link->prepare($sql);
        // $stmt->bind_param("sssss", $bedrijfsnaam, $image, $date, $provincies, $sector);
        // $id = mysqli_insert_id($dbh);
        // $sql2 = "INSERT INTO notities (notitie, Bid, Cid) VALUES ($notitie, $`id, $Cid)";
        // $dbh->commit();

    }
}catch (Exception $e) {
    $link->rollBack();
    echo "Failed: " . $e->getMessage();
}
$date = date("Y-m-d H:i:s");
echo $date;
$sql = "INSERT INTO bedrijven (bedrijfsnaam, image, date, provincie, sector) VALUES (?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("sssss", $bedrijfsnaam, $image, $date, $provincies, $sector);
$stmt->execute();

header('Location: ../../bedrijfslogger');
