<?php
include("config/connection.php");
include("layout/header.php");
session_start();
if(isset($_POST['submit'])){
  $new_password  =md5($_POST['new_password']);

  $change_password_query="UPDATE users SET password='$new_password' where id=".$_SESSION['user_id'];
  
$password_result=mysqli_query($connection,$change_password_query);
if($password_result){
$_SESSION['password']="password updated";

header("Location: list.php");
}
else{

     echo "not updated".mysqli_error($connection);
}
}
?>
<html>
     <head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Password Change</title>
     </head>
    <body>
        <center>
    <h1>Change Password</h1>
   <form method="POST" action="">
  <tr>
    <td>Enter your new password:</td>
    <td><input type="password" size="10" name="new_password"></td>
    </tr><br><br>
   

    <input type="submit" name="submit" value="Update Password">
    </form>
</center>
<?php include("layout/footer.php");?>
   </body>
    </html>  
