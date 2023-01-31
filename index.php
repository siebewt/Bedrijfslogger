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
    $sql = "SELECT t0.id, t0.image, t0.bedrijfsnaam, t1.Bid, t1.notitie, t2.tasks FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid LEFT JOIN tasks t2 ON t0.id = t2.Bid WHERE bedrijfsnaam = '$bedrijf'";
    //SELECT t0.id, t0.image, t0.bedrijfsnaam, t1.Bid, t1.notitie FROM bedrijven t0 INNER JOIN notities t1 ON t0.id = t1.Bid WHERE bedrijfsnaam = '$bedrijf

    $res = $link->query($sql);
    while ($row = $res->fetch_assoc()) {
        ?>
        <div class="title-wrapper">
        <h1><?php echo $row['bedrijfsnaam'];?></h1>
        <?php
        if ($row['image'] != ""){
            $image = $row['image'];
         } 
         ?>
        <div><img class="logo" src='./pictures/<?php echo $image?>' alt='logo'></a></div>
    </div>
    <div class="card-holder">
        <div class="card">
            <a href="upload/notitie.php?Bid=<?php echo $row['id'];?>">notitie</a>
            <p><?php echo $row['notitie'];?></p>
        </div>
        <div class="card">
        <a href="upload/tasks.php?Bid=<?php echo $row['id'];?>">Tasks</a>
        <p><?php echo $row['tasks'];?></p>
    </div>
    </div>
    <?php
    }

}
?>
<div class="body-wrapper"><?php
GetBedrijf();
?>
</div>
</body>
</html>