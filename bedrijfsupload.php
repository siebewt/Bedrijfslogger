<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
<p class="text-preview">Foto die word toegevoegd:</p>
<div class='image-preview' style='height:200px;'><img id="output" alt='foto' src=""></div>
<form class="form" action="uploads/upload.php" method="post" name="cmsform" enctype="multipart/form-data">
    <h1 class="login-title">Bedrijfs toevoegen</h1>
    <p>Naam: *</p><input type="text" name="title" id="title" required="required"/>
    <p>Tekst: *</p><textarea name="body" minlength="100" rows="5" cols="40" required="required" ></textarea>
    <p>Selecteer logo om te uploaden:<input type="file" name="file" onchange="loadFile(event)" id="file" /></p>

    <a href="index.php" class="link">Terug</a>

    <input type="submit" class="login-button" value="Verzend" name="verzend">
</form>
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