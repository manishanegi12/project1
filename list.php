<?php
include("config/connection.php");
include("session.php");
include("layout/header.php");
if (!empty($_SESSION['first_name'])) {


    echo "<div id='form'> Welcome" . " " . ucfirst($_SESSION['first_name']) . "! You are logged In.</div>";

    echo "<div id='formHELP' style='display: block'>";
}
$select_query  = "SELECT u.id as user_id,u.phone,u.first_name,u.last_name,u.email,u.address,u.skills,u.profile_image,u.gender, c.country_name,s.state_name 
FROM users as u INNER JOIN country as c ON u.country_id=c.id  INNER JOIN state as s ON c.id = s.country_id where u.id !=" . $_SESSION['user_id'];

//$select_query = "SELECT * FROM users where id !=" . $_SESSION['user_id'];

$select_result = mysqli_query($connection, $select_query);
if (isset($_POST['submit'])) {
    header("Location: registration.php");
}
if (!empty($_SESSION['update'])) {
    $update_message = $_SESSION['update'];
    unset($_SESSION['update']);
}
if (!empty($_SESSION['delete'])) {
    $delete_message = $_SESSION['delete'];
    unset($_SESSION['delete']);
}
if (!empty($_SESSION['insert'])) {
    $insert_message = $_SESSION['insert'];
    unset($_SESSION['insert']);
}
if (!empty($_SESSION['password'])) {
    $password_message = $_SESSION['password'];
    unset($_SESSION['password']);
}
?>


<style>
    #logout {
        margin-top: 10%;
        ;
        margin-left: 90%;
        color: #6495ED;
        background: #FFEBCD;
        font-size: medium;
        padding: 8px;
        margin-top: 4px;

    }

    #form {
        text-align: center;

    }
</style>



<div class="container">
    <h2>Users records</h2>
    <form action="" method="post">
        <input type="submit" name="submit" value="Add Records"><br><br>
    </form>
    <form action="logout.php" method="post">
        <input type="submit" name="logout" value="Logout" id="logout">
    </form>
    <?php

    if (isset($_POST['logout'])) {
        header("Location: authentication.php");
    }
    if (!empty($password_message)) {


        echo " <div class='alert alert-success'>$password_message</div>";
    }

    if (!empty($insert_message)) {


        echo " <div class='alert alert-success'>$insert_message</div>";
    }

    if (!empty($update_message)) {


        echo " <div class='alert alert-success'>$update_message</div>";
    }
    if (!empty($delete_message)) {


        echo " <div class='alert alert-danger'>$delete_message</div>";
    }
    ?>


    <table class="table">
<p lorem2>
    
        <thead>
            <tr>
                <th>ID </th>
                <th>Profile</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Skills</th>
                <th>Country</th>
                <th>State</th>
                <th>Action</th>

            </tr>

        </thead>

        <tbody>
            <?php
            $i = 1;
            $row = mysqli_num_rows($select_result);
            if ($row > 0) {
                while ($row = mysqli_fetch_array($select_result)) {
                //    echo "<pre>"; print_r($row);die;
            ?>
                    <tr>

                        <td><?php echo $i; ?></td>
                     
                        <td> <img src='images/user_<?php echo $row['user_id'] ."/". $row['profile_image']; ?>' height='50px' width='50px' /></td>
                       
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['gender']; ?></td>
                        <td><?php echo $row['skills']; ?></td>

                        <td><?php echo $row['country_name']; ?></td>
                        <td><?php echo $row['state_name']; ?></td>

                        <td> <a class="btn btn-primary" href="edit-profile.php?id=<?php echo $row['user_id']; ?>">EDIT

                            </a>

                            <form method="GET" action="delete.php">
                                <input type="hidden" value="<?php echo $row['user_id']; ?>" name="id">
                                <input type="hidden" value="<?php echo $row['profile_image']; ?>" name="profile_image">
                                <button type="submit" name="delete" onclick="return checkdelete()" class="btn btn-danger">Delete</button>

                            </form>

                        </td>

                    </tr>
                <?php $i++;
                }
            } else { ?>
                <tr>
                    <th style="text-align:center;" colspan="6">No Records Found</th>
                </tr><?php } ?>

        </tbody>
    </table>

</div>


<script>
    function checkdelete()

    {
        return confirm('Are you sure you want to delete this record?');
    }
</script>
<?php include("layout/footer.php"); ?>