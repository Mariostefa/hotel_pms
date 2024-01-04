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
    <title>Πελάτες</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/pelates.css">
</head>
<body style="background-color: #889bbf;">

<div class="topnav">
    <a href="home.php" <?php echo isActive('home')  ?>>Αρχική</a>
    <a href="pelates.php" <?php if (!shouldDisplayLink('pelates')) echo ' style="display: none;"' ; echo isActive('pelates')  ?>> Πελάτες </a>
    <a href="krathseis.php" <?php if (!shouldDisplayLink('krathseis')) echo ' style="display: none;"' ; echo isActive('krathseis') ?>> Κρατήσεις </a>
    <a href="upliloi.php" <?php if (!shouldDisplayLink('upliloi')) echo ' style="display: none;"' ; echo isActive('upaliloi')?>> Υπάλληλοι </a>
    <a href="dwmatia.php" <?php if (!shouldDisplayLink('dwmatia')) echo ' style="display: none;"' ; echo isActive('dwmatia')?>> Δωμάτια </a>
    <a href="uphresies.php" <?php if (!shouldDisplayLink('uphresies')) echo ' style="display: none;"' ; echo isActive('uphresies')?>>Υπηρεσίες </a>
    <a href="../logout.php" class="split">Αποσύνδεση</a>
</div>


<div style="padding-left:16px; padding-right:16px">

<h1> Πελάτες</h1>


<table border="0" cellspacing="3" cellpadding="4">
  <tr>
    <th>No</th>
    <th>ΑΦΜ</th>
    <th>ΟΝΟΜΑ</th>
    <th>ΕΠΙΘΕΤΟ</th>
    <th>ΦΥΛΟ</th>
    <th>EMAIL</th>
    <th>ΤΗΛΕΦΩΝΟ</th>
    <th>ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ</th>
  </tr>

<?php 
    include '../db_connection.php';
    
    $query = "select * from pelaths";
    $queryResult= mysqli_query($conne , $query);
    $numrows=mysqli_num_rows($queryResult);
    $num = 0;
    while($row = mysqli_fetch_assoc($queryResult)) {
        $num = $num + 1 ;
    ?>
    <tr>
      <td><?php echo $num?></td>
      <td><?php echo $row['afm']?></td>
      <td><?php echo $row['onoma']?></td>
      <td><?php echo $row['epitheto']?></td>
      <td><?php echo $row['filo']?></td>
      <td><?php echo $row['email']?></td>
      <td><?php echo $row['thlefono']?></td>
      <td><?php echo $row['hm_gennishs']?></td>
    </tr>
        <?php
    }
?>

</table>



</div>

</body>
</html>