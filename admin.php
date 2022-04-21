<?php
    require 'diskont/_header.php';
    if (isset($_SESSION['id'])) {
        if ($_SESSION['admin'] != 1) {
           header ("Location: pocetna.php");
        }
    } else {
        header ("Location: pocetna.php");
    }
  
  
    // proveravmo da li postoji superglobalna $_GET 
    // odn. da li dobijamo neke parametre preko URL-a
    // ako dobijamo neke parametre to znaci da je rec o izmeni postojeceg artikla
    // u suprotnom nema izmene

    $naziv = '';
    $cena = '';
    $vrsta = 0;
    $zapremina = 0;

    if (isset($_GET['id'])) {
        $sql = "SELECT * FROM pice WHERE id =".$_GET['id'] ;
        $result = $konekcija->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $naziv = $row['naziv'];
                $cena = $row['cena'];
                $vrsta = $row['id_vrste'];
                $zapremina = $row['id_zapremine'];
            }
        } else {
            echo "Nema rezultata";
        }
    }
?>
 <main>

<?php

    if(isset($_GET['id'])) {
        echo '<form class="unos-pica" 
                    action="diskont/unosPica.php?id='.$_GET['id'].'" 
                    method="POST"
                    enctype="multipart/form-data">
              <h2>Izmena prozvoda</h2><hr>';
    } else {
        echo '<form class="unos-pica" 
                    action="diskont/unosPica.php" 
                    method="POST"
                    enctype="multipart/form-data">
              <h2>Unos prozvoda</h2><hr>';
    } 
?>
        
        <p>Unesite naziv pića:</p>
        <input type="text" name="naziv" value="<?php echo $naziv?>">
        <p>Unesite cenu pića:</p>
        <input type="text" name="cena" value="<?php echo $cena?>">
        <p>Izaberite vrstu:</p>
        <select name="vrsta" id="">
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
                        if ($vrsta == $row['id']) {
                            echo '<option value='.$row['id'].' selected>'.$row['naziv'].'</option>';
                        } else {
                            echo '<option value='.$row['id'].'>'.$row['naziv'].'</option>';
                        }
                       
                    }
                } else {
                    echo "Nema rezultata";
                }
            ?>
        </select>
        <p>Izaberite zapreminu:</p>
        <select name="zapremina" id="">
            <?php
                $sql = "SELECT * FROM zapremina";

                $result = $konekcija->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        if ($zapremina == $row['id']) {
                            echo '<option value='.$row['id'].' selected>'.$row['kolicina'].'</option>';
                        } else {
                            echo '<option value='.$row['id'].'>'.$row['kolicina'].'</option>';
                        }
                        
                    }
                } else {
                    echo "Nema rezultata";
                }
            ?>
        </select>
        <p>Dodajte sliku:</p>
        <input type="file" name="slika"><br><br>
        <input type="submit" value="Potvrdi">
    </form>

        <div id="tabele">
            <table id="karta-pica">
                <caption><h2>Karta pica</h2><hr></caption>
                <thead>
                    <tr>
                        <th>br.</th>
                        <th>Naziv</th>
                        <th>Cena</th>
                        <th>Vrsta</th>
                        <th>Zapremina</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT pice.id, pice.naziv, pice.cena, vrsta.naziv AS vrsta, 
                                    zapremina.kolicina AS zapremina
                                FROM pice
                                INNER JOIN vrsta on pice.id_vrste = vrsta.id 
                                INNER JOIN zapremina on pice.id_zapremine = zapremina.id";
                        
                        $result = $konekcija->query($sql);
                    
                        $brojac = 1;
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>
                                        <td>'.$brojac++.'</td>
                                        <td>'.$row['naziv'].'</td>
                                        <td>'.$row['cena'].' din.</td>
                                        <td>'.$row['vrsta'].'</td>
                                        <td>'.$row['zapremina'].' <i>l</i></td>
                                        <td><a class="izmena" onclick="unosProizvoda()" href="admin.php?id='.$row['id'].'">Izmeni</a></td>
                                        <td><a class="brisanje" href="diskont/brisanje.php?id='.$row['id'].'">Obrisi</a></td>
                                    </tr>';
                            }
                        } else {
                            echo "<div id='karta-pica'>Nema rezultata</div>";
                        }
                    ?>
                </tbody>
            </table>


            <table id="porudzbine">
                <caption><h2>Porudzbine u toku</h2><hr></caption>
                <thead>
                    <tr>
                        <th>br.</th>
                        <th>Ime klijenta</th>
                        <th>Email klijenta</th>
                        <th>Naziv pica</th>
                        <th>Cena</th>
                        <th>Vrsta</th>
                        <th>Zapremina</th>
                        <th>Kolicina</th>
                        <th>Ukupno</th>
                        
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sql = "SELECT klijent.korisnicko_ime, klijent.email, 
                                pice.naziv AS 'naziv pica', pice.cena, 
                                zapremina.kolicina AS zapremina, 
                                vrsta.naziv AS vrsta, porudzbina.kolicina 
                            FROM klijent
                            INNER JOIN porudzbina ON porudzbina.id_klijenta = klijent.id
                            INNER JOIN pice ON porudzbina.id_pica = pice.id
                            INNER JOIN vrsta ON pice.id_vrste = vrsta.id
                            INNER JOIN zapremina ON pice.id_zapremine = zapremina.id";
                    
                    $result = $konekcija->query($sql);
                
                    $brojac = 1;
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '<tr>
                                    <td>'.$brojac++.'</td>
                                    <td>'.$row['korisnicko_ime'].'</td>
                                    <td>'.$row['email'].'</td>
                                    <td>'.$row['naziv pica'].'</td>
                                    <td>'.$row['cena'].' din. </td>
                                    <td>'.$row['vrsta'].'</td>
                                    <td>'.$row['zapremina'].' <i>l</i></td>
                                    <td>'.$row['kolicina'].'</td>
                                    <td>'.$row['kolicina'] * $row['cena'].' din.</td>
                                </tr>';
                        }
                    } else {
                        echo "<div id='porudzbine'>Nema rezultata</div>";
                    }
                ?>
                </tbody>
            </table>


        </div>
    </main>
</body>
</html>