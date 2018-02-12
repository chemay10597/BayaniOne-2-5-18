<?php
//code to validate and login users
if(isset($_POST["register"]))
{
 if(!empty($_POST['w_username']) && !empty($_POST['w_password']))
 {
     $w_username=$_POST['w_username'];
     $w_password=$_POST['w_password'];
     $connect=mysqli_connect('localhost','root','','watering_scheduler') or die(mysqli_error());
     $result=mysqli_query($connect, "SELECT w_username, w_password FROM w_users WHERE w_username='".$w_username."' AND w_password='".$w_password."'");
     $numrows=mysqli_num_rows($result);
     if($numrows!=0)
     {
       while($row=mysqli_fetch_assoc($result))
     {
     $dbusername=$row['w_username'];
     $dbpassword=$row['w_password'];
     }

     if($w_username == $dbusername && $w_password == $dbpassword)
     {
       session_start();
       $_SESSION['w_username']=$w_username;

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
