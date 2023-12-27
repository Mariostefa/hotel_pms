
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <center> <h1> Login </h1> </center>   
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <div class="container">   
            <label>Username : </label>   
            <input type="text" placeholder="Enter Username" name="username" required>  
            <label>Password : </label>   
            <input type="password" placeholder="Enter Password" name="password" required>  
            <button type="submit" name="login">Login</button>   
            <input type="checkbox" checked="checked"> Remember me    
            Forgot <a href="#"> password? </a>   
        </div>   
    </form>  

</body>
</html>