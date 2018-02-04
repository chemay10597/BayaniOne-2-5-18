<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
    //code to check login user
    session_start();
    if(isset($_SESSION["username"])){
        header('location:home.php');
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml">
  <head >
      <title>BayaniOne</title>
      <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
      <link rel="stylesheet" type="text/css" href="../fonts/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="../css/style.css">
      <link rel="stylesheet" type="text/css" href="../css/button.css">
      <link rel="stylesheet" type="text/css" href="../css/nav.css">
      <link rel="stylesheet" type="text/css" href="../css/sb-admin.css">
      <link rel="stylesheet" type="text/css" href="../css/home.css">
  </head>
  <body style="background-color:#b3b3b3;">
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class = "navbar-brand" href="index.php"><span><image src = "../images/logo.png" height= "50px" width="50px"></span><span><image src = "../images/logotext.png" id="logotext" height= "50px" width="200px"></span></a>
          </div>
          <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav navbar-right">
              <li>
                <form action="" method="POST">
                  <ul class="nav navbar-nav navbar-right">
                    <li><input class="form-control" style="border: 1px solid #000000;border-radius: 4px;" placeholder="username" type="text" name="username"></li>
                    <li>&nbsp;</li>
                    <li><input class="form-control" style="border: 1px solid #000000;border-radius: 4px;" placeholder="password" type="password" name="password"></li>
                    <li>
                      <input type="checkbox" name="remember" <?php if(isset($_COOKIE['remember_me'])) {
                    		echo 'checked="checked"';
                    	}
                    	else {
                    		echo '';
                    	}
                    	?> >Remember Me &nbsp;&nbsp;
                    </li>
                    <li><input class="btnlogin" type="submit" value="Login" name="submit" /></li>
                  </ul>
                </form>
                <?php
                //code to validate and login users
                if(isset($_POST["submit"]))
                {
                 if(!empty($_POST['username']) && !empty($_POST['password']))
                 {
                     $username=$_POST['username'];
                     $password=$_POST['password'];
                     $connect=mysqli_connect('localhost','root','','bayanion_db') or die(mysqli_error());
                     $result=mysqli_query($connect, "SELECT username, password FROM users WHERE username='".$username."' AND password='".$password."'");
                     $numrows=mysqli_num_rows($result);
                     if($numrows!=0)
                     {
                       while($row=mysqli_fetch_assoc($result))
                     {
                     $dbusername=$row['username'];
                     $dbpassword=$row['password'];
                     }

                     if($username == $dbusername && $password == $dbpassword)
                     {
                       session_start();
                       $_SESSION['username']=$username;

                       /* Redirect browser */
                       header("Location: home.php");
                     }
                     } else {
                       echo "username and password does not match!";
                     }

                 } else {
                     echo "All fields are required!";
                   }
                }
                ?>
              </li>
              <li><a></a></li>
              <li>
                  <li ><a class="btn-signup" href= "signup.php">Signup</a></li>
              </li>
            </ul>
          </div>
        </div>
    </nav>>

    <!--Banner-->
  <section>
    <div class="banner">
      <div class="bg-color">
        <div class="container">
          <div class="row">
            <div class="banner-text text-center">
              <div class="text-border">
                  <h2 class="text-dec">Welcome to BayaniOne</h2>
              </div>
              <div class="intro-para text-center quote">
                  <p class="big-text">Help starts with everyone of us</p>
                   <p class="small-text">A person has two hands, one is for helping himself.<br>The other is for helping others. </p>
                  <a href="#footer" class="btn get-quote">About Us</a>
              </div>
              <a href="#work-shop" class="mouse-hover"><div class="mouse"></div></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </br></br>
    <div id="work-shop" style="background-color:#b3b3b3;">
      <?php
        //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
        $connect=mysqli_connect("localhost","root","","bayanion_db");
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        //code to display donation posts
        $result = mysqli_query($connect,"SELECT * FROM donation_campaign INNER JOIN users ON donation_campaign.user_id=users.user_id WHERE donation_campaign.post_status='public'");
        echo "<table>";
        echo "<center>";
          echo "<tbody>";
            echo "<form action='home.php' method='post'>";
              echo "<tr>";
              $i = 0;
        while($row = mysqli_fetch_assoc($result) AND $i<4)
        {
          $i++;
          $campaign_id=$row['campaign_id'];
          $user_id=$row['user_id'];
                  echo "<td style='text-align: left; padding: 10px;width:350px; height: 400px; background-color: #ffffff;'>";
                      echo "<img class='img-circle' src='Uploads/",$row['user_photo'],"' width='50px' height='50px' />";
                    echo "<label name='username' id='username' value =" . $row['username'] . ">". $row['username'] ."</label>";
                      echo "</br>";
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
                  echo "</td>";
        }
              echo "</tr>";
            echo "</form>";
          echo "</tbody>";
          echo "</center>";
        echo "</table>";
        echo "</br>";
        mysqli_close($connect);
      ?>

      <?php
        //code to diplays post, comment, and insert comment for all that login user can see (donation_campaign)
        $connecttest=mysqli_connect("localhost","root","","bayanion_db");
        // Check connection
        if (mysqli_connect_errno())
        {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        //code to display donation posts
        $result_testimonies = mysqli_query($connecttest,"SELECT * FROM testimonies INNER JOIN users ON testimonies.user_id=users.user_id WHERE testimonies.post_status='public'");
        echo "<table>";
        echo "<center>";
          echo "<tbody>";
            echo "<form action='home.php' method='post'>";
              echo "<tr>";
              $i = 0;
        while($rowtestimony = mysqli_fetch_assoc($result_testimonies) AND $i<4)
        {
          $i++;
          $campaign_id=$row['campaign_id'];
          $user_id=$row['user_id'];
                  echo "<td style='text-align: left; padding: 10px;width:350px; height: 200px; background-color: #ffffff;'>";
                      echo "<img class='img-circle' src='Uploads/",$rowtestimony['user_photo'],"' width='50px' height='50px' />";
                      echo "</br>";
                      echo "<center>";
                    echo "<label name='username' id='username' value =" . $rowtestimony['username'] . ">". $rowtestimony['username'] ."</label>";
                      echo "</center>";
                      echo "</br>";

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
                  echo "</td>";
        }
        echo "</tr>";
      echo "</form>";
    echo "</tbody>";
    echo "</center>";
  echo "</table>";
  echo "</br>";
        mysqli_close($connecttest);
      ?>
    </div>
  </section>

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
</html>
