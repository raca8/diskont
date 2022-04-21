<?php
    require 'diskont/_header.php';

    $greska = "";
    $email = "";
    if (isset($_GET["greska"])) {
        if ($_GET["greska"] == "prazno") {
            $greska = "Molimo popunite sva polja";
        } else if ($_GET["greska"] == "email") {
            $greska = "Ne postoji korisnik sa unetim email-om";
        } else if ($_GET["greska"] == "lozinka") {
            $greska = "Lozinka je nepravilno uneta";
        }
    }
    //     } else if ($_GET["greska"] == "ime") {
    //         $greska = "Nepravilan unos imena, u imenu nisu dozvoljeni specijalni karakteri";
    //     } else if ($_GET["greska"] == "email") {
    //         $greska = "Nepravilan unos emaila";
    //         $ime = $_GET["ime"];
    //     } else if ($_GET["greska"] == "duzina") {
    //         $greska = "Lozinka mora sadrzati bar 8 karaktera";
    //         $ime = $_GET["ime"];
    //         $email = $_GET["email"];
    //     } else if ($_GET["greska"] == "sifra") {
    //         $greska = "Lozinke se ne poklapaju";
    //         $ime = $_GET["ime"];
    //         $email = $_GET["email"];
    //     } else if ($_GET["greska"] == "zauzeto") {
    //         $greska = "Korisnički nalog sa unetim email-om već postoji";
    //         $ime = $_GET["ime"];
    //     }

    // }
?>

<main>
    <form action="diskont/proveraPrijave.php" method="POST">
        <p id="greska"> <?php echo $greska ?></p>
        <p>Email:</p>
        <input type="text" name="email" value="<?php echo $email?>">
        <p>Unesite lozinku:</p>
        <input type="password" name="lozinka">
        
        <br><br>
        <input type="submit" value="Potvrdi">
    </form>
</main>

</body>
</html>