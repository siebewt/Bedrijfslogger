
<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
</head>
<body>
<a class="account" href="account.php"><i class="fa-solid fa-user fa-3x"></i></a>
<?php
include('header.php');
requireValidUser();
function GetBedrijf(){
    $link = mysqli_connect(server, user, password, database);
    if (isset($_GET['bedrijf'])){
        $bedrijf = $_GET['bedrijf'];
    }
    else{
        $bedrijf = "";
    }
    $sql = "SELECT t0.id, t0.image, t0.bedrijfsnaam, t1.Bid, t1.notitie, t2.tasks, t0.date FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid" 
    . " LEFT JOIN tasks t2 ON t0.id = t2.Bid WHERE bedrijfsnaam = '$bedrijf'"
    . " LIMIT 1";
    //select bedrijfsnaam from bedrijven WHERE instr(bedrijfsnaam, "Bedrijf");
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
        <?php if (!isAdmin()){ ?>
        <div class="delete-button"><a href="delete.php?id=<?php echo $row['id'];?>&amp;table=bedrijven&amp;location=index.php&amp;image=<?php echo $row['image'];?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')" class='table-link'><i class="fa fa-trash" id="deletebutton" aria-hidden="true"></i></a>
        </div>    
        <?php } ?>
    </div>
    <div class="card-holder">
        <div class="card">
            <p>notitie</p>
            <a href="upload/notitie.php?Bid=<?php echo $row['id'];?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
            <p class="text"><?php echo $row['notitie'];?></p>
        </div>
        <div class="card">
        <p>Tasks</p>
        <a href="upload/tasks.php?Bid=<?php echo $row['id'];?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
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