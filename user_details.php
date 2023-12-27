<?php
    
    session_start();    
    include 'db_connection.php';


    function details ($id){
        
        $data = request_data($id);


        $_SESSION['afm'] = $data[3];          
        $_SESSION['user_id'] = $id;
        $_SESSION['logged_in'] = true;
        

        header("Location: panel.php");
    }

    $retunred = details(15);

    function request_data($id){
        
        global $conne;

        $query_login = "SELECT * FROM stoixia_sundeshs WHERE kwdikos = $id ";
        $result = mysqli_query($conne , $query_login) ;
        $row= mysqli_fetch_row($result);

        return $row;

    }

?>