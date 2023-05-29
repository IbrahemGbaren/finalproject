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
$sql="SELECT * FROM `history` WHERE `history`.`Status`='Pending...'";
        $pendingorders = mysqli_query($con,$sql);
        $date=array();
        while($row=mysqli_fetch_array($pendingorders)){
          $date[]=$row["Date"];
        }
        $date=array_unique($date);
        $numofpending=count($date);
        
$sql2="SELECT * FROM `messages` WHERE `messages`.`Replied?`=0";
$noreply=mysqli_query($con,$sql2);
$numnoreplied=mysqli_num_rows($noreply);
      
?>
<div id="navuser" class="topnav" style="display:block">
<a href="/labs/Sem1FinalP/home.php"><img class="logo" src="Pictures/logo.jpg" /></a>
  <a class="active" href="/labs/Sem1FinalP/Table.php" style="color: black;">Info</a>
  <a href="/labs/Sem1FinalP/ItemsM.php" style="color: black;">Shop</a>
  <a href="/labs/Sem1FinalP/About.php" style="color: black;">About</a>
  <a href="/labs/Sem1FinalP/messages.php" style="color: black;">Messages
    <?php
    if($numnoreplied>0)
    echo "<label style='background-color:aliceblue'>".$numnoreplied."</label>"
    ?>
  </a>
  <a href="/labs/Sem1FinalP/ordersM.php" style="color: blue;">Orders
    <?php
    if($numofpending>0)
   echo "<label style='background-color:aliceblue'>".$numofpending."</label>"
    ?>
  </a>
  <a href="/labs/Sem1FinalP/profile.php" style="color: brown;">
  <?php
if($userdet["Gender"]=="Male")
echo '<img src="Pictures/icon-admin.png" class="logo" />';
else
echo '<img src="Pictures/adminF.png" class="logo" />';
?> - <?=$_COOKIE["uname"]?></a>
  <a id="users" href="/labs/Sem1FinalP/logout.php" style="color: red;" >LOG OUT</a>
    

</div>
  </html>