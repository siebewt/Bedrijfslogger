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
        /**delete.php?id=<?php echo $row['id'];?>&amp;table=contactspersoon&amp;location=index.php*/
    }
    function get_delete() {
        return $this->delete;
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