<?php
session_start();

if(!empty($_POST['email']) || !empty($_POST['upswd']))
{
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "bus_booking";
    
    //create connection
    $con = new mysqli($host, $dbusername, $dbpassword, $dbname);
    $uname = $_POST['uname'];
    $upswd = $_POST['upswd'];
    
    if(mysqli_connect_error()){
        die('Connect Error('. mysqli_connect_errno() .') '
            .mysqli_connect_error());
    }
	
        $uname=$_REQUEST["uname"];
		$upswd=$_REQUEST["upswd"];
        $query=mysqli_query($con,"SELECT * FROM reg WHERE uname='$uname' && upswd='$upswd'");
		$rowcount=mysqli_fetch_array($query);

		if($rowcount > 0)
		{  
            $extra="index.php";
            $_SESSION['login']=$_POST['uname'];
            $_SESSION['uid']=$rowcount['uid'];
            $_SESSION['email']=$rowcount['email'];
            $_SESSION['uname']=$rowcount['uname'];
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http:/bus_booking/$extra");
            mysqli_query($con,"UPDATE user SET last_login=now() WHERE uid=".$_SESSION['uid']);
            exit();
		}
		else
		{
            echo "<script type='text/javascript'>alert('Email or Password incorrect.Try again.');</script>";
            header("Refresh:0; url=signing.html");
}
}

?>
