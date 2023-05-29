<?php
include 'MenuM.php';
$id=$_POST["id"];

$con=mysqli_connect("localhost","root","","storedatabase");
$result = mysqli_query($con,"SELECT * FROM items");
while($row=mysqli_fetch_array($result)){
    if($row["ID"]==$id)
    break;
}
?>
<div class="card" style="width: 18rem;margin-left:40%;margin-top:5%" >
<img src="<?=$row['Picture'] ?>" width="70%" height="250px" >
<h4>Root of the Pic is : <?= $row["Picture"] ?></h4> 
<div class="card-body">
<h5 class="card-title">Name = <?= $row["Name"]?></h5> 
<p class="card-text">Price = <?=
 $row["Price"] ?></p> 
<div class="row" >
<div class="col-md-4">
    <div class="input-group mb-3" style="width:130px">
     <h4>Stock = <?= $row["Stock"]?></h4>
     <?php
     echo "This item will be deleted";
     $sql="DELETE FROM `items` WHERE `items`.`ID`='$id'";
     mysqli_query($con,$sql);
     $sql2="DELETE FROM `Cart` WHERE `Cart`.`item-ID`='$id'";
     mysqli_query($con,$sql);
     header("refresh:2;url=ItemsM.php");
?>