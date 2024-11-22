<?php
// Pokretanje sesije
session_start();

// Povezivanje s bazom podataka
include "dbConn.php";

// Varijabla za poruke korisniku
$message = "";

// Obrada forme za rezervacije šišanja
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_sisanje'])) {
    $ime = mysqli_real_escape_string($db, $_POST['Ime_korisnika']);
    $prezime = mysqli_real_escape_string($db, $_POST['Prezime_korisnika']);
    $datum = mysqli_real_escape_string($db, $_POST['Datum_rezervacije']);
    $vrijeme = mysqli_real_escape_string($db, $_POST['Vrijeme_rezervacije']);
    $kontakt = mysqli_real_escape_string($db, $_POST['Kontakt_broj']);

    // Validacija
    if (empty($ime) || empty($prezime) || empty($datum) || empty($vrijeme) || empty($kontakt)) {
        $message = "Sva polja za rezervaciju šišanja moraju biti popunjena!";
    } else {
        // Unos u tablicu rezervacije_sisanje
        $sql = "INSERT INTO rezervacije_sisanje (Ime_korisnika, Prezime_korisnika, Datum_rezervacije, Vrijeme_rezervacije, Kontakt_broj)
                VALUES ('$ime', '$prezime', '$datum', '$vrijeme', '$kontakt')";
        if (mysqli_query($db, $sql)) {
            $message = "Rezervacija šišanja uspješno unesena!";
        } else {
            $message = "Greška prilikom unosa rezervacije šišanja: " . mysqli_error($db);
        }
    }
}

// Obrada forme za rezervacije brijanja
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_brijanje'])) {
    $ime = mysqli_real_escape_string($db, $_POST['Ime_korisnika']);
    $prezime = mysqli_real_escape_string($db, $_POST['Prezime_korisnika']);
    $datum = mysqli_real_escape_string($db, $_POST['Datum_rezervacije']);
    $vrijeme = mysqli_real_escape_string($db, $_POST['Vrijeme_rezervacije']);
    $kontakt = mysqli_real_escape_string($db, $_POST['Kontakt_broj']);

    // Validacija
    if (empty($ime) || empty($prezime) || empty($datum) || empty($vrijeme) || empty($kontakt)) {
        $message = "Sva polja za rezervaciju brijanja moraju biti popunjena!";
    } else {
        // Unos u tablicu rezervacije_brijanje
        $sql = "INSERT INTO rezervacije_brijanje (Ime_korisnika, Prezime_korisnika, Datum_rezervacije, Vrijeme_rezervacije, Kontakt_broj)
                VALUES ('$ime', '$prezime', '$datum', '$vrijeme', '$kontakt')";
        if (mysqli_query($db, $sql)) {
            $message = "Rezervacija brijanja uspješno unesena!";
        } else {
            $message = "Greška prilikom unosa rezervacije brijanja: " . mysqli_error($db);
        }
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
    <title>Rezervacije</title>
</head>
<body>
<?php if (!empty($message)): ?>
    <div style="color: white; padding: 10px; border-radius: 5px; text-align: center;">
        <p><?php echo $message; ?></p>
    </div>
<?php endif; ?>


    <div class="rezer">
        <div class="konjina">
            <h1>Rezervacije šišanja</h1>
            <form method="post" action="">
                <legend>Podaci za rezervacije</legend>
                <label for="Ime_korisnika">Ime</label>
                <input type="text" name="Ime_korisnika" class="urpInput"><br><br>
                <label for="Prezime_korisnika">Prezime</label>
                <input type="text" name="Prezime_korisnika" class="urpInput"><br><br>
                <label for="Datum_rezervacije">Datum rezervacije</label>
                <input type="date" name="Datum_rezervacije" class="urpInput"><br><br>
                <label for="Vrijeme_rezervacije">Vrijeme od</label>
                <input type="time" name="Vrijeme_rezervacije" class="urpInput"><br><br>
                <label for="Kontakt_broj">Kontakt broj</label>
                <input type="tel" name="Kontakt_broj"><br><br>
                <input type="submit" name="save_sisanje" value="Unesi" class="prvw">
            </form>
        </div>

        <div class="konj">
            <h1>Rezervacije brijanja</h1>
            <form method="post" action="">
                <legend>Podaci za rezervacije</legend>
                <label for="Ime_korisnika">Ime</label>
                <input type="text" name="Ime_korisnika" class="urpInput"><br><br>
                <label for="Prezime_korisnika">Prezime</label>
                <input type="text" name="Prezime_korisnika" class="urpInput"><br><br>
                <label for="Datum_rezervacije">Datum rezervacije</label>
                <input type="date" name="Datum_rezervacije" class="urpInput"><br><br>
                <label for="Vrijeme_rezervacije">Vrijeme od</label>
                <input type="time" name="Vrijeme_rezervacije" class="urpInput"><br><br>
                <label for="Kontakt_broj">Kontakt broj</label>
                <input type="tel" name="Kontakt_broj"><br><br>
                <input type="submit" name="save_brijanje" value="Unesi" class="prvw">
            </form>
        </div>
    </div>
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
  
</body>
</html>
