<?php

    session_start();
    require "konekcija.php";

    $id_pica = $_GET['id'];
    $id_klijenta = $_SESSION['id'];
    $kolicina = $_POST['kolicina'];

    $sql = "INSERT INTO porudzbina(id_pica,id_klijenta,kolicina)
    VALUES ($id_pica, $id_klijenta, $kolicina)";

    mysqli_query($konekcija,$sql);

    header("Location: ../pocetna.php?dodato=true")





?>