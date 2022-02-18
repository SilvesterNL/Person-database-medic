<?php
    ini_set("session.hash_function","sha512");
    session_start();

    ini_set("max_execution_time",500);


    
    $db_hosti = "web01.hostvalues.net";
    $db_useri = "silveste_meos";
    $db_passi = "jekankermoeder";
    $db_datai = "silveste_meos";

    $con = new mysqli($db_hosti,$db_useri,$db_passi,$db_datai);
?>