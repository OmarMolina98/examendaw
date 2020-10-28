<?php

  session_start();

  require_once("util.php");  

  $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);

  $_POST["EstadoActual"] = htmlspecialchars($_POST["EstadoActual"]);


  if(isset($_POST["Nombre"],$_POST["EstadoActual"])) {
      
      if (insertarIncidente($_POST["Nombre"],$_POST["EstadoActual"])){
          
         
      } 
      else {
          
        
      }
  }

  header("location:index.php");
?>