<?php
include("config/connection.php");


session_start();


if (!isset($_SESSION['user_id'])) {
    // header("Location: login.php");
}
if (isset($_POST['sign'])) {
    header("Location: registration.php");
}

if (isset($_POST['login'])) {
    $errorsArr = [];
    $postArr = $_POST;
   
    if (empty($_POST['email'])) {
        $errorsArr['email'] = "Username is required";
    }
    
    if (empty($_POST['password'])) {
        $errorsArr['password'] = "Password is required";
    }
    if (count($errorsArr) > 0) {
        $_SESSION['errors'] = $errorsArr;
        header("Location: login.php");
    } else {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $query = "select * from users where password='$password' AND email ='$email'";
        $result = mysqli_query($connection, $query);
        $count = mysqli_num_rows($result);

       
        if ($count == 1) {
            while ($row = mysqli_fetch_assoc($result)) {

                $_SESSION['username'] = $row['email'];
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['first_name'] =$row['first_name'];

                // echo $_SESSION['first_name'];
                // die;
                // echo "<script language='javascript'>
                // alert('Congratulations! You Are Logged In!.');
                // window.location.href='list.php';
                // </script>";
                header("Location: list.php");
            }
        } else {
            $errorsArr['login'] = "Username or Password is invalid";
            header("Location: login.php");
            $_SESSION['errors'] = $errorsArr;
        }
    }
}
