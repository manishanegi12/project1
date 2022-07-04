<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>
<?php

include "config/connection.php";
session_start();

if (!empty($_GET['id'])&& (isset($_GET['id']))){
  

    $id = $_GET['id'];
    $delete_file_name=$_GET['profile_image'];
    $delete_query = "DELETE FROM `users` WHERE `id`='$id'";
    $delete_result = mysqli_query($connection, $delete_query);
    if ($delete_result) {
        if(file_exists('./images/'.$delete_file_name)){
            unlink("./images/$delete_file_name");
        }
        // echo "<script language='javascript'>
        // alert('Record deleted successfully.');
        // window.location.href='list.php';
        // </script>";
        $_SESSION['delete'] = "Deleted successfully";
        header("Location: list.php");
    }
} else {

    echo "Error:" . mysqli_error($connection);
}



?>