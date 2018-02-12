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
<div id="about" class="container-fluid">
  <div class="row" style="text-align:center;">

  </div>
</div>

<div class="container-fluid bg-grey">
  <div class="row" style="text-align:center;">

  </div>
</div>

<!-- Container (Services Section) -->
<div id="services" class="container-fluid text-center">

</div>

<!-- Container (Portfolio Section) -->
<div id="portfolio" class="container-fluid text-center bg-grey">

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
