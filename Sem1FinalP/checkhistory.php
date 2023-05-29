<?php
include 'connMB.php';
if(isset($_COOKIE["Manager"])){
    include 'MenuM.php';
}else{
    include 'MenuU.php';
}
$user=$_POST["User"];
$date=$_POST["date"];
$useritems=mysqli_query($con,"SELECT * FROM `history` WHERE `history`.`user`='$user' AND `history`.`Date`='$date'");
$stat=mysqli_query($con,"SELECT * FROM `history` WHERE `history`.`user`='$user' AND `history`.`Date`='$date'");
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<div class="py-5">
<div class="container" >
<div class="mb-3" >
    <?php
    $getstatus=mysqli_fetch_array($stat);
    $status=$getstatus["Status"];
    if(isset($_COOKIE["Manager"])){
    echo "<a href='ordersM.php'><button class='btn btn-dark'>Back</button></a>";
    }else{
        echo "<a href='ordersU.php'><button class='btn btn-dark'>Back</button></a>";
    }
?>
</div>
<?php
if($status=="Pending...")
echo "<div class='card card-body shadow' style='background-color:red;'>";
else if($status=="Checked By Manager")
echo "<div class='card card-body shadow' style='background-color:yellow;'>";
else
echo "<div class='card card-body shadow' style='background-color:green;'>";
?>
<div class="row">
<div class="col-md-12">
<div class="row align-items-center">   
        <div class="col-md-2">
          <h5> Product  </h5>
        </div>
        <div class="col-md-2">
          <h5> Name </h5>
        </div>
        <div class="col-md-2">
            <h5>Price for one</h5>
        </div>
        <div class="col-md-2" >
        <h5>Quantity</h5>
        </div>
        <div class="col-md-2">
        <h5>Paid With</h5>
        </div>
        <div class="col-md-2" >
        <h5>Date</h5>
        </div>     
    </div>
<?php
$totalprice=0;
while($iteminhistory=mysqli_fetch_array($useritems)){
    $id=$iteminhistory["Item_id"];
    $item=mysqli_query($con,"SELECT * FROM `items` WHERE `items`.`ID`='$id'");
    $itemDet=mysqli_fetch_array($item);
    $itemprice=$iteminhistory["Price"];
    $totalprice+=$itemprice;
    $C_NUMBER=$iteminhistory["C-Number"];
    ?>
    <div class="card shadow-sm mb-2">
    <div class="row align-items-center">
        <div class="col-md-2">
           <img src=" <?= $iteminhistory["Picture"] ?>" class="w-50" alt="image" />
        </div>
        <div class="col-md-2">
           <?php 
           if(mysqli_num_rows($item)==FALSE)
           echo "Deleted Item - ". $iteminhistory["Name"]; 
           else
           echo $itemDet["Name"];
           ?>
        </div>
        <div class="col-md-2">
            <?= $itemprice/$iteminhistory["Quantity"] ?>
        </div>
        <div class="col-md-2" >
            <?= $iteminhistory["Quantity"] ?>
        </div>
        <div class="col-md-2">
        Card ends with - <?= substr($C_NUMBER,-4) ?><br><br>
        <?php
        $PickedCarddet=mysqli_query($con,"SELECT * FROM `card` WHERE `card`.`Number`='$C_NUMBER'");
        $carddetails=mysqli_fetch_array($PickedCarddet);
        if($carddetails["Type"]=="VISA"){
        echo "<img src='Pictures/visa.jpg' width=50px height=35px />";
        }
        if($carddetails["Type"]=="MASTERCARD"){
        echo "<img src='Pictures/mastercard.jpg' width=100px height=35px />";
        }
        if($carddetails["Type"]=="AMEX"){
        echo "<img src='Pictures/amex.png' width=100px height=35px />";
        }
    ?>
    <br>
    <br>
    Expires at : <?= $carddetails["Month"] ?>/<?= $carddetails["Year"] ?>
    <br>
    Owner is : <?= $carddetails["Owner"] ?> 
        </div>
        <div class="col-md-2">
            <?= $iteminhistory["Date"] ?>
        </div>
        </div>
        </div>
        
    <?php
}
?>
<div class="col-md-2"><h5>Total Price : <?= $totalprice ?> <?= $status ?></h5></div>
</div>
</div>
</div>
</div>
</div>
</body>
