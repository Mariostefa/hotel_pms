<?php

include '../../accesses.php';

if (!$_SESSION['logged_in']) {
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

$afm_update = substr($_GET["updateid"],0,9);
$service_update = substr($_GET["updateid"],10,4);
$service_use_date_update = substr($_GET["updateid"],15);

$query = "SELECT * FROM xrhsh_yphresias WHERE pelatis_fk='$afm_update' AND yphresia_fk='$service_update' AND hm_yphresias='$service_use_date_update'";
$result = mysqli_query($conne, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {

    $afm = $_POST["afm"];
    $service_id = $_POST["service-id"];
    $service_use_date = $_POST["service-use-date"];
    $service_price = $_POST["price"];
    $date_of_transaction = $_POST["date-of-transaction"];
    $state_of_transaction = $_POST["state-of-transaction"];
    $payment_method = $_POST["payment-method"];

    $query = "UPDATE xrhsh_yphresias SET pelatis_fk='$afm' ,yphresia_fk='$service_id' , hm_yphresias='$service_use_date' 
            , poso='$service_price' , hmerominia_synallaghs='$date_of_transaction' , katastash_synallaghs='$state_of_transaction' 
            , tropos_plhrwmhs='$payment_method' WHERE pelatis_fk= '$afm_update' AND yphresia_fk='$service_update ' AND hm_yphresias='$service_use_date_update'";
    $result = mysqli_query($conne, $query);
    if ($result) {
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
        <form method="post">
            <h1>Εισαγωγή νέας υπηρεσίας</h1>
            <label for="afm">ΑΦΜ</label>
            <input id="afm" name="afm" type="text" minlength="9" maxlength="9" value="<?php echo $row["pelatis_fk"] ?>">
            <label for="service-id">ΚΩΔ. ΥΠΗΡΕΣΙΑΣ</label>
            <input id="service-id" name="service-id" type="text" value="<?php echo $row["yphresia_fk"] ?>">
            <label for="service-use-date">ΗΜ. ΧΡΗΣΗΣ ΥΠΗΡΕΣΙΑΣ</label>
            <input id="service-use-date" name="service-use-date" type="datetime-local" step="any" value="<?php echo $row["hm_yphresias"] ?>">
            <label for="price">ΠΟΣΟ</label>
            <input id="price" name="price" type="number" step="0.01" value="<?php echo $row["poso"] ?>">
            <label for="date-of-transaction">ΗΜ. ΣΥΝΑΛΛΑΓΗΣ</label>
            <input id="date-of-transaction" name="date-of-transaction" type="datetime-local" step="any" value="<?php echo $row["hmerominia_synallaghs"] ?>">
            <label for="state-of-transaction">ΚΑΤΑΣΤΑΣΗ ΣΥΝΑΛΛΑΓΗΣ</label>
            <select id="state-of-transaction" name="state-of-transaction">
            <?php
                $state_of_transaction_option = array(
                    'ACCEPTED' => 'ACCEPTED',
                    'PENDING' => 'PENDING',
                );
                foreach ($state_of_transaction_option as $value => $label) {
                    $selected = ($value == $row["orofos"]) ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
            </select>
            <label for="payment-method">ΤΡΟΠΟΣ ΠΛΗΡΩΜΗΣ</label>
            <select id="payment-method" name="payment-method">
            <?php
                $payment_method_option = array(
                    'CASH' => 'CASH',
                    'CARD' => 'CARD',
                );
                foreach ($payment_method_option as $value => $label) {
                    $selected = ($value == $row["orofos"]) ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Αλλαγή">
        </form>
    </div>





    <body>