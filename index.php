
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
//haalt lijst met bedrijven op
include('header.php');
//check of de pagina bezoeker een gebruiker is als niet dan stuurt ie hem naar de inglogpagina
requireValidUser();


//haalt error op van upload pagina om de error te laten zien
if(isset($_GET['name'])){
    if ($_GET['name'] == 'true'){
        echo "<script>window.alert('Naam bestaat al')</script>";
    }
}

$db = new DB();
$bedrijvenlijst = $db -> getBedrijven();
//while loop hier
// haalt alle contacten op gelimiteerd tot 5 contacten max
function GetContactpersonen($id){
    //haal connectie met db op
    $link = mysqli_connect(server, user, password, database);
    if (isset($_GET['bedrijf'])){
        $bedrijf = $_GET['bedrijf'];
    }
    else{
        $bedrijf = "";
    }
    //SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.tasks, t1.id FROM bedrijven t0 LEFT JOIN tasks t1 ON t0.id = t1.Bid WHERE bedrijfsnaam = '$bedrijf'
    //t0.bedrijfsnaam, t0.id, t1.Bid, t1.tasks, t1.id FROM bedrijven t0 
    //SELECT id, naam, Bid FROM
    //$sql = "SELECT t0.bedrijfsnaam, t0.id, t1.id, t1.naam, t1.Bid FROM bedrijven t0 LEFT JOIN contactspersoon t1 ON t0.id = t1.Bid WHERE bedrijfsnaam = '$bedrijf";
    //haal de specifieke data op voor de functie
    $sql = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.naam, t1.id, t1.email FROM bedrijven t0 LEFT JOIN contactspersoon t1 ON t0.id = t1.Bid WHERE bedrijfsnaam = '$bedrijf' LIMIT 5";
    //$sql .= " limit 5";
    $res = $link->query($sql);
    if(isset($_GET['bedrijf'])){
    ?>
    <div class="AddCPersoon">
    <a href="upload/addcontact.php?Bid=<?php echo $id;?>&amp;bedrijf=<?php echo $bedrijf?>"><i class="fa-solid fa-plus"></i></a>
</div>
<?php }?>
<div class='navbar-personen'>
    <?php
    //while loop om data te laten zien
    while ($row = $res->fetch_assoc()) {
        if(isset($row['id'])){
            // $bedrijf = new delete();
            // $id = new delete();
            // // $table = new delete();
            // // $location = new delete();
             $delete = new delete();
            // //$bedrijf->set_name();
            $delete->setdelete($row['id'],'contactspersoon','index.php');
            $delete1 = $delete->get_delete();
            // $table->setdelete('contactspersoon');
            // $location->setdelete('index.php');
            ?>
        <div class="c-card">
        <p><?php echo $row['naam'];?></p>
        <p><?php echo $row['email'];?></p>
        <a class="delete-button" href="delete.php?<?php echo $delete1 ?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')" class='table-link'><i class="fa fa-trash fa-1x" id="deletebutton" aria-hidden="true"></i></a>
        </div>
        <?php }
    }
    ?></div><?php
}

//haal bedrijfsnaams op en logo
function GetBedrijfNaam(){
    //haal connectie op voor de functie
    $link = mysqli_connect(server, user, password, database);
    if (isset($_GET['bedrijf'])){
        $bedrijf = $_GET['bedrijf'];
    }
    else{
        $bedrijf = "";
    }
    //haal de specifieke data op van de tabellen voor de functie
    $sql = "SELECT t0.id, t0.image, t0.bedrijfsnaam, t1.Bid, t1.notitie, t2.tasks, t0.date FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid" 
    . " LEFT JOIN tasks t2 ON t0.id = t2.Bid WHERE bedrijfsnaam = '$bedrijf'"
    . " LIMIT 1";
    // $sql = "SELECT t0.id, t0.image, t0.bedrijfsnaam, t1.Bid, t1.notitie, t2.tasks, t0.date FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid" 
    // . " LEFT JOIN tasks t2 ON t0.id = t2.Bid WHERE bedrijfsnaam = '$bedrijf'"
    // . " LIMIT 1";
    //select bedrijfsnaam from bedrijven WHERE instr(bedrijfsnaam, "Bedrijf");
    //SELECT t0.id, t0.image, t0.bedrijfsnaam, t1.Bid, t1.notitie FROM bedrijven t0 INNER JOIN notities t1 ON t0.id = t1.Bid WHERE bedrijfsnaam = '$bedrijf
    //$result=mysqli_query($link,$sql);
    //$amount = mysqli_num_rows ($result);
    $res = $link->query($sql);
    //while loop om de data te laten zien
    while ($row = $res->fetch_assoc()) {
        global $Bid;
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
        <?php if (!isAdmin()){ ?>
        <div class="delete-button"><a href="delete.php?id=<?php echo $row['id'];?>&amp;table=bedrijven&amp;location=index.php&amp;image=<?php echo $image;?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')" class='table-link'><i class="fa fa-trash fa-3x" id="deletebutton" aria-hidden="true"></i></a>
        </div>    
        <?php } ?>
    </div>
    <?php
    return $Bid = $row['id'];
    }

}

//functie om de notities van de specifieke bedrijf op te halen
function GetBedrijfnotitie($id){
    $link = mysqli_connect(server, user, password, database);
    if (isset($_GET['bedrijf'])){
        $bedrijf = $_GET['bedrijf'];
    }
    else{
        $bedrijf = "";
    }
    //benodigde data van notities ophalen doormiddel van de bedrijfsnaam
    $notities = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.notitie, t1.id FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid WHERE bedrijfsnaam = '$bedrijf'";
    $result = $link->query($notities);
    $amount = mysqli_num_rows ( $result );
    //check voor de geselecteerde pagina voor de notities
    if(isset($_GET['pagenotitie'])){
        $offset = $_GET['pagenotitie'];
        $offset = $offset-1;
    }
    else {
        $offset = 0;
    }
    $notities .= "LIMIT 1 OFFSET $offset";
    $res = $link->query($notities);
    $tel = 1;
    //while loop om de data te laten zien
    while ($row = $res->fetch_assoc()) {
        ?>
        <div class="card">
            <p>notitie</p>
            <a href="upload/notitie.php?Bid=<?php echo $id;?>&amp;bedrijf=<?php echo $bedrijf?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
            <div class="delete-notitie"><a href="delete.php?id=<?php echo $row['id'];?>&amp;table=notities&amp;location=index.php?bedrijf=<?php echo $row['bedrijfsnaam'];?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')"><i class="fa fa-trash fa-1x" id="deletebutton" aria-hidden="true"></i></a>
            </div>
            <div class="page">
            <?php 
            for ($k = 0 ; $k < $amount; $k++){ 
                ?>
                <a class="page" href="index.php?bedrijf=<?php echo $row['bedrijfsnaam'];?>&amp;pagenotitie=<?php echo $tel?>"><?php echo $tel;?></a>
                <?php $tel = $tel+1; 
            }
            ?>
            </div>
            <p class="text"><?php echo $row['notitie'];?></p>
        </div>
    <?php
}
}

//functie om bedrijfstasks op te halen
function GetBedrijfTasks($id){
    //haal connectie op voor de functie
    $link = mysqli_connect(server, user, password, database);
    if (isset($_GET['bedrijf'])){
        $bedrijf = $_GET['bedrijf'];
    }
    else{
        $bedrijf = "";
    }
    //haal de tasks data op doormiddel van de bedrijfsnaam
    $tasks = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.tasks, t1.id FROM bedrijven t0 LEFT JOIN tasks t1 ON t0.id = t1.Bid WHERE bedrijfsnaam = '$bedrijf'";
    $result = $link->query($tasks);
    $amount = mysqli_num_rows ( $result );
    //check de selecteerde pagina om die specifiek op te halen
    if(isset($_GET['pagetasks'])){
        $offset = $_GET['pagetasks'];
        $offset = $offset-1;
    }
    else {
        $offset = 0;
    }
    //limiteer het aantal data dat word opgehaald
    $tasks .= "LIMIT 1 OFFSET $offset";
    $res = $link->query($tasks);
    $tel = 1;
    //while loop om de data te laten zien
    while ($row = $res->fetch_assoc()) {
        ?>
    <div class="card">
        <p>Tasks</p>
        <a href="upload/tasks.php?Bid=<?php echo $id;?>&amp;bedrijf=<?php echo $bedrijf?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
         <div class="delete-task"><a href="delete.php?id=<?php echo $row['id'];?>&amp;table=tasks&amp;location=index.php?bedrijf=<?php echo $row['bedrijfsnaam'];?>" onClick="return confirm('Weet je zeker dat je dit wilt verwijderen?')"><i class="fa fa-trash fa-1x" id="deletebutton" aria-hidden="true"></i></a>
         </div>
         <div class="page">
        <?php 
            for ($k = 0 ; $k < $amount; $k++){ 
                ?>
                <a class="page" href="index.php?bedrijf=<?php echo $row['bedrijfsnaam'];?>&amp;pagetasks=<?php echo $tel?>"><?php echo $tel;?></a>
                <?php $tel = $tel+1; 
            }
            ?>
        </div>
        <p><?php echo $row['tasks'];?></p>
    </div>
        <?php
}
}

?>
<div class="body-wrapper"><?php
$Bid = "";
//de functies die worden uitgevoerd
GetBedrijfNaam();
GetContactpersonen($Bid);
echo '<div class="card-holder">';
GetBedrijfTasks($Bid);
GetBedrijfnotitie($Bid);
echo '</div>';
?>
</div>
</body>
</html>