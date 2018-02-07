<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

    include_once("header.php");
    //session_start();
    if(!isset($_SESSION["username"])){
        header("location:index.php");
    } else {
?>
<?php include 'databaseconn.php' ?>

  <body style="background-color:#b3b3b3;">
      <div>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class = "navbar-brand" href="home.php"><span><image src = "../images/logo.png" height= "50px" width="50px"></span><span><image src = "../images/logotext.png" id="logotext" height= "50px" width="200px"></span></a>
              </div>

              <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav navbar-right">
                  <form action="search.php" method="GET" style="height:40px;">
                    <input class="form-control" name="datainput" type="text" style="width:100%; position:bottom;" placeholder="Search users, posts, groups...">
                    <input style="width:0;height:0;display: none;" class="btnlogin" type="submit" value="Search" name="search" />
                  </form>
                  <li>
                    <div class="dropdown">
                  			   <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><img height="30px" weight="30px" src="images/notif.png" /></button>
                      <div class="dropdown-content" style="height:500px; overflow:auto;" id="nav">
                      <?php if(isset($message)) { ?> <div class="error"><?php echo $message; ?></div> <?php } ?>
                    	<?php if(isset($success)) { ?> <div class="success"><?php echo $success;?></div> <?php } ?>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown">
                      <button class="dropbtn">Delivery Courier</button>
                      <div class="dropdown-content" id="nav">
                        <a href="http://www.air21.com.ph/main/">AIR21</a>
                        <a href="https://express.2go.com.ph/">2GO Express</a>
                        <a href="http://www.lbcexpress.com/">LBC Express</a>
                        <a href="http://new.xend.com.ph/">Xend Business Solutions</a>
                        <a href="http://www.jrs-express.com/">JRS Express</a>
                        <a href="http://abestexpress.com/">ABest Express</a>
                        <a href="http://www.dhl.com.ph/en.html">DHL Express</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <a href= "viewmap.php">View Map</a>
                  </li>
                  <li>
                    <div class="dropdown">
                      <button class="dropbtn">Community Updates</button>
                      <div class="dropdown-content" id="nav">
                        <a href="publicupdate.php">Public Update</a>
                        <a href="privateupdate.php">Private Update</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <!--<a href="#mygroup">My Group</a>-->
                    <div class="dropdown">
                      <button class="dropbtn">My Group</button>
                      <div class="dropdown-content" id="nav">
                        <a href="creategroup.php">Create Group</a>
                        <?php
                        //code to get the user_id that is used in inserting record in post table
                          $connect=mysqli_connect("localhost","root","","bayanion_db");
                          // Check connection
                          if (mysqli_connect_errno())
                          {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                          }

                          $result = mysqli_query($connect,"SELECT group_name FROM groups INNER JOIN users ON groups.user_id=users.user_id WHERE username='". $_SESSION["username"] ."'");
                            while($row = mysqli_fetch_array($result))
                            {
                              echo "<a href='groupprofile.php'>". $row['group_name'] ."</a>";
                            }
                          mysqli_close($connect);
                        ?>
                      </div>
                  </li>
                  <li>
                    <!--<a href= "#posts">Post</a>-->
                    <div class="dropdown">
                      <button class="dropbtn">Post</button>
                      <div class="dropdown-content" id="nav">
                        <a href="donationcampaign.php">DonationCampaign</a>
                        <a href="testimonies.php">Testimonies</a>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="dropdown">
                      <button class="dropbtn">
                        <?php
                        //code to get the user_id that is used in inserting record in post table
                          $connect=mysqli_connect("localhost","root","","bayanion_db");
                          // Check connection
                          if (mysqli_connect_errno())
                          {
                            echo "Failed to connect to MySQL: " . mysqli_connect_error();
                          }

                          $result = mysqli_query($connect,"SELECT username FROM users WHERE username='". $_SESSION["username"] ."'");
                            while($row = mysqli_fetch_array($result))
                            {
                              echo $row['username'];
                            }
                          mysqli_close($connect);
                        ?>

                      </button>
                        <div class="dropdown-content" id="nav">
                          <a href="userinfo.php">AccountSetting</a>
                        </div>
                    </div>
                  </li>
                  <li>
                    <a class="btn-logout" href= "logout.php">Logout</a>
                  </li>
                </ul>
              </div>
            </div>
        </nav>

        <center><div class="scroll">
          </br>
          <?php
          //code to get login user info for individual_user
          $connect=mysqli_connect("localhost","root","","bayanion_db");
          // Check connection
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          //code to get the login user info based on account_type (individual user)
            $result = mysqli_query($connect,"SELECT * FROM groups INNER JOIN users ON groups.user_id=users.user_id WHERE users.username = '".$_SESSION['username']."' AND groups.group_name='squad'");
            while($row = mysqli_fetch_assoc($result))
              {
                echo "<div>";
                  echo "<table>";
                    echo "<tbody>";
                      echo "<form action='' method='post'>";
                        echo "<tr>";
                          echo "<td>";
                            echo "<input type='hidden' name='group_id' id='group_id' value =" . $row['group_id']. ">";
                            echo "<img src='Uploads/",$row['group_logo'],"' width='175' height='200' />";
                          echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Group Name:' . "</td>";
                          echo "<td>" . "<input type='text' id='group_name' name='group_name' value=". $row['group_name'] .">";
                          echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Group Description:' . "</td>";
                          echo "<td>" . "<textarea rows='3' cols='50' style='text-align:left;resize:none;' id='group_description' name='group_description'>" .$row['group_description']. "</textarea>" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Admin:' . "</td>";
                          echo "<td>" . "<input type='text' id='admin' name='admin' value=". $row['admin'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Members:' . "</td>";
                          echo "<td>" . "<input type='text' id='members' name='members' value=". $row['members'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Since:' . "</td>";
                          echo "<td>" . "<input type='text' name='create_date' id='create_date' value =" . $row['create_date']. ">" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          //echo "<td>" . "<input type='submit' id='editind' name='editind' value='Edit'>" . "</td>";
                          echo "<td>" . "<input type='submit' id='updateind' name='updateind' value='Update'>" . "</td>";
                        echo "</tr>";
                      echo "</form>";
                    echo "</tbody>";
                  echo "</table>";
                echo "</div>";
              }
            mysqli_close($connect);
          ?>
        </br>
          <?php include 'databaseconn.php' ?>
          <?php
            if (isset($_POST['updateind'])) {
            $group_id = $_POST['group_id'];
            $group_name = $_POST['group_name'];
            $group_description = $_POST['group_description'];
            $admin = $_POST['admin'];
            $members = $_POST['members'];
            mysqli_query($connect, "UPDATE groups SET group_name='$group_name', group_description='$group_description', admin='$admin', members='$members' WHERE group_id=$group_id");
            if(mysqli_affected_rows($connect) > 0){
              echo "Successfully Update!";
            }else {
              echo mysqli_error($connect);
             }
            echo "<meta http-equiv='refresh' content='0'>";
            }
          ?>

          <div class="createactivity">
            </br>
            <form id="create_activity" name="create_activity" action="" method="post">
              <h2>Post Activity</h2>
              </br>
              <fieldset>
                <?php
                //code to get the user_id that is used in inserting record in post table
                  $connect=mysqli_connect("localhost","root","","bayanion_db");
                  // Check connection
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }

                  $result = mysqli_query($connect,"SELECT group_id FROM groups WHERE group_name = 'squad'");
                  while($row = mysqli_fetch_assoc($result))
                  {
                    echo "<input type='hidden' name='group_id' id='group_id' value =" . $row['group_id']. ">";
                  }
                  mysqli_close($connect);
                ?>
                <?php
                //code to get the user_id that is used in inserting record in post table
                  $connect=mysqli_connect("localhost","root","","bayanion_db");
                  // Check connection
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }

                  $result = mysqli_query($connect,"SELECT user_id FROM users WHERE username = '".$_SESSION['username']."'");
                  while($row = mysqli_fetch_assoc($result))
                  {
                    echo "<input type='hidden' name='user_id' id='user_id' value =" . $row['user_id']. ">";
                  }
                  mysqli_close($connect);
                ?>
                <?php
                  //code to get user_id
                  $connect=mysqli_connect("localhost","root","","bayanion_db");
                  // Check connection
                  if (mysqli_connect_errno())
                  {
                    echo "Failed to connect to MySQL: " . mysqli_connect_error();
                  }
                  $result = mysqli_query($connect,"SELECT MAX(address_id) FROM address GROUP BY address_id");
                  if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){
                      $next = $row['MAX(address_id)'] + 1;
                    }
                      echo "<input value='". $next ."' type='hidden' name='address_id' id='address_id'>";
                      echo "</input>";
                  }
                  mysqli_close($connect);
                ?>
              </br>
              <select class="input" id="post_status" name="post_status" value="" Height="22px" Width="187px" requireds>
                  <option value="">where to post?</option>
                  <option value="public">Public</option>
                  <option value="timeline">Timeline</option>
              </select>
              <input type="hidden" id="create_date" name="create_date"/>
              <input type="text" id="act_title" name="act_title" placeholder="Activity Title" style="width:500px;"/>
              </br></br>
              <label>Start @</label>
              <input type="datetime-local" id="act_start" name="act_start"/>
              <label>End @</label>
              <input type="datetime-local" id="act_end" name="act_end"/>
              </br>
              </br>
              <label>Location</label>
              </br>
              <input type="text" id="street" name="street" placeholder="Street"/>
              <input type="text" id="barangay" name="barangay" placeholder="Barangay"/>
              <input type="text" id="city" name="city" placeholder="City"/>
              <input type="text" id="zip_code" name="zip_code" placeholder="Zip Code"/>
              <input type="text" id="province" name="province" placeholder="Province"/>
              </br></br>
              <input class="btnlogin" type="submit" id="post_activity" name="post_activity" value="Post"/>
            </fieldset>
            </form>

            <?php include 'databaseconn.php' ?>
            <?php
              //code to insert record in post table
              if(isset($_POST['post_activity']))
              {
                //variables
                $group_id = $_POST['group_id'];
                $user_id = $_POST['user_id'];
                $address_id = $_POST['address_id'];
                $act_title = $_POST['act_title'];
                $act_start = $_POST['act_start'];
                $act_end = $_POST['act_end'];
                $create_date = $_POST['create_date'];
                $post_status = $_POST['post_status'];
                $street = $_POST['street'];
                $barangay = $_POST['barangay'];
                $city = $_POST['city'];
                $zip_code = $_POST['zip_code'];
                $province = $_POST['province'];

                //query to insert data
                mysqli_query($connect, "INSERT INTO activities (group_id,user_id,address_id,act_title,act_start,act_end,create_date,post_status)
                            VALUES('$group_id','$user_id','$address_id','$act_title','$act_start','$act_end',NOW(),'$post_status')");
                            if(mysqli_affected_rows($connect) > 0){
                          }else {
                            echo mysqli_error($connect);
                            echo "Not Added!";
                          }
                          mysqli_query($connect, "INSERT INTO address (address_id,street,barangay,city,zip_code,province)
                                      VALUES('$address_id','$street','$barangay','$city','$zip_code','$province')");
                                      if(mysqli_affected_rows($connect) > 0){
                                    }else {
                                      echo mysqli_error($connect);
                                      echo "Not Added!";
                                    }
              }
            ?>
          </div>
        </br>
        </div></center>
      </div>
    </div>
    <footer id="myFooter">
      <center>
      <div class="container">
        <div class="row">
          <ul>
              <li><a href="#">Privacy Policy</a></li>
              <li><a href="#">FAQ</a></li>
              <li><a href="#">About Us</a></li>
            </ul>
          </div>
        </div>
        </center>
        <div class="footer-copyright">
            <p>© 2017 BayaniOne </p>
        </div>
    </footer>
    <script src="../jquery/jquery.min.js"></script>
    <script src="../jquery/bootstrap.min.js"></script>
</body>
<?php } ?>
</html>
