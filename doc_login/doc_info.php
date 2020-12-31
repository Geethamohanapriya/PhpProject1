<?php include "db.php"; ?>
    
    <!-- Navigation -->

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 
                    $con=mysqli_connect("localhost:3308", "root", "","loginsystem");

                    if(isset($_GET['username'])) {
                        $selected_doc = $_GET['username'];
                    }
                    
                    $query = "SELECT *  FROM  doctors WHERE username = $username ";

                    $select_all_doc_query = mysqli_query($con,$query);

                    while($row = mysqli_fetch_assoc($select_all_doc_query)) {
                        $username = $row['username'];
                        $email = $row['email'];
                        $gender = $row['gender'];
                        $mobile = $row['mobile'];
                        $address = $row['address'];
                        $yoe = $row['yoe'];
                        $img = $row['img'];
                  
                        ?>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="samp.php?id=<?php echo $id; ?>"></a>
                        </h2>
                                                <hr>
                        <img class="img-responsive" src="images/<?php echo $img; ?>" alt="">

                        <hr>
                        <p><?php echo $username ?></p>
                        
                        <div class="jumbotron jumb">
                            <h2><b>Details:</b></h2>
                            <h5>Years of experience:         <?php echo $yoe ?></h5>
                            <h5>Address:   <?php echo $address?></h5>
                            <h5>E-mail:   <?php echo $email?></h5>
                            <h5>Gender:   <?php echo $gender?></h5>


                        
                        </div>


                        <?php

                        if (isset($_SESSION['id'])) {
                            # code...

                        ?>


                        <div class="jumbotron">
                            <div class="container-fluid">
                                <h2>Enter Details:</h2>

                                <form action="" method="post" class="form-horizontal">

                                    <select>
                                        <option>
                                        <input type="time" name="time">Select time
                                        </option>
                                    </select>
                                    <button class="btn-xs btn-primary" style="margin-left: 5px;">GO</button>

                                </form>

                                <form action="bus_info.php?bus_id=<?php echo $selected_bus ?>&count=<?php echo $_POST['passenger_count'] ?>" method="post" class="form-horizontal">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">Source:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" placeholder="Source" name="source">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">Destination:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" placeholder="Destination" name="destination">
                                        </div>
                                    </div>

                                <?php

                                if (isset($_POST['passenger_count'])) {
                                    $count = $_POST['passenger_count'];
                                    //echo "<h1>$count</h1>";

                                    for ($i=0; $i < $count; $i++) { 

                                        ?>
                                        <h6><?php echo "Passenger "; echo $i+1;?></h6>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Name:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" placeholder="Name" name="name<?php echo "$i" ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Age:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="email" placeholder="Age" name="age<?php echo "$i" ?>">
                                            </div>
                                        </div>
                                        <?php
                                    }

                                }

                                ?>

                                <button class="btn btn-primary" name="book" style="margin-left: 40%; margin-top: 15px;">Book online appointment</button>
                                <button class="btn btn-primary" name="book" style="margin-left: 40%; margin-top: 15px;">Book direct appointment</button>
                                <button class="btn btn-primary" name="book" style="margin-left: 40%; margin-top: 15px;">Follow up (running case)</button>

                                </form>

                                
                            </div>
                        </div>
                        <?php } ?>

                        <hr>
                    <?php } ?>


                    <!-- Blog Comments -->

                <?php 

                    if (isset($_POST['submit_query'])) {
                        $user_name = ucfirst($_SESSION['s_username']) ;
                        if($user_name == "") {
                            $user_name = "(unknown)";
                        }
                        $user_email = $_POST['user_email'];
                        $user_query = $_POST['user_query'];

                        $query = "INSERT INTO query(query_bus_id, query_user, query_email, query_date, query_content, query_replied) VALUES ('$selected_bus', '$user_name', '$user_email', now(), '$user_query', 'no')";

                        $query_insert = mysqli_query($connection, $query);
                        if(!$query_insert) {
                            die("Query Failed" . mysqli_error($connection));
                        }

                        $query = "UPDATE posts SET post_query_count = post_query_count + 1 WHERE post_id = $bus_id";
                        $increase_query_count = mysqli_query($connection,$query);
                    }

                ?>



                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="samp.php?id=<?php echo $username ?>" method="post" role="form">
                        
                        <!-- <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" name="user_name"></textarea>
                        </div> -->

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email"></textarea>
                        </div>

                        <div class="form-group">
                            <label> Query</label>
                            <textarea class="form-control" rows="3" name="query"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit_query">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php 

                $query = "SELECT * FROM query WHERE query_doc_id = $id";
                $get_query = mysqli_query($connection,$query);

                while ($row = mysqli_fetch_assoc($get_query)) {
                    
                $query_user = $row['query_user'];
                $query_content = $row['query_content'];
                $query_date = $row['query_date'];

                ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"> <?php echo $query_user; ?>
                            <small><?php echo $query_date; ?></small>
                        </h4>
                        <?php echo $query_content; ?>
                    </div>
                </div>
      
                <?php } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->

        </div>
        <!-- /.row -->

        <hr>

