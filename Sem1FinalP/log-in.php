<?php

include 'menu.php';
include 'bootstrap.php';
?>

<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<center>
    <br>
    <br>
    
<form class="form-horizontal" action="bdeka.php" method="post" >
<fieldset>
<legend>Register Yourself</legend>
<div class="form-group" >
  <label class="col-md-4 control-label" name="uname" >Username</label>  
  <div class="col-md-4">
  <input name="uname" type="text" placeholder="KingKong11" class="form-control input-md" required>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label">Password</label>  

  <div class="col-md-4">
  <input id="lname" name="pass" type="Password" placeholder="Password" class="form-control input-md" required>
    
  </div>
</div>

<br>
Remember me<input type="checkbox" name="click" />
<br>
<input type="submit" />
<a href="register.php">Register Now</a>
</form>
</center>
</body>
</html>
