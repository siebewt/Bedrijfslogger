<?php 
include 'config/config.php'; 
session_start();
requireValidUser();

$link = mysqli_connect(server, user, password, database);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Account</title>
</head>
<body>
    <div class="accountdisplay">
    <form class="form" action="upload/accountupload.php" method="post" name="cmsform" enctype="multipart/form-data">
    <h1 class="login-title">Account toevoegen</h1>
    <p>Accountnaam: </p><input type="text" name="username" id="username" required="required"/><br>
    <p>Wachtwoord: </p><input type="password" name="password" id="password" required="required"/><br>
    <label for="admin">Admin: </label><input type="checkbox" id="admin" name="admin" value="admin"><br><br>

    <input type="submit" class="login-button" value="Verzend" name="verzend"><br><br>
    <a href="projecten_crud.php" class="link">Terug</a><br>
</form>
    
        </div>

        </form>
    </section>
    </div>
    
</body>
</html>