<?php
$cnt1=90;
$con=mysqli_connect("localhost","root","0505715242Az","alizr11");
$result = mysqli_query($con,"SELECT * FROM motherboards");
echo '

<script>
function increase(n){
    switch (n) {
        ';while($row=mysqli_fetch_array($result)){
            echo '
                case '.$row['ID'].':
                        ';if($cnt1<$row['Stock']){
                        $cnt1++; echo '
                    document.getElementById('.$row['ID'].').innerHTML ='.$cnt1.';
                        ';}echo '
                    break;
            ';}echo '
          
}';

?>

                
                    