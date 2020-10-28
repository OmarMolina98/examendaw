<?php

    session_start();

    require_once("util.php");

    include("_header.html");

    include("_nuevo.html");
  

    echo(" <div id=\"Zombie\">");

    echo getZombie();

    echo(" </div>");

    include("_footer.html");

  
?>