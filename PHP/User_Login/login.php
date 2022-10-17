
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css">
    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form class = "login-box" action="loginsystem.php" method="POST">
        <h1>Login</h1>
        
        <div class="textbox">
            <i class="fa fa-user" aria-hidden="true"></i>
            <input type="text" placeholder="EmailID" name="username" required >
        </div>
        <div class="textbox">

            <i class="fa fa-lock" aria-hidden="true"></i>

            <input type="password" id = "password" placeholder="Password" name="pass_w" required >
            <span>
                <i class="fa fa-eye" aria-hidden="true" id = "eye" onclick="toggle()"></i>
        </span>
        </div>
        <br>
    <br>
        <input class = "butt" type="submit" id="btn1" name = "button" value="Sign in">
        
    </form> 
    
<script src="func.js"></script>
</body>
</html>