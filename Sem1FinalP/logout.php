<?php
setcookie("loggedin",1,time()-3600);
setcookie("Manager",1,time()-3600);
setcookie("name",1,time()-3600);
setcookie("uname",1,time()-3600);
header("location:log-in.php");
?>