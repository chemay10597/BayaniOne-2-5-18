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
</head>
