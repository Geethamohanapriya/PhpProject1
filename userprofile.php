<html> 
    <head>
<style>
table,td {
  border: 3px solid greenyellow;
  border-collapse: collapse;
  font-size:25px;
}
a{
            display:block;
            font-weight:bold;
            color:pink;
            background:blue;
            width:95%;
            text-align:center;
            padding:4px;
        }
        a:hover{
            background:blue;
            color:blue;
        }
        a:focus{
            background:blue;
            color:blue;
        }
        a:active{
            border:3px solid blue;
        }
        body{
            background-image:url("images/demo/regbg1.jpg"); 
            height: 100%;
            margin: 0;
            height: 100%; 
            /* Center and scale the image nicely */
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;            
        }  
</style>
    </head>
    <body>
        
<?php
$username = "root";
$password = "";
$database = "loginsystem";
$mysqli = new mysqli("localhost:3308", $username, $password, $database);

$query = "SELECT * FROM users";

if ($result = $mysqli->query($query)) {

    while ($row = $result->fetch_assoc()) {
        $field1name = $row["username"];
        $field2name = $row["email"];
        $field3name = $row["gender"];
        $field4name = $row["mobile"];
        $field5name = $row["address"];
        $field6name = $row["yoe"];
        $field7name = $row["img"];
?>
        
       <table class="table table-striped" style="width: 50%" align="center">
       <tbody> 
           <tr>
               <td><b>Dietician Name:</b></td>
               <td><?php echo $field1name.'<br />';?></td>
           </tr>
           <tr>
               <td><b>Dietician E-mail ID:</b></td>
               <td><?php echo $field2name.'<br />';?></td>
           </tr>
           <tr>
               <td><b>Gender:</b></td>
               <td><?php echo $field3name.'<br />';?></td>
           </tr>
           <tr>
               <td><b>Mobile:</b></td>
               <td><?php echo $field4name.'<br />';?></td>
       
               <td>
            <a href="http://localhost/PhpProject1/booking.php">Book appointment</a>
               
           </td>
      
       
           </tr>
           <tr>
               <td><b>Location:</b></td>
               <td><?php echo $field5name.'<br />';?></td>
           </tr>
           <tr>
               <td><b>Years of experience:</b></td>
               <td><?php echo $field6name.'<br />';?></td>
           </tr>
           <tr>
               <td><b>Image:</b></td>
               <td><?php echo $field7name.'<br />';?></td>
           </tr><br><br>
       
        <?php
      

    }

/*freeresultset*/
$result->free();
}
?>
       

      <img src="getImage.php?id=21 width='50' height='50' "/>
    </body>
</html>

