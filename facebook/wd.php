<?php
    $eam=$_COOKIE['email1'];
    $con=mysqli_connect("localhost","root","","bankreg");
    $passwo=mysqli_query($con,"select * from breg where email ='$eam'");
    $pa=mysqli_fetch_assoc($passwo);
    $nm=ucfirst($pa['name']);
    $sn=ucfirst($pa['surname']);
    $acno=$pa['accno'];
    $bal=$pa['balance']; //balance  
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="wd.css">
</head>
<body>
<header>
    <div class="hcon" >
    <div class="clogo">
        <!-- this div is used to show company logo  -->
         <img src="img/logo.png" alt="" height="90px">
</div>
<div class="ud" >
    <!--  this div is for showing user details  -->
    <span class="ws" >Welcome <?php echo $nm; echo $sn;  ?> </span>
    <span class="ai" >Account No:- <?php echo $acno ?></span>
</div>  
</header><br>
   <h1>Deposit Form</h1>
   <form method="POST" action="wd.php">
<div class="form">
    <div class="fromele">
    <div class="emal">
    <!-- input box for email  -->
   <label for="">Email :- </label> <input type="email" name="emli" placeholder="enter your email " required autofocus>
    </div>
    <div class="pass">
    <!-- input box for password  -->
   <label for="">Password :- </label> <input type="text" name="pass" placeholder="enter your Password " required autofocus>
    </div>
    <div class="pas">
       <label for="">Date :- </label> <input type="Date" name="date" required>
    </div>
    <div class="amount">
     <label for="">Amount :- </label>   <input type="text" name="amt"placeholder="enter the amount " required>
    </div>
    <div class="subm" >
        <input type="submit" value="submit" name="wi" class="wi" >
    </div>
    </div>
</div>
</form>
<?php
   if(array_key_exists('wi', $_POST)){
$emaili=$_POST['emli'];
if($eam==$emaili){
    if($_POST['pass']==$pa['password']){
        $con=mysqli_connect("localhost","root","","bankreg");
        $qr=mysqli_query($con,"insert into withdraw values ('$_POST[emli]','$_POST[date]','$_POST[amt]')");
      
        $da=$_POST['amt'];  // withdraw amount 
        echo "$da";
        $tb=$da+$bal;      // total balnce which will updated into databse 
        echo $tb;
        
        $qry=mysqli_query($con,"update breg set balance= '$tb' where email='$eam'");
        echo "<script> alert('Balance Updated');  </script>";
        mysqli_close($con);
    }
    
    }
    else{
        echo "<script> alert('You Cant Deposit money to Others Account ');  </script>";
    }
}
?>
</body>
</html>