  <?php
    //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
    $connect=mysqli_connect("localhost","root","","bayanion_db");
    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //code to display donation posts
    $result = mysqli_query($connect,"SELECT * FROM donation_campaign INNER JOIN users ON donation_campaign.user_id=users.user_id ORDER BY donation_campaign.campaign_id DESC");

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
              if($row['post_status']==='timeline')
              {
                  echo "<img src='images/user.png' width='20px' height='20px' />";
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
                  echo "</br>";
                echo "<p>".$row['campaign_description']."</p>";
                  echo "</br>";
                echo "<img src='Uploads/",$row['campaign_photo'],"' width='300px' height='250px' />";
                  echo "</br>";
                  echo "<label type='text' name='total_like' id='total_like' value =" . $row['total_like'] . ">" . $row['total_like'] ."</label>";
                  echo "<form id='likefrm' name='likefrm' action='' method='post'>";
                    echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $row['campaign_id'] . ">";
                    echo "<input type=hidden id='Text1' name='Text1'>";
                    echo "<input type=hidden id='Text1' name='Text1'>";
                    echo "<button type='submit' style='border:0;background:transparent' id='like' name='like'>";
                      echo "<img src='/images/star.png' width='30px' height='30px' alt='submit'>";
                    echo "</button>";
                  echo "</form>";
                  echo "<form action='' method='post' style='float:right;padding-right:25em';>";
                  echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $row['campaign_id'] . ">";
                  echo "<button name='commentbtn' id='commentbtn' style='border:0;background:transparent'>";
                    echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                  echo "</button>";
                  echo "</form>";
                echo "<div>";
                //code to create comment
                    echo "<center>";
                      echo "<form id='create_comment' name='create_comment' action='' method='post' style='display:inline-block;'>";
                        echo "</br>";
                        echo "<fieldset>";
                            echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $row['campaign_id'] . ">";
                            echo "<input type='hidden' name='username' id='username' value ='". $_SESSION["username"] ."'>";
                          echo "<textarea name='comment_content' id='comment_content' rows='1' cols='50' style='text-align:left;width:300px;resize:none;' placeholder='Write A Comment........'>" . "</textarea>";
                          echo "<button type='submit' style='border:0;background:transparent;' id='commment_status' name='comment_status'>";
                            echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                          echo "</button>";
                        echo "</fieldset>";
                      echo "</form>";
                    echo "</center>";
                    //code to display comments
                    $result_comment = mysqli_query($connect,"SELECT comment_content, comment_date, username FROM post_comment WHERE campaign_id=". $row['campaign_id']."");
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
    mysqli_close($connect);
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

<?php include 'databaseconn.php' ?>
<?php
  //code to insert records in comment table
  if(isset($_POST['comment_status']))
  {
    $username = $_POST['username'];
    $campaign_id = $_POST['campaign_id'];
    $comment_content = $_POST['comment_content'];

    mysqli_query($connect, "INSERT INTO post_comment (username,campaign_id,comment_content,comment_date)
                VALUES('$username','$campaign_id','$comment_content', NOW())");
                if(mysqli_affected_rows($connect) > 0){
              }else {
                echo mysqli_error($connect);
                echo "Not Added!";
              }
    echo "<meta http-equiv='refresh' content='0'>";
  }
?>

<?php
  //if(isset($_POST["commentbtn"])){
  //  session_start();
    //$_SESSION["post_id"] = $_GET['post_id'];
  //}
?>
