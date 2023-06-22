<html>
    <head>
        <title>Login- Sales Automation</title>
        <link rel="stylesheet" href="loginstyles.css">
    </head>
    <body>
        
        <div class="hero">
            <div class="form-box">
                <div class="button-box">
                  <div id="btn"></div>
                    <button type="button" class="toggle-btn" onclick="login()">Login</button>
                    <button type="button" class="toggle-btn" onclick="register()">Register</button>
                </div>
                <div class="social-icons">
                    <img src="img/fb.png" >
                    <img src="img/google.jpg" >
                    <img src="img/twitter.png" >
            </div>
            
            <form id="login" class="input-group" action="process.php" method="post">
                <input type="text" name="username" class="input-field" placeholder="Enter User Id" required>
                <input type="password" name="password" class="input-field" placeholder="Enter Password" required>
                <button type="submit" class="submit-btn" name="Login">Login</button>

            </form>
            <form id="register" class="input-group" action="register.php" method ="post">
                <input type="text" name="new_User_Id" class="input-field" placeholder="Enter User Id" required>
                <input type="email" name="email_Id" class="input-field" placeholder="Enter Email Id" required>
                <input type="password" name="password_register" class="input-field" placeholder="Enter password" required>
                <button type="submit"  name="register" class="submit-btn">Register</button>

            </form>
            </div>


        </div>
<script>
var x= document.getElementById("login");
var y= document.getElementById("register");
var z= document.getElementById("btn");

function register(){
    x.style.left= "-400px";
    y.style.left="50px";
    z.style.left="110px";

}
function login(){
    x.style.left= "50px";
    y.style.left="450px";
    z.style.left="0";

}

</script>


    </body>
</html>