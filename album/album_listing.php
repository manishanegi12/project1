<?php
session_start();
include("../layout/header.php");
$connection = mysqli_connect("localhost","root", "Teamwebethics3!","registration");
// if(isset($_SESSION['user_id'])){

$id = $_SESSION['user_id'];


include("header.php");

$select_query = "SELECT * FROM album_photo WHERE album_id=".$_SESSION['user_id'];
 $select_result = mysqli_query($connection, $select_query);
// if(isset($_SESSION['insert'])){

if (!empty($_SESSION['insert'])) {
    $insert_message = $_SESSION['insert'];
    unset($_SESSION['insert']);
}
?>

<body>
    <div class="container">
        <form method="post" action="add-album.php">
            <!-- <label>Add New Album:</label><br>
            <input type="text" name="album_name" /> -->
            <input type="submit" name="submit_album" value="Add New Album" />
        </form><br>
    </div>
    <table class="table">

        <thead>
            <tr>
                <?php if (!empty($insert_message)) {


                    echo " <div class='alert alert-success'>$insert_message</div>";
                } ?>
                <th>Album ID</th>
                <th>Album Title</th>
                <th>Album Description</th>
                <th>Album Place</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $row = mysqli_num_rows($select_result);
            if ($row > 0) {
                while ($row = mysqli_fetch_array($select_result)) {
                    $_SESSION['user_id'] = $row['album_id'];


                    //    echo "<pre>"; print_r($row);die;
            ?>
                    <tr>

                        <td><?php echo $i; ?></td>
                        <td><?php echo $row['album_title']; ?></td>
                        <td><?php echo $row['album_description']; ?></td>
                        <td><?php echo $row['album_place']; ?></td>
                        <td> <a class="btn btn-primary" href="edit_album.php?id=<?php echo $row['album_id']; ?>">EDIT

                            </a>

                            <a class="btn btn-danger" href="delete_album.php?id=<?php echo $row['album_id']; ?>">DELETE

                            </a>
                            <a class="btn btn-secondary" href="hjshhj_album.php?id=<?php echo $row['']; ?>">Gallery

                            </a>
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
    <?php include("../layout/footer.php");?>
</body>

</html>