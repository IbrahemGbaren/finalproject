<?php
include 'menuU.php';
include 'bootstrap.php';
include 'connMB.php';
$user=$_COOKIE["uname"];

$useritems=mysqli_query($con,"SELECT * FROM `cart` WHERE `cart`.`user-ID`='$user'");
if(mysqli_num_rows($useritems)!=FALSE){
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<div class="py-5">
<div class="container">
<div class="mb-3">
<a href="items.php"><button class="btn btn-dark">Back</button></a>
</div>
<div class="card card-body shadow ">
<div class="row">
<div class="col-md-12">
<div class="row align-items-center">
        <div class="col-md-2">
          <h5> Product </h5>
        </div>
        <div class="col-md-2">
          <h5> Name </h5>
        </div>
        <div class="col-md-2">
            <h5>Price</h5>
        </div>
        <div class="col-md-2" >
        <h5>Quantity</h5>
        </div>
        <div class="col-md-2">
        <h5>Type</h5>
        </div>
        <div class="col-md-2" >
        <h5>Delete</h5>
        </div>
    </div>

<?php
$totalprice=0;
while($cartitem=mysqli_fetch_array($useritems)){
    $id=$cartitem["item-ID"];
    $item=mysqli_query($con,"SELECT * FROM `items` WHERE `items`.`ID`='$id'");
    $itemDet=mysqli_fetch_array($item);
    $itemprice=$itemDet["Price"]*$cartitem["Quantity"];
    $totalprice+=$itemprice;
    ?>
    <div class="card shadow-sm mb-2">
    <div class="row align-items-center">
        <div class="col-md-2">
           <img src=" <?= $itemDet["Picture"] ?>" class="w-50" alt="image"/>
        </div>
        <div class="col-md-2">
           <?= $itemDet["Name"] ?>
        </div>
        <div class="col-md-2">
            <?= $itemprice ?>
        </div>
        <div class="col-md-2" >
        <form method="post" action="itemcart.php">
    <br>
    <input type="hidden" name="iditem" value="<?= $cartitem["item-ID"] ?>" />
    <div class="input-group mb-3" style="width:130px">
    <input class="input-group-text decreament-btn" type="submit" name="menus" value="-"/> 
    <input class="from-control text-center input-qty bg-white" type="text" name="Quantity" value="<?=$cartitem["Quantity"] ?>" size="1" readonly />
    <input class="input-group-text decreament-btn" type="submit" name="plus" value="+"/>
    </div>
        </div>
        <div class="col-md-2">
                    <?=  $itemDet["Type"] ?>
        </div>
                <div class="col-md-2">
                    <button class="btn btn-danger btn-sm" type="submit" name="delete" ><i class="fa fa-trash"></i> Remove </button>
                    
                </form>
                </div>
            </div>
        </div>
    

    <?php
}
?>
<div class="float-end"><a href="bill.php" class="btn btn-success"> Procced to Check out </a></div>
<div class="col-md-2"><h5>Total Price : <?= $totalprice ?></h5></div>
</div>
</div>
</div>
</div>
</div>
</body>
<?php
  }else{
    header("location:items.php");
  }
?>