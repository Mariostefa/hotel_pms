<?php

$service_price;
$service_choosed;
$date_and_time;
$currentDateTime = date('Y-m-d H:i:s');

if(isset($_POST["send-customer-form"])){
    if (isset($_COOKIE["service"]) && isset($_COOKIE["date-and-time"])) {
        $service_choosed = $_COOKIE["service"];
        $date_and_time =  $_COOKIE["date-and-time"];
    }

    $query = "SELECT timi FROM yphresia WHERE kwdikos='{$service_choosed}'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $price = $row["timi"];

    if ($payment_method == "CARD") {
        $query = "INSERT INTO xrhsh_yphresias VALUES('{$afm}','{$service_choosed}','{$date_and_time}',
                 '{$price}','{$currentDateTime}','ACCEPTED','CARD')";
        mysqli_query($conn, $query);
    } else {
        $query = "INSERT INTO krathsh VALUES('{$afm}','{$service_choosed}','{$date_and_time}',
                 '{$price}','{$currentDateTime}','PENDING','CASH')";
        mysqli_query($conn, $query);
    }

mysqli_close($conn);
header("location: services.php");

}



?>