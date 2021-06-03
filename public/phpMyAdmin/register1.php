<?php
session_start();



include("connection.php");
include ("function.php");
$con=mysqli_connect('localhost','root','root12345','register');
$user_data=check_login($con);

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $username= $_POST['username'];
    $email= $_POST['email'];
    $password= $_POST['password'];

    if(!empty($username)&& !empty($email)&& !empty($password) && !is_numeric($username))
    {
        $user_id=random_num(20);
        $query="insert into user (user_id,username,email,password) VALUES ('$user_id','$username','$email','$password')";

        mysqli_query($con,$query);

        header("location: login.php");
        die;

    }else
    {
        echo "please enter some valid information";
    }

}

?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>
        <link rel="stylesheet" href="register.css">
    </head>
    <body>
    <h1>TechForum<br>
        Q&A</h1>
    <div class="registerpage">
        <img src="avatar.jpg" class="avatar">

        <h1>Register</h1>

        <form action="new.php" method="post">
            <input class="text" type="text" name="username" placeholder="username" required="">


            <p1> <input class="text email" type="email" name="email" placeholder="Email" required=""><br><br></p1>
            <input class="text" type="password" name="password" placeholder="Password" required=""><br><br>

            <div class="wthree-text">
                <label class="anim">
                    <input type="checkbox" class="checkbox" required=""><br>
                    <span>I Agree To The Terms & Conditions</span><br><br>
                </label>
                <div class="clear"> </div>
            </div>
            <input type="submit" value="SIGNUP">
        </form>
        <p> have an Account? <a href="login.html"> Login Now!</a></p>
    </div>
    </form>

    </div>
    </body>
    </html><?php
