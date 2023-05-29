<?php
include 'menu.php';
include 'sendmail.php';
$con=mysqli_connect("localhost","root","","storedatabase");
session_start();
$_SESSION["uname"]=$_POST["Username"];
$_SESSION["psw"]=$_POST["psw"];
$_SESSION["mail"]=$_POST["email"];
$_SESSION["gender"]=$_POST["gender"];
$result = mysqli_query($con,"SELECT * FROM users");
$f=0;
$f2=0;
while($row = mysqli_fetch_array($result)){
    if($row["Email"]==$_POST["email"]){
        $f=1;
    }if($row["Username"]==$_POST["Username"]){
        $f2=1;
    }
}
    if($f==1){ 
        echo ("the email Already Have a User<br>") ;
        header("refresh:0.5;url=register.php");
    }if($f2==1){
        echo ("the Username Already Have a User") ;
        header("refresh:0.5;url=register.php");
    }
    if($f2==0&&$f==0){
        $num=rand(999,2000);
       if(func($_POST["email"],"this number ".$num." s your new Password login with it on the normal login form to enter a change Password page","Activate User")){
        $_SESSION["num"]=$num;
        ?>
        <div style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
        <form method="post" action="checkmail.php">
        Enter The Num U Received <input type="text" name="num"/>
        <input type="submit" name="send" />
        <a href="register.php"><button>Back</button></a>
        </form>
    </div>
    <?php
       }else{
        header("refresh:1;url=register.php");
       }
    }

?>