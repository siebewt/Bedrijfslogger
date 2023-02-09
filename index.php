
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
//check of de pagina bezoeker een gebruiker is als niet dan stuurt ie hem naar de inglogpagina
requireValidUser();

//haalt error op van upload pagina om de error te laten zien
if(isset($_GET['name'])){
    if ($_GET['name'] == 'true'){
        echo "<script>window.alert('Naam bestaat al')</script>";
    }
}
?>
<div class="body-wrapper">

<?php
$Bid = "";
//de functies die worden uitgevoerd
$db = new DB();
$res = $db -> getBedrijfNaam();
//haal bedrijfsnaams op en logo
while ($row = $res->fetch_assoc()) {
    $Bid = $row['id'];
    ?>
    <div class="title-wrapper">
    <h1><?php echo $row['bedrijfsnaam'];?></h1>
    <?php
    if (!isset($row['image'])){
        $image = "";
    }
    else{
        $image = $row['image'];
    }
    ?>
    <div><img class="logo" src='./pictures/<?php echo $image?>' alt='logo'></a></div>
    <?php
    if (!isAdmin()){ 
        ?>
        <div class="delete-button"><a href="delete.php?id=<?php echo $row['id'];?>&amp;table=bedrijven&amp;location=index.php&amp;image=<?php echo $image;?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')" class='table-link'><i class="fa fa-trash fa-3x" id="deletebutton" aria-hidden="true"></i></a>
    </div>    
    <?php
    } 
    ?>
    </div>
    <?php
}


// GetContactpersonen($Bid);
$res = $db -> GetContactpersonen($Bid);

?>
<div class='navbar-personen'>
    <?php
while ($row = $res->fetch_assoc()) {
    if(isset($row['id'])){
        $delete = new delete();
        $delete1 = $delete->setdelete($row['id'],'contactspersoon','index.php');
        //$delete1 = $delete->get_delete();
        ?>
    <div class="c-card">
    <p><?php echo $row['naam'];?></p>
    <p><?php echo $row['email'];?></p>
    <a class="delete-button" href="delete.php?<?php echo $delete1 ?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')" class='table-link'><i class="fa fa-trash fa-1x" id="deletebutton" aria-hidden="true"></i></a>
    </div>
    <?php
    }
}
?>
</div>
<?php
$bedrijf = "";
if(isset($_GET['bedrijf'])){
    $bedrijf = $_GET['bedrijf'];
}
echo '<div class="card-holder">';

// GetBedrijfTasks($Bid);
$res = $db -> GetBedrijfTasks($Bid, $bedrijf);
$amount = $db -> GetTasksAmount();
while ($row = $res->fetch_assoc()){
    $tel = 1;
    ?>
    <div class="card">
    <p>Tasks</p>
    <a href="upload/tasks.php?Bid=<?php echo $_GET['bedrijf'];?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
    <div class="delete-task"><a href="delete.php?id=<?php echo $row['id'];?>&amp;table=tasks&amp;location=index.php?bedrijf=<?php echo $row['bedrijfsnaam'];?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')"><i class="fa fa-trash fa-1x" id="deletebutton" aria-hidden="true"></i></a>
    </div>
    <div class="page">
        <?php 
        for ($k = 0 ; $k < $amount; $k++){ 
            ?>
            <a class="page" href="index.php?bedrijf=<?php echo $_GET['bedrijf'];?>&amp;pagetasks=<?php echo $tel?>"><?php echo $tel;?></a>
            <?php
            $tel = $tel+1; 
        }
        ?>
    </div>
    <p>
        <?php
        echo $row['tasks'];
        ?>
        </p>
</div>
<?php
}
$res = $db -> getBedrijfnotitie($Bid);
$amount = $db -> GetNotitieAmount();
while ($row = $res->fetch_assoc()) {
    $tel = 1;
    ?>
    <div class="card">
        <p>notitie</p>
        <a href="upload/notitie.php?Bid=<?php echo $_GET['bedrijf'];?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
        <div class="delete-notitie"><a href="delete.php?id=<?php echo $row['id'];?>&amp;table=notities&amp;location=index.php?bedrijf=<?php echo $row['bedrijfsnaam'];?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')"><i class="fa fa-trash fa-1x" id="deletebutton" aria-hidden="true"></i></a>
    </div>
    <div class="page">
        <?php 
        for ($k = 0 ; $k < $amount; $k++){ 
            ?>
            <a class="page" href="index.php?bedrijf=<?php echo $_GET['bedrijf'];?>&amp;pagenotitie=<?php echo $tel?>"><?php echo $tel;?></a>
            <?php
            $tel = $tel+1; 
        }
        ?>
        </div>
        <p class="text"><?php echo $row['notitie'];?></p>
    </div>
<?php
}
echo '</div>';
?>
</div>
</body>
</html>