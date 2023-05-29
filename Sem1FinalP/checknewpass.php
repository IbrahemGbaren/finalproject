<?php
session_start();
if(isset($_SESSION["loggedin"]))
include 'menuu.php';
else if(isset($_SESSION["Manager"]))
include 'menuM.php';
else
include 'menu.php';
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<?php
$user=$_SESSION['chngpsw'];
$p1=$_POST['p1'];
$p2=$_POST['p2'];
$con=mysqli_connect("localhost","root","","storedatabase");
$result = mysqli_query($con,"SELECT * FROM users");
while($row=mysqli_fetch_array($result)){
    if($row['Username']==$user)
        break;
}
if($p1==$p2){
if($p1!=$row['p1Pass']&&$p1!=$row['p2Pass']&&$p1!=$row['p3Pass']){
   mysqli_query($con,"UPDATE `users` SET `Password`='$p1',`Blocked?`='0' WHERE `users`.`Username`='$user'");
   if(!isset($_SESSION["Manager"])&& !isset($_SESSION["loggedin"])){ 
    echo "The pass has been changed";
    header("refresh:2;url=log-in.php");
   }else{
    echo "The pass has been changed";
    header("refresh:2;url=editprofile.php");
   }
}else{
    echo "u have entered a prev password";
    header("refresh:2;url=newpass.php");
}
}else{
    echo "the 2 Passwords arent the same";
    header("refresh:2;url=newpass.php");
}
setcookie("chngpsw",$row['Username'],time()-3600);

?>
</body>