<?php
include "Connection.php";
include "Navbar.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<style type="text/css">
		section { margin-top: -20px; }
		.box1
		{
			height: 500px;
			width: 450px;
			background-color: black;
			margin: 0px auto;
			opacity: .8;
			color: white;
			padding: 20px;			
		}
		label
		{
			font-size: 18px;
			font-weight: 600;
		}
	</style>
</head>
<body>
	<section >
		<div class="log_img"><br>
		<div class="box1">
			<h1 style="font-size: 35px;font-family: Lucida Console; text-align: center;">Library Management System</h1><br>
			<h1 style="font-size: 25px;">User Login Form</h1>
			<form name="Login" action="" method="post">
				<b><p style="padding-left: 50px;font-size: 15px;font-weight: 700;">Login as:</p></b>
				<input style="margin-left: 50px;width: 18px;" type="radio" name="user" id="Admin" value="Admin">
				<label for="Admin">Admin</label>
				<input style="margin-left: 50px;width: 18px;" type="radio" name="user" id="Student" value="Student" checked="">
				<label for="Student">Student</label>
				<div class="login">
					<input class="form-control" type="text" name="username" placeholder="Username" required="" ><br>
					<input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
					<input class="btn btn-default" type="Submit" name="submit" value="Login" style="color: black;width: 70px;height: 30px;">
				</div>
				<p style="color: white; padding-left: 15px;"><br>
					<a style="color: yellow; text-decoration: none;" href="Admin/Update_password_A.php">Forgot password?</a> &nbsp &nbsp &nbsp &nbsp &nbsp  
					New to this website?<a style="color:yellow;text-decoration: none;"href="Registration.php">Sign Up</a>
				</p>
			</form>
		</div>
		</div>
	</section>
	<?php
		if(isset($_POST['submit']))
		{

			if ($_POST['user']=='Admin') 
			{
				$count=0;
				$res=mysqli_query($db,"SELECT * FROM `admin` WHERE username	='$_POST[username]' && password='$_POST[password]' and Status='Yes';");
				$row=mysqli_fetch_assoc($res);
				$count=mysqli_num_rows($res);
				if($count==0)
				{
					?>				
					<div class="alert alert-danger" style="width: 600px; margin-left: 370px; background-color: #de1313;color: white; text-align: center;">	
						<strong>The username or password doesn't match.</strong>
					</div>
					<?php
				}
				else
				{
					/*------ if username and password matches-----*/
					
					$_SESSION['login_user']=$_POST['username'];
					$_SESSION['pic']=$row['pic'];
					$_SESSION['username']='';
					?>
						<script type="text/javascript">
						window.location="Admin/Profile_A.php";
						</script>
					<?php
				}
			}
//----------Admin Login-----------
			
//----------Student Login-----------
			else
			{
				$count=0;
				$res=mysqli_query($db,"SELECT * FROM `registration` WHERE username='$_POST[username]' && password='$_POST[password]';");
				$row=mysqli_fetch_assoc($res);
				$count=mysqli_num_rows($res);
				if($count==0)
				{
					?>
					<div class="alert alert-danger" style="width: 600px; margin-left: 370px; background-color: #de1313;color: white; text-align: center;">	
						<strong>The username and password doesn't match.</strong>
					</div>
					<?php
				}
				else
				{				
					if($row['Status']==1)
					{
						$_SESSION['login_user']=$_POST['username'];
						$_SESSION['pic']=$row['pic']
						?>
							<script type="text/javascript">
								window.location="Student/Profile_S.php";
							</script>
						<?php
					}
					else
					{
						?>
							<script type="text/javascript">
								alert("Verify your email address by OTP befor login.")
								window.location="Verify.php";
							</script>
						<?php
					}
				}
			}
			
		}
	?>
</body>
</html>