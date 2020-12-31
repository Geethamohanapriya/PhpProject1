<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    require('db.php');
    session_start();

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
        $gender    = stripslashes($_REQUEST['gender']);
        $gender    = mysqli_real_escape_string($con, $gender);
        $mobile    = stripslashes($_REQUEST['mobile']);
        $mobile    = mysqli_real_escape_string($con, $mobile);
        $address    = stripslashes($_REQUEST['address']);
        $address    = mysqli_real_escape_string($con, $address);
        $yoe    = stripslashes($_REQUEST['yoe']);
        $yoe    = mysqli_real_escape_string($con, $yoe);
        $img    = stripslashes($_REQUEST['img']);
        $img    = mysqli_real_escape_string($con, $img);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `doctors` (username,password,email,gender,mobile,address,yoe,img, create_datetime)
                     VALUES ('$username', '" . md5($password) . "', '$email','$gender','$mobile','$address','$yoe','$img', '$create_datetime')";
        $result   = mysqli_query($con, $query);
        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='doc_login/registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="text" class="login-input" name="gender" placeholder="Gender">
        <input type="text" class="login-input" name="mobile" placeholder="Enter mobile number">
        <input type="text" class="login-input" name="address" placeholder="Enter Work Address">
        <input type="text" class="login-input" name="yoe" placeholder="Years of experience">
        <input type="file" class="login-input" name="img"  placeholder="Your photo">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="doc_login/login.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
