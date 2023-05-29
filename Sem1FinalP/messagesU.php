<?php
include 'menuu.php';
include 'ConnMB.php';
$user=$_COOKIE["uname"];
?>
<div style="margin-left:400px">
<?php
$messages=mysqli_query($con,"SELECT * FROM `messages` WHERE `messages`.`User`='$user' AND `messages`.`Replied?`=1 ORDER BY `messages`.`Date`");
if(mysqli_num_rows($messages)!=FALSE){
while($msg=mysqli_fetch_array($messages)){
?>
<style>
        th,td{
            padding:30px;
        }
        table{
            margin-bottom: 25px;
        }
        
    </style>
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
        
            <textarea cols='80' rows='6' style='resize:none' disabled name="Reply"><?= $msg["Reply"] ?></textarea><br><br>
    </td>
</tr>
<tr>
    <td>-</td>
<td>

</form>
</td>
</tr>
</table>
<?php
}
}
?>
</div>