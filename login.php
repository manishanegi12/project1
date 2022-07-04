<?php
include("layout/header.php");
session_start();
if (!empty($_SESSION['errors'])) {
    $errorsToDisplay = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>


<body>
    <center>
        <h2>Login Form</h2>
        <form action="authentication.php" method="post">
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['login'])) {
                                            echo $errorsToDisplay['login'];
                                        } ?></span><br><br>
            <label>UserName :</label>
            <input id="name" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" placeholder="Email" type="text"> <br><span class="text-danger"> <?php if (!empty($errorsToDisplay['email'])) {
                                                                                                                                                                                    echo $errorsToDisplay['email'];
                                                                                                                                                                                } ?></span><br>
            <label>Password :</label>
            <input id="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>" placeholder="Password" type="password"> <br><span class="text-danger"> <?php if (!empty($errorsToDisplay['password'])) {
                                                                                                                                                                                                        echo $errorsToDisplay['password'];
                                                                                                                                                                                                    } ?></span><br>

            <input name="login" type="submit" value="Login" class="text-primary">
            <input type="submit" name="sign" value="Register">
            <!-- <input type="submit" name="forgot" class="text-success" value="Forgot password"> <a href="forgetPassword.php"> -->




        </form>


    </center>
    <?php  include("layout/footer.php");?>
</body>

</html>