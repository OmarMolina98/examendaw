<?php
    session_start();

    require_once("util.php");  

    $_POST["Lugar"] = htmlspecialchars($_POST["Lugar"]);

    echo getIncidentes($_POST["Lugar"]);

?>