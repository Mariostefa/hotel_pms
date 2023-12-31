<?php
    include '../accesses.php';
    //security check
    if(!$_SESSION['logged_in']){
        header("Location: ../login.php");
        die();
    }
?>



<?php

// Handle update request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update-customer'])) {
    $old_afm = mysqli_real_escape_string($conne, $_POST['update-afm']);
    
    $afm = mysqli_real_escape_string($conne, $_POST['afm']);
    $fname = mysqli_real_escape_string($conne, $_POST['fname']);
    $lname = mysqli_real_escape_string($conne, $_POST['lname']);
    $email = mysqli_real_escape_string($conne, $_POST['email']);
    $phone = mysqli_real_escape_string($conne, $_POST['phone']);
    $sex = mysqli_real_escape_string($conne, $_POST['sex']);
    $bdate = mysqli_real_escape_string($conne, $_POST['bdate']);

    $updateQuery = "UPDATE pelaths SET afm = '$afm' ,onoma = '$fname', epitheto = '$lname', filo = '$sex', 
                    email = '$email', thlefono = '$phone', hm_gennishs = '$bdate' 
                    WHERE afm = '$old_afm'";

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

    // Perform the deletion from the database
    $deleteQuery = "DELETE FROM pelaths WHERE afm = '$deleteAfm'";
    
    if (mysqli_query($conne, $deleteQuery)) {
        // Successful deletion
        $deleteMessage = "Επιτυχής διαγραφή πελάτη.";
    } else {
        // Error in deletion
        $deleteMessage = "Σφάλμα κατά τη διαγραφή: " . mysqli_error($conne);
    }
}

// Handle form submission for new customer 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['data-submit'])) {
    $afm = mysqli_real_escape_string($conne, $_POST['afm']);
    $fname = mysqli_real_escape_string($conne, $_POST['fname']);
    $lname = mysqli_real_escape_string($conne, $_POST['lname']);
    $email = mysqli_real_escape_string($conne, $_POST['email']);
    $phone = mysqli_real_escape_string($conne, $_POST['phone']);
    $sex = mysqli_real_escape_string($conne, $_POST['sex']);
    $bdate = mysqli_real_escape_string($conne, $_POST['bdate']);

    if (empty($updateData['afm'])) {
        // It's an insert operation
        $insertQuery = "INSERT INTO pelaths (afm, onoma, epitheto, filo, email,  thlefono, hm_gennishs) 
                        VALUES ('$afm', '$fname', '$lname', '$sex' ,'$email', '$phone', '$bdate')";
        
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
    <title>Πελάτες</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/pelates.css">
</head>
<body style="background-color: #889bbf;">
<!-- Creates the Navigation Bar and checks if a user has access on some elements of the bar or not  -->
<div class="topnav">
    <a href="home.php" <?php echo isActive('home')  ?>>Αρχική</a>
    <a href="pelates.php" <?php if (!shouldDisplayLink('pelates')) echo ' style="display: none;"' ; echo isActive('pelates')  ?>> Πελάτες </a>
    <a href="krathseis.php" <?php if (!shouldDisplayLink('krathseis')) echo ' style="display: none;"' ; echo isActive('krathseis') ?>> Κρατήσεις </a>
    <a href="upaliloi.php" <?php if (!shouldDisplayLink('upaliloi')) echo ' style="display: none;"' ; echo isActive('upaliloi')?>> Υπάλληλοι </a>
    <a href="dwmatia.php" <?php if (!shouldDisplayLink('dwmatia')) echo ' style="display: none;"' ; echo isActive('dwmatia')?>> Δωμάτια </a>
    <a href="uphresies.php" <?php if (!shouldDisplayLink('uphresies')) echo ' style="display: none;"' ; echo isActive('uphresies')?>>Υπηρεσίες </a>
    <a href="../logout.php" class="split">Αποσύνδεση</a>
</div>


<div style="padding-left:10px; padding-right:10px">

<h1> Πελάτες</h1>


<?php
        // Display messages if set
        if (isset($deleteMessage)) {
            header("Location: pelates.php"); // Redirect to the page showing the updated table
            die();
        }
        if (isset($insertMessage)) {
            header("Location: pelates.php"); // Redirect to the page showing the updated table
            die();
        }
        if (isset($updateMessage)) {
            header("Location: pelates.php"); // Redirect to the page showing the updated table
            die();
        }
?>



<div class="dedwmena">
 <!-- table for pelates table -->
<table border="1" cellspacing="3" cellpadding="4">
  <tr>
    <th>#</th>
    <th>ΑΦΜ</th>
    <th>ΟΝΟΜΑ</th>
    <th>ΕΠΙΘΕΤΟ</th>
    <th>ΦΥΛΟ</th>
    <th>EMAIL</th>
    <th>ΤΗΛΕΦΩΝΟ</th>
    <th>ΗΜΕΡΟΜΗΝΙΑ ΓΕΝΝΗΣΗΣ</th>
    <th>Actions</th>
  </tr>
<!-- request all data about each pelath and for every value pass it on the table on each row -->
<?php 
    include '../db_connection.php';

    $query = "select * from pelaths";
    $queryResult= mysqli_query($conne , $query);
    $numrows=mysqli_num_rows($queryResult);
    $num = 0;
    while($row = mysqli_fetch_assoc($queryResult)) {
        $num = $num + 1 ;
    ?>
    <tbody>
    <tr  id='row-<?php echo $row['afm'] ?>'>
      <td style="text-align: center;"><?php echo $num ?> </td>
      <td><?php echo $row['afm']?></td>
      <td><?php echo $row['onoma']?></td>
      <td><?php echo $row['epitheto']?></td>
      <td><?php echo $row['filo']?></td>
      <td><?php echo $row['email']?></td>
      <td><?php echo $row['thlefono']?></td>
      <td><?php echo $row['hm_gennishs']?></td>
      <td > <!-- When you press update runs javascript below-->
        <button class="btnUpdate" onclick="showUpdateForm(<?php echo $row['afm']; ?>)">Update</button>
        <form method="post" class="formdel" >  <!-- When you press delete automatically runs the code above , which handles the delete function-->
            <input type="hidden" name="delete-afm" value="<?php echo $row['afm']; ?>">
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
        let row = document.getElementById('row-' + id);
        let afm = row.cells[1].innerText;
        let fname = row.cells[2].innerText;
        let lname = row.cells[3].innerText;
        let sex = row.cells[4].innerText;
        let email = row.cells[5].innerText;
        let phone = row.cells[6].innerText;
        let bdate = row.cells[7].innerText;

        // Set the value of the hidden input in the update form
        document.getElementById('update-id').value = id;
        document.getElementById('update-afm').value = afm;

        // Hide the "ΚΑΤΑΧΩΡΗΣΗ" button
        document.getElementById('submit-btn').style.display = 'none';
        
        // Show the "UPDATE" button
        document.getElementById('update-btn').style.display = 'inline-block';

        // Populate the input fields in the update form
        document.getElementById('afm').value = afm;
        document.getElementById('first-name').value = fname;
        document.getElementById('last-name').value = lname;
        document.getElementById('sex').value = sex;
        document.getElementById('email').value = email;
        document.getElementById('phone').value = phone;
        document.getElementById('bdate').value = bdate;
        event.preventDefault();
    }
</script>

</div>

<div class="form">
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="new-customer" style="text-align:center; padding-bottom:15px;" >
        <h1>Στοιχεία Πελάτη</h1><br>

        <input id="update-id" name="update-id" type="hidden" value="">
        <input id="update-afm" name="update-afm" type="hidden" value="">

        <label for="afm">Αρ. φορολογικού μητρώου: </label>
            <input id="afm" name="afm" type="text" minlength="9" maxlength="9" value=""><br>
        <label for="first-name">Όνομα: </label>
            <input id="first-name" name="fname" type="text" value=""><br>
        <label for="last-name">Επώνυμο: </label>
            <input id="last-name" name="lname" type="text" value=""><br>
        <label for="sex">Φίλο: </label>
        <select id="sex" name="sex">
            <option value=""> - </option>
            <option value="MALE">MALE</option>
            <option value="FEMALE" >FEMALE</option>
            <option value="OTHER" >OTHER</option>
        </select><br>
        <label for="email">Email: </label>
            <input id="email" name="email" type="email" value=""><br>
        <label for="phone">Αρ. τηλεφώνου: </label>
            <input id="phone" name="phone" type="tel" max="10" value=""><br>

        <label for="bdate">Ημ. Γέννησης: </label>
            <input id="bdate" name="bdate" type="date" value=""><br>
        <!-- it displayes each button under specific circumstances-->
        <button id="submit-btn" class="submit" type="submit" name="data-submit">ΚΑΤΑΧΩΡΗΣΗ</button>
        <button id="update-btn" class="submit" type="submit" name="update-customer" style="display: none;">UPDATE</button>
    </form>  
    
</div>

</div>

</body>
</html>

