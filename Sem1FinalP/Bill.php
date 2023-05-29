<?php
include 'menuU.php';
$con=mysqli_connect("localhost","root","","storedatabase");
$user=$_COOKIE["uname"];
$items_from_cart=mysqli_query($con,"SELECT * FROM cart WHERE `cart`.`user-ID`='$user'");
$totalprice=0;
$cnt=1;
$locate=mysqli_query($con,"SELECT * FROM `location` WHERE `location`.`user-ID`='$user'");
$location=mysqli_fetch_array($locate);
if(mysqli_num_rows($locate)==FALSE){
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<a href="Cart.php" style="margin-left:240px;margin-top:100px"><button class="btn btn-dark mt-4">Back to Cart</button></a>
<?php
}else{
?>
<a href="Cart.php" style="margin-left:435px;margin-top:200px"><button class="btn btn-dark mt-4">Back to Cart</button></a>
<?php
}
?>
<style>
        th,td{
            padding:30px;
        }
        
    </style>
    <center>
<table>
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
    $itemprice=$item_Details["Price"]*$items["Quantity"];
    $totalprice+=$itemprice;
?>
    <tr>
        <td><?= $cnt++ ?></td>
        <td><?= $item_Details["Name"] ?></td>
        <td><?= $items["Quantity"] ?></td>
        <td><?= $item_Details["Price"] ?></td>
        <td><?= $itemprice ?></td>
        <td><?= date("d/m/y - h:s") ?></td>
    </tr>
<?php
}
$card=mysqli_query($con,"SELECT * FROM `user_cards` WHERE `user_cards`.`Default`=1 AND `user_cards`.`user-ID`='$user'");
$PickedCard=mysqli_fetch_array($card);
if(mysqli_num_rows($card)==FALSE){
    ?>
    <tr><td colspan='5'>No Default Card Selected : </td><td> <a href='Cards.php'>Pick Card</a></td><tr>
<?php
}else{ 
    ?>
    <tr><td colspan='4' style="text-align:right">Card Ends With :<br>-</td> <td> <?= substr($PickedCard["C-Number"],-4) ?>
    <?php
    $number=$PickedCard["C-Number"];
    $PickedCarddet=mysqli_query($con,"SELECT * FROM `card` WHERE `card`.`Number`='$number'");
   $carddetails=mysqli_fetch_array($PickedCarddet);
    if($carddetails["Type"]=="VISA"){
        echo "<img src='Pictures/visa.jpg' width=50px height=35px/>";
      }
      if($carddetails["Type"]=="MASTERCARD"){
        echo "<img src='Pictures/mastercard.jpg' width=100px height=35px/>";
      }
      if($carddetails["Type"]=="AMEX"){
        echo "<img src='Pictures/amex.png' width=100px height=35px/>";
      }
    ?>
    <br>
    Expires at : <?= $carddetails["Month"] ?>/<?= $carddetails["Year"] ?>
    <br>
    Owner is : <?= $carddetails["Owner"] ?>
    </td>
    <td><a href="Cards.php" class="btn btn-dark"> Change Default </a></td>
</tr>
<?php
}
        if(mysqli_num_rows($locate)==FALSE){
           ?> <tr>
            <form method="post">
                <td>LOCATION - Country = <input type="text" name="country"/></td>
                <td>City = <input type="text" name="city"/></td>
                <td>Postal Code = <input type="number" name="code"/></td>
                <td><input type="submit" name="send" /></td>
            </form>
            </tr>
           <?php
        }else{
            ?>
            <tr>
            
                <td>Location - Country = <?= $location["Country"] ?></td>
                <td>City = <?= $location["City"] ?></td>
                <td>Postal Code = <?= $location["PCode"] ?></td>
                <td><form method="post"><input class="btn btn-danger" type="submit" name="delete" Value="Change Location" /></form></td>
            </tr>
            <?php
        }
        ?>
    <tr>
        <td colspan='5' style="text-align:right">Total Price - <?= $totalprice ?> </td>
        <?php
        if(mysqli_num_rows($locate)!=FALSE&&mysqli_num_rows($card)!=FALSE){
        ?>
        <td >
        <form method="post" action="PayedSuccessfully.php" >
        <input class="btn btn-success" type='submit' Value='Confirm Payment' />
        </form>
        </td>
        <?php
        }else{
            ?>
<form>
    <td><input class="btn btn-success" type='submit' Value='Confirm Payment' disabled/></td>
</form>
    <?php
        }
        ?>
    </tr>
</table>
</center>
    </body>
<?php
if(isset($_POST["send"])){
    $country=$_POST["country"];
    $city=$_POST["city"];
    $PCode=$_POST["code"];
    if($country!=NULL&& $city!=NULL&& $PCode!=NULL){
        mysqli_query($con,"INSERT INTO `location`(`user-ID`, `Country`, `City`, `PCode`) VALUES ('$user','$country','$city','$PCode')");
    }else{
        echo"<script>alert('Wrong input')</script>";
    }
    header("refresh:0.2;url=Bill.php");
}
if(isset($_POST["delete"])){
mysqli_query($con,"DELETE FROM `location` WHERE `location`.`user-ID`='$user'");
header("location:Bill.php");
}
?>


