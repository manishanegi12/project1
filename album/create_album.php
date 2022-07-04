<?php 
session_start();
include("../layout/header.php");
$connection = mysqli_connect("localhost", "root", "Teamwebethics3!", "registration");

include("header.php");
if (isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_POST);die;
    
    $title = $_POST['album_title'];
    $discription = $_POST['album_discription'];
    $place = $_POST['album_place'];
    $created =  date('Y-m-d H:i:s');
     $insert_query = "INSERT INTO album_photo(`album_title`,`album_place`,`album_description`,`created_on`,`id`)VALUES('$title','$place','$discription','$created')".$_SESSION['user_id']; 
    $result = mysqli_query($connection, $insert_query);
    //    print_r($result);
    //    die;
    if ($result) {
        $_SESSION['insert'] = "Inserted successfully";
        header("Location: album_listing.php");
    } else {
        echo "not inserted" . mysqli_error($connection);
    }
}
?>

<body>
    <div class="container">
        <form method="POST" action="">

            <label for="album_title">Album Title</label>
            <div class="col-3">
                <input type="text" name="album_title" id="album_title" class="album_title">
            </div>

            <label for="album_discription">Album Discription</label>
            <div class="col-3">
            <input type="text" name="album_discription" id="album_discription" class="album_discription">
    </div>
   
        <label for="album_place">Album Place</label>
        <div class="col-3">
        <input type="text" name="album_place" id="album_place" class="album_place">
    </div>
    <div><br>
        <button type="submit" name="submit" class="btn btn-secondary">Submit </button>
    </div>
    </form>
    </div>
    <?php include("../layout/footer.php"); ?>
</body>

</html>