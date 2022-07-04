<?php
include("config/connection.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <center>
        <form method="post" action="">
          Username: <input type="email" placeholder="Email id" name="email" value=""><br><br>
            <input type="submit" name="submit" value="Create">
        </form>
    </center>
</body>

</html>