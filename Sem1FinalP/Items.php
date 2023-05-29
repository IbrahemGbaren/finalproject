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
<?php
    if(isset($_COOKIE["uname"])){
      $user=$_COOKIE["uname"];
      $sql="SELECT * FROM `cart` WHERE `cart`.`user-ID`='$user'";
      $rows_USER = mysqli_query($con,$sql);
      if(mysqli_num_rows($rows_USER)!=FALSE){
        $items_incart=mysqli_num_rows($rows_USER);
        echo "<div style='position: fixed;right: 0;top :100px;z-index:1'>
        <a href='Cart.php' style='font-size:25px'><button><img src='Pictures/cart.png' width=40px height=40px /> ".$items_incart."</button></a>
              </div>";
      }
      }
?>
<br>

    <?php
    $Type=array("MotherBoard","CPU","GPU","RAM","Storage");
    foreach($Type as $t){
      $result=mysqli_query($con,"SELECT * FROM `items` WHERE `items`.`Type`='$t'");
      if(mysqli_num_rows($result)!=FALSE){
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
       <div class="input-group mb-3" style="width:130px">
       <form method="post" action="Check.php">
       <input type="hidden" name="username" value="<?php
       if(isset($_COOKIE["uname"])) 
          echo $_COOKIE["uname"];
       else
          echo "/" ;
          ?>
          " />
       <input type ="hidden" name="id" value="<?=$row["ID"]?>" />
       <?php
       if($row["Stock"]>0){
       echo ' <input class="btn btn-dark" type="submit" value="Add To Cart" /> ';
      }else{
       echo '<input class="btn btn-dark" type="submit" Value="Out Of Stock" disabled />';
       }
       ?>
       
       </form>
       <br>
       </div>
       </div>
       </div>
 </div>
 <?php
} 
}
}
?>
</div>

</body>
</html>
