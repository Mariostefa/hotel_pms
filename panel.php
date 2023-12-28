<?php
    session_start();
    include 'db_connection.php';
    include 'accesses.php';
    

    if($_SESSION['logged_in']){
        
        echo "call function";
    
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
    <title>Controll Panel</title>
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>

<div class="topnav">

    <a href="#news" >News</a>
    <a class="active" href="#home">Home</a>
    <a href="#contact">Contact</a>
    <a href="#about" class="split">Help</a>
    <a href="logout.php">logout</a>
</div>

<div style="padding-left:16px">
    <h2>Split Navigation Example</h2>
    <p class="intro"> <?php echo "Welcome " . $_SESSION['user'] ?> </p> </br>
</div>
</body>
</html>




