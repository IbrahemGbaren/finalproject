
<html>
    <form method = 'post'>
        <div>
            <input type = 'text' name =  'cpu'/> cpu  
            <input type = 'text' name =  'motherboard'/> motherboard 
            <input type = 'submit' name = 'submit'/>
        </div>
    </form>
</html>
<?php

$con=mysqli_connect("localhost","root","","storedatabase");  
//$con=mysqli_connect("localhost","root","","storedatabase");
if(isset($_POST["submit"])){
    $cp=$_POST["cpu"];
    $mb=$_POST["motherboard"];
    $result_mb = mysqli_query($con,"SELECT * FROM `motherboards` WHERE `motherboards`.`brand`='$mb'");
    $result_cpu = mysqli_query($con,"SELECT * FROM `cpus` WHERE `cpus`.`brand`='$cp'");
while($row=mysqli_fetch_array($result_mb)){
    $mb_socket=$row["socket"];
}
while($row=mysqli_fetch_array($result_cpu)){
    $cp_socket=$row["socket"];
}
if ($mb_socket==$cp_socket) {
    echo "Motherboard connected with CPU using LGA1200 socket.";
} else {
    echo "Motherboard not connected with CPU using LGA1200 socket.";
}

}
?>