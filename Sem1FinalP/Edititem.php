<?php
include 'MenuM.php';
include 'bootstrap.php';
$id=$_POST["id"];

$con=mysqli_connect("localhost","root","","storedatabase");
$result = mysqli_query($con,"SELECT * FROM items");
while($row=mysqli_fetch_array($result)){
    if($row["ID"]==$id)
    break;
}

?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<form method="post" action="Checkedit.php">
<div class="card" style="width: 25%;margin-left:40%;margin-top:5%;background-color:blanchedalmond; background-size:cover;" >
<img src="<?= $row['Picture']?>" width="70%" height="250px" >
<input type ="hidden" name="id" value='<?= $row["ID"] ?>' />
<h4>Root of the Pic is </h4> <input type="text" name="pic" value='<?= $row["Picture"]?>'/>
<div class="card-body">
<h5 class="card-title">Name = </h5><input type="text" name="name"  value='<?= $row["Name"] ?>' />
<p class="card-text">Price = </p><input type="text" name="price" value='
 <?= $row["Price"] ?>' />
<div class="row" >
<div class="col-md-4">
    <div class="input-group mb-3" style="width:130px">
     <h4 >Stock = </h4><input type="text" name="stock" value="<?= $row['Stock'] ?>"/>
     
     <input type="submit" name="submit"/>
     </form>
</body>