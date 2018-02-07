<?php
session_start();
if(isset($_SESSION['username'])) {
  //echo "Your session is running " . $_SESSION['username'];
	$username=$_SESSION['username'];
?>
<?php
$conn = new mysqli("localhost","root","","bayanion_db");

$sql="UPDATE post_comment SET status=1 WHERE status=0";
$result_comment=mysqli_query($conn, $sql);
"<div class='notification-item' style='overflow:auto;'>" .
$sql="SELECT * FROM donation_campaign INNER JOIN users ON donation_campaign.user_id=users.user_id";
$result_comment=mysqli_query($conn, $sql);
while($rowrcom=mysqli_fetch_array($result_comment)) {
	$dcusername=$rowrcom["username"];
$sql="SELECT * FROM post_comment INNER JOIN users ON post_comment.user_id=users.user_id WHERE username='$username' OR username='$dcusername' ORDER BY comment_id DESC";
$result_comment=mysqli_query($conn, $sql);
$response='';
while($rowrcom=mysqli_fetch_array($result_comment)) {
	$response = $response .
	"<form action='campaignpost.php' method='get' style='text-align:left;'>".
	"<input type=hidden name='campaign_id' id='campaign_id' value =" . $rowrcom['campaign_id'] . ">".
	"<button name='commentbtncampaign' id='commentbtncampaign' style='border:0;background:transparent'>".
	"<div class='comment-name'>". $rowrcom["username"] . "</div>" .
	"<div class='comment'>" . $rowrcom["comment_content"]  . "</div>" .
	"</button>".
	"</form>";
}
}
/*
$sql="SELECT * FROM post_comment INNER JOIN users ON post_comment.user_id=users.user_id INNER JOIN donation_campaign ON users.user_id=donation_campaign.user_id WHERE username='$username' ORDER BY comment_id DESC";
$result_comment=mysqli_query($conn, $sql);
$response='';
while($rowrcom=mysqli_fetch_array($result_comment)) {
	$response = $response .
	"<form action='campaignpost.php' method='get' style='text-align:left;'>".
	"<input type=hidden name='campaign_id' id='campaign_id' value =" . $rowrcom['campaign_id'] . ">".
	"<button name='commentbtncampaign' id='commentbtncampaign' style='border:0;background:transparent'>".
	"<div class='comment-name'>". $rowrcom["username"] . "</div>" .
	"<div class='comment'>" . $rowrcom["comment_content"]  . "</div>" .
	"</button>".
	"</form>";
}*/
"</div>";
if(!empty($response)) {
	print $response;
}
?>
<?php
}
?>
