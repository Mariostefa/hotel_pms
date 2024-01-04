<?php
    include '../accesses.php';

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
    <title>Πελάτες</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/pelates.css">
</head>
<body style="background-color: #889bbf;">

<div class="topnav">
    <a href="home.php" <?php echo isActive('home')  ?>>Αρχική</a>
    <a href="pelates.php" <?php if (!shouldDisplayLink('pelates')) echo ' style="display: none;"' ; echo isActive('pelates')  ?>> Πελάτες </a>
    <a href="krathseis.php" <?php if (!shouldDisplayLink('krathseis')) echo ' style="display: none;"' ; echo isActive('krathseis') ?>> Κρατήσεις </a>
    <a href="upliloi.php" <?php if (!shouldDisplayLink('upaliloi')) echo ' style="display: none;"' ; echo isActive('upaliloi')?>> Υπάλληλοι </a>
    <a href="dwmatia.php" <?php if (!shouldDisplayLink('dwmatia')) echo ' style="display: none;"' ; echo isActive('dwmatia')?>> Δωμάτια </a>
    <a href="uphresies.php" <?php if (!shouldDisplayLink('uphresies')) echo ' style="display: none;"' ; echo isActive('uphresies')?>>Υπηρεσίες </a>
    <a href="../logout.php" class="split">Αποσύνδεση</a>
</div>


<div style="padding-left:16px; padding-right:16px">

<h1> Πελάτες</h1>


<table border="0" cellspacing="3" cellpadding="4">
  <tr>
    <th style="text-align: center;">#</th>
    <th>ΑΦΜ</th>
    <th>ΟΝΟΜΑ</th>
    <th>ΕΠΙΘΕΤΟ</th>
    <th>ΦΥΛΟ</th>
    <th>EMAIL</th>
    <th>ΤΗΛΕΦΩΝΟ</th>
    <th>ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ</th>
    <th>Actions</th>
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
      <td><button>Update</button>
      <button>Delete</button>
    </td>
    </tr>
        <?php
    }
?>
</table>

<button> insert </button>

<form action="customer_information.php" method="post" id="customer-form">
        <h1>Φόρμα Κράτησης</h1>
        <p>Παρακαλούμε συμπληρώστε με τις απαιτούμενες πληροφορίες την παρακάτω φόρμα</p>

        <div class="">
            <label for="afm">Αρ. φορολογικού μητρώου: </label>
            <input id="afm" name="afm" value="<?Php echo isset($_SESSION["afm"]) ? $_SESSION["afm"] : ""; ?>" type="text"
                minlength="9" maxlength="9">
            <label for="first-name">Όνομα: </label>
            <input id="first-name" name="fname"
                value="<?Php echo isset($_SESSION["first-name"]) ? $_SESSION["first-name"] : ""; ?>" type="text">(*)
            <label for="last-name">Επώνυμο: </label>
            <input id="last-name" name="lname"
                value="<?Php echo isset($_SESSION["last-name"]) ? $_SESSION["last-name"] : ""; ?>" type="text">(*)
            <label for="email">Email: </label>
            <input id="email" name="email" value="<?Php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ""; ?>"
                type="email">
            <label for="phone">Αρ. τηλεφώνου: </label>
            <input id="phone" name="phone" value="<?Php echo isset($_SESSION["phone"]) ? $_SESSION["phone"] : ""; ?>"
                type="tel" max="10">
        </div>
        <label for="sex">Φίλο: </label>
        <select id="sex" name="sex">
            <option value="" <?php echo empty($_SESSION["sex"]) ? 'selected' : ''; ?> disabled>-</option>
            <option value="male" <?php echo ($_SESSION["sex"] === 'male') ? 'selected' : ''; ?>>Ανδράς</option>
            <option value="female" <?php echo ($_SESSION["sex"] === 'female') ? 'selected' : ''; ?>>Γυναίκα</option>
            <option value="other" <?php echo ($_SESSION["sex"] === 'other') ? 'selected' : ''; ?>>Άλλο</option>
        </select>(*)


        <label for="bdate">Ημ. Γέννησης: </label>
        <input id="bdate" name="bdate"
            value="<?php echo isset($_SESSION["date-of-birth"]) ? $_SESSION["date-of-birth"] : ""; ?>" type="date">


        <label for="payment-method">Τρόπος πληρωμής: </label>
        <select id="payment-method" name="payment" onchange="togglePaymentArea()">
            <option value="" selected disabled>-</option>
            <option value="CASH">Μετρητά</option>
            <option value="CARD">Κάρτα</option>
        </select>(*)

        <button type="submit" name="send-customer-form">Αποστολή</button>
    </form>  

</div>

</body>
</html>