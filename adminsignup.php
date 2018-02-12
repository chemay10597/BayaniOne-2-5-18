<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    include_once("header.php");
    if(!isset($_SESSION["username"])){
        header("location:index.php");
    } else {
?>
<?php include 'databaseconn.php' ?>
  <body>
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
                <input class="form-control" name="datainput" type="text" style="width:100%; position:bottom;" placeholder="Search for...">
                <input style="width:0;height:0;display: none;" class="btnlogin" type="submit" value="Search" name="search" />
              </form>
              <li>
                <div class="dropdown">
                   <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><img height="30px" weight="30px" src="images/notif.png" /></button>
                  <div class="dropdown-content" style="height-max:500px;overflow:auto;" id="nav">
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

                      $resultgroup = mysqli_query($connect,"SELECT group_name FROM groups INNER JOIN users ON groups.user_id=users.user_id WHERE username='". $_SESSION["username"] ."'");
                        while($rowgroup = mysqli_fetch_array($resultgroup))
                        {
                          echo "<a href='groupprofile.php'>". $rowgroup['group_name'] ."</a>";
                        }
                      mysqli_close($connect);
                    ?>
                  </div>
              </li>
              <li>
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
                      <?php
                      //code to get login user info for individual_user
                      $connect=mysqli_connect("localhost","root","","bayanion_db");
                      // Check connection
                      if (mysqli_connect_errno())
                      {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                      }
                      //code to get the login user info based on account_type (individual user)
                        $result = mysqli_query($connect,"SELECT * FROM users WHERE username = '".$_SESSION['username']."'");
                        while($row = mysqli_fetch_assoc($result))
                          {
                            if($row['account_type'] == "admin") {
                            echo "<a href='adminsignup.php'>".'Add admin'."</a>";
                            echo "<a href='reports.php'>".'View Reports'."</a>";
                            }
                          }
                        mysqli_close($connect);
                      ?>
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

  <section id="goodwork" class="section-padding" style="background-color:#b3b3b3;">
    <div class="main">
      <div class="header" >
        <h1>Register New Admin</h1>
      </div>
      <p>We make a living by what we get, but we make a life by what we give.</p>
      <form class="modal-content animate" id="UserFormReg" name="UserFormReg" action="" method="post">
        <fieldset class="left-form">
          <h2>Personal Information:</h2>
          </br></br></br>
            <?php
              //code to get user_id
              $connect=mysqli_connect("localhost","root","","bayanion_db");
              // Check connection
              if (mysqli_connect_errno())
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
              $result = mysqli_query($connect,"SELECT MAX(user_id) FROM users GROUP BY user_id");
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  $next = $row['MAX(user_id)'] + 1;
                }
                  echo "<input value='". $next ."' type='hidden' name='user_id' id='user_id'>";
                  echo "</input>";
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
            <input id="account_type" name="account_type" type="hidden" value="admin"/>
            <div id="individual_user">
              <ul>
                <li>
                  <input id="admin_firstname" name="admin_firstname" type="text" placeholder="first name ..."/>
                  <a href="#" class="icon into"></a>
                  <div class="clear"> </div>
                </li>
                <li>
                  <input id="admin_middlename" name="admin_middlename" type="text"   placeholder="middle name ..."/>
                  <a href="#" class="icon into"> </a>
                  <div class="clear"> </div>
                </li>
                  <li>
                    <input id="admin_lastname" name="admin_lastname" type="text"   placeholder="last name ..."/>
                    <a href="#" class="icon into"> </a>
                    <div class="clear"> </div>
                  </li>
                  <li>
                    <input id="admin_birthdate" name="admin_birthdate" style="border:0; height:45px;width:400px;" type="date"/>
                    <a href="#" class="icon into"> </a>
                    <div class="clear"> </div>
                  </li>
                  <li>
                    <label>Gender:</label><i>&nbsp &nbsp</i>
                    <select class="input" runat="server" id="admin_gender" name="admin_gender" value="" style="border:0;" Height="22px" Width="187px"required>
                      <option value="">choose gender ..</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                    <a href="#" class="icon into"> </a>
                    <div class="clear"> </div>
                  </li>
                </ul>
              </div>
            <li>
              <input type="text" id="street" name="street" placeholder="Street ..." required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
            <li>
              <input type="text" id="barangay" name="barangay" placeholder="Barangay ..." required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
            <li>
              <input type="text" id="city" name="city" placeholder="City ..." required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
            <li>
              <input type="text" id="zip_code" name="zip_code" placeholder="Zip Code ..." required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
            <li>
              <input type="text" id="province" name="province" placeholder="Province ..." required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
            <li>
              <input type="text" id="mobile_no" name="mobile_no" placeholder="Mobile No ..." required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
            <li>
              <input type="text" id="telephone_no" name="telephone_no" placeholder="Telephone No ..." required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
            <li>
              <input id="email_address" name="email_address" type="email" placeholder="user@domain.com" required/>
              <a href="#" class="icon into"> </a>
              <div class="clear"> </div>
            </li>
        </fieldset>
        <ul class="right-form">
          <h3>Login Information:</h3>
          <div>
            <li>
              <center><img id="user_image" name="user_image" runat="server" height="150" width="150"/></center>
            </br>
              <center><input type="file" id="user_photo" name="user_photo" accept="image/*" onchange="readURL(this);" required/></center>
              <!-- script to display image on select -->
              <script>
                //script code to display photo during selection
                function readURL(input) {
                  if (input.files && input.files[0]) {
                      var reader = new FileReader();
                      reader.onload = function (e) {
                            $('#user_image')
                            .attr('src', e.target.result)
                            .width(150)
                            height(150);
                      };
                      reader.readAsDataURL(input.files[0]);
                  }
                }
              </script>
            </li>
              <li>
                <input id="username" name="username" type="text" placeholder="username ..." required/>
                <a href="#" class="icon into"> </a>
                <div class="clear"> </div>
              </li>
              <li>
                <input id="password" name="password" type="password" placeholder="password ..." required/>
                <a href="#" class="icon into"> </a>
                <div class="clear"> </div>
              </li>
              <li>
                <input id="confirm_password" name="confirm_password" type="password" placeholder="confirm password ..." required/>
                </br>
                <span id='message'></span>
                <script>
                  $('#password, #confirm_password').on('keyup', function () {
                    if ($('#password').val() == $('#confirm_password').val()) {
                      $('#message').html('Password Matched').css('color', '#669999');
                    } else
                      $('#message').html('Not Matched').css('color', 'red');
                  });
                </script>
                <a href="#" class="icon into"> </a>
                <div class="clear"> </div>
              </li>
                <button type="submit" class="signupbtn" height="59px"width="341px" id="registerUser" name="registerUser" >Sign Up</button>
            </div>
            <div class="clear"> </div>
          </ul>
          <div class="clear"> </div>
        </form>
      </div>
     </section>

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
        <?php include 'databaseconn.php' ?>
        <?php
          //code to insert records in users table, individual_user table, and organization_user table
          if(isset($_POST['registerUser']))
          {
            $user_id = $_POST['user_id'];
            $address_id = $_POST['address_id'];
            $account_type = $_POST['account_type'];
            $email_address = $_POST['email_address'];
            $user_photo = $_POST['user_photo'];
            $mobile_no = $_POST['mobile_no'];
            $telephone_no = $_POST['telephone_no'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $street = $_POST['street'];
            $barangay = $_POST['barangay'];
            $city = $_POST['city'];
            $zip_code = $_POST['zip_code'];
            $province = $_POST['province'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $middle_name = $_POST['middle_name'];
            $birthdate = $_POST['birthdate'];
            $gender = $_POST['gender'];
            $org_name = $_POST['org_name'];
            $rep_name = $_POST['rep_name'];

            if(isset($_FILES['user_photo'])) {
              $user_photo=addslashes(file_get_contents($_FILES['user_photo']['tmp_name'])); //will store the image to fp
            }

            //query to insert data
              mysqli_query($connect, "INSERT INTO users (address_id,account_type,user_photo,email_address,mobile_no,telephone_no,username,password)
                          VALUES('$address_id','$account_type','$user_photo','$email_address','$mobile_no','$telephone_no','$username','$password')");
                                if(mysqli_affected_rows($connect) > 0){
                                }else {
                                  echo mysqli_error($connect);
                                  echo "Not Added!";
                                }

                                mysqli_query($connect, "INSERT INTO address (street,barangay,city,zip_code,province)
                                            VALUES('$street','$barangay','$city','$zip_code','$province')");
                                                if(mysqli_affected_rows($connect) > 0){
                                                }else {
                                                  echo mysqli_error($connect);
                                                  echo "Not Added!";
                                                  }
              mysqli_query($connect, "INSERT INTO admin (user_id,admin_firstname,admin_middlename,admin_lastname,admin_birthdate,admin_gender)
                          VALUES('$user_id','$admin_firstname','$admin_middlename','$admin_lastname','$admin_birthdate','$admin_gender')");
                              if(mysqli_affected_rows($connect) > 0){
                              }else {
                                echo mysqli_error($connect);
                                echo "Not Added!";
                                }
                                echo "<meta http-equiv='refresh' content='0'>";
              }
        ?>
      </body>
    <?php } ?>
</html>
