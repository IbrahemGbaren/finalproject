<?php
function func($mail,$msg,$sub){
$h="From:ibtg1997@gmail.com";
if(mail($mail,$sub,$msg,$h)){
    echo "the email has been sent to ".$mail." succesfully";
    return true;
}else{
    echo "We couldnt send the email to - ".$mail;
    return false;
}
}
?>