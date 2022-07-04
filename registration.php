<?php
include("config/connection.php");
include("layout/header.php");

$country_query = "SELECT * FROM country";
$country_result = mysqli_query($connection, $country_query);

session_start();
if (isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_POST);die;
    $errorsArray = [];
    $postArr = $_POST;
    $postkeysArr = array_keys($postArr);

    foreach ($postkeysArr as $keys) {
        if ((gettype($_POST[$keys]) === 'array') ? empty($_POST[$keys]) : empty(trim($_POST[$keys]))) {
            $errorsArray[$keys] = ucfirst(str_replace('_', ' ', $keys)) . 'is required';
        }
    }

    if (empty($_POST['first_name'])) {
        $errorsArray['first_name'] = "Name is required";
    } else {
        $first_name = $_POST['first_name'];
    }
    $email = $_POST['email'];
    if (!empty($_POST['email'])) {
        $email_query = "select * from users where email = '$email'";
        $email_result = mysqli_query($connection, $email_query);
        if (mysqli_num_rows($email_result) > 0) {
            $errorsArray['email'] = "This email is already exixts";
        }
    } else {
        $email = $_POST['email'];
    }

    if (empty($_POST['gender'])) {
        $errorsArray['gender'] = "Please select gender";
    }
    if (empty($_POST['skills'])) {
        $errorsArray['skills'] = "Please choose skills";
    }
    $profile_image = $_FILES['profile_image']['name'];
    // if (empty($profile_image)) {
    //     $errorsArray['profile_image'] = "Please select your file";
    // }

    if (count($errorsArray) > 0) {
        // print_r($errorsArray);die;

        $_SESSION['errors'] = $errorsArray;

        $errorsToDisplay = $_SESSION['errors'];
    }
    if (!$errorsArray) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];

        $address = trim($_POST['address']);

        $gender = $_POST['gender'];
        $skills = $_POST['skills'];
        $skills = implode(",", $skills);
        $password = md5($_POST['password']);
        $phone = $_POST['phone'];
        $created_at = date('Y-m-d H:i:s');
        $country=$_POST['country'];
        $state=$_POST['state'];
        $profile_image = str_replace(" ", "_", time() . '_' . $_FILES['profile_image']['name']);

        $tmp_name = $_FILES['profile_image']['tmp_name'];
        if (!file_exists("images")) {
            mkdir("images", 0777);
        }
        $images_directory = "images/" . $profile_image;
        move_uploaded_file($tmp_name, $images_directory);
         $insert_query = "INSERT INTO `users`(`first_name`,`last_name`,`email`,`phone`,`address`,`gender`,`skills`,`country_id`,`state_is`,`password`,`created_at`,`profile_image`)VALUES('$first_name','$last_name','$email','$phone','$address','$gender','$skills','$country','$state','$password','$created_at','$profile_image')";
       $insert_result = mysqli_query($connection, $insert_query);
        // print_r($insert_result);
        // die;
        if ($insert_result == TRUE) {
            // $last_id = mysqli_insert_id($connection);
            // $update_query = "UPDATE USERS SET profile_image='$profile_image' where id='$last_id'";
            // mysqli_query($connection, $update_query);
            $_SESSION['insert'] = "inserted successfully";
            header("Location: list.php");
        } else {
            mysqli_error($connection);
        }
    }
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
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
    </script>
</head>

<body>

    <div class="container">

        <form method="post" action="" enctype="multipart/form-data">
            <h3> <i>Registration Form</i></h3>

            <div class="col-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first_name" name="first_name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['first_name'])) {
                                            echo $errorsToDisplay['first_name'];
                                        } ?></span>

            <div class="col-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" id="last_name" name="last_name" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['last_name'])) {
                                            echo $errorsToDisplay['last_name'];
                                        } ?></span>
            <div class="col-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($_POST['email']))  echo $_POST['email']; ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['email'])) {
                                            echo $errorsToDisplay['email'];
                                        } ?></span>
            <div class="col-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="number" class="form-control" id="phone" name="phone" value="<?php if (isset($_POST['phone'])) echo $_POST['phone'] ?? ''; ?>">

            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['phone'])) {
                                            echo $errorsToDisplay['phone'];
                                        } ?></span>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="male" <?php if (isset($gender) && $gender == "male") echo "checked"; ?> value="male">
                <label class="form-check-label" for="male">
                    Male
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" <?php if (isset($gender) && $gender == "female") echo "checked"; ?> id="female" value="female">
                <label class="form-check-label" for="female">
                    Female
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" <?php if (isset($gender) && $gender == "others") echo "checked"; ?> id="others" value="others">
                <label class="form-check-label" for="others">
                    Others
                </label>
            </div>

            <span class="text-danger"> <?php if (!empty($errorsToDisplay['gender'])) {
                                            echo $errorsToDisplay['gender'];
                                        } ?></span>

            <div class="col-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" name="address" id="address" rows="3"> <?php if (isset($_POST['address'])) {
                                                                                            echo $_POST['address'];
                                                                                        } ?></textarea>
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['address'])) {
                                            echo $errorsToDisplay['address'];
                                        } ?></span><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="skills[]" type="checkbox" id="singing" value="singing">
                <label class="form-check-label" for="singing">Singing</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="skills[]" type="checkbox" id="dancing" value="dancing">
                <label class="form-check-label" for="dancing">Dancing</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" name="skills[]" type="checkbox" id="sports" value="sports">
                <label class="form-check-label" for="sports">Sports</label>
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['skills'])) {
                                            echo $errorsToDisplay['skills'];
                                        } ?></span>
            <div class=" col-3 form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="<?php if (isset($_POST['password'])) echo $_POST['password']; ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['password'])) {
                                            echo $errorsToDisplay['password'];
                                        } ?></span><br>

            <div class=" col-3 form-group">
                <label for="profile_image">Profile Image:</label>
                <input type="file" class="form-control" id="profile_image" name="profile_image" value="<?php if (isset($_FILES['profile_image'])) echo $_FILES['profile_image']; ?>">
            </div>
            <span class="text-danger"> <?php if (!empty($errorsToDisplay['profile_image'])) {
                                            echo $errorsToDisplay['profile_image'];
                                        } ?></span><br>
            <div class="card">
                <div class="card-body">
                    <div class="input-group mb-3">
                        <select class="form-select" id="country" name="country">
                            <option>Select Country</option>
                            <?php while ($row = mysqli_fetch_assoc($country_result)) : ?>
                                <option value="<?php echo $row['id']; ?>"> <?php echo $row['country_name']; ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <select class="form-select" id="state" name="state">
                            <option>Select state </option>
                        </select>
                    </div>

                </div>
            </div><br>
            <input type="submit" name="submit" value="Submit" class="btn btn-secondary">
        </form>
    </div>
    <?php include("layout/footer.php"); ?>
    <script>
        $('#country').on('change', function() {

            //console.log(this.value);

            var country_id = this.value;
            // console.log(country_id);
            $.ajax({
                url: 'ajax/state.php',
                type: "POST",
                data: {
                    country_data: country_id
                },
                success: function(result) {

                    $('#state').html(result);

                }
            })
        });
    </script>
    <!-- <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
$(socument).ready(function(){
function loadData(){
    $.ajax({
url:"state.php",
type="POST",
success:function(data){
$("#country").append(data);

}



    });
}

});






</script>
 -->


</body>

</html>