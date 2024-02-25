<?php

require_once("config.php");
require_once("PreviewProvider.php");
require_once("Entity.php");
require_once("CategoryContainer.php");
require_once("EntityProvider.php");
require_once("ErrorMessage.php");
require_once("SeasonProvider.php");
require_once("Season.php");
//require_once("Video.php");


if(!isset($_SESSION["userLoggedIn"])){
    header("Location: register.php");
}

$userLoggedIn = $_SESSION["userLoggedIn"];

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/06a651c8da.js" crossorigin="anonymous"></script>
    <script src="assets/styles/script.js"></script>
    
    <link rel="stylesheet" href="assets\styles\style.css">
    
    <title>Syndflix</title>
</head>
<body>
    <div class="wrapper">   
    
    <title>Syndflix</title>
</head>

<body>
    <div class="wrapper">

    <?php
if(!isset($hideNav)){
    include_once("naviBar.php");
}
?>

