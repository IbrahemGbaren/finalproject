<?php
include 'ConnMB.php';
if(isset($_COOKIE["loggedin"])){
include 'menuu.php';
}else{
    include 'menuM.php';
}
$uname=$_COOKIE["uname"];
$user = mysqli_query($con,"SELECT * FROM `users` WHERE `users`.`Username`='$uname'");
$userinfo=mysqli_fetch_array($user);
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css" />
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<a stye="margin-left: 350px;" href="profile.php">Back To Profile</a>
<center>
<fieldset>
<br>
<br>
<legend>Register Sheet</legend>
<div class="form-group">
  <label class="col-md-4 control-label"  name="uname">Username</label>  
  <div class="col-md-4">
  <form class="form-horizontal"  method="post">
  <input name="Username" type="text" value="<?= $userinfo["Username"] ?>" class="form-control input-md" disabled/>
  <input type="submit" value="UNCHANGEABLE - CONTACT US TO CHANGE IT" class="btn btn-primary" disabled/>
  </form>
</div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" >Password</label>
  <div class="col-md-4">
  <form class="form-horizontal"  method="post">
  <input  name="psw" type="Text" value="<?= $userinfo["Password"] ?>" class="form-control input-md" readonly/>
  <input type="submit" name="CPass" value="Change Password" class="btn btn-primary" />  
</form>
</div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"  >Email</label>
  <div class="col-md-4">
  <form class="form-horizontal"  method="post">
  <input id="email" name="email" type="text" value="<?= $userinfo["Email"] ?>" class="form-control input-md" />
  <input type="submit" name="Cemail" value="Change Email" class="btn btn-primary" />
</form>  
</div>
</div>
<div class="form-group">
Gender : 
<form class="form-horizontal"  method="post">
<?php
if($userinfo["Gender"]=="Male"){
    ?>
<input type="radio" name="gender" value="Male" checked/> Male 
<input type="radio" name="gender" value="Female"/> Female 
<input type="submit" name="Cgender" value="Change Gender" class="btn btn-primary"/>
<?php
}else{
?>
<input type="radio" name="gender" value="Male" /> Male 
<input type="radio" name="gender" value="Female" Checked/> Female 
<input type="submit" name="Cgender" value="Change Gender" class="btn btn-primary"/>
<?php
}
?>
</form>
</div>
<!-- Button (Double) -->
</fieldset>
</form>
</center>
</body>
<?php

if(isset($_POST["Cgender"])){
    if($_POST["gender"]==$userinfo["Gender"]){
        echo "<script>alert('no change')</script>";
        header("Refresh:0.2");
    }else{
        $user=$userinfo["Username"];
        $newgen=$_POST["gender"];
        $prevgen=$userinfo["Gender"];
        mysqli_query($con,"UPDATE `users` SET `Gender`='$newgen' WHERE `users`.`Username`='$user'");
        echo "<script>alert('gender Changed')</script>";
        header("refresh:0.2");
    }
}
if(isset($_POST["CPass"])){
        $_SESSION["chngpsw"]=$userinfo["Username"];
        header("refresh:1;url=newpass.php");
}
if(isset($_POST["Cemail"])){
    if($_POST["email"]==$userinfo["Email"]){
        echo "<script>alert('You Havent Changed Anything in The Email')</script>";
        header("Refresh:0.5");
    }else{
        session_start();
        $_SESSION["pemail"]=$userinfo["Email"];
        $_SESSION["nemail"]=$_POST["email"];
        header("location:ChangeEmail.php");
        
    }
}


?>