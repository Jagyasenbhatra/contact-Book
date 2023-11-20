<?php


$conn=mysqli_connect('localhost','root','','jagya');


$name=$_POST['a'];
$mobile=$_POST['b'];
$address=$_POST['c'];

$sql="INSERT INTO `phone_book`(Name,Mobile,Address) VALUES('$name','$mobile','$address')";

$query=mysqli_query($conn,$sql);


?>