<?php
    session_start();
    include 'db_connection.php';
    

    if($_SESSION['logged_in']){

        echo "Welcome " . $_SESSION['user']. "</br>"; 
    
    }else{
        header("Location: index.php");
        die();
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
</head>
<body>
<a href='logout.php'> Log out  </a>
</body>
</html>




