<?php 
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    die(); 
}
include 'config/config.php';
$link = mysqli_connect(server, user, password, database);
//error_reporting(0);

if (isset($_POST['submit'])){
    $link = mysqli_connect(server, user, password, database);
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $sql = "SELECT id, username, password, admin FROM gebruikers WHERE username = '$username'";
    $stmt = $link->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $query="SELECT * FROM gebruikers WHERE username = '$username'";

    $res2 = mysqli_query($link, $query);

    if(mysqli_num_rows($result) > 0 ){

        $row = mysqli_fetch_assoc($res2);
        $user_id =  $row['id'];

       $_SESSION["user_id"] = $user_id;
    }

    if($row && password_verify($password, $row['password'])){
        session_start();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['username'] = $row['username'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['admin'] = $row['admin'];
        echo $_SESSION['username'];
        echo "<script>
        alert('Admin inlog succesvol!');
        window.location.href='./index.php';
        </script>";
    } else{
        echo "<p style='color: red; font-weight: bold; font-size: 20px;'>Onjuiste gegevens</p>";
    }
} else {

}


?>
<body>
<div class="all-content">
        <nav class="nav-bar">
            <h1 class="title_login">Bedrijfslogger</h1>
        </nav>
        <h1 class="page-title">Login</h1>
        <div class="container">
            <form method="POST" class="center" action="" method="post">
                <div class="form-floating mb-3" id="loginform">
                Username<label for="floatingInput"></label>
                        <input type="text" name="username" class="form-control" id="floatingInput"  placeholder="" autofocus>
                        <?php if (!empty($loginErrors['Name'])) { ?>
                            <div class="alert alert-danger"><?= $loginErrors['Name']; ?></div>
                        <?php } ?>
                </div>
                <div class="form-floating mb-3"id="loginform">
                    Password<label for="floatingInput"></label>
                            <input type="password" name="password" class="form-control" id="floatingInput"  placeholder="">
                            <?php if (!empty($loginErrors['Password'])) { ?>
                                <div class="alert alert-danger"><?= $loginErrors['Password']; ?></div>
                            <?php } ?>
                            <?php if (!empty($loginErrors['WrongPass'])) : ?>
                                <div class="alert alert-danger"><?= $loginErrors['WrongPass']; ?></div>
                            <?php  endif; ?>
                        <input type="submit" name="submit" id="submit" value="Login">
                </div>
            </form> 
        </div>
    </div>
</body>