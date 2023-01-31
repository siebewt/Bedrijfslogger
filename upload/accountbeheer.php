<?php 
include '../config/config.php'; 
session_start();
requireValidUser();
$link = mysqli_connect(server, user, password, database);
if(isset($_POST['update'])){
        $id = $_POST['id'];
        $title = $_POST['title'];
        $body = $_POST['body'];
        $db = $_GET['db'];
        $href = $_POST['href'];

        if(empty($title) && empty($body)){
            if (empty($title)){
                echo 'Titel veld is leeg' . "<br>";
            }

            if (empty($body)){
                echo 'Post tekstveld is leeg' . "<br>";
            }
        } else {
            $location = $_GET['location'];
            $stmt = $link->prepare("UPDATE $db SET title = ? ,body = ? WHERE id=$id");
            $stmt->bind_param("ss", $title, $body);
            $stmt->execute();

            header("Location: $location");
        }
    }
    $id = $_GET['id'];
$result = mysqli_query($link, "SELECT * FROM gebruikers WHERE id=$id");
while($row = mysqli_fetch_array($result))
{
    $username = $row['username'];
    $id = $row['id'];
}
?>

<section class="post-section">
        <h1>Bewerk post</h1>

        <form class="form1" name="form" method="post">
        <div class="project-container">

            <p>Gebruikersnaam: </p><input type="text" name="title" id="title" value="<?php echo $username;?>"></p>
            <input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td><br><br>
            <a href="projecten_crud.php" class="login-button">Terug</a>
            <input class="login-button" type="submit" name="update" value="Update"></td>
        </div>

        </form>
        <form name="delete" action="../delete.php?id=<?php echo $id;?>&amp;table=gebruikers&amp;location=account.php" method="post" >
            <input class="login-button" type="submit" name="update" value="Delete"></td>

        </form>
    </section>