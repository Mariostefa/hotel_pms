
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <center> <h1> Password Reset </h1> </center>   
    <form >  
        <div class="container">   
            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="user" required> 
            <label>Email :</label>   <br>
            <input type="email" placeholder="Enter Email" name="email" required> <br>
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="pass" required>  
            <!-- when you press the button redirects you on login.php-->
            <button class="login_button" name="reset" onclick="window.location.href='login.php'" >Reset Password</button>      
        </div>   
    </form>  

</body>
</html>