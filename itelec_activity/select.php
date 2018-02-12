<?php
//code to get the user_id that is used in inserting record in post table
  $connect=mysqli_connect("localhost","root","","activity_db");
  // Check connection
  if (mysqli_connect_errno())
  {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $result = mysqli_query($connect,"SELECT * FROM users");
  echo "<table style='border: 1px solid black;'>";
    echo "<tbody>";
  while($row = mysqli_fetch_assoc($result))
  {
    //echo "<input type='text' name='username' id='username' value =" . $row['username']. ">";
      echo "<form action='activity1.php' method='post'>";
        echo "<tr>";
        echo "<td>" . "<input type='text' name='user_id' id='user_id' value =" . $row['user_id']. ">" . "</td>";
          echo "<td>" . "<input type='text' name='username' id='username' value =" . $row['username']. ">" . "</td>";
          echo "<td>" . "<input type='text' name='password' id='password' value =" . $row['password']. ">" . "</td>";
          echo "<td>" . "<input type='text' name='email' id='email' value =" . $row['email']. ">" . "</td>";
          echo "<td>" . "<input type='submit' name='delete' id='delete' value='Delete'>" . "</td>";
          echo "<td>" . "<input type='submit' name='update' id='update' value='Update'>" . "</td>";
        echo "</tr>";
        echo "</form>";
  }
  echo "</tbody>";
echo "</table>";
  mysqli_close($connect);
?>

<?php include 'databaseconn.php' ?>
<?php
if (isset($_POST['update'])) {
  $user_id = $_POST['user_id'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  mysqli_query($connect, "UPDATE users SET username='$username', password='$password', email='$email' WHERE user_id=$user_id");
  if(mysqli_affected_rows($connect) > 0){
    echo "Successfully Update!";
  }else {
    echo mysqli_error($connect);
    echo "";
  }
    echo "<meta http-equiv='refresh' content='0'>";
}
?>

<?php include 'databaseconn.php' ?>
<?php
if (isset($_POST['delete'])) {
  $user_id = (int) $_POST['user_id'];

  mysqli_query($connect, "DELETE FROM users WHERE user_id='$user_id'");
  if(mysqli_affected_rows($connect) > 0){
    echo "Successfully Deleted!";
  }else {
    echo mysqli_error($connect);
    echo "";
  }
    echo "<meta http-equiv='refresh' content='0'>";
}
?>
