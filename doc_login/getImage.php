<?php

  // do some validation here to ensure id is safe

  $con=mysqli_connect("localhost:3308", "root", "","loginsystem");
  $sql = "SELECT img FROM doctors where id=21";
  $result = mysqli_query($con,$sql);
  $row = mysqli_fetch_assoc($result);

  //header("Content-type: image/jpeg"); 
  $img= $row['img'];
  echo $img;
?>
