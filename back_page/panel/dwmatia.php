<?php
    include '../accesses.php';

    if(!$_SESSION['logged_in']){
        header("Location: ../login.php");
        die();
    }
    include('../db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Δωμάτια</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/uphresies-dwmatia.css">

</head>
<body style="background-color: #889bbf;">

<div class="topnav">
    <a href="home.php" <?php echo isActive('home')  ?>>Αρχική</a>
    <a href="pelates.php" <?php if (!shouldDisplayLink('pelates')) echo ' style="display: none;"' ; echo isActive('pelates')  ?>> Πελάτες </a>
    <a href="krathseis.php" <?php if (!shouldDisplayLink('krathseis')) echo ' style="display: none;"' ; echo isActive('krathseis') ?>> Κρατήσεις </a>
    <a href="upaliloi.php" <?php if (!shouldDisplayLink('upaliloi')) echo ' style="display: none;"' ; echo isActive('upaliloi')?>> Υπάλληλοι </a>
    <a href="dwmatia.php" <?php if (!shouldDisplayLink('dwmatia')) echo ' style="display: none;"' ; echo isActive('dwmatia')?>> Δωμάτια </a>
    <a href="uphresies.php" <?php if (!shouldDisplayLink('uphresies')) echo ' style="display: none;"' ; echo isActive('uphresies')?>>Υπηρεσίες </a>
    <a href="../logout.php" class="split">Αποσύνδεση</a>
</div>


<div style="padding-left:16px; padding-right:16px">

<div>
            <div class="title-insert-btn">
                <h1>Δωμάτια</h1>
                <a class="insert-button" href="create-delete-update/insert_dwmatio.php">ΕΙΣΑΓΩΓΗ</a>
            </div>


            <div class="border-outline">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ΑΡΙΘΜΟΣ</th>
                            <th>ΑΡΙΘΜΟΣ ΚΛΙΝΩΝ</th>
                            <th>ΟΡΟΦΟΣ</th>
                            <th>ΤΟΠΟΘΕΣΙΑ</th>
                            <th>ΤΙΜΗ</th>
                            <th>ΚΑΤΑΣΤΑΣΗ</th>
                            <th>ΚΑΘΑΡΙΟΤΗΤΑ</th>
                            <th>ΕΝΕΡΓΕΙΕΣ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM dwmatio";
                        $queryResult = mysqli_query($conne, $query);
                        $numrows = mysqli_num_rows($queryResult);
                        $num = 0;

                        while ($row = mysqli_fetch_assoc($queryResult)) {
                            $num = $num + 1;
                            echo "<tr>";
                            echo "<td>{$num}</td>";
                            echo "<td>{$row['arithmos']}</td>";
                            echo "<td>{$row['arithmos_klinwn']}</td>";
                            echo "<td>{$row['orofos']}</td>";
                            echo "<td>{$row['topothesia']}</td>";
                            echo "<td>{$row['timi']}</td>";
                            echo "<td>{$row['katastash']}</td>";
                            echo "<td>{$row['kathariothta']}</td>";
                            echo "<td>";
                            echo " <div class='update-delete-btns'>";
                            echo "<a href='create-delete-update/update_uphresia.php?updateid={$row['arithmos']}'>Επεξεργασία</a>";
                            echo "<a href='create-delete-update/delete_uphresia.php?deleteid={$row['arithmos']}'>Διαγραφή</a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";

                        }
                        ?>
                    <tbody>
                </table>
            </div>
        </div>

<!--select-->
<div id="center">

<table border=2 align=center>
<!--thead><-->
	<tr>
		<th width=80>ΑΡΙΘΜΟΣ</th>
		<th width=80>ΑΡΙΘΜΟΣ ΚΛΙΝΩΝ</th>
		<th width=80>ΟΡΟΦΟΣ</th>
		<th width=80>ΤΟΠΟΘΕΣΙΑ</th>
		<th width=80>ΤΙΜΗ</th>
		<th width=80>ΚΑΤΑΣΤΑΣΗ</th>
		<th width=80>ΚΑΘΑΡΙΟΤΗΤΑ</th>
	</tr>
<!--/thead><-->
<!--tbody><-->
<?php
	// Σύνταξη Ερωτήματος για την εμφάνιση δεδομένων
	$qry = "SELECT * FROM dwmatio";
	
	// Εκτέλεση Ερωτήματος
	$result = mysqli_query($conne, $qry);
	
	// Παρουσίαση αποτελεσμάτων Ερωτήματος
	while($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
		
        echo ("<tr><td><div align=\"center\"> $row[0]</div></td>
				<td><div align=\"center\"> $row[1] </div></td>
				<td><div align=\"center\"> $row[2] </div></td>
				<td><div align=\"center\"> $row[3] </div></td>
				<td><div align=\"center\"> $row[4] </div></td>
				<td><div align=\"center\"> $row[5] </div></td>
				<td><div align=\"center\"> $row[6] </div></td></tr>");
	}
?>



</div>

</body>
</html>
