<a href="bedrijfsupload.php" class='table-link'>Nieuwe bedrijf toevoegen</a><br><br>
<?php include '../config/config.php';

$conn = mysqli_connect(DBSERVERHOST, DBSERVERUSER, DBSERVERPASS, DBSERVERNAME);
function getBedrijven($conn) {
    $sql = "SELECT * FROM bedrijven ORDER BY date DESC";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        echo $row['bedrijfsnaam'];
}
}
getBedrijven($conn);
?>
<nav>
    <a>test</a>
</nav>