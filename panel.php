<?php
    session_start();
    include 'db_connection.php';
    include 'index.php';


    

    if($_SESSION['logged_in']){

        echo "Welcome " . $_SESSION['username']. "</br>"; 
        echo "<a href='logout.php'> Log out  </a>";
    }else{
        header("Location: index.php");
        session_destroy();
    }
    
?>




