<?php

include '../../accesses.php';

if(!$_SESSION['logged_in']){
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

$updateid = $_GET["updateid"];

$query = "SELECT * FROM yphresia WHERE kwdikos = '$updateid'";
$result = mysqli_query($conne, $query);
$row = mysqli_fetch_assoc($result);

if(isset($_POST["submit"])){
    $service_id = $_POST["service-id"];
    $service_name = $_POST["service-name"];
    $service_price = $_POST["service-price"];
    $service_availability =  $_POST["service-availability"];

    $query = "UPDATE yphresia SET kwdikos='{$service_id}',onoma='{$service_name}',timi='{$service_price}',diathesimotita='{$service_availability}' WHERE kwdikos='{$updateid}'";
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
    <link rel="stylesheet" href="../../css/uphresies-dwmatia.css">
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
        <a href="../upaliloi.php" <?php if (!shouldDisplayLink('upaliloi'))
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

    <h1>Επεξεργασία υπηρεσίας</h1>

    <div class="form">
        <form method="post" >


            
            <label for="service-id">ΚΩΔΙΚΟΣ (Μέχρι 4 χαρακτήρες)</label>
            <input id="service-id" name="service-id" type="text" minlength="4" maxlength="4" value=<?php echo $row["kwdikos"] ?>>
            <label for="service-name">ΟΝΟΜΑ</label>
            <input id="service-name" name="service-name" type="text" value=<?php echo $row["onoma"] ?>>
            <label for="service-price">TIMH: </label>
            <input id="service-price" name="service-price" type="number" step="0.01" value=<?php echo $row["timi"] ?>>
            <label for="service-availability">ΔΙΑΘΕΣΙΜΟΤΗΤΑ:</label>
            <input id="service-availability" name="service-availability" type="text" value=<?php echo $row["diathesimotita"] ?>>
            <input type="submit" name="submit" value="Εισαγωγή">
        </form>
    </div>





<body>