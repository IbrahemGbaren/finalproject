<?php
session_start();
include 'sendmail.php';
if(isset($_COOKIE["loggedin"]))
include 'menuu.php';
else
include 'menum.php';
$num=rand(999,2000);
$newmail=$_SESSION["nemail"];
$checkmail=mysqli_query($con,"SELECT * FROM `users` WHERE `users`.`Email`='$newmail'");
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<?php
        if(mysqli_num_rows($checkmail)==FALSE){
       if(func($_SESSION["nemail"],"your email will be used in our website this email - ".$_SESSION["pemail"]." -  was the prev one"," Changing email")){
       if(func($_SESSION["pemail"],"this number ".$num." is the one that you should write","Change email")){
        
        $_SESSION["num"]=$num;
        ?>
        <form method="post" action="checkmail.php">
        Enter The Num U Received <input type="text" name="num"/>
        <input type="submit" name="send" />
        </form>
    <?php
    }
    }else{
        header("refresh:1;url=editprofile.php");
        session_unset();
       }
    }else{
        echo "The email has a user in our system";
        header("refresh:1;url=editprofile.php");
    }
    
       ?>
</body>