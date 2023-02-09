<?php 
define("server","localhost");
define("user","Bedrijf");
define("password","mw/2!GIvqFfsJjsg");
define("database","Bedrijven");

class delete{
    public $delete;
    protected $bedrijf;
    protected $id;
    protected $table;
    protected $location;
    function setdelete($id,$table,$location = NULL){
        $this->delete = "id=$id&amp;table=$table&amp;location=$location";
        return $this->delete;
    }
}

class DB{
    private $link;
    
    public function __construct()
    {
        $this->link = mysqli_connect(server, user, password, database);
    }

    public function GetBedrijfNaam(){

        if (isset($_GET['bedrijf'])){
            $bedrijf = $_GET['bedrijf'];
        }
        else{
            $bedrijf = "";
        }
        //haal de specifieke data op van de tabellen voor de functie
        $sql = "SELECT t0.id, t0.image, t0.bedrijfsnaam, t1.Bid, t1.notitie, t2.tasks, t0.date FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid" 
        . " LEFT JOIN tasks t2 ON t0.id = t2.Bid WHERE t0.id = '$bedrijf'"
        . " LIMIT 1";
        //while loop om de data te laten zien
        return $res = $this->link->query($sql);
    }

    public function GetBedrijfnotitie($id){
        $link = mysqli_connect(server, user, password, database);
        if (isset($_GET['bedrijf'])){
            $bedrijf = $_GET['bedrijf'];
        }
        else{
            $bedrijf = "";
        }
        //benodigde data van notities ophalen doormiddel van de bedrijfsnaam
        $notities = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.notitie, t1.id FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid WHERE t0.id = '$bedrijf'";
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
        return $res = $link->query($notities);
    }

    public function GetNotitieAmount(){
        $link = mysqli_connect(server, user, password, database);
        if (isset($_GET['bedrijf'])){
            $bedrijf = $_GET['bedrijf'];
        }
        else{
            $bedrijf = "";
        }
        //benodigde data van notities ophalen doormiddel van de bedrijfsnaam
        $notities = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.notitie, t1.id FROM bedrijven t0 LEFT JOIN notities t1 ON t0.id = t1.Bid WHERE t0.id = '$bedrijf'";
        $result = $link->query($notities);
        return $amount = mysqli_num_rows ( $result );
    }

    public function GetBedrijfTasks($id){
        //haal connectie op voor de functie
        $link = mysqli_connect(server, user, password, database);
        if (isset($_GET['bedrijf'])){
            $bedrijf = $_GET['bedrijf'];
        }
        else{
            $bedrijf = "";
        }
        //haal de tasks data op doormiddel van de bedrijfsnaam
        $tasks = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.tasks, t1.id FROM bedrijven t0 LEFT JOIN tasks t1 ON t0.id = t1.Bid WHERE t0.id = '$bedrijf'";
        $result = $link->query($tasks);
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
        $id = $id;
        return $res = $link->query($tasks);
    }

    public function GetTasksAmount(){
        $link = mysqli_connect(server, user, password, database);
        if (isset($_GET['bedrijf'])){
            $bedrijf = $_GET['bedrijf'];
        }
        else{
            $bedrijf = "";
        }
        //benodigde data van notities ophalen doormiddel van de bedrijfsnaam
        $notities = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.tasks, t1.id FROM bedrijven t0 LEFT JOIN tasks t1 ON t0.id = t1.Bid WHERE t0.id = '$bedrijf'";
        $result = $link->query($notities);
        return $amount = mysqli_num_rows ( $result );
    }       

    public function GetContactpersonen($id){
        //haal connectie met db op
        $link = mysqli_connect(server, user, password, database);
        if (isset($_GET['bedrijf'])){
            $bedrijf = $_GET['bedrijf'];
        }
        else{
            $bedrijf = "";
        }
        //haal de specifieke data op voor de functie
        $sql = "SELECT t0.bedrijfsnaam, t0.id, t1.Bid, t1.naam, t1.id, t1.email FROM bedrijven t0 LEFT JOIN contactspersoon t1 ON t0.id = t1.Bid WHERE t0.id = '$bedrijf' LIMIT 5";
        ?>
        <div class="AddCPersoon">
        <a href="upload/addcontact.php?Bid=<?php echo $id;?>&amp;bedrijf=<?php echo $bedrijf?>"><i class="fa-solid fa-plus"></i></a>
        </div>
        <?php
        return $res = $link->query($sql);
    }

}


function isAdmin() {
    return $_SESSION['admin'] != 1; 
}

function requireValidUser() {
    if ($_SESSION['loggedin'] !== TRUE) {
        header('Location: login.php');
    } 
}
?>