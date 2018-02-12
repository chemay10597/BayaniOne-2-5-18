<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
    //code to check login user
    session_start();
    if(isset($_SESSION["w_username"])){
        header('location:home.php');
    }
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
  <link href="/watering_scheduler/index.css" rel="stylesheet" type="text/css">
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
      </br>
        <li>
          <input style=" vertical-align: bottom; width: 100px; height:35px; font-size:15px; border:none; background-color:#f4511e; color:white;" type="button" value="Signup" onclick="location.href='signup.php';"/>
          &nbsp;&nbsp;
        </li>
        <li>
          <form action="" method="POST"><input class="form-control" style="border: 1px solid #000000;border-radius: 4px;" placeholder="username" type="text" name="w_username"></li>
          &nbsp;
        </li>
        <li>
          <input class="form-control" style="border: 1px solid #000000;border-radius: 4px;" placeholder="password" type="password" name="w_password"></li>
          &nbsp;</li>
        <li>
          &nbsp;
          <input type="checkbox" name="remember" <?php if(isset($_COOKIE['remember_me'])) {
            echo 'checked="checked"';
          }
          else {
            echo '';
          }
          ?> ><label style="color:#ffffff; font-size:10px;">&nbsp;Remember Me<label>
        </li>
        <li>
          <input style=" vertical-align: bottom; width: 100px; height:30px; font-size:15px;border: 1px solid #ffffff;border-radius: 10px; background-color:#f4511e; color:white;" type="submit" value="Login" name="register" />
          &nbsp;&nbsp;</form></li>
          <?php
            include_once("login.php");
          ?>
      </ul>
    </div>
  </div>
</nav>

<div class="jumbotron text-center">
  <h1>PLANT WATERING SCHEDULER</h1>
  <p>We specialize in auto plant watering scheduler.</p>
</div>

<!-- Container (About Section) -->
<div id="register" class="container-fluid">
  <center>
  <div class="row">
    <p>Register Here!</p>
    </br>
    <form style="border:10px;" action="" method="post">
      <div class="col-sm-6">
          <ul style="list-style-type: none;">
            <?php
              //code to get user_id
              $connect=mysqli_connect("localhost","root","","watering_scheduler");
              // Check connection
              if (mysqli_connect_errno())
              {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }
              $result = mysqli_query($connect,"SELECT MAX(w_address_id) FROM w_address GROUP BY w_address_id");
              if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                  $next = $row['MAX(w_address_id)'] + 1;
                }
                  echo "<input value='". $next ."' type='hidden' name='w_address_id' id='w_address_id'>";
                  echo "</input>";
              }
              mysqli_close($connect);
            ?>
            <li><input style="width:300px;" id="w_first_name" name="w_first_name" type="text" placeholder="first name ..." required/></li></br>
            <li><input style="width:300px;" id="w_middle_name" name="w_middle_name" type="text"   placeholder="middle name ..." required/></li></br>
            <li><input style="width:300px;" id="w_last_name" name="w_last_name" type="text"   placeholder="last name ..." required/></li></br>
            <li>
              <label>Birthdate</label>
              <input style="width:235px;" id="w_birthdate" name="w_birthdate" type="date" required/>
            </li></br>
            <li>
              <label>Gender&nbsp;&nbsp;</label>
              <input type="radio" name="w_gender" id="w_gender" value="male"> Male
              <input type="radio" name="w_gender" id="w_gender" value="female"> Female
            </li></br>
            <li><input style="width:300px;" type="text" id="w_street" name="w_street" placeholder="Street ..." required/></li></br>
            <li><input style="width:300px;" type="text" id="w_barangay" name="w_barangay" placeholder="Barangay ..." required/></li></br>
            <li><input style="width:300px;" type="text" id="w_city" name="w_city" placeholder="City ..." required/></li></br>
            <li><input style="width:300px;" type="text" id="w_zip_code" name="w_zip_code" placeholder="Zip Code ..." required/></li></br>
            <li><input style="width:300px;" type="text" id="w_province" name="w_province" placeholder="Province ..." required/></li></br>
            <li><input style="width:300px;" type="text" id="w_mobile_no" name="w_mobile_no" placeholder="Mobile No ..." required/></li></br>
            <li><input style="width:300px;" type="text" id="w_telephone_no" name="w_telephone_no" placeholder="Telephone No ..." required/></li></br>
            <li><input style="width:300px;" id="w_email_address" name="w_email_address" type="email" placeholder="user@domain.com" required/></li>
          </ul>
      </div>
      <div class="col-sm-6">
          <ul style="list-style-type: none;">
            <li>
              <label>Profile Photo</label>
              <center><img id="user_image" name="user_image" runat="server" height="150" width="150"/></center>
            </br>
              <center><input type="file" id="w_user_photo" name="w_user_photo" accept="image/*" onchange="readURL(this);" required/></center>
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
            <li><input style="width:300px;" id="w_username" name="w_username" type="text" placeholder="username ..." required/><li></br>
            <li><input style="width:300px;" id="w_password" name="w_password" type="password" placeholder="password ..." required/><li></br>
            <li><input style="width:300px;" id="confirm_password" name="w_confirm_password" type="w_password" placeholder="confirm password ..." required/></li></br>
            <li><button style="width:300px; background-color:#f4511e; color:white;" type="submit" class="signupbtn" height="59px"width="341px" id="registerUser" name="registerUser" >Sign Up</button></li>
          </ul>
      </div>
    </form>
    <?php include 'databaseconn.php' ?>
    <?php
      //code to insert records in users table, individual_user table, and organization_user table
      if(isset($_POST['registerUser']))
      {
        //variables
        $w_address_id = $_POST['w_address_id'];
        $w_first_name = $_POST['w_first_name'];
        $w_middle_name = $_POST['w_middle_name'];
        $w_last_name = $_POST['w_last_name'];
        $w_birthdate = $_POST['w_birthdate'];
        $w_gender = $_POST['w_gender'];
        $w_user_photo = $_POST['w_user_photo'];
        $w_street = $_POST['w_street'];
        $w_barangay = $_POST['w_barangay'];
        $w_city = $_POST['w_city'];
        $w_zip_code = $_POST['w_zip_code'];
        $w_province = $_POST['w_province'];
        $w_email_address = $_POST['w_email_address'];
        $w_mobile_no = $_POST['w_mobile_no'];
        $w_telephone_no = $_POST['w_telephone_no'];
        $w_username = $_POST['w_username'];
        $w_password = $_POST['w_password'];
        $w_confirm_password = $_POST['w_confirm_password'];
        if(isset($_FILES['w_user_photo'])) {
          $w_user_photo=addslashes(file_get_contents($_FILES['w_user_photo']['tmp_name'])); //will store the image to fp
        }
        //query to insert data
        mysqli_query($connect, "INSERT INTO w_users (w_address_id,w_first_name,w_middle_name,w_last_name,w_birthdate,w_gender,w_user_photo,w_email_address,w_mobile_no,w_telephone_no,w_username,w_password,w_confirm_password)
                    VALUES('$w_address_id','$w_first_name','$w_middle_name','$w_last_name','$w_birthdate','$w_gender','$w_user_photo','$w_email_address','$w_mobile_no','$w_telephone_no','$w_username','$w_password','$w_confirm_password')");
                          if(mysqli_affected_rows($connect) > 0){
                          }else {
                            echo mysqli_error($connect);
                          }
                          mysqli_query($connect, "INSERT INTO w_address (w_address_id,w_street,w_barangay,w_city,w_zip_code,w_province)
                                      VALUES('$w_address_id','$w_street','$w_barangay','$w_city','$w_zip_code','$w_province')");
                                            if(mysqli_affected_rows($connect) > 0){
                                            }else {
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
