<?php

    session_start();
    require_once("util.php");
    include("Partials/General/_head.html");
  
    include("Partials/ConsultaIncidentes/_titulo.html");

    include("Partials/General/_fedback.html");


            echo(" <div id=\"resultadoIncidentes\">");

                echo getIncidentes();

            echo(" </div>");

    include("Partials/General/_endPage.html");
?>