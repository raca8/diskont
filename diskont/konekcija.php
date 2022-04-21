<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "diskont_pica";

    // Kreiramo konekciju između nasih php skripti i baze podataka
    // $konekcija je promenljiva koja je objekat klase mysqli i na ovom
    // mestu je kreiramo pozivajuci konstruktor, kome prosledjujemo
    // promenljive koje smo gore naveli
    $konekcija = new mysqli($servername, $username, $password, $dbname);

    // Proveravamo da li je konekcija uspela, ukoliko nije
    // prikazujemo gresku (connect_error svojstvo klase mysqli)
    if ($konekcija->connect_error) {
        die("Konekcija nije uspela: " . $konekcija->connect_error);
    } 
?>