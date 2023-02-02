<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <link rel="stylesheet" href="../css/css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
<div class="upload">
<form class="form" action="notitieupload.php" method="post" name="cmsform" enctype="multipart/form-data">
    <h1 class="login-title">Notitie</h1>
    <p>Notitie: </p><input type="text" name="notitie" id="notitie" required="required"/>
    <input type="hidden" name="Bid" id="Bid" required="required" value="<?php echo $_GET['Bid'];?>"/>
    <input type="hidden" name="Cid" id="Cid" required="required" value="<?php echo $_SESSION['id'];?>"/>

    <br><br><a href="index.php" class="link">Terug</a>

    <br><br><input type="submit" class="login-button" value="Verzend" name="verzend">
</form>
</div>
</body>
</html>