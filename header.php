<link rel="stylesheet" href="css/css.css">
<a href="bedrijfsupload.php" class='table-link'>Nieuwe bedrijf toevoegen</a><br><br>
<?php
include 'config/config.php'; 
function GetBedrijvenLijst($offset = null){
    $params = [];
    $link = mysqli_connect(server, user, password, database);
    $offset = 0;
    $sql = "select bedrijfsnaam from bedrijven "
    . " limit 5 OFFSET $offset";
    $res = $link->query($sql);
    while ($row = $res->fetch_assoc()) {
        echo '<a class="Bedrijf" href="./index.php?bedrijf='.$row['bedrijfsnaam'].'">'.$row['bedrijfsnaam'].'</a>';
    }
}
?>
<nav class="navbar">
    <?php GetBedrijvenLijst();?>
</nav>