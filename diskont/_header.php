<?php
    session_start();
    require 'konekcija.php'

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-Diskont</title>
</head>
<body>
    <header>
        <div id="logo"><a href="pocetna.php">E-diskont</a></div>
        <nav>
            <ul>
                <a href="pocetna.php"><li>Početna</li></a>
                <?php
                    // kreiramo promenljivu $sql - promenljiva predstavlja obican string
                    // ali takav da je sadrzaj stringa validan sql upit
                    $sql = "SELECT * FROM vrsta";
                    // pozivamo metod query naseg objekta konekcija,
                    // koji vraca objekat $result sto je rezultat iz baze
                    // o kome mozemo razmisljati kao o tabeli koju inace dobijemo u mySQLAdminu
                    $result = $konekcija->query($sql);
                    // najpre proveravamo broj redova veci od 0, odn da li smo 
                    // dobili neki rezultat iz baze
                    if ($result->num_rows > 0) {
                        // petljom prolazimo kroz tabelu, pozivamo metod fetch_assoc()
                        // za objekat $result - sto nam vraca asocijativni niz
                        // u kome je index elementa zapravo naziv kolone u tabeli
                        while($row = $result->fetch_assoc()) {
                            echo '<a href="pocetna.php?id='.$row['id'].'"><li>'.$row['naziv'].'</li></a>';
                        }
                    } else {
                        echo "Nema rezultata";
                    }
                ?>
            </ul>
            <form class="pretraga" action="diskont/pretraga.php" method="POST">
                <input type="text" name="pretraga">
                <button type="submit" value="pretrazi"><img src="diskont/ikonice/lupa.ico" alt="" srcset=""></button>
            </form>
            <ul class="desno">
                
                <?php 


                    if(isset($_SESSION['id']) && $_SESSION['admin'] == 1) {
                        echo '<a href="admin.php"><li>Admin Panel</li></a>';
                        echo '<a href="diskont/odjava.php"><li>Odjava</li></a>';
                    } else if (isset($_SESSION['id'])) {
                        echo '<a href="diskont/odjava.php"><li>Odjava</li></a>';
                    } else {
                        echo '<a href="prijava.php"><li>Prijava</li></a>';
                        echo '<a href="registracija.php"><li>Registracija</li></a>';
                    }
                ?>
                
            </ul>
        </nav>
    </header>
