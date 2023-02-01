<link rel="stylesheet" href="css/css.css">
<script src="https://kit.fontawesome.com/9e89c75990.js" crossorigin="anonymous"></script>
<a class="Bedrijftoevoegen" href="upload/bedrijf.php"><i class="fa fa-plus fa-3x" aria-hidden="true"></i></a>
<?php
include 'config/config.php'; 
function GetBedrijvenLijst($offset = null){
    $link = mysqli_connect(server, user, password, database);
    $sql = "SELECT bedrijfsnaam FROM bedrijven ";
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $sql .= " WHERE instr(bedrijfsnaam, '$search')";
    }
    $sql .= " limit 20";
    $res = $link->query($sql);
    ?>
    <div class="search-bar">
    <form action="index.php" method="post" name="cmsform" enctype="multipart/form-data">
    <input type="text" name="search" id="search" placeholder="Zoek">
    <button type="submit"><i class="fa fa-search search-button"></i></button>
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