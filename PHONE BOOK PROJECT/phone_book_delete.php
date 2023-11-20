<?php


$conn=mysqli_connect('localhost','root','','jagya');







    $id=$_POST['row'];
    $sql="DELETE FROM `phone_book` WHERE id='$id'";

    $query=mysqli_query($conn,$sql);


?>