<?php
$con=mysqli_connect("localhost","root","","storedatabase");
$user=$_POST["username"];
$iditem=$_POST["id"];
if(!isset($_COOKIE["uname"])){
echo "<script> alert('You have to log-in')</script>";
header("refresh:0.5;url=log-in.php");
}else{
    $sql="SELECT * FROM `cart` WHERE `cart`.`user-ID`='$user'";
    $result2 = mysqli_query($con,$sql);
    $flag=0;
    while($row=mysqli_fetch_array($result2)){
        if($iditem==$row["item-ID"]&& $user==$row["user-ID"]){
            $flag=1;
            echo "<script> alert('The item is already in the cart')</script>";
            header("refresh:0.5;url=items.php");
        }
    }
    if($flag==0){
        echo $user;
        $r=mysqli_query($con,"INSERT INTO `cart`(`user-ID`, `item-ID`, `Quantity`) VALUES ('$user','$iditem',1)");
        if(isset($r)){
            echo "<script>alert('new item added')</script>";
            header("location:items.php");
        }
    }
}
?> 