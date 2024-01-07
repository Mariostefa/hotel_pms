<?php
session_start();
include("timezone.php");
include("user_session_variables.php");
$_SESSION["services_date_picker_value"] = isset($_SESSION["services_date_picker_value"]) ? $_SESSION["services_date_picker_value"] : date('Y-m-d');
$_SESSION["services_drop_down_value"] = isset($_SESSION["services_drop_down_value"]) ? $_SESSION["services_drop_down_value"] : "eight";
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
    include("timezone.php");
    include("database_connection.php");
    define("submition_page", "insert_into_services.php");


    if (isset($_POST["choose-datetime"])) {
        $_SESSION["services_date_picker_value"] = $_POST["services-date-picker"];
        $_SESSION["services_drop_down_value"] = $_POST["hour-choosed"];
    }

    $date = $_SESSION["services_date_picker_value"];
    $hour_choosed = $_SESSION["services_drop_down_value"];
    $date_and_time = null;




    switch ($hour_choosed) {
        case "eight":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 08:00:00'));
            break;
        case "nine":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 09:00:00'));
            break;
        case "ten":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 10:00:00'));
            break;
        case "eleven":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 11:00:00'));
            break;
        case "twelve":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 12:00:00'));
            break;
        case "thirteen":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 13:00:00'));
            break;
        case "fourteen":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 14:00:00'));
            break;
        case "fifteen":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 15:00:00'));
            break;
        case "sixteen":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 16:00:00'));
            break;
        case "seventeen":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 17:00:00'));
            break;
        case "eighteen":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 18:00:00'));
            break;
        case "nineteen":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 19:00:00'));
            break;
        case "twenty":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 20:00:00'));
            break;
        case "twenty-one":
            $date_and_time = date('Y-m-d H:i:s', strtotime($date . ' 21:00:00'));
            break;
    }

    echo $date_and_time
        ?>

    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
        <label for="date">Επιλέξτε ημερομηνία:<label>
                <input type="date" id="date" name="services-date-picker" value="<?php echo $_SESSION["services_date_picker_value"]; ?>" min="<?php echo date('Y-m-d'); ?>">
                <label for="hour-selector">Επιλέξτε ώρα<label>
                        <select id="hour-choosed" name="hour-choosed" required>
                            <?php
                            $hourOptions = array(
                                'eight' => '8:00',
                                'nine' => '9:00',
                                'ten' => '10:00',
                                'eleven' => '11:00',
                                'twelve' => '12:00',
                                'thirteen' => '13:00',
                                'fourteen' => '14:00',
                                'fifteen' => '15:00',
                                'sixteen' => '16:00',
                                'seventeen' => '17:00',
                                'eighteen' => '18:00',
                                'nineteen' => '19:00',
                                'twenty' => '20:00',
                                'Twenty-one' => '21:00'

                            );
                            foreach ($hourOptions as $value => $label) {
                                $selected = ($value == $_SESSION["services_drop_down_value"]) ? 'selected' : '';
                                echo "<option value=\"$value\" $selected>$label</option>";
                            }
                            ?>
                        </select>
                        <input type="submit" value="Επιλογή" name="choose-datetime">
    </form>



    <?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
    $query = "SELECT * FROM yphresia";
    $result = mysqli_query($conn, $query);

    

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<form action='services.php' method='post' onsubmit='serviceForm(event)' >";
        echo "<div class='service-item'>";
        echo "<img src='images/services/{$row["onoma"]}.jpg' alt='Εικόνα υπηρίσας {$row["onoma"]}'>";
        echo "<p>{$row["onoma"]} Τιμή:<span>{$row["timi"]}&euro; </span></p>";
        echo "</div>";
        echo "<input type='hidden' name='service-selected' value='{$row["kwdikos"]}'>";
        echo "<input type='hidden' name='service-date-time' value='{$date_and_time}'>";
        echo "<input type='submit' name='choose' value='Επιλογή'>";
        echo "</form>";
    }


    
}
    include("customer_modal.php");
    include("footer.html");
    ?>
</body>