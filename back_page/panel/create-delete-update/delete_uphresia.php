<?php
include '../../accesses.php';

if(!$_SESSION['logged_in']){
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

if(isset($_GET["deleteid"])){
    $id = $_GET["deleteid"];
    $query = "DELETE FROM  yphresia WHERE kwdikos='{$id}'";
    $result = mysqli_query($conne, $query);
    if($result){
        header('location: ../uphresies.php');
    }

}

?>