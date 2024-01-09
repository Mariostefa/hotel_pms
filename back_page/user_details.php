<?php
    session_start();    
    include 'db_connection.php';

    // sets the user status as logged in and request some information
    function details ($id){
        
        $_SESSION['logged_in'] = true;

        //request a function that retrieves the afm for the session
        $pr_key_yp = request_data($id , 0);
        
        $_SESSION['afm'] = $pr_key_yp[3];          
        $_SESSION['user_id'] = $id;

        //request a faction that retrieves some personal information and rights on the web services
        //next move , needs to check on what rights exactly has.
        $info_yp = request_data($id ,1);

        $_SESSION['user'] = $info_yp[1] ;
        $_SESSION['epitheto'] = $info_yp[2];
        $_SESSION['dikaiwma'] = $info_yp[9];

        //Redirects on panel.php
        header("Location: panel/home.php");
        die();
    }

    //retrives sthe afm of the user and the unique_code from table stoixia_sundeshs
    function request_data($id , $unique){
        
        global $conne;
        if($unique == 0){
            $query_login = "SELECT * FROM stoixia_sundeshs WHERE kwdikos = $id ";
            $result = mysqli_query($conne , $query_login) ;
            $row= mysqli_fetch_row($result);        
        }
        else{
            $afm = $_SESSION['afm'];
            $query_login = "SELECT * FROM ypallhlos WHERE  afm = $afm ";
            $result = mysqli_query($conne , $query_login) ;
            $row= mysqli_fetch_row($result);    
        }

        return $row;
    }
?>