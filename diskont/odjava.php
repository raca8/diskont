<?php

    session_start();
    session_unset();
    // Super globalna $_SESSION je asocijativni niz koji sadrzi
    // elemente koje smo dodelili tokom prijave
    // session_unset prakticno super globalnu $_SESSION pretvara u prazan niz
    session_destroy();
     // session_unset potpuno uklanja super globalnu $_SESSION
    header("Location: ../pocetna.php");

?>