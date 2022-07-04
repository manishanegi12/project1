<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link rel=”stylesheet” href=”https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css”rel=”nofollow” integrity=”sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I” crossorigin=”anonymous”>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    .navbar {
      width: auto;
      background-color: #555;
      overflow: auto;
    }

    .navbar a {
      float: left;
      padding: 12px;
      color: white;
      text-decoration: none;
      font-size: 20px;
    }

    .navbar a:hover {
      background-color: #000;
    }

    .active {
      background-color: #04AA6D;
    }
    #pwd{
  float: left;
  display:flex;
  margin-left: 64%;
    }
  </style>
</head>

<body>
<?php

?>
  <div class="container-fluid">

    <div class="navbar">
      <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
      <a href=""><i class="fa fa-fw fa-search"></i> Search</a>
      <a href=""><i class="fa fa-fw fa-envelope"></i> Contact</a>
      <?php 
      if (!empty($_SESSION['user_id'])) { ?>
         <!-- <a href="logout.php"><i class="fa fa-fw fa-user"></i> Logout</a> -->
      <?php  
      }else{?>

        <a href="login.php"><i class="fa fa-fw fa-user"></i> Login</a>

      <?php }?>
     
      <a href="change_password.php" id="pwd"> Change Password</a>

    </div>
  </div>