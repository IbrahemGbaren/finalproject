<?php
include 'MenuU.php';
include 'connMB.php';
ob_start();
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<div style="margin-up : 100px">
<div class="container">
    <div class="mb-3">
<?php
$user=$_COOKIE["uname"];
$orders=mysqli_query($con,"SELECT * FROM `history` WHERE `history`.`User`='$user' ORDER BY `history`.`Date` DESC");
$date=array();
$cnt=1;
while($row=mysqli_fetch_array($orders)){
    $date[]=$row["Date"];
}
$date=array_unique($date);

?>

<style>
        th,td{
            padding:30px;
        }
        table{
            margin-bottom: 25px;
        }
        
    </style>
          <h3>Username - <?= $user ?></h3>

    
<table >
    <tr>
    <th>Order Number</th>
    <th>Date</th>
    <th>Paid With</th>
    <th>Total Price</th>
    <th>Change Status</th>
    <th>Status</th>
    <th>Delevering to</th>
    <th>Details</th>
    </tr>
    
        <?php
        if(count($date)>0){
        foreach($date as $d){
        ?>
        <tr>
        <td><?= $cnt++ ?></td>
        <td><?= $d ?></td>
        <?php
        $order=mysqli_query($con,"SELECT * FROM `history` WHERE `history`.`User`='$user' AND `history`.`Date`='$d'");
        $price=0;
        while($row=mysqli_fetch_array($order)){
            $price+=$row["Price"];
            $C_NUMBER=$row["C-Number"];
            $status=$row["Status"];
            $country=$row["Country"];
            $city=$row["City"];
            $pcode=$row["PCode"];
        }
        ?>
        <td>Card ends with - <?= substr($C_NUMBER,-4) ?><br><br>
        <?php
        $PickedCarddet=mysqli_query($con,"SELECT * FROM `card` WHERE `card`.`Number`='$C_NUMBER'");
        $carddetails=mysqli_fetch_array($PickedCarddet);
        if($carddetails["Type"]=="VISA"){
        echo "<img src='Pictures/visa.jpg' width=50px height=35px/>";
        }
        if($carddetails["Type"]=="MASTERCARD"){
        echo "<img src='Pictures/mastercard.jpg' width=100px height=35px/>";
        }
        if($carddetails["Type"]=="AMEX"){
        echo "<img src='Pictures/amex.png' width=100px height=35px/>";
        }
    ?>
    <br>
    <br>
    Expires at : <?= $carddetails["Month"] ?>/<?= $carddetails["Year"] ?>
    <br>
    Owner is : <?= $carddetails["Owner"] ?>
    
        </td>
        <td><?= $price ?></td>
        <td>
        <?php
        if($status=="Checked By Manager"){
        ?>
           
        <form method="post">
            <input type="hidden" name="date" value="<?= $d ?>" readonly />
            <input type="hidden" name="User" value="<?= $user ?>" readonly /> 
            <input type="submit" name="send" class="btn btn-success" value="Deleverd?" />
        </form>
        <?php
        }else{
        ?>
        <form> 
            <input type="submit" class="btn btn-dark" value="Change" disabled/>
        </form>
        
        <?php
        }
        ?>
        </td>
        
        <?php
        if($status=="Pending..."){
        ?>
        <td style="background-color:red;">
            <?= $status ?>
        </td>
        <?php
        }else if($status=="Checked By Manager"){
       ?>
        <td style="background-color:yellow;">
            <?= $status ?>
        </td>
       <?php
        }else{
       ?>
       <td style="background-color:green;">
            <?= $status ?>
        </td>
       <?php
        }
       ?>
        
        <td>
            <?= $country ?><br>
            <?= $city ?><br>
            <?= $pcode ?>
        </td>
        <td>
        <form method="post" action="checkhistory.php">
            <input type="hidden" name="date" value="<?= $d ?>" readonly />
            <input type="hidden" name="User" value="<?= $user ?>" readonly /> 
            <input type="submit" class="btn btn-success" value="View Details" />
        </form>
        </td>
        </tr>
        <?php
        }
    }else{
        ?>
        <tr>
    <td>Nothing Yet</td>
    <td>Nothing Yet</td>
    <td>Nothing Yet</td>
    <td>Nothing Yet</td>
    <td>Nothing Yet</td>
    <td>Nothing Yet</td>
    <td>Nothing Yet</td>
    <td>Nothing Yet</td>
    </tr>
    <?php
    }
    ?>
    </table>
</div>
</div>
</div>
</body>
    <?php
    if(isset($_POST["send"])){
    $user=$_POST["User"];
    $date=$_POST["date"];
    mysqli_query($con,"UPDATE `history` SET `Status`='Delivered Successfully' WHERE `history`.`User`='$user' AND `history`.`Date`='$date'");
    header("refresh:0.2;url=ordersU.php");
    ob_end_flush();
}


?>