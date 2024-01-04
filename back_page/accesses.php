<?php
    session_start();
    include 'db_connection.php';
    
    //gets the rights a user has from the database
    function getRights(){
        global $conne;

        $right = $_SESSION['dikaiwma'] ;
        $query_login = "SELECT prosvasi FROM dikaiwmata WHERE kwdikos = '$right' ";
        $result = mysqli_query($conne , $query_login) ;


        $row= mysqli_fetch_row($result);
        $acces = explode(',', $row[0]);
        return $acces;
    }
        
    //sets the rights on the navbar
    function shouldDisplayLink($userRole) {
        $rights = getRights();

        // If $userRole is a string, convert it to an array for consistency
        $userRoles = is_array($userRole) ? $userRole : [$userRole];

        // Check if any role in $userRoles is present in $rights
        foreach ($userRoles as $role) {
            if (in_array($role, $rights)) {
                return true;
            }
        }
        return false;
    }

    //checks if the current page is the active page
    function isActive($page) {
        $current_page = basename($_SERVER['PHP_SELF'], '.php');
        if ($page == $current_page) {
            // Return additional styles for the active link
            return 'class="active" style="background-color: #3363b6; color: white;"'; // Change color to your preferred style
        } else {
            return '';
        }
    }

?>