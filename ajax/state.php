<?php
include("../config/connection.php");
 $country_id=$_POST['country_data'];

$state="select * from state where country_id=$country_id";

$state_query=mysqli_query($connection,$state);
//echo $state_query;
$output='<option value="">Select state</otion>';
while($state_row=mysqli_fetch_assoc($state_query)){
    $output.='<option value="'. $state_row['state_id'].'">'.$state_row['state_name'].'</option>';

}
echo $output;
?>

<!-- 
include("config/connection.php");


$country_query="SELECT * FROM country";
 $country_result=mysqli_query($connection,$country_query);
 $str="";
 while($row=mysqli_fetch_assoc($country_result)){
$str .="<option value='{$row['id']}'>{$row['country_name']}</option>";
echo $str;

 }
?> --> 