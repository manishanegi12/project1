<?php

include("config/connection.php");

session_start();
if (isset($_POST['update'])) {
    $id =  $_POST['id'];
    $errorsArray = [];
    $postArr = $_POST;

    // echo "<pre>";
    // print_r($_POST);
    // die;
    // $postKeysArr = array_keys($postArr);
    // foreach ($postKeysArr as $key) {
    //     if ((gettype($_POST[$key]) === 'array') ?  empty($_POST[$key]) : empty(trim($_POST[$key]))) {
    //         $errorsArray[$key] = ucfirst(str_replace('_', ' ', $key))   . ' is required';
    //     }
    // }

    $email =  $_POST['email'];
    if (!empty($_POST['email'])) {
         $query = "SELECT * FROM users WHERE email ='$email'  AND id NOT IN ($id)";
        
        $result = mysqli_query($connection, $query);
        if (mysqli_num_rows($result) > 0) {
            $errorsArray['email'] = "This email address is already exists";
        }
    }
    if (empty($_POST['gender'])) {
        $errorsArray['gender'] = "please choose your gender";
    }
    if (empty($_POST['skills'])) {
        $errorsArray['skills'] = "please choose skills";
    }

    if (count($errorsArray) > 0) {
        $_SESSION['errors'] = $errorsArray;
        // print_r($errorsArray);
        //  die;
        header("Location: edit-profile.php?id=$id");
        exit();
    } else {
        $first_name = $_POST['first_name'];
        $last_name =  $_POST['last_name'];
        $email =  $_POST['email'];
        $address = trim($_POST['address']);
        $phone =  $_POST['phone'];
        $gender = $_POST['gender'];
        $skills = $_POST['skills'];
        $skills = implode(",", $skills);
        $updated_at = date("Y-m-d h:i:s");

        $profile_sub_field = '';
        if (!empty($_FILES['profile_image']['name'])) {
             $file_name = str_replace(" ", "_", time() . '_' . $_FILES['profile_image']['name']);
            $tmp_name = $_FILES['profile_image']['tmp_name'];
            $user='user';
            $path = "images/".$user."_".$id;
            // print_r( $path);die;
            if (!file_exists($path)) {
                mkdir($path, 0777);
            }
            $images_directory = $path.'/'.$file_name;
            // print_r($images_directory);
            // die;
            move_uploaded_file($tmp_name, $images_directory);
            $profile_sub_field = ",profile_image='$file_name'";
           //get old image name fom the table
            $old_image_name = mysqli_fetch_assoc(mysqli_query($connection, "SELECT profile_image FROM users WHERE id='$id'"))['profile_image'];

            unlink("$path/$old_image_name");
        }

      $update_query = "UPDATE users SET first_name='$first_name',last_name='$last_name',email='$email',phone='$phone', address='$address',gender='$gender',skills='$skills',updated_at='$updated_at' $profile_sub_field WHERE id='$id'";
        $update_result =  mysqli_query($connection, $update_query);
        // print_r($update_result);die;

        if ($update_result) {
       
            
            $_SESSION['update'] = "Updated Successfully";

            header("Location: list.php");
        } else {
            die("not updated" . mysqli_error($connection));
        }
    }
}
