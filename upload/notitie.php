<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
<form class="form" action="notitieupload.php" method="post" name="cmsform" enctype="multipart/form-data">
    <h1 class="login-title">Notitie</h1>
    <p>Notitie: </p><input type="text" name="notitie" id="notitie" required="required"/>
    <input type="hidden" name="Bid" id="Bid" required="required" value="<?php echo $_GET['Bid'];?>"/>


    <a href="index.php" class="link">Terug</a>

    <input type="submit" class="login-button" value="Verzend" name="verzend">
</form>
</body>
</html>