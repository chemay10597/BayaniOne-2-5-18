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
              <!-- <a class="navbar-brand" href="index.html">BayaniOne<span>.</span></a> -->
              </div>

              <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav navbar-right">
                  <form action="search.php" method="GET" style="height:40px;">
                    <input class="form-control" name="datainput" type="text" style="width:100%; position:bottom;" placeholder="Search users, posts, groups...">
                    <input style="width:0;height:0;display: none;" class="btnlogin" type="submit" value="Search" name="search" />
                  </form>
                  <li>
                    <a href= "notification.php">
                        <img src="images/notif.png" width="30px" height="30px" />
                    </a>
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
          <div class="createtestimony" style="height:500px;">
            </br>
            <form id="create_testimonies" name="create_testimonies" action="" method="post">
              <h2>Post Testimonies</h2>
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

                  $result = mysqli_query($connect,"SELECT user_id FROM users WHERE username = '".$_SESSION['username']."'");
                  while($row = mysqli_fetch_assoc($result))
                  {
                    echo "<input type='hidden' name='user_id' id='user_id' value =" . $row['user_id']. ">";
                  }
                  mysqli_close($connect);
                ?>
              </br>
              <input type="hidden" id="post_type" name="post_type" value="testimony"/>
              <select class="input" id="post_status" name="post_status" value="" Height="22px" Width="187px" requireds>
                  <option value="">where to post?</option>
                  <option value="public">Public</option>
                  <option value="timeline">Timeline</option>
              </select>
              <input type="hidden" id="create_date" name="create_date"/>
              <?php
              //code to get the user_id that is used in inserting record in post table
                $connect=mysqli_connect("localhost","root","","bayanion_db");
                // Check connection
                if (mysqli_connect_errno())
                {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                $result = mysqli_query($connect,"SELECT username FROM users");
                echo "<select name='tag_user' id='tag_user' value=''>";
                echo "<option value =''>" .'choose username..'. "</option>";
                while($row = mysqli_fetch_assoc($result))
                  {
                    echo "<option value =" . $row['username']. ">" .$row['username']. "</option>";
                  }
                  echo "<select>";
                mysqli_close($connect);
              ?>
              </br>
              </br>
              <textarea name="testimony" rows="7" cols="64" style="text-align:left;resize:none;" placeholder=".........Write Something........"></textarea>
              <input class="btnlogin" type="submit" id="post_testimonies" name="post_testimonies" value="Post"/>
            </fieldset>
            </form>

            <?php include 'databaseconn.php' ?>
            <?php
              //code to insert record in post table
              if(isset($_POST['post_testimonies']))
              {
                //variables
                $user_id = $_POST['user_id'];
                $post_status = $_POST['post_status'];
                $testimony = $_POST['testimony'];
                $create_date= $_POST['create_date'];
                $tag_user = $_POST['tag_user'];

                //query to insert data
                if($post_status!='')
                {
                mysqli_query($connect, "INSERT INTO testimonies (user_id,post_status,testimony,create_date,tag_user)
                            VALUES('$user_id','$post_status','$testimony',NOW(),'$tag_user')");
                            if(mysqli_affected_rows($connect) > 0){
                          }else {
                            echo mysqli_error($connect);
                            echo "Not Added!";
                          }
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