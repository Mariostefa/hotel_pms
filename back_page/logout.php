<?php
    //ends the session and redirects you on the login page
    session_start();
    session_destroy();
    header("Location: login.php");

?>