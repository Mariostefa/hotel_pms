<?php

include '../../accesses.php';

if (!$_SESSION['logged_in']) {
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

if (isset($_POST["submit"])) {

    $afm = $_POST["afm"];
    $service_id = $_POST["service-id"];
    $service_use_date = $_POST["service-use-date"];
    $service_price = $_POST["price"];
    $date_of_transaction = $_POST["date-of-transaction"];
    $state_of_transaction = $_POST["state-of-transaction"];
    $payment_method = $_POST["payment-method"];
    



    $query = "INSERT INTO xrhsh_yphresias VALUES ('$afm','$service_id','$service_use_date','$service_price','$date_of_transaction','$state_of_transaction','$payment_method')";
    $result = mysqli_query($conne, $query);
    if ($result) {
        header('location: ../uphresies.php');
    } else {
        echo "ERROR WRONG INPUTS!";
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

    <div class="form">
        <form method="post">
            <h1>Εισαγωγή νέας υπηρεσίας</h1>
            <label for="afm">ΑΦΜ</label>
            <input id="afm" name="afm" type="text" minlength="9" maxlength="9">
            <label for="service-id">ΚΩΔ. ΥΠΗΡΕΣΙΑΣ</label>
            <input id="service-id" name="service-id" type="text">
            <label for="service-use-date">ΗΜ. ΧΡΗΣΗΣ ΥΠΗΡΕΣΙΑΣ</label>
            <input id="service-use-date" name="service-use-date" type="datetime-local" step="any">
            <label for="price">ΠΟΣΟ</label>
            <input id="price" name="price" type="number" step="0.01">
            <label for="date-of-transaction">ΗΜ. ΣΥΝΑΛΛΑΓΗΣ</label>
            <input id="date-of-transaction" name="date-of-transaction" type="datetime-local" step="any">
            <label for="state-of-transaction">ΚΑΤΑΣΤΑΣΗ ΣΥΝΑΛΛΑΓΗΣ</label>
            <select id="state-of-transaction" name="state-of-transaction">
                <option value="ACCEPTED">ACCEPTED</option>
                <option value="PENDING">PENDING</option>
            </select>
            <label for="payment-method">ΤΡΟΠΟΣ ΠΛΗΡΩΜΗΣ</label>
            <select id="payment-method" name="payment-method">
                <option value="CASH">CASH</option>
                <option value="CARD">CARD</option>
            </select>
            <input type="submit" name="submit" value="Εισαγωγή">
        </form>
    </div>





    <body>