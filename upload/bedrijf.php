<?php 
include './WeatherCaller.php';
$apicall = new weather();
$weer = $apicall->getWeather();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/css.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
  <div class="b-upload">
<form class="form" action="bedrijfsupload.php" method="post" name="cmsform" enctype="multipart/form-data">
    <h1 class="login-title">Bedrijf toevoegen</h1>
    <p>Bedrijfsnaam: *</p><input type="text" name="bedrijfsnaam" id="bedrijfsnaam" required="required"/>
    <p>Selecteer logo om te uploaden:<input type="file" name="file" onchange="loadFile(event)" id="file" /></p>
    <label for="provincies">Provincie: </label>
    <select name="provincies" id="provincies">
      <option value="friesland">Friesland</option>
      <option value="drenthe">drenthe</option>
      <option value="gelderland">gelderland</option>
      <option value="overijssel">overijssel</option>
      <option value="noord-holland">noord-holland</option>
      <option value="zuid-holland">zuid-holland</option>
      <option value="noord-brabant">noord-brabant</option>
      <option value="flevoland">flevoland</option>
      <option value="zeeland">zeeland</option>
      <option value="utrecht">utrecht</option>
      <option value="limburg">limburg</option>
    </select>
    <br>
    <br>
    <label for="sector">Sector: </label>
    <select name="sector" id="sector">
      <option value="overheid">Overheid</option>
      <option value="Consument">Consument</option>
      <option value="Particulier">Particulier</option>
    </select>
    <br>
    <br>


    <a href="index.php" class="link">Terug</a><br><br>

    <input type="submit" class="login-button" value="Verzend" name="verzend">
    <h1 class="login-title">Notitie</h1>
    <p>Notitie: </p><input type="text" name="notitie" id="notitie"/>
    <input type="hidden" name="Cid" id="Cid" required="required" value="<?php echo $_SESSION['id'];?>"/>

    <br><br><a href="index.php" class="link">Terug</a>

    <br><br><input type="submit" class="login-button" value="Verzend" name="verzend">
</form>
</div>
<div class='image-preview'><p>Foto die word toegevoegd:</p><br><br><img id="output" alt='foto' src=""></div>
</body>
</html>
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src) // free memory
    }
  };
</script>