<?php
include '../../accesses.php';

if(!$_SESSION['logged_in']){
    header("Location: ../../login.php");
    die();
}
include('../../db_connection.php');

$afm = substr($_GET["deleteid"],0,9);
$service_id = substr($_GET["deleteid"],10,4);
$service_use_date = substr($_GET["deleteid"],15);


if(isset($_GET["deleteid"])){
    $id = $_GET["deleteid"];
    $query = "DELETE FROM  xrhsh_yphresias WHERE pelatis_fk='$afm' AND yphresia_fk='$service_id' AND hm_yphresias='$service_use_date'";
    $result = mysqli_query($conne, $query);
    if($result){
        header("location: ../uphresies.php");
    }

}



?>