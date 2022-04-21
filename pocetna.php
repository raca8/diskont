<?php
   
    require 'diskont/_header.php'
?>

<main>
    <?php
        // ukoliko je korisnik dodao u korpu neki proizvod
        // i ta akcija je izvrsena uspesno (vidi diskont/porudzbina.php)
        if(isset($_GET['dodato'])) {
            echo '<script>
                    alert("Proizvod je narucen");
                 </script>';
            
        }
        
        // ako je postavljen id atribut unutar URL-a, onda biramo samo 
        // pica koja su te vrste(sa tim id-jem)
        if (isset($_GET['id'])) {
            // kreiramo promenljivu $sql - promenljiva predstavlja obican string
            // ali takav da je sadrzaj stringa validan sql upit
            $sql = "SELECT * FROM pice WHERE id_vrste=".$_GET['id'];
        } else {
            $sql = "SELECT * FROM pice";
        }

        // ukoliko je postavljen parametar rute 'pretraga' onda..
        if(isset($_GET['pretraga'])) {
            // kreiramo promenljivu pretraga na osnovu vrednosti parametra u ruti
            $pretraga = $_GET['pretraga'];
            // menjamo sql upit tako da biramo samo one proizvode koji sadrze
            // unutar naziva termin pretrage
            $sql = "SELECT * FROM pice WHERE naziv LIKE '%$pretraga%'";
        }

        // ako je postavljen parametar rute 'registracija', to znaci da
        // se neko uspesno registrovao i alertujemo poruku o tome
        if (isset($_GET['registracija'])) {
            echo "<script> alert('Uspešna registracija!') </script>";
        }


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
                // ispis koji sledi prakticno predstavlja 'template' jedne kartice sa picem
                echo '<div class="kartica">
                        <img src="diskont/slike/'.$row['slika'].'">
                        <h4>'.$row['naziv'].'</h4>
                        <h3>'.$row['cena'].'<sup><small>.00</small></sup> din.</h3>';
                if (isset($_SESSION['id'])) {
                    echo '<form action="diskont/porudzbina.php?id='.$row['id'].'" method="POST">
                            <input type="number" name="kolicina" 
                                   value="1" min="1" max="100">
                            <button type="submit" value="naruci"><img src="diskont/ikonice/korpa24.png"></button>
                          </form>';
                }
                echo '</div>';
                      
            }
        } else {
            echo "Nema rezultata";
        }

    
    
    ?>
</main>

</body>
</html>