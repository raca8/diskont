<?php
      require 'konekcija.php';

      $id = $_GET['id'];
      echo $id;
  
      $sql = "DELETE FROM pice WHERE id=".$id;
      mysqli_query($konekcija,$sql);
  
      header("Location: ../admin.php");
?>