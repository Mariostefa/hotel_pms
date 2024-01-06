<?php

include '../../accesses.php';

if (!$_SESSION['logged_in']) {
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

$updateid = $_GET["updateid"];

$query = "SELECT * FROM dwmatio WHERE arithmos='$updateid'";
$result = mysqli_query($conne, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST["submit"])) {
    $room_id = $_POST["room-id"];
    $room_space = $_POST["room-space"];
    $floor = $_POST["floor"];
    $location = $_POST["location"];
    $price = $_POST["price"];
    $state = $_POST["state"];
    $cleanliness = $_POST["cleanliness"];

    $query = "UPDATE dwmatio SET arithmos='$room_id', arithmos_klinwn='$room_space', orofos='$floor', topothesia='$location', timi='$price', katastash='$state', kathariothta='$cleanliness' WHERE arithmos='$updateid'";
    $result = mysqli_query($conne, $query);
    if ($result) {
        header('location: ../dwmatia.php');
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
            <h1>Εισαγωγή δωματίου</h1>
            <label for="room-id">Αριθμός</label>
            <input id="room-id" name="room-id" type="text" minlength="1" maxlength="2" value="<?php echo $row["arithmos"] ?>">
            <label for="room-space">Αριθμός κλινών</label>
            <select id="room-space" name="room-space">
                <?php
                $room_space_option = array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5'
                );
                foreach ($room_space_option as $value => $label) {
                    $selected = ($value == $row["arithmos_klinwn"]) ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
            </select>
            <label for="floor">Όροφος</label>
            <select id="floor" name="floor">
                <?php
                $floor_option = array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                );
                foreach ($floor_option as $value => $label) {
                    $selected = ($value == $row["orofos"]) ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
            </select>
            <label for="location">Τοποθεσία</label>
            <select id="location" name="location">
                <?php
                $location_option = array(
                    'Thea Sth Thalassa' => 'Θέα στη Θάλασσα',
                    'Xwris veranda' => 'Χωρίς βεράντα',
                    'Me veranda' => 'Με βεράντα',
                    'Me mpalkoni' => 'Με μπαλκόνι',
                    'Xwris mpalokoni' => 'Χωρις μπαλκόνι'
                );
                foreach ($location_option as $value => $label) {
                    $selected = ($value == $row["topothesia"]) ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
            </select>
            <label for="price">Τιμή</label>
            <input type="number" id="price" name="price" step="0.01" value="<?php echo $row["timi"] ?>">
            <label for="state" name="state">Κατάσταση</label>
            <select id="state" name="state">
                <?php
                $state_option = array(
                    'AVAILABLE' => 'Διαθέσιμο',
                    'UNAVAILABLE' => 'Μη Διαθέσιμο',
                );
                foreach ($state_option as $value => $label) {
                    $selected = ($value == $row["katastash"]) ? 'selected' : '';
                    echo "<option value=\"$value\" $selected>$label</option>";
                }
                ?>
                <select>
                    <label for="cleanliness">Καθαριότητα</label>
                    <select id="cleanliness" name="cleanliness">
                        <?php
                        $cleanliness_option = array(
                            'CLEAN' => 'Καθαρό',
                            'DIRTY' => 'Βρώμικο',
                        );
                        foreach ($cleanliness_option as $value => $label) {
                            $selected = ($value == $row["kathariothta"]) ? 'selected' : '';
                            echo "<option value=\"$value\" $selected>$label</option>";
                        }
                        ?>
                        <select>
                            <input type="submit" name="submit" value="Αλλαγή">

        </form>
    </div>





    <body>