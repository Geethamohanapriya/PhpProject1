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
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // removes backslashes
        $username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
        $username = mysqli_real_escape_string($con, $username);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($con, $email);
        $date = stripslashes($_REQUEST['date']);
        $date = mysqli_real_escape_string($con, $date);
        $time = stripslashes($_REQUEST['time']);
        $time = mysqli_real_escape_string($con, $time);
        $create_datetime = date("Y-m-d H:i:s");
        $query    = "INSERT into `bookings` (username,email,date,time, create_datetime)
                     VALUES ('$username', '$email','$date','$time', '$create_datetime')";
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
    <form class="form" action="http://localhost/PhpProject1/doc_login/mail.php" method="post" background-image="images/regbg.jpg">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="date" class="login-input" name="date">
        <label for="time">Choose slot</label>
        <select name="time" id="time">
          <option value="9:00-9:30">9:00-9:30</option>
          <option value="9:30-10:00">9:30-10:00</option>
          <option value="10:00-10:30">10:00-10:30</option>
          <option value="10:30-11:00">10:30-11:00</option>
        </select><br>
        <input type="submit" value="Book" name="submit" class="login-button"/>
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
<?php
    }
?>
</body>
</html>
