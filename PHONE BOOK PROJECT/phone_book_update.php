<?php 


$conn=mysqli_connect('localhost','root','','jagya');

$id=$_POST['row'];
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$address=$_POST['address'];

$sql="UPDATE `phone_book` SET Name='$name',Mobile='$mobile',Address='$address' WHERE id='$id'";

mysqli_query($conn,$sql);



?>