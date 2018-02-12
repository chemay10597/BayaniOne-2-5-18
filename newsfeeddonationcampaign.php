  <?php
    $connect_campaign=mysqli_connect("localhost","root","","bayanion_db");
    // Check connection
    if (mysqli_connect_errno())
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    //code to display donation posts
    $result_campaign = mysqli_query($connect_campaign,"SELECT * FROM donation_campaign INNER JOIN users ON donation_campaign.user_id=users.user_id ORDER BY donation_campaign.campaign_id DESC");
    while($rowcampaign = mysqli_fetch_assoc($result_campaign))
    {
      echo "<center>";
      echo "<div style='width:600px;height:auto;background-color:#ffffff;'>";
      echo "<table style='width 500px;height:auto;>";
        echo "<tbody>";
          echo "<form action='home.php' method='post'>";
            echo "<tr>";
              echo "<td style='text-align:left;padding:10px;'>";
                  echo "<img class='img-circle' src='Uploads/",$rowcampaign['user_photo'],"' width='50px' height='50px' />";
                  echo "</br>";
                  echo "<center>";
                echo "<label name='username' id='username' value =" . $rowcampaign['username'] . ">". $rowcampaign['username'] ."</label>";
                  echo "</center>";
                  echo "</br>";
              echo "</td>";
              echo "<td style='text-align:left;padding:10px;'>";
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
                echo "<img src='Uploads/",$rowcampaign['campaign_photo'],"' width='400px' height='300px' />";
                  echo "</br>";
                  echo "<span style='float:left;'>";
                    echo "<label type='text' name='total_like' id='total_like' value =" . $rowcampaign['total_like'] . ">" . $rowcampaign['total_like'] ."</label>";
                    echo "<form id='likefrm' name='likefrm' action='' method='post'>";
                      echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $rowcampaign['campaign_id'] . ">";
                      echo "<input type=hidden id='Text1' name='Text1'>";
                      echo "<input type=hidden id='Text1' name='Text1'>";
                      echo "<button type='submit' style='border:0;background:transparent' id='like' name='like'>";
                        echo "<img src='/images/star.png' width='30px' height='30px' alt='submit'>";
                      echo "</button>";
                    echo "</form>";
                  echo "</span>";
                  echo "<span style='float:left;'>";
                    echo "<form action='campaignpost.php' method='get'>";
                    echo "</br>";
                    echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $rowcampaign['campaign_id'] . ">";
                    echo "<button name='commentbtncampaign' id='commentbtncampaign' style='border:0;background:transparent'>";
                      echo "<img src='/images/comment.png' width='30px' height='30px' alt='submit'>";
                    echo "</button>";
                    echo "</form>";
                  echo "</span>";
              echo "</td>";
              echo "<td style='text-align:left;padding:10px; width:20px;'>";
                echo "<div style=''>";
                  echo "<button onclick='myFunction()' class='dropbtn' style='width:50px;height:70px;border:0;background:transparent;'>";
                    echo "<img src='/images/menu.png' width='30px' height='30px' alt='submit'>";
                  echo "</button>";
                    echo "<div id='myDropdown' class='dropdown-content' style='background:#ffffff;border:1px;'>";
                      echo "<form action='editcampaignpost.php' method='get'>";
                      echo "</br>";
                      echo "<input type=hidden name='campaign_id' id='campaign_id' value =" . $rowcampaign['campaign_id'] . ">";
                      echo "<button name='commentbtncampaign' id='commentbtncampaign' style='border:0;background:transparent'>";
                        echo "Edit";
                      echo "</button>";
                      echo "</form>";
                      echo "<a href='#about'>"."</a>";
                      echo "<a href='#contact'>"."</a>";
                    echo "</div>";
                echo "</div>";
              echo "</td>";
              echo "<script>
              function myFunction() {
                  document.getElementById('myDropdown').classList.toggle('show');
              }
              window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {

                  var dropdowns = document.getElementsByClassName('dropdown-content');
                  var i;
                  for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                      openDropdown.classList.remove('show');
                    }
                  }
                }
              }
              </script>";
            echo "</tr>";
          echo "</form>";
        echo "</tbody>";
      echo "</table>";
      echo "</div>";
      echo "</center>";
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
