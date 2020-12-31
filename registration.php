<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
    
</head>
<body>
<?php
    session_start();
    require('db.php');
    include ('header.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $weight = stripslashes($_REQUEST['weight']);
        $weight = mysqli_real_escape_string($con, $weight);
        $consulted_doctor = stripslashes($_REQUEST['consulted_doctor']);
        $consulted_doctor = mysqli_real_escape_string($con, $consulted_doctor);
        $last_appntmnt = stripslashes($_REQUEST['last_appntmnt']);
        $last_appntmnt = mysqli_real_escape_string($con, $last_appntmnt);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `users` (username, password, email, create_datetime,weight,consulted_doctor,last_appntmnt)
                     VALUES ('$username', '" . md5($password) . "', '$email', '$create_datetime','$weight','$consulted_doctor','$last_appntmnt')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post" background-image="images/regbg.jpg">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="text" class="login-input" name="weight" placeholder="weight">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
    }
     include ('footer.php');
?>
</body>
</html>
