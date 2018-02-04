<?php
  //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
  $connecttest=mysqli_connect("localhost","root","","bayanion_db");
  // Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  //code to display donation posts
  $result_testimonies = mysqli_query($connecttest,"SELECT * FROM testimonies INNER JOIN users ON testimonies.user_id=users.user_id ORDER BY testimonies.testimony_id DESC");

  while($rowtestimony = mysqli_fetch_assoc($result_testimonies))
  {
    echo "<table style='width: 600px; height: auto; background-color: #ffffff;'>";
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
                echo "<form action='testimonypost.php' method='get' style='float:right;padding-right:25em';>";
                echo "<input type=hidden name='testimony_id' id='testimony_id' value =" . $rowtestimony['testimony_id'] . ">";
                echo "<button name='commentbtntest' id='commentbtntest' style='border:0;background:transparent'>";
                  echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                echo "</button>";
                echo "</form>";
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
