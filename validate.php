<?php
include 'config/config.php';
    $link = mysqli_connect(server, user, password, database);
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $sql = "SELECT id, username, password FROM gebruikers WhERE username = '$username'";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $query="SELECT * FROM gebruikers WHERE username = '$username'";

    $res2 = mysqli_query($link, $query);

    if(mysqli_num_rows($result) > 0 ){

        $row = mysqli_fetch_assoc($res2);
        $user_id =  $row['id'];

       $_SESSION["user_id"] = $user_id;

        echo $user_id;
    }
?>