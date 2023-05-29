<?php
include 'sendmail.php';
if(!isset($_COOKIE["loggedin"])&&!isset($_COOKIE["Manager"])){
include 'menu.php';
$uname=$_SESSION["uname"];
$pass=$_SESSION["psw"];
$gender=$_SESSION["gender"];
$mail=$_SESSION["mail"];
$num=$_SESSION["num"];
if($_POST["num"]==$num){
    
    mysqli_query($con,"INSERT INTO `users`(`Username`, `Password`, `Email`, `Gender`) VALUES ('$uname','$pass','$mail','$gender')");
    echo "new user inserted";
    session_unset();
}else{
    session_unset();
    echo "<script>alert('Wrong Input'".$_POST["num"].")</script>";
    header("refresh:2;url=register.php");
}
}else{
if(isset($_COOKIE["loggedin"]))
include 'menuu.php';
else
include 'menum.php';
$num=$_SESSION["num"];
$newemail=$_SESSION["nemail"];
$prevemail=$_SESSION["pemail"];
if($_POST["num"]==$num){
    mysqli_query($con,"UPDATE `users` SET `Email`='$newemail' WHERE `users`.`Email`='$prevemail'");
    echo "Email has been changed";
    session_unset();
}else{
    echo "Wrong Number";
    session_unset();
}
}



?>
