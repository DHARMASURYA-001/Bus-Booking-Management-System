<?php

if(!empty($_POST['uname']) || !empty($_POST['email']) || !empty($_POST['upswd']) || !empty($_POST['upswd1']))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "bus_booking";
    
    //create connection
    $con = new mysqli($host, $dbusername, $dbpassword, $dbname);
    $uname = $_POST['uname'];
    $email = $_POST['email'];
    $upswd = $_POST['upswd'];
    $upswd1 = $_POST['upswd1'];
    
    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno() .') '
            .mysqli_connect_error());
    }

$sql=mysqli_query($con,"select id from reg where email='$email'");
$row=mysqli_num_rows($sql);
if($row>0)
{
	echo "<script>alert('Email id already exist with another account. Please try with other email id');</script>";
    
}else{
	$msg=mysqli_query($con,"insert into reg(uname,email,upswd,upswd1) values('$uname','$email','$upswd','$upswd1')");

    if($msg)
    {
	echo "<script>alert('Register successfully');</script>";
    header('location: log in.html');
    }

}
}

?>