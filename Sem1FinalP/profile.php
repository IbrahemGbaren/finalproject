<div style="width:100%;height:100%;background-image:url('pictures/bg.jpg');background-size:cover">
<?php
$con=mysqli_connect("localhost","root","","storedatabase");
$result = mysqli_query($con,"SELECT * FROM users");

if(isset($_COOKIE["loggedin"])){
$uname=$_COOKIE["uname"];
include 'menuu.php';
while($row=mysqli_fetch_array($result))
{
    if($row['Username']==$uname)
    {
        break;
    }
}
?>
<div class="card" style="width: 18rem;margin-left:40%;margin-top:5%" >
<?php
if($row["Gender"]=="Male")
echo '<img src="Pictures/user.jpg" width="100%" height="250px" />';
else
echo '<img src="Pictures/userF.png" width="100%" height="250px" />';
?>
<div class="card-body">
<h5 class="card-title"> Username = <?= $row["Username"] ?></h5>
<p class="card-text">Email = <?= $row["Email"] ?> </p>
<p class="card-text">Manager/Normal = <?= $row["Type"] ?> </p>
<p class="card-text">Gender = <?= $row["Gender"] ?> </p>
<p class="card-text">Edit Profile - <a href="Editprofile.php">Edit</a> </p>
"<a href="logout.php">Log Out</a>"
</div>
</div><?php
}else if(isset($_COOKIE["Manager"])){
$uname=$_COOKIE["uname"];
include 'MenuM.php';
while($row=mysqli_fetch_array($result))
{
    if($row['Username']==$uname)
    {
        break;
    }
}
?>
<div class="card" style="width: 18rem;margin-left:40%;margin-top:5%" >
<?php
if($row["Gender"]=="Male")
echo '<img src="Pictures/icon-admin.png" width="100%" height="250px" />';
else
echo '<img src="Pictures/adminF.png" width="100%" height="250px" />';
?>
<div class="card-body">
<h5 class="card-title"> Username = <?= $row["Username"] ?></h5>
<p class="card-text">Email = <?= $row["Email"] ?> </p>
<p class="card-text">Manager/Normal =  <?= $row["Type"] ?> </p>
<p class="card-text">Gender = <?= $row["Gender"] ?> </p>
<a href="logout.php">Log Out</a>"
</div>
</div>
<?php
}else{
include 'menu.php';
echo '<div class="card" style="width: 18rem;margin-left:40%;margin-top:5%" >
<img src="Pictures/nouser.png" width="100%" height="250px" >
<div class="card-body">
<h3>Not Logged In</h3>
<h5 class="card-title"> Username = NULL</h5>
<p class="card-text">Email = NULL </p>
<p class="card-text">Manager/Normal = NULL </p>';
echo "<a href='log-in.php'>Click to Log in</a>
</div>
</div>";
}
?>
</div>