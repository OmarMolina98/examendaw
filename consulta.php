<?php
    session_start();

    require_once("util.php");  

    $_POST["Nombre"] = htmlspecialchars($_POST["Nombre"]);

    echo getZombie($_POST["Nombre"]);

?>