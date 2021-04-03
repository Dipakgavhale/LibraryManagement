<?php
include "Connection_A.php";
//include "Navbar_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Registration</title>
		<link rel="stylesheet" type="text/css" href="Style_A.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<style type="text/css">
				section { margin-top: -20px; }
		</style>
	</head>
	<body>
		<section>
			<div style="height: 800px;margin-top: 0px;background-image: url('Admin_Images/Admin_Registration_B.jpg');background-repeat: no-repeat;">
			<div class="box2">
				<h1 style="text-align: center;font-size: 35px;font-family: Lucida Console;">Library Management System</h1><br>
				<h1 style="text-align: center;font-size: 25px;">Admin Registration Form</h1>
				<form name="registration" action="" method="post">
					<div class="login">
						<input class="form-control" type="text"name="first"placeholder="First Name" required=""><br>
						<input class="form-control" type="text"name="last"placeholder="Last Name"required=""><br>
						<input class="form-control" type="Email"name="email"placeholder="Email Address"required=""><br>
						<input class="form-control" type="text"name="mobile"placeholder="Mobile No."required=""><br>
						<input class="form-control" type="text"name="username"placeholder="Username"required=""><br>
						<input class="form-control" type="password"name="password"placeholder="password"required=""><br>
						<input class="btn btn-default"type="submit"name="submit"value="Sign Up"style="color:black;width:70px;height:30px;">
					</div><br>
				</form>
			</div>
			</div>
		</section>

<?php
 if (isset($_POST['submit'])) 
 {
	$count=0;
	$sql="SELECT username from admin";
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
		mysqli_query($db,"INSERT INTO `admin` VALUES('','$_POST[first]','$_POST[last]','$_POST[email]','$_POST[mobile]','$_POST[username]','$_POST[password]', 'abc.png','');");
		?>
			<script type="text/javascript">
				alert("Registration Successful.");
				window.location="../Login.php";
			</script>
		<?php
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