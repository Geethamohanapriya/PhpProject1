<?php 
require_once 'phpmailer/PHPMailerAutoload.php';

error_reporting(E_ERROR | E_PARSE);
$email = $_SESSION['email'];

function sanitize_my_email($field) {
    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
        return true;
    } else {
        return false;
    }
}
$mail = new PHPMailer();
  $output = '';

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    //$subject = $_POST['subject'];
    //$message = $_POST['message'];

    try {
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->SMTPSecure = 'ssl';
          $mail->Host = 'ssl://smtp.gmail.com';

      // Gmail ID which you want to use as SMTP server
      $mail->Username = 'ncccanteenguntur@gmail.com';
      // Gmail Password
      $mail->Password = 'ncc169@vignan';
      $mail->Port ='465';
      //$mail->SMTPDebug = 3;
      // Email ID from which you want to send the email
      $mail->setFrom('ncccanteenguntur@gmail.com','test dietsuggesto');
      // Recipient Email ID where you want to receive emails
      $mail->addAddress('geethamohanapriyapuli@gmail.com');

      $mail->isHTML(true);
      $mail->Subject = 'Booking appointment';
      $mail->Body = "<h3>Hello $username thanks for consulting DietSuggesto<br>with mail : $email <br>Booked date : $date<br>Booked time:$time</h3><h2>your appointement is booked on $date at $time</h2>";

      $mail->send();
      $output = '<div class="alert alert-success">
                  <h5>Thankyou! for contacting us, We\'ll get back to you soon!</h5>
                </div>';
    } catch (Exception $e) {
      $output = '<div class="alert alert-danger">
                  <h5>' . $e->getMessage() . '</h5>
                </div>';
    }
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">

  <!--<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css' />-->
</head>

<body class="bg-info">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 mt-3">
        <div class="card border-danger shadow">
          <div class="card-header bg-danger text-light">
            <h3 class="card-title">Book Appointement</h3>
          </div>
          <div class="card-body px-4">
            <form action="#" method="POST">
              <div class="form-group">
                <?= $output; ?>
              </div>
              <div class="form-group">
                <input type="text" name="username" id="username" class="form-control" placeholder="Enter username" required>
              </div>
              <div class="form-group">
                <input type="text" name="email" id="email" class="form-control" placeholder="Enter email" required>
              </div>
              <div class="form-group">
                <input type="date" name="date" id="date" class="form-control" 
                  required>
              </div>
              <div class="form-group">
                <input type="time" name="time" id="time" class="form-control" 
                  required>
              </div>
              <div class="form-group">
                <input type="submit" name="submit" value="Book" class="btn btn-danger btn-block" id="sendBtn">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>