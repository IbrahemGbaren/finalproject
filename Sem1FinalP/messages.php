<?php
include 'MenuM.php';
include 'connMB.php';
ob_start();
$allusers=mysqli_query($con,"SELECT * FROM `Users` WHERE `users`.`Type`='Normal'");
$users=array();
while($row=mysqli_fetch_array($allusers)){
$users[]=$row["Username"];
}
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<div style="margin-left:400px">
<?php
foreach($users as $user){
    ?>
    <style>
        th,td{
            padding:30px;
        }
        table{
            margin-bottom: 25px;
        }
        
    </style>
    
    <?php
    $messages=mysqli_query($con,"SELECT * FROM `messages` WHERE `messages`.`User`='$user' AND `messages`.`Replied?`=0 ORDER BY `messages`.`Date`");
    if(mysqli_num_rows($messages)!=FALSE){
    while($msg=mysqli_fetch_array($messages)){
    ?>
    <h3>Username - <?= $user ?></h3>
    <table >
    <tr>
    <th>Date Message</th>
    <th>Message Data</th>
    </tr>
    <tr>
        <td><?= $msg["Date"] ?></td>
        <td><textarea cols="80" rows="6" style="resize:none" disabled ><?= $msg["Message"] ?></textarea></td>
    </tr>
    <tr>
        <th>Reply</th>
        <td>
            <form method="post">
                <input type="hidden" readonly value="<?=$msg["Date"] ?>" name="Date" />
                <input type="hidden" readonly value="<?=$msg["User"] ?>" name="user" />
                <textarea cols='80' rows='6' style='resize:none'  name="Reply"></textarea><br><br>
        </td>
    </tr>
    <tr>
        <td>-</td>
    <td>
    <input type="submit" name="send" value ="Reply To this Message" class="btn btn-primary" />
    </form>
    </td>
    </tr>
</table>
<?php
    }
}else{
    ?>
    <h3>Username - <?= $user ?></h3>
    <table>
        <th>NO NEW MESSAGES YET</th>
        <th>NO NEW MESSAGES YET</th>
    </table>
    <?php
}
}
?>
</div>
</body>
<?php
if(isset($_POST["send"])){
    $user=$_POST["user"];
    $date=$_POST["Date"];
    $reply=$_POST["Reply"];
    echo "<script>alert('".$reply."')</script>";
    mysqli_query($con,"UPDATE `messages` SET `Reply`='$reply',`Replied?`='1' WHERE `messages`.`Date`='$date' AND `messages`.`User`='$user'");
    header("refresh:0.5;url=messages.php");

}
?>