<?php
include 'MenuM.php';
$con=mysqli_connect("localhost","root","","storedatabase");
$result = mysqli_query($con,"SELECT * FROM items");
$name=$_POST["name"];
$img=$_POST["pic"];
$price=$_POST["price"];
$Stock=$_POST["stock"];
$type=$_POST["Type"];
$flag=0;
while($row=mysqli_fetch_array($result)){
    if($name==$row["Name"]){
        $flag=1;
    }
}
if($flag==0&&$name!=NULL){
    $sql="INSERT INTO `items`( `Name`, `Stock`, `Price`, `Picture`, `Type`) VALUES ('$name','$Stock','$price','$img','$type')"; 
        $add= mysqli_query($con,$sql);
        echo "<script>alert('The Item has been inserted')</script>";
        header("location:ItemsM.php");
}else{
    echo "<script>alert('The Item is Already Found'".$name.")</script>";
    header("refresh:1;url=ItemsM.php");
}



?>