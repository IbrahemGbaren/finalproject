<html>
<body>
<?php
include 'menuu.php';
$user=$_COOKIE["uname"];
include 'ConnMB.php';
$sql="SELECT * FROM `messages` WHERE `messages`.`User`='$user' AND `messages`.`Replied?`=1";
        $Repliedmessages = mysqli_query($con,$sql);
        $numReplied=mysqli_num_rows($Repliedmessages);
        if($numReplied>0){
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<div style='position: fixed;right: 0;top :100px;z-index:1'>
<a href='messagesU.php' style='font-size:25px'><button><img src='Pictures/msg.png' width=40px height=40px /> <?= $numReplied ?></button></a>
</div>
<?php
}
?>
<center>

<h1 style='font-size:50px'> Contact Us</h1>
<form method="post" style='color:Grey'>
Username - <input type='text' value="<?= $user ?>" readonly/>
<br>
<br>
<br>
<textarea cols='80' rows='6' style='resize:none' name="text"></textarea><br><br>
<input type="submit" name="send" value ="Send Message" class="btn btn-primary" />
</form>
</center>
</body>
</html>
<?php
if(isset($_POST["send"])){
  $message=$_POST["text"];
  if($message!=NULL)
  mysqli_query($con,"INSERT INTO `messages`(`Message`, `User`) VALUES ('$message','$user')");
  header("location:contact-us.php");
}
?>