<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
</head>
<body>
<?php
include('header.php');
function GetBedrijf(){
    $link = mysqli_connect(server, user, password, database);
    if (isset($_GET['bedrijf'])){
        $bedrijf = $_GET['bedrijf'];
    }
    else{
        $bedrijf = "";
    }
    $sql = "SELECT * FROM bedrijven WHERE bedrijfsnaam = '$bedrijf'";
    $res = $link->query($sql);
    while ($row = $res->fetch_assoc()) {
        echo '<h1>'.$row['bedrijfsnaam'].'</h1>';
    }

}
GetBedrijf();
?>
</body>
</html>