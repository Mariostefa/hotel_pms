<?php
    include '../accesses.php';

    if(!$_SESSION['logged_in']){
        header("Location: ../index.php");
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

<div class="topnav">
    <a href="home.php" <?php echo isActive('home') ?>>Αρχική</a>
    <a href="pelates.php" <?php if (!shouldDisplayLink('pelates')) echo ' style="visibility: hidden;"' ;    echo isActive('pelates')  ?>> Πελάτες </a>
    <a href="krathseis.php" <?php if (!shouldDisplayLink('krathseis')) echo ' style="visibility: hidden;"'; echo isActive('krathseis') ?>> Κρατήσεις </a>
    <a href="upliloi.php" <?php if (!shouldDisplayLink('upliloi')) echo ' style="visibility: hidden;"' ;    echo isActive('upaliloi')?>> Υπάλληλοι </a>
    <a href="dwmatia.php" <?php if (!shouldDisplayLink('dwmatia')) echo ' style="visibility: hidden;"' ;    echo isActive('dwmatia')?>> Δωμάτια </a>
    <a href="uphresies.php" <?php if (!shouldDisplayLink('uphresies')) echo ' style="visibility: hidden;"'; echo isActive('uphresies')?>>Υπηρεσίες </a>
    <a href="../logout.php" class="split">Αποσύνδεση</a>
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
