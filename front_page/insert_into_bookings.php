<?php


$price;
$room_choosed;
$initial_date;
$final_date;
$currentDateTime = date('Y-m-d H:i:s');


if (isset($_POST["send-customer-form"])) {
    if (isset($_COOKIE["room"]) && isset($_COOKIE["initial-date"]) && isset($_COOKIE["final-date"])) {
        $room_choosed = $_COOKIE["room"];
        $initial_date = $_COOKIE["initial-date"];
        $final_date = $_COOKIE["final-date"];
    }

    $query = "SELECT timi FROM dwmatio WHERE arithmos='{$room_choosed}'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $price = $row["timi"];

    if ($payment_method == "CARD") {
        $query = "INSERT INTO krathsh VALUES('{$room_choosed}','{$afm}','{$initial_date}',
                 '{$final_date}','ACCEPTED','{$price}','{$currentDateTime}','ACCEPTED','CARD')";
        mysqli_query($conn, $query);
    } else {
        $query = "INSERT INTO krathsh VALUES('{$room_choosed}','{$afm}','{$initial_date}',
                 '{$final_date}','PENDING','{$price}','{$currentDateTime}','PENDING','CASH')";
        mysqli_query($conn, $query);
    }

}

mysqli_close($conn);
header("location: bookings.php");

?>