<?php
include("layout/header.php");
session_start();
include('config/connection.php');
if (!empty($_SESSION['errors'])) {
    $errorsToDisplay = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $Select_query = "SELECT * FROM users WHERE ID = '$id'";

    $result = mysqli_query($connection, $Select_query);

    $get = mysqli_fetch_assoc($result);
    // echo "<pre>";
    // print_r($get);
    // die;

    $getArr['skills'] = explode(",", $get['skills']);
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">

        <form method="post" action="edit.php" enctype="multipart/form-data">
            <h3> <i>Registration Form</i></h3>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="col-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php if (isset($get['first_name'])) {
                                                                                                        echo $get['first_name'];
                                                                                                    } ?>">
            </div>

            <span class="text-danger"> <?php if (!empty($errorsToDisplay['first_name'])) {
                                            echo $errorsToDisplay['first_name'];
                                        } ?></span>

            <div class="col-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php if (isset($get['last_name'])) {
                                                                                                    echo $get['last_name'];
                                                                                                } ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['last_name'])) {
                                            echo $errorsToDisplay['last_name'];
                                        } ?></span>
            <div class="col-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($get['email'])) echo $get['email']; ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['email'])) {
                                            echo $errorsToDisplay['email'];
                                        } ?></span>
            <div class="col-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="phone" class="form-control" id="phone" name="phone" value="<?php if (isset($get['phone'])) echo $get['phone']; ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['phone'])) {
                                            echo $errorsToDisplay['phone'];
                                        } ?></span>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" value="male" <?php if (isset($get['gender']) && $get['gender'] == "male") echo "checked"; ?>>
                <label class="form-check-label" for="male">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="female" value="female" <?php if (isset($get['gender']) && $get['gender'] == "female") echo "checked"; ?>>
                <label class="form-check-label" for="female">
                    Female
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="others" value="others" <?php if (isset($get['gender']) && $get['gender'] == "others") echo "checked"; ?>>
                <label class="form-check-label" for="others">
                    Others
                </label>
            </div>

            <span class="text-danger"> <?php if (!empty($errorsToDisplay['gender'])) {
                                            echo $errorsToDisplay['gender'];
                                        } ?></span>

            <div class="col-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" name="address" id="address" rows="3"> <?php if (isset($get['address'])) echo $get['address']; ?></textarea>
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['address'])) {
                                            echo $errorsToDisplay['address'];
                                        } ?></span><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="skills[]" type="checkbox" id="singing" value="singing" <?php if (is_array("singing")AND (in_array("singing", $getArr['skills']))) {
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                <label class="form-check-label" for="singing">Singing</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="skills[]" type="checkbox" id="dancing" value="dancing" <?php if(is_array("dancing") AND(in_array("dancing", $getArr['skills']))){
                                                                                                                    echo "checked";
                                                                                                                } ?>>
                <label class="form-check-label" for="dancing">Dancing</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="skills[]" type="checkbox" id="sports" value="sports" <?php if (is_array("sports")AND(in_array("sports", $getArr['skills']))) {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                <label class="form-check-label" for="sports">Sports</label>
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['skills'])) {
                                            echo $errorsToDisplay['skills'];
                                        } ?></span>

            <div class=" col-3 form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image"  value="<?php  if(isset($get['profile_image'])) echo $get['profile_image'];?> ">

                <!-- <span class="text-danger"> <?php if (!empty($errorsToDisplay['profile_image'])) {
                                                echo $errorsToDisplay['profile_image'];
                                            } ?></span> -->

                <img src="images/<?php echo $get['profile_image']; ?>" height='60px' width='60px' /><br><br>
            </div>
            <input type="submit" name="update" value="Update">


        </form>

    </div>
    <!-- <script>
function checkupdate(){
return alert('Record updated');
}<
    </script> -->
    <?php  include("layout/footer.php");?>
</body>

</html>