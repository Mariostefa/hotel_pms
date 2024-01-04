<?php
session_start();

include("database_connection.php");
include("timezone.php");


$page_of_submition = $_POST["submition-page"];
$afm = $_POST["afm"];
$first_name = $_POST["fname"];
$second_name = $_POST["lname"];
$email = empty($_POST["email"]) ? null : $_POST["email"];
$phone = $_POST["phone"];
$sex = $_POST["sex"];
$date_of_birth = $_POST["bdate"];
$payment_method = $_POST["payment"];



    if(empty($_SESSION["afm"])){
        $_SESSION["afm"] = $afm;
        $_SESSION["first-name"] = $first_name;
        $_SESSION["last-name"] = $second_name;
        $_SESSION["email"] = $email;  
        $_SESSION["phone"] = $phone;
        $_SESSION["sex"] = $sex;
        $_SESSION["date-of-birth"] = date("Y-m-d", strtotime($date_of_birth)) ;
    }



    $query = "SELECT afm FROM pelaths WHERE afm='{$afm}'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    if ($row == null) {
        $query = "INSERT INTO pelaths VALUES('{$afm}','{$first_name}','{$second_name}'
        ,'{$sex}','{$email}','{$phone}','{$date_of_birth}')";
        mysqli_query($conn, $query);
    }


    if($page_of_submition == "insert_into_bookings.php"){
        include("insert_into_bookings.php");
    } 
    else if($page_of_submition == "insert_into_services.php"){
        include("insert_into_services.php");
    }