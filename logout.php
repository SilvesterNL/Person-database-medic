<?php
    require "requires/config.php";
    $_SESSION['online'] = 0;
    $con->query("UPDATE users SET onl = '".$con->real_escape_string($_SESSION['online'])."' WHERE id = ".$_SESSION['id']);
    session_start();
    session_destroy();
    Header("Location:login");
?>