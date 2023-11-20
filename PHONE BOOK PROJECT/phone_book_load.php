<?php 

$conn=mysqli_connect('localhost','root','','jagya');


$sql="SELECT * FROM `phone_book`";

$query=mysqli_query($conn,$sql);
$row=mysqli_num_rows($query);
echo "Total Contact : ".$row;
?>
<!-- <h1><?php echo $row;?></h1> -->
<tr id="1">
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Mobile No</th>
                    <th>Address</th>
                    <th colspan="2">Operation</th>
                </tr>
<?php
  $row=0;
while($demo=mysqli_fetch_array($query))
{
    $row=$row+1;
    ?>
    <tr id="<?php echo $demo['id'];?>">
        <td><?php echo $row;?></td>
        <td target="name" ><?php echo $demo['Name'];?></td>
        <td target="mobile" ><?php echo $demo['Mobile'];?></td>
        <td target="address" ><?php echo $demo['Address'];?></td>
        
        <td><button class="update-btn" id="<?php echo $demo['id'];?>">Update</button></td>
        <td><button class="delete-btn" id="<?php echo $demo['id'];?>">Delete</button></td>
    </tr>
    <?php
}


?>