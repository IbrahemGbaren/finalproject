<?php
include 'menuM.php';
$con=mysqli_connect("localhost","root","","storedatabase");
$result = mysqli_query($con,"SELECT * FROM items");
$name=$_POST["name"];
$img=$_POST["pic"];
$price=$_POST["price"];
$Stock=$_POST["stock"];
$id=$_POST["id"];
$flag=0;
while($row=mysqli_fetch_array($result)){
    if($name==$row["Name"]&&$img==$row["Picture"]&&$price==$row["Price"]&&$Stock==$row["Stock"]){
        $flag=1;
    }
}
if($flag==0){
    $sql="UPDATE `items` SET `Name`='$name',`Stock`='$Stock',`Price`='$price',`Picture`='$img' WHERE `items`.`ID`='$id'";
    $r=mysqli_query($con,$sql);
    
    if(isset($r)){
    echo "<script>alert('Item Changed')</script>";
    header("refresh:2;url=ItemsM.php");
    }
}else{
    echo "<script>alert('You Havent Changed Anything ')</script>";
    header("refresh:2;url=ItemsM.php");
}
?>