<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
<form class="form" action="contactupload.php" method="post" name="cmsform" enctype="multipart/form-data">
    <h1 class="login-title">contactspersoon</h1>
    <p>Naam: </p><input type="text" name="naam" id="naam" required="required"/>
    <p>Email: </p><input type="text" name="email" id="email" required="required"/>
    <input type="hidden" name="Bid" id="Bid" required="required" value="<?php echo $_GET['Bid'];?>"/>
    <input type="hidden" name="Cid" id="Cid" required="required" value="<?php echo $_SESSION['id'];?>"/>
    <input type="hidden" name="bedrijf" value="<?php echo $_GET['bedrijf'];?>"/>


    <a href="index.php" class="link">Terug</a>

    <input type="submit" class="login-button" value="Verzend" name="verzend">
</form>
</body>
</html>