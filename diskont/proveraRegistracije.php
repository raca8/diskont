<?php
    require "konekcija.php";

    $ime = $_POST["ime"];
    $email = $_POST["email"];
    $loz1 = $_POST["loz1"];
    $loz2 = $_POST["loz2"];

    if(empty($ime) || empty($email) || empty($loz1) || empty($loz2)) {
        header("Location: ../registracija.php?greska=prazno");
    } else if (!preg_match("/^[a-zA-Z0-9]*$/", $ime)) {
        header("Location: ../registracija.php?greska=ime");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../registracija.php?greska=email&ime=$ime");
    } else if (strlen($loz1) < 8) {
        header("Location: ../registracija.php?greska=duzina&ime=$ime&email=$email");
    } else if ($loz1 !== $loz2) {
        header("Location: ../registracija.php?greska=sifra&ime=$ime&email=$email");
    } else {
        $sql = "SELECT * FROM klijent WHERE email='$email'";
        $result = $konekcija->query($sql);
        if ($result->num_rows > 0) {
            header("Location: ../registracija.php?greska=zauzeto&ime=$ime");
        } else {
            $sql = "INSERT INTO klijent (korisnicko_ime, email, sifra, je_admin)
                    VALUES (?,?,?,0);";
            $stmt = mysqli_stmt_init($konekcija);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../registracija.php?greska=svi");
            } else {
                mysqli_stmt_bind_param($stmt, "sss", $ime, $email, $loz1);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                header("Location: ../pocetna.php?registracija=true");
            }
        }
    }


?>