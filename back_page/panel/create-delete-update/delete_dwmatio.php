<?php
include '../../accesses.php';

if(!$_SESSION['logged_in']){
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

if(isset($_GET["deleteid"])){
    $id = $_GET["deleteid"];
    $query = "DELETE FROM dwmatio WHERE arithmos='{$id}'";
    $result = mysqli_query($conne, $query);
    if($result){
        header('location: ../dwmatia.php');
    }
}



?>