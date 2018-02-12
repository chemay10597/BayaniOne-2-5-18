<?php
$connect=mysqli_connect('localhost','root','','activity_db');

if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}

?>
