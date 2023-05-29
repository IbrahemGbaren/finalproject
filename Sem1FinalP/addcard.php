<?php
include 'menuU.php';
$con=mysqli_connect("localhost","root","0505715242Az","alizr11");
$user=$_COOKIE["uname"];
?>
<body style="width:100%;height:100%;background-color:rgb(255,247,236); background-size:cover;">
<a href="Cards.php" style="margin-left:780px;margin-top:200px"><button class="btn btn-dark mt-4">Back to Cards</button></a>

<center>
    <h1>Add Card</h1>
<div class="card" style="width:350px;height:480px">
                    <form method="post">
                        <div class="card-header">
                        <div class="row" >
                            <div class="col-md-6">
                                CREDIT/DEBIT CARD PAYMENT
                            </div>
                            <div class="col-md-6 text-right" style="margin-top: -5px;">
                                  <img src="https://img.icons8.com/color/36/000000/visa.png">
                                  <img src="https://img.icons8.com/color/36/000000/mastercard.png">
                                  <img src="https://img.icons8.com/color/36/000000/amex.png">             
                            </div>      
                        </div>    
                        </div>
                        <div class="card-body" style="height: 350px;width:350px">
                            <div class="form-group">
                            CARD NUMBER
                            <input name="number" type="text" class="input-lg form-control cc-number" placeholder="4580 **** **** ****" required maxlength="16" minlength="16">
                          </div>
                          <div class="row">
                            <div class="col-md-6">
                                 <div class="form-group">
                                    CARD EXPIRY
                                    <input style="border-radius:5px" name="MM" type="number" autocomplete="cc-exp" placeholder="MM" required size="2" maxlength="2"> / 
                                    <input style="border-radius:5px" name="YY"  type="number"  placeholder="YY" required size="2" maxlength="2">
                                  </div>
                            </div>
                             <div class="col-md-6">
                               <div class="form-group">
                                CARD CVV
                                <input name="CVV" type="number" class="input-lg form-control cc-cvc" placeholder="9999" required>
                              </div>
                            </div>
                            <div class="form-group">
                            NAME OF OWNER
                            <input name="name" type="text" class="input-lg form-control cc-number" placeholder="Mr's" required maxlength="16" >
                          </div>
                          </div>
                          Type : 
                          <div class="form-group">
                           <input type="radio" name="type" value="VISA" checked/> VISA<br>
                           <input type="radio" name="type" value="MASTERCARD"/> MASTERCARD<br>
                           <input type="radio" name="type" value="AMEX"/> AMEX<br>
                          </div>
                           
                            <input  value="ADD CARD" name="add" type="submit" class="btn btn-success btn-lg form-control" style="font-size: .8rem;">
                    </form>  
                        
                        </div>
                    </div>
</div>
</center>
</body>
<?php
if(isset($_POST["add"])){
    $month=$_POST["MM"];
    $year=$_POST["YY"];
    $number=$_POST["number"];
    $cvv=$_POST["CVV"];
    $type=$_POST["type"];
    $owner=$_POST["name"];
    $cards_user=mysqli_query($con,"SELECT * FROM `user_cards` WHERE `user_cards`.`user-ID`='$user'");
    if($_POST["YY"]<date('Y')-2000){
        echo "<script>alert('wrong Input Year')</script>";
        header("refresh:0");
    }else if($_POST["YY"]==date('Y')-2000){
        if($_POST["MM"]>date('m')&&$_POST["MM"]<13){
            $cards=mysqli_query($con,"SELECT * FROM `card` WHERE `card`.`Number`='$number'");
            if(mysqli_num_rows($cards)==FALSE){
                mysqli_query($con,"INSERT INTO `card`(`Month`, `Type`, `Number`, `CVV`, `Year`,`Owner`) VALUES ('$month','$type','$number','$cvv','$year','$owner')");
                if(mysqli_num_rows($cards_user)==FALSE){
                mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`, `Default`) VALUES ('$number','$user',1)");
                echo "<script>alert('FIRST Card Added')</script>";
                }else{
                   mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`) VALUES ('$number','$user')"); 
                   echo "<script>alert('New Card Added')</script>";
                }
                header("location:Cards.php");
            }else{
                if(mysqli_num_rows($cards_user)==FALSE){
                mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`, `Default`) VALUES ('$number','$user',1)");
                echo "<script>alert('FIRST Card Added')</script>";
                header("location:Cards.php");
                }else{
                    $thiscard=mysqli_query($con,"SELECT * FROM `user_cards` WHERE `user_cards`.`user-ID`='$user' AND `user_cards`.`C-Number`='$number'");
                    if(mysqli_num_rows($thiscard)==FALSE){
                        mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`) VALUES ('$number','$user')");   
                        echo "<script>alert('New Card Added')</script>"; 
                    }else{
                        echo "<script>alert('The Card is already Found in your account')</script>";
                    }
                }
            }
    }else{
            echo "<script>alert('Wrong input Month')</script>";
            
        }
    }else{
        if($_POST["MM"]>0&&$_POST["MM"]<13){
           $cards=mysqli_query($con,"SELECT * FROM `card` WHERE `card`.`Number`='$number'");
            if(mysqli_num_rows($cards)==FALSE){
                mysqli_query($con,"INSERT INTO `card`(`Month`, `Type`, `Number`, `CVV`, `Year`,`Owner`) VALUES ('$month','$type','$number','$cvv','$year','$owner')");
                if(mysqli_num_rows($cards_user)==FALSE){
                mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`, `Default`) VALUES ('$number','$user',1)");
                echo "<script>alert('FIRST Card Added')</script>";
                }else{
                   mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`) VALUES ('$number','$user')"); 
                   echo "<script>alert('New Card Added')</script>";
                }
                header("location:Cards.php");
            }else{
                if(mysqli_num_rows($cards_user)==FALSE){
                mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`, `Default`) VALUES ('$number','$user',1)");
                echo "<script>alert('FIRST Card Added - The Card is Found In our System')</script>";
                header("location:Cards.php");
                }else{
                    $thiscard=mysqli_query($con,"SELECT * FROM `user_cards` WHERE `user_cards`.`user-ID`='$user' AND `user_cards`.`C-Number`='$number'");
                    if(mysqli_num_rows($thiscard)==FALSE){
                        mysqli_query($con,"INSERT INTO `user_cards`(`C-Number`, `user-ID`) VALUES ('$number','$user')");
                        echo "<script>alert('New Card Added - The Card is Found In our System')</script>";  
                        header("location:Cards.php"); 
                    }else{
                        echo "<script>alert('The Card is already Found in your account')</script>";
                    }
                }
            }
        }else{
            echo "<script>alert('Wrong input Month')</script>";
            
        }
    }
    
    
}
?>