<?php
    ini_set("session.hash_function","sha512");
    session_start();

    ini_set("max_execution_time",500);


    
    $db_hosti = "www02.planetnode.net";
    $db_useri = "axrdxmta_ambu";
    $db_passi = "mtt44c2h";
    $db_datai = "axrdxmta_ambu";

    $con = new mysqli($db_hosti,$db_useri,$db_passi,$db_datai);
?>