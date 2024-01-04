<?php
session_start();
$_SESSION["bookings_date_picker_value"] = isset($_SESSION["date_picker_value"]) ? $_SESSION["date_picker_value"] : date('Y-m-d');
$_SESSION["drop_down_value"] = isset($_SESSION["drop_down_value"]) ? $_SESSION["drop_down_value"] : "one";
?>

<!DOCTYPE html>
<html lang="el">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Κράτηση</title>

    <style>
        img {
            width: 200px;
        }

        .hidden {
            display: none;
        }
    </style>
    <script src="utilities.js"></script>


</head>

<body>
    <?php
    include("header.html");

    include("database_connection.php");
    define("submition_page", "insert_into_bookings.php");

    if (isset($_POST["search"])) {
        $_SESSION["bookings_date_picker_value"] = $_POST["bookings-date-picker"];
        $_SESSION["drop_down_value"] = $_POST["days-of-stay"];
    }

    $previous_date_selected = $_SESSION["bookings_date_picker_value"];
    $previous_days_of_stay = $_SESSION["drop_down_value"];
    $initial_date = $_SESSION["bookings_date_picker_value"];
    $days_of_stay = $_SESSION["drop_down_value"];
    $final_date = null;

    switch ($days_of_stay) {
        case "one":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 1 days'));
            break;
        case "two":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 2 days'));
            break;
        case "three":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 3 days'));
            break;
        case "four":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 4 days'));
            break;
        case "five":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 5 days'));
            break;
        case "six":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 6 days'));
            break;
        case "seven":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 7 days'));
            break;
        case "eight":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 8 days'));
            break;
        case "nine":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 9 days'));
            break;
        case "ten":
            $final_date = date('Y-m-d', strtotime($initial_date . ' + 10 days'));
            break;
    }

    $query = "SELECT arithmos,arithmos_klinwn, orofos, topothesia,timi, katastash, kathariothta  FROM dwmatio WHERE  arithmos  NOT IN 
    (SELECT dwmatio_fk FROM krathsh WHERE !(hmeromhnia_anaxwrishs < '{$initial_date}' OR hmeromhnia_afikshs > '{$final_date}'))";
    $result = mysqli_query($conn, $query);
    
    ?>

    <div class="booking-check-form">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <label for="bookings-date-selector">Επιλέξτε μια ημερομηνία<label>
                    <input id="bookings-date-selector" type="date" name="bookings-date-picker" min="<?php echo date('Y-m-d'); ?>"
                        value="<?php echo $previous_date_selected; ?>" required>
                    <label for="day-selector">Διαμονή για<label>
                            <select id="day-selector" name="days-of-stay" required>
                                <?php
                                $dayOptions = array(
                                    'one' => '1 Μέρα',
                                    'two' => '2 Μέρες',
                                    'three' => '3 Μέρες',
                                    'four' => '4 Μέρες',
                                    'five' => '5 Μέρες',
                                    'six' => '6 Μέρες',
                                    'seven' => '7 Μέρες',
                                    'eight' => '8 Μέρες',
                                    'nine' => '9 Μέρες',
                                    'ten' => '10 Μέρες'
                                );
                                foreach ($dayOptions as $value => $label) {
                                    $selected = ($value == $previous_days_of_stay) ? 'selected' : '';
                                    echo "<option value=\"$value\" $selected>$label</option>";
                                }
                                ?>
                            </select>
        </form>
        <input type="submit" name="search" value="αναζήτηση">
    </div>
    <?Php

    echo "<div class='rooms-container'>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<form action='bookings.php' onsubmit='roomForm(event)' >";
        echo "<img src='images/rooms/{$row["topothesia"]}.jpg' alt='dwmatio me {$row["topothesia"]}'>";
        echo "<div class='room-discription'>";
        echo "<p>Γενικές πληροφορίες Δωματίου</p>";
        echo "<p>Αριθμός κλεινών: {$row["arithmos_klinwn"]} Όροφος: {$row["orofos"]} Τοποθεσία: {$row["topothesia"]} <span>Τιμή: {$row["timi"]}&euro; </span></p>";
        echo "<input type='hidden' name='room-choosed' value='{$row["arithmos"]}'>";
        echo "<input type='hidden' name='initial-date' value='{$initial_date}'>";
        echo "<input type='hidden' name='final-date' value='{$final_date}'>";
        echo "</div>";
        echo "<input type='submit' name='sub' value='Επιλογή'>";
        echo "</form>";
    }
    echo "</div>";
    
    include("customer_modal.php");
    
    include("footer.html");
    mysqli_close($conn);
    ?>
</body>