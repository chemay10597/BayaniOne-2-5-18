<?php
$connect=mysqli_connect('localhost','root','','watering_scheduler');

if(mysqli_connect_errno($connect))
{
		echo 'Failed to connect';
}

?>
