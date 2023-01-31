<?php 
define("server","localhost");
define("user","root");
define("password","");
define("database","Bedrijven");

class delete{
    public $id;
    function delete($delete){
    echo "<a href='delete.php?id=".$row['id']."&amp;db=projecten&amp;location=projecten_crud.php&amp;image=".$row['image']." onClick='return confirm('Weet je zeker dat je dit wilt verwijderen?')' class='table-link'>Verwijderen</a></p>";
}
}

function isAdmin() {
    return $_SESSION['admin'] != 1; 
}

function requireValidUser() {
    if ($_SESSION['loggedin'] != TRUE) {
        header('Location: login.php');
    } 
}
?>