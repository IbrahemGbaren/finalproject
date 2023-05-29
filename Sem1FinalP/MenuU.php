<html>
      <head>
            <link rel='stylesheet' href="CSS/LoginNav.css">
</head>  

<?php
include 'ConnMB.php';
$user=$_COOKIE["uname"];
$userinfo=mysqli_query($con,"SELECT * FROM `users` WHERE `users`.`Username`='$user'");
$userdet=mysqli_fetch_array($userinfo);
include 'bootstrap.php';
include 'ConnMB.php';
$sql="SELECT * FROM `history` WHERE `history`.`Status`='Checked By Manager' AND `history`.`User`='$user'";
        $pendingorders = mysqli_query($con,$sql);
        $date=array();
        while($row=mysqli_fetch_array($pendingorders)){
          $date[]=$row["Date"];
        }
        $date=array_unique($date);
        $numofpending=count($date);
$sql2="SELECT * FROM `history` WHERE `history`.`Status`='Delivered Successfully' AND `history`.`User`='$user'";
        $delorders = mysqli_query($con,$sql2);
        $date2=array();
        while($row=mysqli_fetch_array($delorders)){
          $date2[]=$row["Date"];
        }
        $date2=array_unique($date2);
        $numdelievered=count($date2);
        $repliedmsgs=mysqli_query($con,"SELECT * FROM `messages` WHERE `messages`.`User`='$user' AND `messages`.`Replied?`=1 ORDER BY `messages`.`Date`");
        $numrepliedmsgs=mysqli_num_rows($repliedmsgs);
?>
<div id="navuser" class="topnav" style="display:block">
<a href="/labs/sem1finalp/home.php"><img class="logo" src="Pictures/logo.jpg" /></a>
  <a class="active" href="/labs/sem1finalp/Table.php">Info</a>
  <a href="/labs/sem1finalp/Items.php">Shop</a>
  <a href="/labs/sem1finalp/About.php">About</a>
  <a href="contact-us.php">Contact Us
  <?php
  if($numrepliedmsgs>0)
      echo "<label style='background-color:aliceblue'> ".$numrepliedmsgs."-</label>";
      ?>
  </a>
  <a href="ordersU.php">Your Orders 
    <?php
      echo "<label style='background-color:Yellow'> ".$numofpending."-</label>";
      echo "<label style='background-color:green'>-".$numdelievered."</label>";
    ?>
  </a>
  <a href="/labs/sem1finalp/profile.php">
  <?php
if($userdet["Gender"]=="Male")
echo '<img src="Pictures/user.jpg" class="logo" />';
else
echo '<img src="Pictures/userF.png" class="logo" />';
?>-<?=$_COOKIE["uname"]?></a>
  <a id="users" href="logout.php" >LOG OUT</a>
    

</div>
  </html>