<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once("header.php");

if(!isset($_SESSION["username"])){
    header("location:index.php");
} else {
  $var_valuecampaign = $_REQUEST['campaign_id'];
?>
<?php include 'databaseconn.php' ?>
  <body style="background-color: #ffffff;">
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
                    <input class="form-control" name="datainput" type="text" style="width:100%; position:bottom;" placeholder="Search for...">
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

          <?php
            //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
            $connect_campaign=mysqli_connect("localhost","root","","bayanion_db");
            // Check connection
            if (mysqli_connect_errno())
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            $var_valuecampaign = $_REQUEST['campaign_id'];
            //code to display donation posts
            $result_campaign = mysqli_query($connect_campaign,"SELECT * FROM donation_campaign INNER JOIN users ON donation_campaign.user_id=users.user_id WHERE campaign_id=$var_valuecampaign ORDER BY donation_campaign.campaign_id DESC");

            while($rowcampaign = mysqli_fetch_assoc($result_campaign))
            {
              echo "<table style='width: 600px; height: 500px; background-color: #ffffff;'>";
              echo "<center>";
                echo "<tbody>";
                  echo "<form action='home.php' method='post'>";
                    echo "<tr>";
                      echo "<td style='text-align: left; padding: 10px;'>";
                          echo "<img class='img-circle' src='Uploads/",$rowcampaign['user_photo'],"' width='50px' height='50px' />";
                          echo "</br>";
                          echo "<center>";
                        echo "<label name='username' id='username' value =" . $rowcampaign['username'] . ">". $rowcampaign['username'] ."</label>";
                          echo "</center>";
                          echo "</br>";
                      echo "</td>";
                      echo "<td style='text-align: left; padding: 10px;'>";
                      if($rowcampaign['post_status']==='timeline')
                      {
                          echo "<img src='images/user.png' width='20px' height='20px' />";
                          echo "<label >". '@' ."</label>";
                        echo "<label type='text' name='tag_user' id='tag_user' value =" . $rowcampaign['tag_user'] . ">". $rowcampaign['tag_user'] ."</label>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                      }
                        echo "<img src='images/public.png' width='20px' height='20px' />";
                        echo "<label type='text' name='post_status' id='post_status' value =" . $rowcampaign['post_status'] . ">" . $rowcampaign['post_status'] ."</label>";
                          echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                          echo "<img src='images/time.png' width='20px' height='20px' />";
                        echo "<label type='text' name='create_date' id='post_status' value =" . $rowcampaign['create_date'] . ">" . $rowcampaign['create_date'] ."</label>";
                          echo "</br>";
                          echo "</br>";
                        echo "<p>".$rowcampaign['campaign_description']."</p>";
                          echo "</br>";
                        echo "<img src='Uploads/",$rowcampaign['campaign_photo'],"' width='300px' height='250px' />";
                          echo "</br>";
                          echo "<label type='text' name='total_like' id='total_like' value =" . $rowcampaign['total_like'] . ">" . $rowcampaign['total_like'] ."</label>";
                          echo "<form id='likefrm' name='likefrm' action='' method='post'>";
                            echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $rowcampaign['campaign_id'] . ">";
                            echo "<input type=hidden id='Text1' name='Text1'>";
                            echo "<input type=hidden id='Text1' name='Text1'>";
                            echo "<button type='submit' style='border:0;background:transparent' id='like' name='like'>";
                              echo "<img src='/images/star.png' width='30px' height='30px' alt='submit'>";
                            echo "</button>";
                          echo "</form>";
                        echo "<div>";
                        //code to create comment
                            echo "<center>";
                              echo "<form id='create_comment' name='create_comment' action='' method='post' style='display:inline-block;'>";
                                echo "</br>";
                                echo "<fieldset>";
                                    echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $rowcampaign['campaign_id'] . ">";
                                    $resultcampuserid = mysqli_query($connect_campaign,"SELECT user_id FROM users WHERE username='". $_SESSION["username"] ."'");
                                    while($rowcampuserid = mysqli_fetch_assoc($resultcampuserid))
                                    {
                                    echo "<input type='hidden' name='user_id' id='user_id' value ='". $rowcampuserid["user_id"] ."'>";
                                    }
                                  echo "<textarea name='comment_content' id='comment_content' rows='1' cols='50' style='text-align:left;width:300px;resize:none;' placeholder='Write A Comment........'>" . "</textarea>";
                                  echo "<button type='submit' style='border:0;background:transparent;' id='commment_status' name='comment_status'>";
                                    echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                                  echo "</button>";
                                echo "</fieldset>";
                              echo "</form>";
                            echo "</center>";
                            //code to display comments
                            $result_comment_campaign = mysqli_query($connect_campaign,"SELECT comment_content, comment_date, username FROM post_comment INNER JOIN users ON post_comment.user_id=users.user_id WHERE campaign_id=". $rowcampaign['campaign_id']."");
                            while($rowcomcampaign = mysqli_fetch_assoc($result_comment_campaign))
                            {
                                    echo $rowcomcampaign['username'] . "&nbsp;&nbsp;";
                                    echo "(" . $rowcomcampaign['comment_date'] .  ")";
                                    echo "</br>";
                                    echo $rowcomcampaign['comment_content'];
                                    echo "</br>";
                                    echo "</br>";
                            }
                        echo "</div>";
                      echo "</td>";
                    echo "</tr>";
                  echo "</form>";
                echo "</tbody>";
                echo "</center>";
              echo "</table>";
              echo "</br>";
            }
            mysqli_close($connect_campaign);
        ?>

        <?php include 'databaseconn.php' ?>
        <?php
            //code to update like
          if (isset($_POST['like'])) {
            $campaign_id = $_POST['campaign_id'];

            mysqli_query($connect, "UPDATE donation_campaign SET total_like=total_like + 1 WHERE campaign_id=$campaign_id");
            if(mysqli_affected_rows($connect) > 0){
              echo "Successfully Update!";
            }else {
              echo mysqli_error($connect);
            }
              echo "<meta http-equiv='refresh' content='0'>";
          }
        ?>
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
