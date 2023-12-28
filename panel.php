<?php
    include 'db_connection.php';
    include 'accesses.php';
    

    if($_SESSION['logged_in']){

        $rights = getRights();

        
        function shouldDisplayLink($userRole) {
            global $rights;

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
    }else{
        header("Location: index.php");
        die();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controll Panel</title>
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body style="background-color: #889bbf;">


<div class="topnav">
    <a class="active">Αρχική</a>
    <a href="" <?php if (!shouldDisplayLink('pelates')) echo ' style="visibility: hidden;"' ?>> Πελάτες </a>
    <a href="" <?php if (!shouldDisplayLink('krathseis')) echo ' style="visibility: hidden;"' ?>> Κρατήσεις </a>
    <a href="" <?php if (!shouldDisplayLink('upliloi')) echo ' style="visibility: hidden;"' ?>> Υπάλληλοι </a>
    <a href="" <?php if (!shouldDisplayLink('dwmatia')) echo ' style="visibility: hidden;"' ?>> Δωμάτια </a>
    <a href="" <?php if (!shouldDisplayLink('uphresies')) echo ' style="visibility: hidden;"' ?>>Υπηρεσίες </a>
    <a href="logout.php" class="split">Αποσύνδεση</a>
</div>





<div style="padding-left:16px; padding-right:16px">
    <h2 class="intro"> <?php echo "Γεία σου " . $_SESSION['user'] ." ". $_SESSION['epitheto'] ?> </h2> <hr/>
    <h4> <?php echo "Αφμ : " . $_SESSION['afm'] ?></h4>
    <h4> <?php echo "Ονομα : " . $_SESSION['user'] ?></h4>
    <h4> <?php echo "Επιθετο : " . $_SESSION['epitheto'] ?></h4>
    <h4> <?php echo "Unique_Identifier : " . $_SESSION['user_id'] ?></h4>
</div>
</body>
</html>




