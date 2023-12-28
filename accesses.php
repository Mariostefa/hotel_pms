<?php
    session_start();
    include 'db_connection.php';
    
    function getRights(){
        global $conne;

        $right = $_SESSION['dikaiwma'] ;
        $query_login = "SELECT prosvasi FROM dikaiwmata WHERE kwdikos = '$right' ";
        $result = mysqli_query($conne , $query_login) ;


        $row= mysqli_fetch_row($result);
        $acces = explode(',', $row[0]);
        return $acces;
    }
?>