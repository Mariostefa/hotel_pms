<?php

include '../../accesses.php';

if(!$_SESSION['logged_in']){
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

if(isset($_POST["submit"])){

    $room_id = $_POST["service-id"];
    $room_space = $_POST["service-name"];
    $floor = $_POST["service-price"];
    $location =  $_POST["service-availability"];
    $price = 
    $state =
    $cleanliness = 

    $query = "INSERT INTO yphresia VALUES ('$service_id','$service_name','$service_price','$service_availability')";
    $result = mysqli_query($conne, $query);
    if($result){
        header('location: ../uphresies.php');
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Υπηρεσίες</title>
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/uphresies.css">
</head>

<body>

    <div class="topnav">
        <a href="../home.php" <?php echo isActive('home') ?>>Αρχική</a>
        <a href="../pelates.php" <?php if (!shouldDisplayLink('pelates'))
            echo ' style="display: none;"';
        echo isActive('pelates') ?>> Πελάτες </a>
        <a href="../krathseis.php" <?php if (!shouldDisplayLink('krathseis'))
            echo ' style="display: none;"';
        echo isActive('krathseis') ?>> Κρατήσεις </a>
        <a href="../upliloi.php" <?php if (!shouldDisplayLink('upaliloi'))
            echo ' style="display: none;"';
        echo isActive('upaliloi') ?>> Υπάλληλοι </a>
        <a href="../dwmatia.php" <?php if (!shouldDisplayLink('dwmatia'))
            echo ' style="display: none;"';
        echo isActive('dwmatia') ?>> Δωμάτια </a>
        <a href="../uphresies.php" <?php if (!shouldDisplayLink('uphresies'))
            echo ' style="display: none;"';
        echo isActive('uphresies') ?>>Υπηρεσίες </a>
        <a href="../logout.php" class="split">Αποσύνδεση</a>
    </div>

    <div class="form">
        <form method="post" >
            <h1>Εισαγωγή νεου δωματίου</h1>
            <label for="room-id">Αριθμός</label>
            <input id="room-id" name="room-id" type="text" minlength="1" maxlength="1">
            <label for="room-space">Αριθμός κλινών</label>
            <select id="room-space"  name="room-space">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <label for="floor">Όροφος</label>
            <select id="floor"  name="floor">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            <label for="location">Τοποθεσία</label>
            <select id="location"  name="location">
                <option value="Thea Sth Thalassa">Θέα στη Θάλασσα</option>
                <option value="Xwris mpalokoni">Χωρίς βεράντα</option>
                <option value="Me veranda">Με βεράντα</option>
                <option value="Me mpalkoni">Με μπαλκόνι</option>
                <option value="Xwris mpalokoni">Χωρις μπαλκόνι</option>
            </select>
            <label for="price">Τιμή</label>
            <input type="number" id="price"  name="price" step step="0.01">
            <input id="service-price" name="service-price" type="number" step="0.01">
            <label for="state" name="state">Κατάσταση</label>
            <select>
                <option value="AVAILABLE">Διαθέσιμο</option>
                <option value="UNAVAILABLE">Μη Διαθέσιμο</option>
            <select>
            <label for="cleanliness" >Καθαριότητα</label>
            <select id="cleanliness" name="cleanliness">
                <option value="CLEAN">Καθαρό</option>
                <option value="DIRTY">Βρώμικο</option>
            <select>
            <input type="submit" name="submit" value="Εισαγωγή">

        </form>
    </div>





<body>