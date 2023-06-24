<?php
include 'menuU.php';
$cnt=1;
$con=mysqli_connect("localhost","root","","storedatabase");
$user=$_COOKIE["uname"];
$cards=mysqli_query($con,"SELECT * FROM `user_cards` WHERE `user_cards`.`user-ID`='$user'");
if(mysqli_num_rows($cards)!=FALSE){
while($row=mysqli_fetch_array($cards)){
    $num=$row["C-Number"];
    $card=mysqli_query($con,"SELECT * FROM `card` WHERE `card`.`Number`='$num'");
    $card_Details=mysqli_fetch_array($card);
if($card_Details["Year"]==date('Y')-2000&&$card_Details["Month"]==date('m')){
    mysqli_query($con,"DELETE FROM `user_cards` WHERE `user_cards`.`Number`='$num'");   
   
}else{
    if($row["Default"]==1){
      ?>
    <div class="card" style="margin-top:20px;border: solid 8px Black">
    <h5 class="card-header">Card Number <?= $cnt++?> DEFAULT</h5>
    <div class="card-body">
      <h5 class="card-title">This CARD is type Of <?=$card_Details["Type"] ?></h5>
      <?php
      if($card_Details["Type"]=="VISA"){
        echo "<img src='Pictures/visa.jpg' width=100px height=35px/>";
      }
      if($card_Details["Type"]=="MASTERCARD"){
        echo "<img src='Pictures/mastercard.jpg' width=100px height=35px/>";
      }
      if($card_Details["Type"]=="AMEX"){
        echo "<img src='Pictures/amex.png' width=100px height=35px/>";
      }
      ?>

      <p class="card-text">Card Number ends With <?= substr($num, -4) ?></p>
      <p class="card-text">EXP DATE : <?= $card_Details["Month"] ?> /<?= $card_Details["Year"] ?> </p>
      <h5 class="card-title">Owner is : <?=$card_Details["Owner"] ?></h5>
      <form method ="post" action="deletecard.php">
          <input type="hidden" value="<?= $card_Details["Number"] ?>" name="num"/>
          <input type="submit" name="del" value="Delete Card" />
          </form>
    </div>
  </div>
      <?php
    }else{
    ?>
        <div class="card" style="margin-top:20px;border: solid 2px Black">
        <h5 class="card-header">Card Number <?= $cnt++?></h5>
        <div class="card-body">
          <h5 class="card-title">This CARD is type Of <?= $card_Details["Type"]?></h5>
          <?php
          if($card_Details["Type"]=="VISA"){
            echo "<img src='Pictures/visa.jpg' width=100px height=35px/>";
          }
          if($card_Details["Type"]=="MASTERCARD"){
            echo "<img src='Pictures/mastercard.jpg' width=100px height=35px/>";
          }
          if($card_Details["Type"]=="AMEX"){
            echo "<img src='Pictures/amex.png' width=100px height=35px/>";
          }
          ?>
          <p class="card-text">Card Number ends in <?= substr($num, -4) ?></p>
          <p class="card-text">EXP DATE : <?= $card_Details["Month"] ?>/<?= $card_Details["Year"] ?> </p>
          <h5 class="card-title">Owner is : <?=$card_Details["Owner"] ?></h5>
          <form method ="post">
          <input type="hidden" value="<?= $card_Details["Number"] ?>" name="num"/>
          <input type="submit" name="def" value="SET DEFALUT" class="btn btn-dark"/>
          </form>
          <form method="post" action="deletecard.php">
          <input type="hidden" value="<?= $card_Details["Number"] ?>" name="num"/>
          <input type="submit" name="del" value="Delete Card" class="btn btn-primary"/>
        </form>
        </div>
      </div>
      <?php
    }
}
}
?>
<a href="bill.php"  ><button class="btn btn-success mt-2" >Get To The Bill</button></a>
<?php
if(mysqli_num_rows($cards)<3){
    echo "<a style='margin-top:20px;margin-left:20px' class='btn btn-primary' href='addcard.php'>Add Card</a>";
}else{
  ?>
  <a>Delete one to Add Another One</a>
  <?php
}
}else{
    echo "You dont have any Card in Your Account Going to AddCard Page";
    header("refresh:1;url=addcard.php");
}
if(isset($_POST["def"])){
    $number=$_POST["num"];
    mysqli_query($con,"UPDATE `user_cards` SET `Default`=0 WHERE `user_cards`.`Default`=1");
    mysqli_query($con,"UPDATE `user_cards` SET `Default`=1 WHERE `user_cards`.`user-ID`='$user' AND `user_cards`.`C-Number`='$number'");
    header("location:Cards.php");
}
// add to cart user , but if the quantity is less the quantity in the stuck then the cart of the user is updated with no item from the one who is less than the one in the quantity of the database 

?>