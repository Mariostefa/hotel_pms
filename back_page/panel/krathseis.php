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
    <title>Κρατήσεις</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/krathseis.css">
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

<h1> Κρατήσεις</h1>


<?php
        // Display messages if set
        if (isset($deleteMessage)) {
            echo '<p style="color: green;">' . $deleteMessage . '</p>';
            header("Location: pelates.php"); // Redirect to the page showing the updated table
            die();
        }
        if (isset($insertMessage)) {
            echo '<p style="color: green;">' . $insertMessage . '</p>';
            header("Location: pelates.php"); // Redirect to the page showing the updated table
            die();
        }
        if (isset($updateMessage)) {
            echo '<p style="color: green;">' . $updateMessage . '</p>';
            header("Location: pelates.php"); // Redirect to the page showing the updated table
            die();
        }
?>



<div class="dedwmena">

<table border="1" cellspacing="3" cellpadding="4">
  <tr>
    <th>#</th>
    <th>ΑΡΙΘΜΟΣ ΔΩΜΑΤΙΟΥ</th>
    <th>ΑΦΜ ΠΕΛΑΤΗ</th>
    <th>CHECK IN</th>
    <th>CHECK OUT</th>
    <th>ΚΑΤΑΣΤΑΣΗ</th>
    <th>ΠΟΣΟ</th>
    <th>ΗΜΕΡΟΜΗΝΙΑ ΠΛΗΡΩΜΗΣ</th>
    <th>ΚΑΤΑΣΤΑΣΗ ΠΛΗΡΩΜΗΣ</th>
    <th>ΜΕΘΟΔΟΣ ΠΛΗΡΩΜΗΣ</th>
    <th>Actions</th>
  </tr>

<?php 
    include '../db_connection.php';

    $query = "select * from krathsh";
    $queryResult= mysqli_query($conne , $query);
    $numrows=mysqli_num_rows($queryResult);
    $num = 0;
    while($row = mysqli_fetch_assoc($queryResult)) {
        $num = $num + 1 ;
    ?>
    <tbody>
    <tr  id='row-<?php echo $num?>'>
      <td style="text-align: center;"><?php echo $num ?> </td>
      <td><?php echo $row['dwmatio_fk']?></td>
      <td><?php echo $row['pelatis_fk']?></td>
      <td><?php echo $row['hmeromhnia_afikshs']?></td>
      <td><?php echo $row['hmeromhnia_anaxwrishs']?></td>
      <td><?php echo $row['katastash_krathshs']?></td>
      <td><?php echo $row['poso']?></td>
      <td><?php echo $row['hmerominia_synallaghs']?></td>
      <td><?php echo $row['katastash_synallaghs']?></td>
      <td><?php echo $row['tropos_plhrwmhs']?></td>
      <td>
        <button class="btnUpdate" onclick="showUpdateForm(<?php echo $num ?>)">Update</button>
        <form method="post" style="display: inline-block;">
            <input type="hidden" name="delete-afm" value="<?php echo $num ?>">
            <button type="submit" class="btnDelete" name="delete-customer">Delete</button>
        </form>
      </td>
    </tr>
    </tbody>

        <?php
    }
?>
</table>
<br>


<script>

    function showButton(){
        // Hide the "ΚΑΤΑΧΩΡΗΣΗ" button
        document.getElementById('submit-btn').style.display = 'inline-block';

        // Show the "UPDATE" button
        document.getElementById('update-btn').style.display = 'none';
    }

    function showUpdateForm(id) {
        // Get the data values for the clicked row
        console.log(id);
        let row = document.getElementById('row-' + id);
        console.log(row);
        let dwmatio = row.cells[1].innerText;
        let pelatis = row.cells[2].innerText;
        let check_in = row.cells[3].innerText;
        let check_out = row.cells[4].innerText;
        let status_res = row.cells[5].innerText;
        let amount = row.cells[6].innerText;
        let date_trans = row.cells[7].innerText;
        let status_trans = row.cells[8].innerText;
        let method = row.cells[9].innerText;

        // Set the value of the hidden input in the update form
        document.getElementById('update-pel').value = id;
        document.getElementById('update-dwmatio').value = dwmatio;

        // Hide the "ΚΑΤΑΧΩΡΗΣΗ" button
        document.getElementById('submit-btn').style.display = 'none';
        
        // Show the "UPDATE" button
        document.getElementById('update-btn').style.display = 'inline-block';

        // Populate the input fields in the update form
        document.getElementById('dwmatio').value = dwmatio;
        document.getElementById('pelatis').value = pelatis;
        document.getElementById('check_in').value = check_in;
        document.getElementById('check_out').value = check_out;
        document.getElementById('status_res').value = status_res;
        document.getElementById('amount').value = amount;
        document.getElementById('date_trans').value = date_trans;
        document.getElementById('status_trans').value = status_trans;
        document.getElementById('method').value = method;
        event.preventDefault();
    }
</script>

</div>

<div class="form">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="new-customer" style="text-align:center; padding-bottom:15px;" >
        <h1>Στοιχεία Πελάτη</h1><br>

        <input id="update-pel" name="update-pel" type="hidden" value="">
        <input id="update-dwmatio" name="update-dwmatio" type="hidden" value="">

        <label for="afm">Αριθμός Δωματίου:: </label>
            <input id="afm" name="afm" type="text" value=""><br>
        <label for="first-name">ΑΦΜ Πελάτη: </label>
            <input id="first-name" name="fname" type="text" value=""><br>
        <label for="last-name">Check-In: </label>
            <input id="bdate" name="bdate" type="date" value=""><br>
        <label for="last-name">Check-Out: </label>
            <input id="bdate" name="bdate" type="date" value=""><br>
        <label for="sex">Κατάσταση Κράτησης: </label>
        <select id="sex" name="sex">
            <option value=""> - </option>
            <option value="MALE">MALE</option>
            <option value="FEMELE" >FEMELE</option>
        </select><br>
        <label for="email">Χρηματικό Ποσό: </label>
            <input id="email" name="email" type="text" value=""><br>
        <label for="bdate">Ημ. Πληρωμής: </label>
            <input id="bdate" name="bdate" type="date" value=""><br>
        <label for="sex">Κατάσταση Πληρωμής: </label>
        <select id="sex" name="sex">
            <option value=""> - </option>
            <option value="MALE">MALE</option>
            <option value="FEMELE" >FEMELE</option>
        </select><br>
        <label for="sex">Τρόπος Πληρωμής: </label>
        <select id="sex" name="sex">
            <option value=""> - </option>
            <option value="MALE">MALE</option>
            <option value="FEMELE" >FEMELE</option>
        </select><br>

        <button id="submit-btn" class="submit" type="submit" name="data-submit">ΚΑΤΑΧΩΡΗΣΗ</button>
        <button id="update-btn" class="submit" type="submit" name="update-customer" style="display: none;">UPDATE</button>
    </form>  
    
</div>

</div>

</body>
</html>