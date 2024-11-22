<?php
require('db.php');
session_start();

if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);
    $username = mysqli_real_escape_string($con, $username);
    $password = stripslashes($_REQUEST['password']);
    $password = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
    $result = mysqli_query($con, $query) or die(mysqli_error($con));

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);

        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = "Prijava nije uspješna. Pokušajte ponovno.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="style.css">
    <title>Prijava</title>
</head>
<body>
    <div class="menu-wrap">
        <input type="checkbox" class="toggler">
        <div class="hamburger"><div></div></div>
        <div class="menu">
            <div>
                <div>
                    <ul>
                        <li><a href="onama.html">O NAMA</a></li>
                        <li><a href="cjenik.html">CJENIK USLUGA</a></li>
                        <li><a href="galerija.html">GALERIJA ZADOVOLJNIH KORISNIKA</a></li>
                        <li><a href="kontakt.html">KONTAKT</a></li>
                        <li><a href="rezervacije.php">REZERVACIJE</a></li>
                        <li><a href="login.php">PRIJAVA</a></li>
						            <li><a href="register.php">REGISTRACIJA</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <form class="form" method="post" name="login">
            <h1 class="login-title">Prijavi se</h1>
            <?php
            if (isset($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
            <input type="text" class="login-input" name="username" placeholder="Korisničko ime" required autofocus>
            <input type="password" class="login-input" name="password" placeholder="Lozinka" required>
            <input type="submit" value="Prijava" name="submit" class="login-button">
        </form>
    </div>
</body>
</html>
