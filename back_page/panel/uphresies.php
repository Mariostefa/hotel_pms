<?php
include '../accesses.php';

if (!$_SESSION['logged_in']) {
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
    <title>Υπηρεσίες</title>
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/uphresies-dwmatia.css">
</head>

<body>

    <div class="topnav">
        <a href="home.php" <?php echo isActive('home') ?>>Αρχική</a>
        <a href="pelates.php" <?php if (!shouldDisplayLink('pelates'))
            echo ' style="display: none;"';
        echo isActive('pelates') ?>> Πελάτες </a>
        <a href="krathseis.php" <?php if (!shouldDisplayLink('krathseis'))
            echo ' style="display: none;"';
        echo isActive('krathseis') ?>> Κρατήσεις </a>
        <a href="upliloi.php" <?php if (!shouldDisplayLink('upaliloi'))
            echo ' style="display: none;"';
        echo isActive('upaliloi') ?>> Υπάλληλοι </a>
        <a href="dwmatia.php" <?php if (!shouldDisplayLink('dwmatia'))
            echo ' style="display: none;"';
        echo isActive('dwmatia') ?>> Δωμάτια </a>
        <a href="uphresies.php" <?php if (!shouldDisplayLink('uphresies'))
            echo ' style="display: none;"';
        echo isActive('uphresies') ?>>Υπηρεσίες </a>
        <a href="../logout.php" class="split">Αποσύνδεση</a>
    </div>

    <div style="padding-left:10px; padding-right:10px">

        <div>
            <div class="title-insert-btn">
                <h2>Υπηρεσίες</h2>
                <a class="insert-button" href="create-delete-update/insert_uphresia.php">ΕΙΣΑΓΩΓΗ</a>
            </div>


            <div class="border-outline">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ΚΩΔΙΚΟΣ</th>
                            <th>ΟΝΟΜΑΣΙΑ</th>
                            <th>ΤΙΜΗ</th>
                            <th>ΔΙΑΘΕΣΙΜΟΤΗΤΑ</th>
                            <th>ΕΝΕΡΓΕΙΕΣ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM yphresia";
                        $queryResult = mysqli_query($conne, $query);
                        $numrows = mysqli_num_rows($queryResult);
                        $num = 0;

                        while ($row = mysqli_fetch_assoc($queryResult)) {
                            $num = $num + 1;
                            echo "<tr>";
                            echo "<td>{$num}</td>";
                            echo "<td>{$row['kwdikos']}</td>";
                            echo "<td>{$row['onoma']}</td>";
                            echo "<td>{$row['timi']}</td>";
                            echo "<td>{$row['diathesimotita']}</td>";
                            echo "<td>";
                            echo " <div class='update-delete-btns'>";
                            echo "<a href='create-delete-update/update_uphresia.php?updateid={$row['kwdikos']}'>Επεξεργασία</a>";
                            echo "<a href='create-delete-update/delete_uphresia.php?deleteid={$row['kwdikos']}'>Διαγραφή</a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";

                        }
                        ?>
                    <tbody>
                </table>
            </div>
        </div>

        <div style="margin-top: 100px;">
            <div class="title-insert-btn">
                <h2>Υπηρεσίες που χρησιμοποιούν οι πελάτες</h2>
                <a class="insert-button" href="create-delete-update/insert_xrhsh_uphresias.php">ΕΙΣΑΓΩΓΗ</a>
            </div>


            <div class="border-outline">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ΑΦΜ</th>
                            <th>ΚΩΔ. ΥΠΗΡΕΣΙΑΣ</th>
                            <th>ΗΜ. ΧΡΗΣΗΣ ΥΠΗΡΕΣΙΑΣ</th>
                            <th>ΠΟΣΟ</th>
                            <th>ΗΜ. ΣΥΝΑΛΛΑΓΗΣ</th>
                            <th>ΚΑΤΑΣΤΑΣΗ ΣΥΝΑΛΛΑΓΗΣ</th>
                            <th>ΤΡΟΠΟΣ ΠΛΗΡΩΜΗΣ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $query = "SELECT * FROM xrhsh_yphresias";
                        $queryResult = mysqli_query($conne, $query);
                        $numrows = mysqli_num_rows($queryResult);
                        $num = 0;

                        while ($row = mysqli_fetch_assoc($queryResult)) {
                            $num = $num + 1;
                            echo "<tr>";
                            echo "<td>{$num}</td>";
                            echo "<td>{$row['pelatis_fk']}</td>";
                            echo "<td>{$row['yphresia_fk']}</td>";
                            echo "<td>{$row['hm_yphresias']}</td>";
                            echo "<td>{$row['poso']}</td>";
                            echo "<td>{$row['hmerominia_synallaghs']}</td>";
                            echo "<td>{$row['katastash_synallaghs']}</td>";
                            echo "<td>{$row['tropos_plhrwmhs']}</td>";
                            echo "<td>";
                            echo " <div class='update-delete-btns'>";
                            echo "<a href='create-delete-update/update_uphresia.php?updateid={$row['pelatis_fk']}+{$row['yphresia_fk']}+{$row['hm_yphresias']}'>Επεξεργασία</a>";
                            echo "<a href='create-delete-update/delete_uphresia.php?deleteid={$row['pelatis_fk']}+{$row['yphresia_fk']}+{$row['hm_yphresias']}'>Διαγραφή</a>";
                            echo "</div>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    <tbody>
                </table>
            </div>
        </div>
    </div>






</body>

</html>