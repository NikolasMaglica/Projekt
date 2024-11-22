<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <meta charset="utf-8"/>
    <title>Registracija</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php'); 
    
    if (isset($_REQUEST['username'])) {
        // Priprema podataka
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        
        $hashed_password = md5($password);
        
        $role = 'user';
        
        $query = "INSERT INTO `users` (username, password, email, role)
                  VALUES ('$username', '$hashed_password', '$email', '$role')";
        
        $result = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>Uspješno ste registrirani s rolom 'user'!</h3><br/>
                  <p class='link'>Kliknite ovdje za <a href='login.php'>prijavu</a>.</p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Došlo je do greške prilikom registracije.</h3><br/>
                  <p class='link'>Pokušajte ponovo <a href='register.php'>registrirati se</a>.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" method="post" name="register">
        <h1 class="login-title">Registracija</h1>
        <input type="text" class="login-input" name="username" placeholder="Korisničko ime" required />
        <input type="email" class="login-input" name="email" placeholder="Email" required />
        <input type="password" class="login-input" name="password" placeholder="Lozinka" required />
        <input type="submit" name="submit" value="Registriraj se" class="login-button"/>
        <p class="link">Već imate račun? <a href="login.php">Prijavite se ovdje</a>.</p>
    </form>
<?php
    }
?>
  <div class="menu-wrap">
      <input type="checkbox" class="toggler">
      <div class="hamburger"><div></div></div>
      <div class="menu">
        <div>
          <div>
            <ul>
              <li><a href="index.html">POČETNA STRANICA</a></li>
              <li><a href="onama.html">O NAMA</a></li>
              <li><a href="cjenik.html">CJENIK USLUGA</a></li>
              <li><a href="galerija.html">GALERIJA ZADOVOLJNIH KORISNIKA</a></li>
              <li><a href="kontakt.html">KONTAKT</a></li>
              <li><a href="rezervacije.php">REZERVACIJE</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    
</body>
</html>
