<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php
    //code to verify user login
    session_start();
    if(!isset($_SESSION["username"])){
        header("location:index.php");
    }
?>

<html xmlns="http://www.w3.org/1999/xhtml"runat="server">
<head >
    <title>BayaniOne</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">
    <link rel="stylesheet" type="text/css" href="../fonts/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">
    <link rel="stylesheet" type="text/css" href="../css/createpost.css">
    <script src="../jquery/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width">
    <?php include 'databaseconn.php' ?>
    <?php
    $count=0;
      //code to insert records in comment table
      if(isset($_POST['comment_status']))
      {
        $user_id = mysqli_real_escape_string($connect, $_POST["user_id"]);
        $campaign_id = mysqli_real_escape_string($connect, $_POST["campaign_id"]);
        $comment_content = mysqli_real_escape_string($connect, $_POST["comment_content"]);


        //$user_id = $_POST['user_id'];
        //$campaign_id = $_POST['campaign_id'];
        //$comment_content = $_POST['comment_content'];

        mysqli_query($connect, "INSERT INTO post_comment (user_id,campaign_id,comment_content,comment_date)
                    VALUES('$user_id','$campaign_id','$comment_content', NOW())");
                    if(mysqli_affected_rows($connect) > 0){
                  }else {
                    echo mysqli_error($connect);
                    echo "Not Added!";
                  }
        echo "<meta http-equiv='refresh' content='0'>";
      }
      $resultcomment = mysqli_query($connect,"SELECT * FROM post_comment INNER JOIN users ON post_comment.user_id=users.user_id WHERE post_comment.status=0");
      $count=mysqli_num_rows($resultcomment);
    ?>
    <script type="text/javascript">
      function myFunction() {
        $.ajax({
          url: "view_notification.php",
          type: "POST",
          processData:false,
          success: function(data){
            $("#notification-count").remove();
            $("#nav").show();$("#nav").html(data);
          },
          error: function(){}
        });
       }
       $(document).ready(function() {
        $('body').click(function(e){
          if ( e.target.id != 'notification-icon'){
            $("#notification-latest").hide();
          }
        });
      });
    </script>
</head>
