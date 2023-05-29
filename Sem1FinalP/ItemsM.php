<?php
include 'bootstrap.php';
if(isset($_COOKIE["loggedin"])){
  include 'menuu.php';
}else if(isset($_COOKIE["Manager"])){
  include 'menum.php';
}else{
  include 'menu.php';
}

$con=mysqli_connect("localhost","root","","storedatabase");



?>

  

<html>
    <body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<br>
    <?php
    $Type=array("MotherBoard","CPU","GPU","RAM","Storage");
    foreach($Type as $t){
      $result=mysqli_query($con,"SELECT * FROM `items` WHERE `items`.`Type`='$t'");
      ?>
      </div>
      <br>
      <center><h2><?= $t ?></h2></center>
      <br>
      <div class="card-deck ml-2 mr-2" >
      <?php
      
$cnt=0;
while($row=mysqli_fetch_array($result))
{
  $cnt++;
   if($cnt%5==0){
    echo "</div>
    <br>
    <div class='card-deck ml-2 mr-2'>";
  }
  ?>

  <div style="width:25%">
   <div class="card" style="background-color:blanchedalmond; background-size:cover;">
   <img src="<?=$row['Picture']?>" width="70%" height="250px" >
   <div class="card-body">
   <h5 class="card-title"> <?= $row["Name"] ?> </h5>
   <p class="card-text">Full name = <?= $row["Name"] ?> </p>
   <p class="card-text">Price : <?=
    $row["Price"] ?>  </p>
      <p class="card-text">
      Stock : <?= $row["Stock"]?>
      <br>
</p>
       <div class="input-group mb-1" style="width:130px">
       <form method="post" action="edititem.php">
       <input type ="hidden" name="id" value="<?=$row["ID"]?>" />
       <input class="btn btn-primary" type="submit" name="add" value="Edit Item / Update Stock "/> 
       </form>
       <form method="post" action="Deleteitem.php" >
       <input type ="hidden" name="id" value="<?=$row["ID"]?>" />
       <input style="margin-top:20px;" class="btn btn-primary" type="submit" name="add" value="Delete Item"/> 
       </form>
       <br>
       
       
       <br>
       </div>
       </div>
       </div>
 </div>
 <?php
} 
$cnt++;
if($cnt%5==0){
  echo "</div>
    <br>
    <div class='card-deck ml-2 mr-2'>";
    ?>
    <div style="width:25%">
   <div class="card" style="background-color:blanchedalmond; background-size:cover;">
   <form method="post" action="additem.php">
   <div class="card-body">
    <center><h2> Add - <?= $t ?></h2></center>
   <br>
   <p class="card-text">Root Of Pic : <input type="text" name="pic" /> </p>
   <br>
    <p class="card-text">Full name : <input type="text" name="name" /> </p>
   <br>
   <p class="card-text">Price : <input type="tel" name="price" /></p>
   <br>
   <p class="card-text">Stock : <input type="tel" name="stock" /></p>
   <br>
   <p class="card-text">Type : <input type="text" name="Type" value="<?= $t ?>"  readonly/></p>   
   <br>
   <br>  
   <input type="submit" class="btn btn-success" value="Add Item"/>
   <br>
   <br>
       </div>
       </div>
 </div>
</div>

    <?php
}else{
  ?>
   <div style="width:25%">
   <div class="card" style="background-color:blanchedalmond; background-size:cover;height:100%">
   
   <div class="card-body">
    <center><h2 class="mt-0"> Add - <?= $t ?></h2></center>
    <form method="post" action="additem.php">
    <br>
    <p class="card-text mt-0">Root Of Pic : <input type="text" name="pic" /> </p>
    <br>
    <p class="card-text">Full name : <input type="text" name="name" /> </p>
    <br>
    <p class="card-text">Price : <input type="number" name="price" /></p>
    <br>
    <p class="card-text">Stock : <input type="number" name="stock" /></p>
    <br>
    <p class="card-text">Type : <input type="text" name="Type" value="<?= $t ?>"  readonly size=8/></p>
    <br>
    <br> 
    <input type="submit" class="btn btn-success" value="Add Item" />
    </form>
       </div>
       </div>
 </div>
  <?php
}
}
?>


</body>
</html>
<?php

?>
