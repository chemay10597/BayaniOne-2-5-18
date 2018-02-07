<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once("header.php");

if(!isset($_SESSION["username"])){
    header("location:index.php");
} else {
  $var_valuetest = $_REQUEST['testimony_id'];
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
              <!-- <a class="navbar-brand" href="index.html">BayaniOne<span>.</span></a> -->
              </div>

              <div class="collapse navbar-collapse" id="myNavbar">

                <ul class="nav navbar-nav navbar-right">
                  <input class="form-control" type="text" style="width:100%; position:bottom;" placeholder="Search for...">
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
        <?php
          //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
          $connecttest=mysqli_connect("localhost","root","","bayanion_db");
          // Check connection
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }
          $var_valuetest = $_REQUEST['testimony_id'];
          //code to display donation posts
          $result_testimonies = mysqli_query($connecttest,"SELECT * FROM testimonies INNER JOIN users ON testimonies.user_id=users.user_id WHERE testimony_id=$var_valuetest ORDER BY testimonies.testimony_id DESC");

          while($rowtestimony = mysqli_fetch_assoc($result_testimonies))
          {
            echo "<table style='width: 600px; height: 300px; background-color: #ffffff;'>";
            echo "<center>";
              echo "<tbody>";
                echo "<form action='home.php' method='post'>";
                  echo "<tr>";
                    echo "<td style='text-align: left; padding: 10px;'>";
                        echo "<img class='img-circle' src='Uploads/",$rowtestimony['user_photo'],"' width='50px' height='50px' />";
                        echo "</br>";
                        echo "<center>";
                      echo "<label name='username' id='username' value =" . $rowtestimony['username'] . ">". $rowtestimony['username'] ."</label>";
                        echo "</center>";
                        echo "</br>";
                    echo "</td>";
                    echo "<td style='text-align: left; padding: 10px;'>";

                    if($rowtestimony['post_status']==='timeline')
                    {
                        echo "<img src='images/user.png' width='20px' height='20px' />";
                        echo "<label >". '@' ."</label>";
                      echo "<label type='text' name='tag_user' id='tag_user' value =" . $rowtestimony['tag_user'] . ">". $rowtestimony['tag_user'] ."</label>";
                      echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                      echo "<img src='images/public.png' width='20px' height='20px' />";
                      echo "<label type='text' name='post_status' id='post_status' value =" . $rowtestimony['post_status'] . ">" . $rowtestimony['post_status'] ."</label>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo "<img src='images/time.png' width='20px' height='20px' />";
                      echo "<label type='text' name='create_date' id='post_status' value =" . $rowtestimony['create_date'] . ">" . $rowtestimony['create_date'] ."</label>";
                        echo "</br>";
                        echo "</br>";
                      echo "<p>".$rowtestimony['testimony']."</p>";
                        echo "</br>";
                      //echo "<img src='Uploads/",$row['campaign_photo'],"' width='300px' height='250px' />";
                        //echo "</br>";
                        echo "<label type='text' name='total_like' id='total_like' value =" . $rowtestimony['total_like'] . ">" . $rowtestimony['total_like'] ."</label>";
                        echo "<form id='likefrm' name='likefrm' action='' method='post'>";
                          echo "<input type=hidden name='testimony_id' id='testimony_id' value =" . $rowtestimony['testimony_id'] . ">";
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
                                  echo "<input type=hidden name='testimony_id' id='testimony_id' value =" . $rowtestimony['testimony_id'] . ">";
                                  $resultuserid = mysqli_query($connecttest,"SELECT user_id FROM users WHERE username='". $_SESSION["username"] ."'");
                                  while($rowuserid = mysqli_fetch_assoc($resultuserid))
                                  {
                                  echo "<input type='hidden' name='user_id' id='user_id' value ='". $rowuserid["user_id"] ."'>";
                                  }
                                echo "<textarea name='comment_content' id='comment_content' rows='1' cols='50' style='text-align:left;width:300px;resize:none;' placeholder='Write A Comment........'>" . "</textarea>";
                                echo "<button type='submit' style='border:0;background:transparent;' id='commment_status' name='comment_status'>";
                                  echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                                echo "</button>";
                              echo "</fieldset>";
                            echo "</form>";
                          echo "</center>";
                          //code to display comments
                          $result_comment_test = mysqli_query($connecttest,"SELECT comment_content, comment_date, username FROM post_comment INNER JOIN users ON post_comment.user_id=users.user_id WHERE testimony_id=". $rowtestimony['testimony_id']."");
                          while($rowtest = mysqli_fetch_assoc($result_comment_test))
                          {
                                  echo $rowtest['username'] . "&nbsp;&nbsp;";
                                  echo "(" . $rowtest['comment_date'] .  ")";
                                  echo "</br>";
                                  echo $rowtest['comment_content'];
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
          mysqli_close($connecttest);
        ?>

        <?php include 'databaseconn.php' ?>
        <?php
          //code to update like
        if (isset($_POST['like'])) {
          $testimony_id = $_POST['testimony_id'];

          mysqli_query($connect, "UPDATE testimonies SET total_like=total_like + 1 WHERE testimony_id=$testimony_id");
          if(mysqli_affected_rows($connect) > 0){
            echo "Successfully Update!";
          }else {
            echo mysqli_error($connect);
          }
            echo "<meta http-equiv='refresh' content='0'>";
        }
        ?>

        <?php include 'databaseconn.php' ?>
        <?php
          //code to insert records in comment table
          if(isset($_POST['comment_status']))
          {
            $user_id = $_POST['user_id'];
            $testimony_id = $_POST['testimony_id'];
            $comment_content = $_POST['comment_content'];

            mysqli_query($connect, "INSERT INTO post_comment (user_id,testimony_id,comment_content,comment_date)
                        VALUES('$user_id','$testimony_id','$comment_content', NOW())");
                        if(mysqli_affected_rows($connect) > 0){
                      }else {
                        echo mysqli_error($connect);
                        echo "Not Added!";
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
