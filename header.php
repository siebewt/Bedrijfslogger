<link rel="stylesheet" href="css/css.css">
<script src="https://kit.fontawesome.com/9e89c75990.js" crossorigin="anonymous"></script>
<a href="upload/bedrijf.php">Nieuwe bedrijf toevoegen</a><br><br>
<?php
include 'config/config.php'; 
function GetBedrijvenLijst($offset = null){
    $link = mysqli_connect(server, user, password, database);
    $sql = "select bedrijfsnaam from bedrijven ";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql .= " WHERE instr(bedrijfsnaam, '$search')";
    }
    $sql .= " limit 20";
    $res = $link->query($sql);
    ?>
    <div class="search-container">
    <form action="index.php" method="post" name="cmsform" enctype="multipart/form-data">
    <input type="text" name="search" id="search" placeholder="Zoek">
    <button type="submit"><i class="fa fa-search"></i></button>
    </form>
    </div>
    <?php
    while ($row = $res->fetch_assoc()) {
        echo '<a class="Bedrijf" href="./index.php?bedrijf='.$row['bedrijfsnaam'].'">'.$row['bedrijfsnaam'].'</a>';
    }
}
?>
<nav class="navbar">
    <?php GetBedrijvenLijst();?>
</nav>