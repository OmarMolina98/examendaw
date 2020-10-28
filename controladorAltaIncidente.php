<?php

  session_start();

  require_once("util.php");  

  $_POST["Lugares"] = htmlspecialchars($_POST["Lugares"]);

  $_POST["IncidenteTipo"] = htmlspecialchars($_POST["IncidenteTipo"]);


  if(isset($_POST["Lugares"],$_POST["IncidenteTipo"])) {
      
      if (insertarIncidente($_POST["Lugares"],$_POST["IncidenteTipo"])){
          
          $_SESSION["mensaje"] = "Se agrego una nuevo incidente de seguridad";
      } 
      else {
          
          $_SESSION["warning"] = "Ocurrió un error al agregar una nuevo incidente de seguridad";
      }
  }

  header("location:index.php");
?>