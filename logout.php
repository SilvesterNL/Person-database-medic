<?php
    $_SESSION['online'] = false;
    session_start();
    session_destroy();
    Header("Location:login");
?>