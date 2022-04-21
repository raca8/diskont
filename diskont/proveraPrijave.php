<?php
    session_start();
    require "konekcija.php";

    $email = $_POST["email"];
    $lozinka = $_POST["lozinka"];

    if(empty($email) || empty($lozinka)) {
        header("Location: ../prijava.php?greska=prazno");
    } else {
        $sql = "SELECT * FROM klijent WHERE email = '$email';";
        $result = mysqli_query($konekcija, $sql);
        if ($result->num_rows > 0) {
                
            while($row = $result->fetch_assoc()) {
                if($lozinka != $row['sifra']) {
                    header("Location: ../prijava.php?greska=lozinka");
                }
                else {
                     $_SESSION['id'] = $row['id'];
                     $_SESSION['ime'] = $row['korisnicko_ime'];
                     $_SESSION['admin'] = $row['je_admin'];
                     header("Location: ../pocetna.php");
                }            
            }
        } else {
            header("Location: ../prijava.php?greska=email");
        }
    }
    
    
    
    // else if (!preg_match("/^[a-zA-Z0-9]*$/", $ime)) {
    //     header("Location: ../prijava.php?greska=ime");
    // } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     header("Location: ../prijava.php?greska=email&ime=$ime");
    // } else if (strlen($loz1) < 8) {
    //     header("Location: ../prijava.php?greska=duzina&ime=$ime&email=$email");
    // } else if ($loz1 !== $loz2) {
    //     header("Location: ../prijava.php?greska=sifra&ime=$ime&email=$email");
    // } else {
    //     $sql = "SELECT * FROM klijent WHERE email='$email'";
    //     $result = $konekcija->query($sql);
    //     if ($result->num_rows > 0) {
    //         header("Location: ../prijava.php?greska=zauzeto&ime=$ime");
    //     } else {
    //         $sql = "INSERT INTO klijent (korisnicko_ime, email, sifra)
    //                 VALUES (?,?,?);";
    //         $stmt = mysqli_stmt_init($konekcija);
    //         if (!mysqli_stmt_prepare($stmt, $sql)) {
    //             header("Location: ../prijava.php?greska=svi");
    //         } else {
    //             mysqli_stmt_bind_param($stmt, "sss", $ime, $email, $loz1);
    //             mysqli_stmt_execute($stmt);
    //             mysqli_stmt_store_result($stmt);
    //             header("Location: ../pocetna.php?prijava=true");
    //         }
    //     }
    // }


?>