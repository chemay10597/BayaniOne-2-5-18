<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

    include_once("header.php");
    //session_start();
    if(!isset($_SESSION["username"])){
        header("location:index.php");
    } else {
      $var_valueuser = $_REQUEST['user_id'];
      $var_valueaccount_type = $_REQUEST['account_type'];
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
            //code to get the account_type of the login user
            $connect=mysqli_connect("localhost","root","","bayanion_db");
            // Check connection
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $result = mysqli_query($connect,"SELECT account_type FROM users WHERE username = '".$_SESSION['username']."'");
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<input type=hidden name='account_type' id='account_type' value =" . $row['account_type']. ">";
            }
            mysqli_close($connect);
          ?>
          <?php
          //code to get login user info for individual_user
          $connect=mysqli_connect("localhost","root","","bayanion_db");
          // Check connection
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $var_valueuser = $_REQUEST['user_id'];
          //code to get the login user info based on account_type (individual user)
          if($account_type='individual')
          {
            $result = mysqli_query($connect,"SELECT * FROM users INNER JOIN individual_user ON users.user_id=individual_user.user_id INNER JOIN address ON users.address_id=address.address_id WHERE user_id=$var_valueuser");
            while($row = mysqli_fetch_assoc($result))
              {
                echo "<div>";
                  echo "<table>";
                    echo "<tbody>";
                      echo "<form action='' method='post'>";
                        echo "<tr>";
                          echo "<td>";
                            echo "<input type='hidden' name='user_id' id='user_id' value =" . $row['user_id']. ">";
                            echo "<input type='hidden' name='iu_id' id='iu_id' value =" . $row['iu_id']. ">";
                            echo "<input type='hidden' name='address_id' id='address_id' value =" . $row['address_id']. ">";
                            echo "<img src='Uploads/",$row['user_photo'],"' width='175' height='200' />";
                          echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'User Full Name:' . "</td>";
                          echo "<td>";
                            echo "<input type='text' id='first_name' name='first_name' value=". $row['first_name'] .">";
                            echo "</br>";
                            echo "<input type='text' id='middle_name' name='middle_name' value=". $row['middle_name'] .">";
                            echo "</br>";
                            echo "<input type='text' id='last_name' name='last_name' value=". $row['last_name'] .">";
                          echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Birthday:' . "</td>";
                          echo "<td>" . "<input type='text' id='birthdate' name='birthdate' value=". $row['birthdate'] .">" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Residential Address:' . "</td>";
                          echo "<td>" . "<input type='text' id='street' name='street' value=". $row['street'] ." >";
                          echo "<input type='text' id='barangay' name='barangay' value=". $row['barangay'] ." >";
                          echo "<input type='text' id='city' name='city' value=". $row['city'] ." >";
                          echo "<input type='text' id='zip_code' name='zip_code' value=". $row['zip_code'] ." >";
                          echo "<input type='text' id='province' name='province' value=". $row['province'] ." >";
                          echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Gender:' . "</td>";
                          echo "<td>" . "<input type='text' id='gender' name='gender' value=". $row['gender'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Email:' . "</td>";
                          echo "<td>" . "<input type='text' id='email_address' name='email_address' placeholder='user@domain.com' value=". $row['email_address'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Mobile No:' . "</td>";
                          echo "<td>" . "<input type='text' id='mobile_no' name='mobile_no' value=". $row['mobile_no'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Telephone:' . "</td>";
                          echo "<td>" . "<input type='text' id='telephone_no' name='telephone_no' value=". $row['telephone_no'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Username:' . "</td>";
                          echo "<td>" . "<input type='text' name='username' id='username' value =" . $row['username']. ">" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Password:' . "</td>";
                          echo "<td>" . "<input type='text' name='password' id='password' value =" . $row['password']. ">" . "</td>";
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
            }
            mysqli_close($connect);
          ?>

          <?php include 'databaseconn.php' ?>
          <?php
            if (isset($_POST['updateind'])) {
            $user_id = $_POST['user_id'];
            $org_id = $_POST['org_id'];
            $address_id = $_POST['address_id'];
            $first_name = $_POST['first_name'];
            $middle_name = $_POST['middle_name'];
            $last_name = $_POST['last_name'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $street = $_POST['street'];
            $barangay = $_POST['barangay'];
            $city = $_POST['city'];
            $zip_code = $_POST['zip_code'];
            $province = $_POST['province'];
            $email_address = $_POST['email_address'];
            $mobile_no = $_POST['mobile_no'];
            $telephone_no = $_POST['telephone_no'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            mysqli_query($connect, "UPDATE users SET email_address='$email_address', mobile_no='$mobile_no', telephone_no='$telephone_no', username='$username', password='$password' WHERE user_id=$user_id");
            mysqli_query($connect, "UPDATE individual_user SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', birthdate='$birthdate', gender='$gender' WHERE iu_id=$iu_id");
            mysqli_query($connect, "UPDATE address SET street='$street', barangay='$barangay', city='$city', zip_code='$zip_code', province='$province' WHERE address_id=$address_id");
            if(mysqli_affected_rows($connect) > 0){
              echo "Successfully Update!";
            }else {
              echo mysqli_error($connect);
             }
            echo "<meta http-equiv='refresh' content='0'>";
            }
          ?>

          <?php
            //code to get login user info for organization_user
            $connect=mysqli_connect("localhost","root","","bayanion_db");
            // Check connection
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $var_valueuser = $_REQUEST['user_id'];
            //code to get the login user info based on account_type (organization user)
            if($account_type='organization')
            {
              $result = mysqli_query($connect,"SELECT * FROM users INNER JOIN organization_user ON users.user_id=organization_user.user_id INNER JOIN address ON users.address_id=address.address_id");
              while($row = mysqli_fetch_assoc($result))
              {
                echo "<div>";
                  echo "<table>";
                    echo "<tbody>";
                      echo "<form action='home.php' method='post'>";
                        echo "<tr>";
                          echo "<td>";
                            echo "<input type='hidden' name='user_id' id='user_id' value =" . $row['user_id']. ">";
                            echo "<input type='hidden' name='org_id' id='iu_id' value =" . $row['org_id']. ">";
                            echo "<input type='hidden' name='address_id' id='address_id' value =" . $row['address_id']. ">";
                            echo "<img src='Uploads/",$row['user_photo'],"' width='175' height='200' />";
                          echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'User Full Name:' . "</td>";
                          echo "<td>" . "<input type='text' id='org_name' name='org_name' value=". $row['org_name'] .">" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Representative Name:' . "</td>";
                          echo "<td>" . "<input type='text' id='rep_name' name='rep_name' value=".$row['rep_name'] .">" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<td>" . 'Residential Address:' . "</td>";
                        echo "<td>" . "<input type='text' id='street' name='street' value=". $row['street'] ." >";
                        echo "<input type='text' id='barangay' name='barangay' value=". $row['barangay'] ." >";
                        echo "<input type='text' id='city' name='city' value=". $row['city'] ." >";
                        echo "<input type='text' id='zip_code' name='zip_code' value=". $row['zip_code'] ." >";
                        echo "<input type='text' id='province' name='province' value=". $row['province'] ." >";
                        echo "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Email:' . "</td>";
                          echo "<td>" . "<input type='text' id='email_address' name='email_address' value=". $row['email_address'] .">" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Mobile No:' . "</td>";
                          echo "<td>" . "<input type='text' id='mobile_no' name='mobile_no' value=". $row['mobile_no'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Telephone:' . "</td>";
                          echo "<td>" . "<input type='text' id='telephone_no' name='telephone_no' value=". $row['telephone_no'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Username:' . "</td>";
                          echo "<td>" . "<input type='text' id='username' name='username' value=". $row['username'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          echo "<td>" . 'Password:' . "</td>";
                          echo "<td>" . "<input type='text' id='password' name='pasword' value=". $row['password'] ." >" . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                          //echo "<td>" . "<input type='submit' id='editorg' name='editorg' value='edit'>" . "</td>";
                          echo "<td>" . "<input type='submit' id='updateorg' name='updateorg' value='update'>" . "</td>";
                        echo "</tr>";
                      echo "</form>";
                    echo "</tbody>";
                  echo "</table>";
                echo "</div>";
              }
            }
            mysqli_close($connect);
          ?>
          <?php include 'databaseconn.php' ?>
          <?php
            if (isset($_POST['updateorg'])) {
              $user_id = $_POST['user_id'];
              $org_id = $_POST['org_id'];
              $address_id = $_POST['address_id'];
              $org_name = $_POST['org_name'];
              $rep_name = $_POST['rep_name'];
              $street = $_POST['street'];
              $barangay = $_POST['barangay'];
              $city = $_POST['city'];
              $zip_code = $_POST['zip_code'];
              $province = $_POST['province'];
              $email_address = $_POST['email_address'];
              $mobile_no = $_POST['mobile_no'];
              $telephone_no = $_POST['telephone_no'];
              $username = $_POST['username'];
              $password = $_POST['password'];
              mysqli_query($connect, "UPDATE users SET residential_address='$residential_address', email_address='$email_address', username='$username', password='$password' WHERE user_id=$user_id");
              mysqli_query($connect, "UPDATE organization_user SET org_name='$org_name', rep_name='$rep_name' WHERE org_id=$org_id");
              mysqli_query($connect, "UPDATE address SET street='$street', barangay='$barangay', city='$city', zip_code='$zip_code', province='$province' WHERE address_id=$address_id");
              if(mysqli_affected_rows($connect) > 0){
                echo "Successfully Update!";
              }else {
                echo mysqli_error($connect);
              }
            echo "<meta http-equiv='refresh' content='0'>";
            }
          ?>
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
