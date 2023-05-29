<?php
session_start();
$uname=$_SESSION["chngpsw"];
if(isset($_COOKIE["loggedin"]))
include 'menuu.php';
else if(isset($_COOKIE["Manager"]))
include 'menuM.php';
else
include 'menu.php';
?>
<script>
    function myFunction() {
  var x = document.getElementById("myInput");
  var x1 = document.getElementById("myInput2");
  if (x.type === "password") {
    x.type = "text";
    x1.type= "text";
  } else {
    x.type = "password";
    x1.type = "password";
  }
}
</script>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<form method="post" action="checknewpass.php" style="text-align:center;font-size:20px">
Changing Password To
<br>
<input type="text" name="user" value="<?= $uname ?>" disabled /><br>
Password: <br><input type="password"  id="myInput" name="p1"><br>
ReType-Password: <br><input type="password"  id="myInput2" name="p2"><br>

<!-- An element to toggle between password visibility -->
<input type="checkbox" onclick="myFunction()">Show Password

<input type="submit" name="send"/>
</form>
</body>