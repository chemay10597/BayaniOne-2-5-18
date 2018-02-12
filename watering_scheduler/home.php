<!DOCTYPE html>
<?php
    session_start();
    if(!isset($_SESSION["w_username"])){
        header("location:index.php");
    } else {
?>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Plant Watering Scheduler</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/watering_scheduler/bootstrap.min.css">
  <link href="/watering_scheduler/fonts.css" rel="stylesheet" type="text/css">
  <link href="/watering_scheduler/fonts2.css" rel="stylesheet" type="text/css">
  <script src="/watering_scheduler/jquery.min.js"></script>
  <script src="/watering_scheduler/bootstrap.min.js"></script>
  <link href="/watering_scheduler/home.css" rel="stylesheet" type="text/css">
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li>
              <?php
              //code to get the user_id that is used in inserting record in post table
                $connect=mysqli_connect("localhost","root","","watering_scheduler");
                // Check connection
                if (mysqli_connect_errno())
                {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }

                $resultuserlogin = mysqli_query($connect,"SELECT w_username FROM w_users WHERE w_username='". $_SESSION["w_username"] ."'");
                  while($rowuserlogin = mysqli_fetch_array($resultuserlogin))
                  {
                    echo "<a class='btn-logout' href= '#'>".$rowuserlogin['w_username']."</a>";
                  }
                mysqli_close($connect);
              ?>
        </li>
        <li>
          <a class="btn-logout" href= "logout.php">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center" style="background-size: 1500px 400px; background-image: url('../watering_scheduler/bgbanner.jpg');background-repeat:no-repeat;">
  <h1>PLANT WATERING SCHEDULER</h1>
  <p>We specialize in auto plant watering scheduler.</p>
</div>

<!-- Container (About Section) -->
<div class="container-fluid">
  <center>
  <div class="row">
    <form action="" method="post">
      <div>
            <?php
            //code to get the user_id that is used in inserting record in post table
              $connect=mysqli_connect("localhost","root","","watering_scheduler");
              // Check connection
              if (mysqli_connect_errno())
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }

              $resultuserlogin = mysqli_query($connect,"SELECT w_user_id FROM w_users WHERE w_username='". $_SESSION["w_username"] ."'");
                while($rowuserlogin = mysqli_fetch_array($resultuserlogin))
                {
                  echo "<input value=".$rowuserlogin['w_user_id']." type='hidden' name='w_user_id' id='w_user_id'>";
                }
              mysqli_close($connect);
            ?>
            <input style="width:300px;" id="w_device_name" name="w_device_name" type="text" placeholder="device name ..." required/>
            <input style="width:300px;" id="w_device_model" name="w_device_model" type="text"   placeholder="device model ..." required/>
            <input style="width:300px;" id="w_device_serialno" name="w_device_serialno" type="text"   placeholder="device serial no ..." required/></li>
            <input type="submit" id="adddevice" name="adddevice" value="Add Device">
      </div>
    </form>
    <?php include 'databaseconn.php' ?>
    <?php
      //code to insert records in users table, individual_user table, and organization_user table
      if(isset($_POST['adddevice']))
      {
        //variables
        $w_user_id = $_POST['w_user_id'];
        $w_device_name = $_POST['w_device_name'];
        $w_device_model = $_POST['w_device_model'];
        $w_device_serialno = $_POST['w_device_serialno'];

        //query to insert data
        mysqli_query($connect, "INSERT INTO w_devices (w_user_id,w_device_name,w_device_model,w_device_serialno)
                    VALUES('$w_user_id','$w_device_name','$w_device_model','$w_device_serialno')");
                          if(mysqli_affected_rows($connect) > 0){
                          }else {
                            echo mysqli_error($connect);
                          }
        //echo "<meta http-equiv='refresh' content='0'>";
        }
    ?>
  </div>
  </br>
  <div class="row">
    <?php
      include_once("databaseconn.php");
      $resultdevice = mysqli_query($connect,"SELECT * FROM w_devices INNER JOIN w_users ON w_devices.w_user_id=w_users.w_user_id WHERE w_username='". $_SESSION["w_username"] ."'");
      /*echo "<label style='float:left; padding-left:18em;'>".'Device ID'."</label>";
      echo "<label style='float:left; padding-left:5em;>".'Device Name'."</label>";
      echo "<label style='float:left; padding-left:5em;>".'Device Model'."</label>";
      echo "<label style='float:left; padding-left:5em;>".'Device Serial No'."</label>";*/
      while ($rowdevice=mysqli_fetch_array($resultdevice))
      {
            echo "<form action='' method='post'>";
            echo "<input type=hidden value='". $rowdevice['w_device_id'] ."' name='w_device_id' id='w_device_id'>";
            echo $rowdevice['w_device_id'] . "&nbsp;&nbsp;";
            echo "<input type='text' value='". $rowdevice['w_device_name'] ."' name='w_device_name' id='w_device_name'>";
            echo "<input type='text' value='". $rowdevice['w_device_model'] ."' name='w_device_model' id='w_device_model'>";
            echo "<input type='text' value='". $rowdevice['w_device_serialno'] ."' name='w_device_serialno' id='w_device_serialnox'>";
            echo "<input type='submit' value='Update' name='updatebtn' id='updatebtn'>";
            echo "<input type='submit' value='Delete' name='deletebtn' id='deletebtn'>";
            echo "</br>";
            echo "</form>";
      }
    ?>

    <?php
      include_once("databaseconn.php");
      if(isset($_POST['updatebtn'])){
        $w_device_id = $_POST['w_device_id'];
        $w_device_name = $_POST['w_device_name'];
        $w_device_model = $_POST['w_device_model'];
        $w_device_serialno = $_POST['w_device_serialno'];

        mysqli_query($connect,"UPDATE w_devices SET w_device_name='$w_device_name',w_device_model='$w_device_model',w_device_serialno='$w_device_serialno' WHERE w_device_id='$w_device_id'");
        if(mysqli_affected_rows($connect)>0)
        {
          echo "Successfully Updated!";
        }
        else {
          echo mysqli_error($connect);
        }
        echo "<meta http-equiv='refresh' content='0'>";
      }
    ?>
    <?php
      include_once("databaseconn.php");
      if(isset($_POST['deletebtn'])){
        $w_device_id = (int) $_POST['w_device_id'];

        mysqli_query($connect,"DELETE FROM w_devices WHERE w_device_id='$w_device_id'");
        if(mysqli_affected_rows($connect)>0)
        {
          echo "Successfully Deleted!";
        }
        else {
          echo mysqli_error($connect);
        }
        echo "<meta http-equiv='refresh' content='0'>";
      }
    ?>
  </div>
  </center>
</div>

<footer class="container-fluid text-center">
  <a href="#myPage" title="To Top">
    <img src="/watering_scheduler/pageup.png" style="width:30px;height:30px;">
  </a>
</footer>

<script>
$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });

  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;

      var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slide");
        }
    });
  });
})
</script>
</body>
</html>
<?php } ?>
