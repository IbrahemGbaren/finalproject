<?php
include 'menu.php';
include "sendmail.php";
$con=mysqli_connect("localhost","root","","storedatabase");
$result = mysqli_query($con,"SELECT * FROM users");
session_start();
if(!isset($_SESSION['userId']))
$_SESSION['userId']=$_POST['uname'];


if($_SESSION['userId']!=$_POST['uname'])
{
$_SESSION['counter']=0;
$_SESSION['userId']=$_POST['uname'];
}
$f=0;
while($row=mysqli_fetch_array($result))
{
    if($row['Username']==$_POST['uname'])
    {
        $f=1;
        break;
    }
}
if($f==1){
if($row['Password']==$_POST['pass']){
    if($row['Blocked?']=='1'){
        $_SESSION["chngpsw"]=$row['Username'];
        echo "changing password to ".$_POST['uname'];
        header("refresh:2;url=newpass.php");
}else{
    if($row['Type']=="Normal"){
        $_SESSION['counter']=0;
    setcookie("loggedin",1);
    setcookie("uname",$row["Username"]);
    if($row["Gender"]=="Male")
    echo "Welcome Mr ".$row['Username'];
    else
    echo "Welcome Mrs ".$row['Username'];
    header('refresh:0.1;url=profile.php');
    }else{
        setcookie("Manager","1");
        setcookie("uname",$row["Username"]);
        if($row["Gender"]=="Male")
        echo "Welcome Mr - Manager".$row['Username'];
        else
        echo "Welcome Mrs - Manager".$row['Username'];
        header('refresh:0.1;url=profile.php');
    }
}
}
else{
   
    if(!isset($_SESSION['counter']))
        $_SESSION['counter']=0;
        
    
    $_SESSION['counter'] =$_SESSION['counter']+1;
    echo "Wrong Password".$_SESSION['counter'];
    header('Refresh:2;url=log-in.php');
    if($_SESSION['counter']==3)
    {   
        
        $_SESSION['counter']=0;
        echo '<script>alert("3 wrong attempt!")</script>';
        $num=rand(999,2000);
        func($row["Email"],"this number ".$num." s your new Password login with it on the normal login form to enter a change Password page","RESET PASSWORD");
        echo "go back to sign in and write the code that has been sent to u in Your email ".$row["Email"]."<br>";
            $_SESSION['code']=$num;
            $p=$row['Password'];
            $p1=$row['p1Pass'];
            $p2=$row['p2Pass'];
            $user=$row["Username"];
            $r=mysqli_query($con,"UPDATE `users` SET `Blocked?`='1', `Password`='$num',`p1Pass`='$p',`p2Pass`='$p1',`p3Pass`='$p2'  WHERE `users`.`Username`='$user'");
            header('Refresh:2;url=log-in.php');
    }


}
}else{
    echo "this username - ".$_POST["uname"]." does not have an account in our Website ";
    header("refresh:2;url=Register.php");
}
?>