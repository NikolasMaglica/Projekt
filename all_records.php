<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Cjenik usluga</title>
</head>
<body>
 
<h1 style="color:white;">Rezervacije šišanja</h1>
<table border="2">
  <tr>
    <td>ID</td>
    <td>Ime</td>
    <td>Prezime</td>
    <td>Datum rezervacije</td>
    <td>Vrijeme rezervacije</td>
    <td>Kontakt</td>  
     <td>Uredi</td>
     <td>Obriši</td>
  </tr>

<?php

include "dbConn.php"; 

$records = mysqli_query($db,"select * from rezervacije_sisanje");

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['ID']; ?></td>
    <td><?php echo $data['Ime_korisnika']; ?></td>
    <td><?php echo $data['Prezime_korisnika']; ?></td>    
      
   
    <td><?php echo $data['Datum_rezervacije']; ?></td>
    <td><?php echo $data['Vrijeme_rezervacije']; ?></td> 
      
          <td><?php echo $data['Kontakt_broj']; ?></td>

      
          <td><a href="edit.php?id=<?php echo $data['ID']; ?>">Edit</a></td>
    <td><a href="delete.php?id=<?php echo $data['ID']; ?>">Delete</a></td>
  
  </tr>	
<?php
}
?>
</table>
            
<h1 style="color:white;">Rezervacije brijanja</h1>

<table border="2">
  <tr>
    <td>ID</td>
    <td>Ime</td>
    <td>Prezime</td>
         <td>Datum rezervacije</td>
    <td>Vrijeme rezervacije</td>
    <td>Kontakt</td> 
     
        <td>Uredi</td>
     <td>Obriši</td>

  </tr>

<?php

include "dbConn.php"; // Using database connection file here

$records = mysqli_query($db,"select * from rezervacije_brijanje"); // fetch data from database

while($data = mysqli_fetch_array($records))
{
?>
  <tr>
    <td><?php echo $data['ID']; ?></td>
    <td><?php echo $data['Ime_korisnika']; ?></td>
    <td><?php echo $data['Prezime_korisnika']; ?></td>    
      
   
    <td><?php echo $data['Datum_rezervacije']; ?></td>
    <td><?php echo $data['Vrijeme_rezervacije']; ?></td> 
      
          <td><?php echo $data['Kontakt_broj']; ?></td>

      
          <td><a href="edit1.php?id=<?php echo $data['ID']; ?>">Edit</a></td>
    <td><a href="delete1.php?id=<?php echo $data['ID']; ?>">Delete</a></td>
  
  </tr>	
<?php
}
?>
</table>
    
    
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
                <li><a href="logout.php">Odjava</a></li>
  
            </ul>
          </div>
        </div>
      </div>
    </div>
  
    
  </body>
  </html>
