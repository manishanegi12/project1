<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$servername = "localhost";
$username = "root";
$password = "Teamwebethics3!";
$database = "registration";


$connection = mysqli_connect($servername, $username, $password,$database);
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
else{

}
