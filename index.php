

<?php
    include 'user_details.php';
    include 'db_connection.php';
    
    //this is a test
    //test number 2

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $pass = $_POST['password'];
        $user = $_POST['username'];
    
        $query_login = "SELECT kwdikos FROM stoixia_sundeshs WHERE onoma = '$user' AND sinthimatiko = '$pass' ";
        $result = mysqli_query($conne , $query_login) ;
        $count = mysqli_num_rows($result);
        if($count > 0){

            $row= mysqli_fetch_row($result);
            $id = $row[0]; 
            details($id);

        }else{
            echo "wrong password or username";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <center> <h1> Login Information </h1> </center>   
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <div class="container">   
            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="username" required>  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="password" required>  
            <button class="login_button" type="submit" name="login">Login</button>   
            <input type="checkbox" checked="checked"> Remember me    
            <button class="forgot_pass" type="button" onclick="window.location.href='forgot_pass.php'">Forgot Password?</button>  
        </div>   
    </form>  
</body>
</html>

