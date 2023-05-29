<?php
include 'ConnMB.php';
if(isset($_POST["plus"])){
    $user=$_COOKIE["uname"];
    $id=$_POST["iditem"];
    $item=mysqli_query($con,"SELECT * FROM `items` WHERE `items`.`ID`='$id'");
    $itemDet=mysqli_fetch_array($item);
    $cnt=($_POST["Quantity"]+1);
    if($cnt<=$itemDet["Stock"]){
    $iditem=$_POST["iditem"];
    mysqli_query($con,"UPDATE `cart` SET `Quantity`='$cnt' WHERE `cart`.`user-ID`='$user' AND `cart`.`item-ID`='$iditem'");
    }else{
        echo "<script>alert('The max u can order')</script>";
    }
    header("location:Cart.php");
}
if(isset($_POST["menus"])){
    $cnt=$_POST["Quantity"]-1;
    $user=$_COOKIE["uname"];
    $id=$_POST["iditem"];
    $item=mysqli_query($con,"SELECT * FROM `items` WHERE `items`.`ID`='$id'");
    $itemDet=mysqli_fetch_array($item);
    if($cnt==0){
        mysqli_query($con,"DELETE FROM `cart` WHERE `cart`.`user-ID`='$user' AND `cart`.`item-ID`='$id'");
        header("location:Cart.php");
    }else{
    mysqli_query($con,"UPDATE `cart` SET `Quantity`='$cnt' WHERE `cart`.`user-ID`='$user' AND `cart`.`item-ID`='$id'");
    header("location:Cart.php");
    }
   
} 
if(isset($_POST["delete"])){
        $user=$_COOKIE["uname"];
        $iditem=$_POST["iditem"];
        mysqli_query($con,"DELETE FROM `cart` WHERE `cart`.`user-ID`='$user' AND `cart`.`item-ID`='$iditem'");
        header("location:Cart.php");
    }
?>