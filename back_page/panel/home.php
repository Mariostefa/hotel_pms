<?php
    include '../accesses.php';
    // security check
    if(!$_SESSION['logged_in']){
        header("Location: ../login.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Αρχική</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/home.css">
</head>
<body style="background-color: #889bbf;">
<!-- Creates the Navigation Bar and checks if a user has access on some elements of the bar or not  -->
<div class="topnav">
    <a href="home.php" <?php echo isActive('home')  ?>>Αρχική</a>
    <a href="pelates.php" <?php if (!shouldDisplayLink('pelates')) echo ' style="display: none;"' ;    echo isActive('pelates')  ?>> Πελάτες </a>
    <a href="krathseis.php" <?php if (!shouldDisplayLink('krathseis')) echo ' style="display: none;"'; echo isActive('krathseis') ?>> Κρατήσεις </a>
    <a href="upaliloi.php" <?php if (!shouldDisplayLink('upaliloi')) echo ' style="display: none;"' ;    echo isActive('upaliloi')?>> Υπάλληλοι </a>
    <a href="dwmatia.php" <?php if (!shouldDisplayLink('dwmatia')) echo ' style="display: none;"' ;    echo isActive('dwmatia')?>> Δωμάτια </a>
    <a href="uphresies.php" <?php if (!shouldDisplayLink('uphresies')) echo ' style="display: none;"'; echo isActive('uphresies')?>>Υπηρεσίες </a>
    <a href="../logout.php" class="split">Αποσύνδεση</a>
</div>

<!-- displayes some information about the user -->
<div style="padding-left:16px; padding-right:16px">
    <h2 class="intro"> <?php echo "Γεία σου " . $_SESSION['user'] ." ". $_SESSION['epitheto'] ?> </h2> <hr/>
    <h4> <?php echo "Αφμ : " . $_SESSION['afm'] ?></h4>
    <h4> <?php echo "Ονομα : " . $_SESSION['user'] ?></h4>
    <h4> <?php echo "Επιθετο : " . $_SESSION['epitheto'] ?></h4>
    <h4> <?php echo "Unique_Identifier : " . $_SESSION['user_id'] ?></h4>
</div>
</body>
</html>
