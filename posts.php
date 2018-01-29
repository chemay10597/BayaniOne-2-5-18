<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once("header.php");

if(!isset($_SESSION["username"])){
    header("location:index.php");
} else {
  session_start();
  $post_id=$_SESSION["post_id"] ;
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
        </br>
        <?php
        //code to get the user_id that is used in inserting record in post table
          $connect=mysqli_connect("localhost","root","","bayanion_db");
          // Check connection
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          $result1 = mysqli_query($connect,"SELECT post_id FROM posts WHERE post_id='". $_SESSION["post_id"] ."'");
            while($row1 = mysqli_fetch_array($result1))
            {
              echo "<input type=hidden name='post_id' id='post_id' value =". $row1["post_id"] .">";

        ?>
        <?php
          //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
          $connect=mysqli_connect("localhost","root","","bayanion_db");
          // Check connection
          if (mysqli_connect_errno())
          {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          //code to display donation posts
          $result = mysqli_query($connect,"SELECT * FROM posts INNER JOIN donation_campaign ON post.post_id=donation_campaign.post_id INNER JOIN users ON users.user_id=post.user_id WHERE post_type='donation campaign'");

          while($row = mysqli_fetch_assoc($result))
          {
            echo "<table style='width: 600px; height: 500px; background-color: #ffffff;'>";
            echo "<center>";
              echo "<tbody>";
                echo "<form action='home.php' method='post'>";
                  echo "<tr>";
                    echo "<td style='text-align: left; padding: 10px;'>";

                        echo "<img class='img-circle' src='Uploads/",$row['user_photo'],"' width='50px' height='50px' />";
                        echo "</br>";
                        echo "<center>";
                      echo "<label name='username' id='username' value =" . $row['username'] . ">". $row['username'] ."</label>";
                        echo "</center>";
                        echo "</br>";
                    echo "</td>";
                    echo "<td style='text-align: left; padding: 10px;'>";
                      echo "<img src='images/posttype.png' width='20px' height='20px' />";
                      echo "<label type='text' name='post_type' id='post_type' value =" . $row['post_type'] . ">" . $row['post_type'] ."</label>";
                        echo "</br>";
                    if($row['post_status']==='timeline')
                    {
                        echo "<label >". '@' ."</label>";
                      echo "<label type='text' name='tag_user' id='tag_user' value =" . $row['tag_user'] . ">". $row['tag_user'] ."</label>";
                      echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                    }
                      echo "<img src='images/public.png' width='20px' height='20px' />";
                      echo "<label type='text' name='post_status' id='post_status' value =" . $row['post_status'] . ">" . $row['post_status'] ."</label>";
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;";
                        echo "<img src='images/time.png' width='20px' height='20px' />";
                      echo "<label type='text' name='create_date' id='post_status' value =" . $row['create_date'] . ">" . $row['create_date'] ."</label>";
                        echo "</br>";
                      echo "<img src='Uploads/",$row['campaign_photo'],"' width='300px' height='250px' />";
                        echo "</br>";
                        echo "<label type='text' name='total_like' id='total_like' value =" . $row['total_like'] . ">" . $row['total_like'] ."</label>";
                        echo "<form id='likefrm' name='likefrm' action='home.php' method='post'>";
                          echo "<input type=hidden name='post_id' id='post_id' value =" . $row['post_id'] . ">";
                          echo "<input type=hidden id='Text1' name='Text1'>";
                          echo "<input type=hidden id='Text1' name='Text1'>";
                          echo "<button type='submit' style='border:0;background:transparent' id='like' name='like'>";
                            echo "<img src='/images/star.png' width='30px' height='30px' alt='submit'>";
                          echo "</button>";
                        echo "</form>";
                        echo "<form action='posts.php' method='post' style='float:right;padding-right:25em';>";
                        echo "<button name='commentbtn' id='commentbtn' style='border:0;background:transparent'>";
                          echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                        echo "</button>";
                        echo "</form>";
                      echo "<div>";
                      //code to create comment
                          echo "<center>";
                            echo "<form id='create_comment' name='create_comment' action='home.php' method='post' >";
                              echo "</br>";
                              echo "<fieldset>";
                                  echo "<input type=hidden name='post_id' id='post_id' value =" . $row['post_id'] . ">";
                                  echo "<input type='hidden' name='username' id='username' value ='". $_SESSION["username"] ."'>";
                                echo "<textarea name='comment_content' id='comment_content' rows='1' cols='50' style='text-align:left;width:300px;resize:none;' placeholder='Write A Comment........'>" . "</textarea>";
                                echo "<button type='submit' style='border:0;background:transparent' id='commment_status' name='comment_status'>";
                                  echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                                echo "</button>";
                              echo "</fieldset>";
                            echo "</form>";
                          echo "</center>";
                          //code to display comments
                          $result_comment = mysqli_query($connect,"SELECT comment_content, comment_date, username FROM post_comment WHERE post_id=". $row['post_id']."");
                          while($row2 = mysqli_fetch_assoc($result_comment))
                          {
                                  echo $row2['username'] . "&nbsp;&nbsp;";
                                  echo "(" . $row2['comment_date'] .  ")";
                                  echo "</br>";
                                  echo $row2['comment_content'];
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
          //mysqli_close($connect);
        }
      mysqli_close($connect);
      ?>
      <script>

      </script>
      <?php include 'databaseconn.php' ?>
      <?php
      if (isset($_POST['like'])) {
        $post_id = $_POST['post_id'];

        mysqli_query($connect, "UPDATE posts SET total_like=total_like + 1 WHERE post_id=$post_id");
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
          $username = $_POST['username'];
          $post_id = $_POST['post_id'];
          $comment_content = $_POST['comment_content'];

          mysqli_query($connect, "INSERT INTO post_comment (username,post_id,comment_content,comment_date)
                      VALUES('$username','$post_id','$comment_content', NOW())");
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
    <div class="homefooter">
    </br>
      <div class="social-networks">
          <a href="https://twitter.com" class="twitter"><img src="/images/twitterIcon.jpg" alt="" class="img-thumbnail img-circle"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="https://facebook.com" class="facebook"><img src="/images/facebookIcon.jpg" alt="" class="img-thumbnail img-circle"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <a href="https://plus.google.com/" class="google"><img src="/images/googlePlusIcon.jpg" alt="" class="img-thumbnail img-circle"/></a>
      </div>
      <div class="footer-copyright">
          <p>© 2017 BayaniOne </p>
      </div>
    </br>
    </div>
</body>
<?php } ?>
</html>
