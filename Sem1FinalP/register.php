
<?php
include 'menu.php';
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<center>
<form class="form-horizontal" action="adduser.php" method="post">
<fieldset>
<br>
<br>
<legend>Register Sheet</legend>
<div class="form-group">
  <label class="col-md-4 control-label"  name="uname">Username</label>  
  <div class="col-md-4">
  <input name="Username" type="text" placeholder="KingKong11" class="form-control input-md" required>
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label" >Password</label>
  <div class="col-md-4">
  <input  name="psw" type="Password" placeholder="Password" class="form-control input-md" required>  
  </div>
</div>
<div class="form-group">
  <label class="col-md-4 control-label"  >Email</label>
  <div class="col-md-4">
  <input id="email" name="email" type="text" placeholder="--.--@gmail.com" class="form-control input-md" required>
  </div>
</div>
<div class="form-group">
Gender : 
<input type="radio" name="gender" value="Male" checked/> Male 
<input type="radio" name="gender" value="Female"/> Female<br>
</div>
<!-- Button (Double) -->
<div class="form-group">

  <div class="col-md-8">
    <button id="save" name="save" style="color:white" class="btn btn-success">Register</button>
    <button id="clear" name="clear" style="color:white" class="btn btn-danger">Reset</button>
  </div>
</div>

</fieldset>
</form>
</center>
</div>