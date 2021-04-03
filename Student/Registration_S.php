<?php
include "Connection_S.php";
//include "Navbar_S.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Registration</title>
	<link rel="stylesheet" type="text/css" href="Style_S.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<style type="text/css">
		section { margin-top: -20px; }
</style>
</head>
<body>
	<section>
		<div style="height: 800px;margin-top: 0px;background-image: url('Student_Images/Student_Registration_B.jpg');background-repeat: no-repeat;">
		<div class="box2">
			<h1 style="text-align: center;font-size: 35px;font-family: Lucida Console;">Library Management System</h1><br>
			<h1 style="text-align: center;font-size: 25px;">User Registration Form</h1>
			<form name="registration" action="" method="post">
				<div class="login">
					<input class="form-control" type="text"name="first"placeholder="First Name" required=""><br>
					<input class="form-control" type="text"name="last"placeholder="Last Name"required=""><br>
					<input class="form-control" type="email"name="email"placeholder="Email"required=""><br>
					<input class="form-control" type="text"name="mobile"placeholder="Mobile"required=""><br>
					<input class="form-control" type="text"name="roll"placeholder="Roll No"required=""><br>
					<input class="form-control" type="text"name="username"placeholder="User Name"required=""><br>
					<input class="form-control" type="password"name="password"placeholder="password"required=""><br>
					<input class="btn btn-default" type="submit" name="submit" value="Sign Up" style="color: black;width: 70px;height: 30px;"><br>
				</div>
			</form>
		</div>
		</div>
	</section>
<?php
 if (isset($_POST['submit'])) 
 {
	$count=0;
	$sql="SELECT username from registration";
	$res=mysqli_query($db,$sql);
	while ($row=mysqli_fetch_assoc($res))
	{
		if($row['username']==$_POST['username'])
		{
			$count=$count+1;
		}
	}
	if($count==0)
	{ 	
		mysqli_query($db,"INSERT INTO `registration` VALUES('$_POST[first]','$_POST[last]','$_POST[email]','0','$_POST[mobile]','$_POST[roll]','$_POST[username]','$_POST[password]','abc.png');");
		$otp=rand(100000,999999);
		$date=date("Y-m-d");
		mysqli_query($db, "INSERT INTO `verify` VALUES('$_POST[username]', '$otp', '$date');");
		$msg="Hello your OTP code is: ".$otp.".";
		$from="From:dipakgavhale95@gmail.com";
		if(mail($_POST['email'], "OTP", $msg, $from))
		{
		?>
			<script type="text/javascript">
				window.location="../verify.php";
			</script>
		<?php
		}
		else
		{
		?>
			<script type="text/javascript">
			alert("Email not sent.");
			</script>
		<?php
		}
	}
	else
	{
		?>
			<script type="text/javascript">
			alert("The username already exist.");
			</script>
		<?php
	}
 }
?>
</body>
