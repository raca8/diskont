<?php
    require 'konekcija.php';


    $naziv = $_POST["naziv"];
    $cena = $_POST["cena"];
    $vrsta = $_POST["vrsta"];
    $zapremina = $_POST["zapremina"];
    $slika = "blabla";

    $slika = $imeSlike = $imeSlikeTmp = $velicinaSlike = $greskaSlika = $tipSlike = '';
   
    if ($_FILES['slika']['size'] > 0) {
        $slika = $_FILES['slika'];

        $imeSlike= $_FILES['slika']['name'];
        $imeSlikeTmp= $_FILES['slika']['tmp_name'];
        $velicinaSlike = $_FILES['slika']['size'];
        $greskaSlika = $_FILES['slika']['error'];
        $tipSlike = $_FILES['slika']['type'];

        $ekstSlike = explode('.', $imeSlike);
        $ekstenzija = $ekstSlike[count($ekstSlike) - 1];
        $dozvoljeneEkst = ['png','PNG','jpg','JPG','jpeg','JPEG'];
        if (in_array($ekstenzija, $dozvoljeneEkst)) {
            if ($velicinaSlike < 1000000) {
                $novoImeSlike = uniqid('',true).".".$ekstenzija;
                $destinacijaSlike = 'slike/'.$novoImeSlike;
                move_uploaded_file($imeSlikeTmp,$destinacijaSlike);
            } else {
                echo "Slika je prevelika";
            }
        } else {
            echo "Tip datoteke nije odgovarajuci";
        }
    } 

    print_r($slika);
    if (isset($_GET['id'])) {
        if ($_FILES['slika']['size'] > 0) {
            $sql = "UPDATE pice 
            SET naziv = '$naziv', 
                cena = $cena, 
                id_vrste = $vrsta, 
                id_zapremine = $zapremina,
                slika = '$novoImeSlike'
            WHERE id =".$_GET['id'];
        } else {
            $sql = "UPDATE pice 
            SET naziv = '$naziv', 
                cena = $cena, 
                id_vrste = $vrsta, 
                id_zapremine = $zapremina 
            WHERE id =".$_GET['id'];
        }
    } else {
        $sql = "INSERT INTO pice(naziv,cena,id_vrste,id_zapremine, slika)
        VALUES ('$naziv', $cena, $vrsta, $zapremina, '$novoImeSlike')";
    }

    mysqli_query($konekcija,$sql);
   
    header("Location: ../admin.php")

?>