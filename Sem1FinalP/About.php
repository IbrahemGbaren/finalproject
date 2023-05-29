<html>
<body>
<?php
include 'bootstrap.php';
if(isset($_COOKIE["loggedin"])){
    include 'menuu.php';
  }else if(isset($_COOKIE["Manager"])){
    include 'menum.php';
  }else{
    include 'menu.php';
  }
?>
<center>
<h1> About Us</h1>
<h3>We Are : </h3>
</center>

<div class="card-deck ml-2 mr-2">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Ali Zrekat</h4>
      <p class="card-text">I am from Kfar Kanna , Israel i Currently live in karmiel i do study software engineering in karmiel,ort braude and this is our project for The course PHP , any problem contact me down below    </p>
      <p class="card-text">Email : mohamadzrekat642@gmail.com</p>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Ibrahem Gbaren</h4>
      <p class="card-text">I am from Om el Fahem , Israel i Currently live in karmiel i do study software engineering in karmiel,ort braude and this is our project for The course PHP , any problem contact me down below   </p>
      <p class="card-text">Email : ibtg1997@gmail.com</p>
    </div>
  </div>
</div>
<h2 style="margin:auto">Firstly thank you for checking our website we hope that everything is ok with you guys if 
        you have any problem or advice you can contact me 
        or my partner Ibrahem by the email or you can send a message to the managers by the page of contact us in the menu above </p>

</body>
</html>