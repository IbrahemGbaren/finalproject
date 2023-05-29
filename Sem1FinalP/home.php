<?php
include 'Connmb.php';
if(isset($_COOKIE["loggedin"]))
include 'menuu.php';
else if(isset($_COOKIE["Manager"]))
include 'MenuM.php';
else
include 'menu.php';
?>
<center>
<h1>Home Page</h1>

<br>
<br>
<h3> Welcome To our shop : <?php
if(isset($_COOKIE["uname"])){
    echo $_COOKIE["uname"];
}else{
    echo "NULL <a href='log-in.php'>Log in to get your username here </a>";
}
?>
<br>We Have The Biggest collection in The PC Parts in The internet</h3>
<h4>The suggested items By Manager </h4>
</center>
<div class='card-deck ml-2 mr-2'>
<?php
$items=mysqli_query($con,"SELECT * FROM `history`");
$id=array(1,3,2);

foreach($id as $i){
    $items=mysqli_query($con,"SELECT * FROM `history` WHERE `item_id`='$i'");
    $item=mysqli_fetch_array($items);
?>
<div class="card" style="background-color:blanchedalmond; background-size:cover;">
   <img src="<?=$item['Picture']?>" width="70%" height="250px" >
   <div class="card-body">
   <h5 class="card-title"> <?= $item["Name"] ?> </h5>
   <p class="card-text">Full name = <?= $item["Name"] ?> </p>
   <p class="card-text">Price : <?=
    $item["Price"]/$item["Quantity"] ?>  </p>
        </div>
    </div>
<?php
}
?>

</div>