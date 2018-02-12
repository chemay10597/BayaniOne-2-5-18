<?php include 'databaseconn.php' ?>
<?php
  //code to insert user records
  if(isset($_POST['adduser']))
  {
    //variables
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //query to insert data

    mysqli_query($connect, "INSERT INTO users (username,password,email)
                VALUES('$email','$username','$password')");
                      if(mysqli_affected_rows($connect) > 0){
                        echo "      ";
                      }else {
                        echo mysqli_error($connect);
                        echo "Not Added!";
                      }
                        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
