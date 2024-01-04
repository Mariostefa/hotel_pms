<dialog class="reservation-form" id="customer-modal">
    <form action="customer_information.php" method="post" id="customer-form">
        <button type="submit" formmethod="dialog">X</button>
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

        <div id="payment-section" class="hidden">
            <label for="first-name-card">Όνομα κατώχου: </label>
            <input id="first-name-card" name="first-name" type="text">

            <label for="last-name-card">Επώνυμο κατώχου: </label>
            <input id="last-name-card" name="secondary-name" type="text">

            <label for="cardnum">Αρ.Κάρτας: </label>
            <input id="cardnum" name="card-number" type="number">

            <label for="cvc">Κωδικός Ασφαλείας: </label>
            <input id="cardnum" type="number" min="0" max="999">

            <label for="exp-date">Ημερομηνία λήξης: </label>
            <input id="exp-date" type="month">
        </div>
        <input type="hidden" name="submition-page" value="<?php echo submition_page; ?>">
        <button type="submit" name="send-customer-form">Αποστολή</button>
    </form>
</dialog>