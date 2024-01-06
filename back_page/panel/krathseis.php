<?php
    include '../accesses.php';

    if(!$_SESSION['logged_in']){
        header("Location: ../login.php");
        die();
    }
?>


<?php
// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-customer'])) {
    $old_dwm = mysqli_real_escape_string($conne, $_POST['update-dwmatio']);
    $old_afm = mysqli_real_escape_string($conne, $_POST['update-afm']);
    $old_check_in = mysqli_real_escape_string($conne, $_POST['hm_krat']); 
    
    $dwm = mysqli_real_escape_string($conne, $_POST['room_no']);
    $afm = mysqli_real_escape_string($conne, $_POST['afm']);
    $check_in = mysqli_real_escape_string($conne, $_POST['check_in']);
    $check_out = mysqli_real_escape_string($conne, $_POST['check_out']);
    $st_res = mysqli_real_escape_string($conne, $_POST['st_res']);
    $am = mysqli_real_escape_string($conne, $_POST['am']);
    $pay_day = mysqli_real_escape_string($conne, $_POST['pay_day']);
    $st_pay = mysqli_real_escape_string($conne, $_POST['st_pay']);
    $pay = mysqli_real_escape_string($conne, $_POST['pay']);

    $updateQuery = "UPDATE krathsh SET dwmatio_fk ='$dwm', pelatis_fk = '$afm', hmeromhnia_afikshs = '$check_in' , hmeromhnia_anaxwrishs = '$check_out', katastash_krathshs = '$st_res', poso = '$am', hmerominia_synallaghs = '$pay_day', 
                    katastash_synallaghs = '$st_pay', tropos_plhrwmhs = '$pay' 
                    WHERE pelatis_fk = '$old_afm' and dwmatio_fk = '$old_dwm' and hmeromhnia_afikshs = '$old_check_in' ";

    if (mysqli_query($conne, $updateQuery)) {
        // Successful update
        $updateMessage = "Επιτυχής ενημέρωση πελάτη.";
    } else {
        // Error in update
        $updateMessage = "Σφάλμα κατά την ενημέρωση: " . mysqli_error($conne);
    }
}

// Handle delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-customer'])) {
    $deleteAfm = mysqli_real_escape_string($conne, $_POST['delete-afm']);
    $deleteDwm = mysqli_real_escape_string($conne, $_POST['delete-dwm']);
    $deleteHmKrat = mysqli_real_escape_string($conne, $_POST['delete-hm_krat']);

    // Perform the deletion from the database
    $deleteQuery = "DELETE FROM krathsh WHERE dwmatio_fk = '$deleteDwm'and pelatis_fk = '$deleteAfm' and hmeromhnia_afikshs = '$deleteHmKrat'";
    
    if (mysqli_query($conne, $deleteQuery)) {
        // Successful deletion
        $deleteMessage = "Επιτυχής διαγραφή πελάτη.";
    } else {
        // Error in deletion
        $deleteMessage = "Σφάλμα κατά τη διαγραφή: " . mysqli_error($conne);
    }
}

// Handle form submission for new customer or update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data-submit'])) {
    $dwm = mysqli_real_escape_string($conne, $_POST['room_no']);
    $afm = mysqli_real_escape_string($conne, $_POST['afm']);
    $check_in = mysqli_real_escape_string($conne, $_POST['check_in']);
    $check_out = mysqli_real_escape_string($conne, $_POST['check_out']);
    $st_res = mysqli_real_escape_string($conne, $_POST['st_res']);
    $am = mysqli_real_escape_string($conne, $_POST['am']);
    $pay_day = mysqli_real_escape_string($conne, $_POST['pay_day']);
    $st_pay = mysqli_real_escape_string($conne, $_POST['st_pay']);
    $pay = mysqli_real_escape_string($conne, $_POST['pay']);

    if (empty($updateData['afm'])) {
        // It's an insert operation
        $insertQuery = "INSERT INTO krathsh (dwmatio_fk, pelatis_fk, hmeromhnia_afikshs , hmeromhnia_anaxwrishs, katastash_krathshs,  poso, hmerominia_synallaghs, katastash_synallaghs , tropos_plhrwmhs) 
                        VALUES ('$dwm', '$afm', '$check_in', '$check_out', '$st_res' ,'$am', '$pay_day', '$st_pay' , '$pay')";
        
        if (mysqli_query($conne, $insertQuery)) {
            // Successful insertion
            $insertMessage = "Επιτυχής καταχώρηση πελάτη.";
        } else {
            // Error in insertion
            $insertMessage = "Σφάλμα κατά την καταχώρηση: " . mysqli_error($conne);
        }
    }
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
            header("Location: krathseis.php"); // Redirect to the page showing the updated table
            die();
        }
        if (isset($insertMessage)) {
            echo '<p style="color: green;">' . $insertMessage . '</p>';
            header("Location: krathseis.php"); // Redirect to the page showing the updated table
            die();
        }
        if (isset($updateMessage)) {
            echo '<p style="color: green;">' . $updateMessage . '</p>';
            header("Location: krathseis.php"); // Redirect to the page showing the updated table
            die();
        }
?>



<div class="dedwmena">

<table border="1" cellspacing="3" cellpadding="4">
  <tr>
    <th>#</th>
    <th>ΑΡ. ΔΩΜΑΤΙΟΥ</th>
    <th>ΑΦΜ ΠΕΛΑΤΗ</th>
    <th>CHECK IN</th>
    <th>CHECK OUT</th>
    <th>ΚΑΤΑΣΤΑΣΗ</th>
    <th>ΠΟΣΟ</th>
    <th>ΗΜ/ΝΙΑ ΠΛΗΡΩΜΗΣ</th>
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
      <td style="text-align: center;"><?php echo $row['dwmatio_fk']?></td>
      <td><?php echo $row['pelatis_fk']?></td>
      <td><?php echo $row['hmeromhnia_afikshs']?></td>
      <td><?php echo $row['hmeromhnia_anaxwrishs']?></td>
      <td><?php echo $row['katastash_krathshs']?></td>
      <td><?php echo $row['poso']?></td>
      <td><?php echo $row['hmerominia_synallaghs']?></td>
      <td style="text-align: center;"><?php echo $row['katastash_synallaghs']?></td>
      <td style="text-align: center;"><?php echo $row['tropos_plhrwmhs']?></td>
      <td>
        <button class="btnUpdate" onclick="showUpdateForm(<?php echo $num ?>)">Update</button>
        <form method="post" style="display: inline-block;">
            <input type="hidden" name="delete-afm" value="<?php echo $row['pelatis_fk'] ?>">
            <input type="hidden" name="delete-dwm" value="<?php echo $row['dwmatio_fk'] ?>">
            <input type="hidden" name="delete-hm_krat" value="<?php echo $row['hmeromhnia_afikshs'] ?>">
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
        document.getElementById('hm_krat').value = check_in;
        document.getElementById('update-dwmatio').value = dwmatio;
        document.getElementById('update-afm').value = pelatis;

        // Hide the "ΚΑΤΑΧΩΡΗΣΗ" button
        document.getElementById('submit-btn').style.display = 'none';
        
        // Show the "UPDATE" button
        document.getElementById('update-btn').style.display = 'inline-block';

        // Populate the input fields in the update form
        document.getElementById('room_no').value = dwmatio;
        document.getElementById('afm').value = pelatis;
        document.getElementById('check_in').value = check_in;
        document.getElementById('check_out').value = check_out;
        document.getElementById('st_res').value = status_res;
        document.getElementById('am').value = amount;
        document.getElementById('pay_day').value = date_trans;
        document.getElementById('st_pay').value = status_trans;
        document.getElementById('pay').value = method;
        event.preventDefault();
    }
</script>

</div>

<div class="form">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="new-customer" style="text-align:center; padding-bottom:15px;" >
        <h1>Στοιχεία Πελάτη</h1><br>

        <input id="hm_krat" name="hm_krat" type="hidden" value="">
        <input id="update-dwmatio" name="update-dwmatio" type="hidden" value="">
        <input id="update-afm" name="update-afm" type="hidden" value="">

        <label for="room_no">Αριθμός Δωματίου:: </label>
            <input id="room_no" name="room_no" type="text" value=""><br>
        <label for="afm">ΑΦΜ Πελάτη: </label>
            <input id="afm" name="afm" type="text" value=""><br>
        <label for="check_in">Check-In: </label>
            <input id="check_in" name="check_in" type="date" value=""><br>
        <label for="check_out">Check-Out: </label>
            <input id="check_out" name="check_out" type="date" value=""><br>
        <label for="st_res">Κατάσταση Κράτησης: </label>
        <select id="st_res" name="st_res">
            <option value="PENDING" default>PENDING</option>
            <option value="ACCEPTED">ACCEPTED</option>
            <option value="DENIED" >DENIED</option>
        </select><br>
        <label for="am">Χρηματικό Ποσό: </label>
            <input id="am" name="am" type="number" value=""><br>
        <label for="pay_day">Ημ. Πληρωμής: </label>
            <input id="pay_day" name="pay_day" type="datetime-local" value="" step="any"><br>
        <label for="st_pay">Κατάσταση Πληρωμής: </label>
        <select id="st_pay" name="st_pay">
            <option value="PENDING" default>PENDING</option>
            <option value="ACCEPTED">ACCEPTED</option>
            <option value="CANCELED" >CANCELED</option>
        </select><br>
        <label for="pay">Τρόπος Πληρωμής: </label>
        <select id="pay" name="pay">
            <option value="CASH" default>CASH</option>
            <option value="CARD" >CARD</option>
        </select><br>

        <button id="submit-btn" class="submit" type="submit" name="data-submit">ΚΑΤΑΧΩΡΗΣΗ</button>
        <button id="update-btn" class="submit" type="submit" name="update-customer" style="display: none;">UPDATE</button>
    </form>  
    
</div>

</div>

</body>
</html>