<?php 
include 'config/config.php'; 
session_start();
requireValidUser();
if(isAdmin()){
    header('Location: index.php');
}
function GetUser(){
    $link = mysqli_connect(server, user, password, database);
    $sql = "SELECT username, id FROM gebruikers ";
    if(isset($_POST['searchuser'])){
        $search = $_POST['searchuser'];
        $sql .= " WHERE instr(username, '$search')";
    }
    $sql .= " LIMIT 50 ";
        $res = $link->query($sql);
        while ($row = $res->fetch_assoc()) {
            ?>
            <div class="accountsdisplay">
                <a class="usericon" href="upload/accountbeheer.php?id='<?php echo $row['id'];?>'"><i class="fa-solid fa-user fa-3x"></i> <?php echo $row['username']?></a>
            </div>
            <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/9e89c75990.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
</head>
<body>
    <form action="account.php" method="post" name="cmsform" enctype="multipart/form-data">
    <input type="text" name="searchuser" id="searchuser" placeholder="Zoek">
    <button type="submit"><i class="fa fa-search search-button"></i></button>
    <div class="account-wrapper">
        <h1><?php echo $_SESSION['username'] ?></h1>
        <a class="addacount" href="addaccount.php"><i class="fa fa-plus fa-2x" aria-hidden="true"></i></a>
    </div>
    <div class="account-card-display">
    <?php GetUser();?>
    </div>
</body>
</html>