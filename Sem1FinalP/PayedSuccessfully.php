<?php
include 'menuU.php';
$con=mysqli_connect("localhost","root","","storedatabase");
$user=$_COOKIE["uname"];
$items_from_cart=mysqli_query($con,"SELECT * FROM cart WHERE `cart`.`user-ID`='$user'");
$totalprice=0;
$cnt=1;
?>

<style>
        th,td{
            padding:30px;
        }
        
    </style>
    <center>
<table style="background-color:Green;margin-top:100px">
    <tr>
    <th>Item Number</th>
    <th>Name</th>
    <th>Quantity</th>
    <th>Price for one</th>
    <th>Price</th>
    <th>Date</th>
    </tr>
<?php
while($items=mysqli_fetch_array($items_from_cart)){
    $id=$items["item-ID"];
    $item=mysqli_query($con,"SELECT * FROM `items` WHERE `items`.`id`='$id'");
    $item_Details=mysqli_fetch_array($item);
    $item_name=$item_Details["Name"];
    $item_picture=$item_Details["Picture"];
    $itemprice=$item_Details["Price"]*$items["Quantity"];
    $quantity=$items["Quantity"];
    $totalprice+=$itemprice;
    $newQ=$item_Details["Stock"]-$quantity;
    mysqli_query($con,"UPDATE `items` SET `Stock`='$newQ' WHERE `items`.`ID`='$id'");
    $card=mysqli_query($con,"SELECT * FROM `user_cards` WHERE `user_cards`.`user-ID`='$user' AND `user_cards`.`Default`=1");
    $cardDetails=mysqli_fetch_array($card);
    $cardnum=$cardDetails["C-Number"];
    $location=mysqli_query($con,"SELECT * FROM `location` WHERE `location`.`user-ID`='$user'");
    $DetLoc=mysqli_fetch_array($location);
    $country=$DetLoc["Country"];
    $city=$DetLoc["City"];
    $Pcode=$DetLoc["PCode"];
?>
    <tr>
        <?php
        mysqli_query($con,"INSERT INTO `history`(`User`, `C-Number`, `Item_id`, `Quantity`, `Price`, `Country`, `City`, `PCode` , `Name`, `Picture`) VALUES ('$user','$cardnum','$id','$quantity','$itemprice','$country','$city','$Pcode','$item_name','$item_picture')");
        ?>
        <td><?= $cnt++ ?></td>
        <td><?= $item_Details["Name"] ?></td>
        <td><?= $items["Quantity"] ?></td>
        <td><?= $item_Details["Price"] ?></td>
        <td><?= $itemprice ?></td>
        <td><?= date("d/m/y") ?></td>
<?php
}
    ?>
    <tr>
        <td colspan='5' style="text-align:right">Total Price - <?= $totalprice ?> </td>
    </tr>
<?php

mysqli_query($con,"DELETE FROM `cart` WHERE `cart`.`user-ID`='$user'");
header("refresh:3;url=items.php");
?>
</table>
</center>


