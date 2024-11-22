<?php
session_start();
include "dbConn.php";

// Pretpostavljamo da korisnikova uloga postoji u sesiji (admin ili user)
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;

// Postavljanje ID-a za uređivanje
$edit_id_sisanje = isset($_GET['edit_sisanje']) ? $_GET['edit_sisanje'] : null;
$edit_id_brijanje = isset($_GET['edit_brijanje']) ? $_GET['edit_brijanje'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible=IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Rezervacije</title>
    <script>
        // Funkcija za potvrdu brisanja
        function confirmDelete(url) {
            if (confirm("Jeste li sigurni da želite obrisati odabrani redak?")) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <h1 style="color:white;">Rezervacija šišanja</h1>
    <table border="2">
        <tr>
            <td>Datum rezervacije</td>
            <td>Vrijeme rezervacije</td>
            <?php if ($role === 'admin') { ?>
            <td>Ime</td>
            <td>Prezime</td>
            <td>Kontakt</td>
            <td>Uredi</td>
            <td>Obriši</td>
            <?php } ?>
        </tr>

        <?php
        $records = mysqli_query($db, "SELECT * FROM rezervacije_sisanje");

        while ($data = mysqli_fetch_array($records)) {
            // Formatiranje datuma i vremena u PHP-u
            $formatted_date = date("d/m/Y", strtotime($data['Datum_rezervacije']));
            $formatted_time = date("H:i", strtotime($data['Vrijeme_rezervacije']));
        ?>
        <tr>
            <?php if ($role === 'admin' && $edit_id_sisanje == $data['ID']) { ?>
                <!-- Formular za uređivanje šišanja -->
                <form method="POST" action="">
                    <td><input type="date" name="Datum_rezervacije" value="<?php echo date("Y-m-d", strtotime($data['Datum_rezervacije'])); ?>"></td>
                    <td><input type="time" name="Vrijeme_rezervacije" value="<?php echo date("H:i", strtotime($data['Vrijeme_rezervacije'])); ?>"></td>
                    <td><input type="text" name="Ime_korisnika" value="<?php echo $data['Ime_korisnika']; ?>"></td>
                    <td><input type="text" name="Prezime_korisnika" value="<?php echo $data['Prezime_korisnika']; ?>"></td>
                    <td><input type="text" name="Kontakt_broj" value="<?php echo $data['Kontakt_broj']; ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
                        <button type="submit" name="update_sisanje">Spremi</button>
                    </td>
                    <td><a href="dashboard.php">Odustani</a></td>
                </form>
            <?php } else { ?>
                <!-- Prikaz podataka šišanja -->
                <td><?php echo $formatted_date; ?></td>
                <td><?php echo $formatted_time; ?></td>
                <?php if ($role === 'admin') { ?>
                <td><?php echo $data['Ime_korisnika']; ?></td>
                <td><?php echo $data['Prezime_korisnika']; ?></td>
                <td><?php echo $data['Kontakt_broj']; ?></td>
                <td><a href="?edit_sisanje=<?php echo $data['ID']; ?>">Edit</a></td>
                <td><a href="#" onclick="confirmDelete('delete.php?id=<?php echo $data['ID']; ?>')">Obriši</a></td>
                <?php } ?>
            <?php } ?>
        </tr>
        <?php
        }

        if (isset($_POST['update_sisanje'])) {
            $id = $_POST['id'];
            $Datum_rezervacije = $_POST['Datum_rezervacije'];
            $Vrijeme_rezervacije = $_POST['Vrijeme_rezervacije'];
            $Ime_korisnika = $_POST['Ime_korisnika'];
            $Prezime_korisnika = $_POST['Prezime_korisnika'];
            $Kontakt_broj = $_POST['Kontakt_broj'];

            $updateQuery = "UPDATE rezervacije_sisanje 
                            SET Datum_rezervacije='$Datum_rezervacije', Vrijeme_rezervacije='$Vrijeme_rezervacije',
                                Ime_korisnika='$Ime_korisnika', Prezime_korisnika='$Prezime_korisnika',
                                Kontakt_broj='$Kontakt_broj'
                            WHERE ID='$id'";

            mysqli_query($db, $updateQuery) or die(mysqli_error($db));
            header("Location: dashboard.php");
            exit;
        }
        ?>
    </table>

    <h1 style="color:white;">Rezervacije brijanja</h1>
    <table border="2">
        <tr>
            <td>Datum rezervacije</td>
            <td>Vrijeme rezervacije</td>
            <?php if ($role === 'admin') { ?>
            <td>Ime</td>
            <td>Prezime</td>
            <td>Kontakt</td>
            <td>Uredi</td>
            <td>Obriši</td>
            <?php } ?>
        </tr>

        <?php
        $records = mysqli_query($db, "SELECT * FROM rezervacije_brijanje");

        while ($data = mysqli_fetch_array($records)) {
            $formatted_date = date("d/m/Y", strtotime($data['Datum_rezervacije']));
            $formatted_time = date("H:i", strtotime($data['Vrijeme_rezervacije']));
        ?>
        <tr>
            <?php if ($role === 'admin' && $edit_id_brijanje == $data['ID']) { ?>
                <!-- Formular za uređivanje brijanja -->
                <form method="POST" action="">
                    <td><input type="date" name="Datum_rezervacije" value="<?php echo date("Y-m-d", strtotime($data['Datum_rezervacije'])); ?>"></td>
                    <td><input type="time" name="Vrijeme_rezervacije" value="<?php echo date("H:i", strtotime($data['Vrijeme_rezervacije'])); ?>"></td>
                    <td><input type="text" name="Ime_korisnika" value="<?php echo $data['Ime_korisnika']; ?>"></td>
                    <td><input type="text" name="Prezime_korisnika" value="<?php echo $data['Prezime_korisnika']; ?>"></td>
                    <td><input type="text" name="Kontakt_broj" value="<?php echo $data['Kontakt_broj']; ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $data['ID']; ?>">
                        <button type="submit" name="update_brijanje">Spremi</button>
                    </td>
                    <td><a href="dashboard.php">Odustani</a></td>
                </form>
            <?php } else { ?>
                <!-- Prikaz podataka brijanja -->
                <td><?php echo $formatted_date; ?></td>
                <td><?php echo $formatted_time; ?></td>
                <?php if ($role === 'admin') { ?>
                <td><?php echo $data['Ime_korisnika']; ?></td>
                <td><?php echo $data['Prezime_korisnika']; ?></td>
                <td><?php echo $data['Kontakt_broj']; ?></td>
                <td><a href="?edit_brijanje=<?php echo $data['ID']; ?>">Edit</a></td>
                <td><a href="#" onclick="confirmDelete('delete1.php?id=<?php echo $data['ID']; ?>')">Obriši</a></td>
                <?php } ?>
            <?php } ?>
        </tr>
        <?php
        }

        if (isset($_POST['update_brijanje'])) {
            $id = $_POST['id'];
            $Datum_rezervacije = $_POST['Datum_rezervacije'];
            $Vrijeme_rezervacije = $_POST['Vrijeme_rezervacije'];
            $Ime_korisnika = $_POST['Ime_korisnika'];
            $Prezime_korisnika = $_POST['Prezime_korisnika'];
            $Kontakt_broj = $_POST['Kontakt_broj'];

            $updateQuery = "UPDATE rezervacije_brijanje 
                            SET Datum_rezervacije='$Datum_rezervacije', Vrijeme_rezervacije='$Vrijeme_rezervacije',
                                Ime_korisnika='$Ime_korisnika', Prezime_korisnika='$Prezime_korisnika',
                                Kontakt_broj='$Kontakt_broj'
                            WHERE ID='$id'";

            mysqli_query($db, $updateQuery) or die(mysqli_error($db));
            header("Location: dashboard.php");
            exit;
        }
        ?>
    </table>
</body>
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
                <li><a href="logout.php">ODJAVA</a></li>
  
            </ul>
          </div>
        </div>
      </div>
    </div>
    </div>
    
</html>
