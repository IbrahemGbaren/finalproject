<?php
  include 'connMB.php';
  $user=$_COOKIE["uname"];
  $number=$_POST["num"];
  $pickedcard=mysqli_query($con,"SELECT * FROM `user_cards` WHERE `user_cards`.`C-Number`='$number' AND `user_cards`.`user-ID`='$user'");
  $usercards=mysqli_query($con,"SELECT * FROM `user_cards` WHERE  `user_cards`.`user-ID`='$user'");
  if(mysqli_num_rows($usercards)==1){
      mysqli_query($con,"DELETE FROM `user_cards` WHERE `user_cards`.`C-Number`='$number' AND `user_cards`.`user-ID`='$user'");
      echo "<script>alert('DELETED YOUR LAST CARD')</script>";
    }else{
      $pickedcarddetails=mysqli_fetch_array($pickedcard);
    if($pickedcarddetails["Default"]==0){
      mysqli_query($con,"DELETE FROM `user_cards` WHERE `user_cards`.`C-Number`='$number' AND `user_cards`.`user-ID`='$user'");
      echo "<script>alert('DELETED A NON DEFAULT CARD')</script>";
    }
    else{
    echo "<script>alert('U HAVE PICKED A DEFAULT CARD CHANGE IT TO DELETE')</script>";
  }
  }
header("refresh:1;url=Cards.php");
?>