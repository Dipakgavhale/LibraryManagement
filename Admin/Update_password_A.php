</<?php 
include "Connection_A.php";
include "Navbar_A.php";
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Change Password</title>
		<style type="text/css">
			body
			{
				height: 650px;			
				background-image: url("Admin_Images/Admin_Updatepassword_B.jpg");
				background-repeat: no-repeat;
			}
			.wrapper
			{
				width:400px; 
				height:400px;
				margin: 100 auto;
				background-color:black; 
				opacity: .8;
				color: white;
				padding: 27x 15px;
			}
			.form-control
			{
				width:300px;
			}
		</style>
	</head>
	<body>
	<div class="wrapper">
		<div style="text-align: center;">
			<h1 style="text-align: center;font-size: 35px;font-family: Lucida Console;">Change Your Password</h1><br><br>
		</div>
		<div style="padding-left: 30px;">
			<form action="" method="post">
				<input type="text" name="username" class="form-control" placeholder="Username" required=""><br><br>
				<input type="text" name="email" class="form-control" placeholder="Email Address" required=""><br><br>
				<input type="text" name="password" class="form-control" placeholder="New Password" required=""><br><br>
				<button class="btn btn-default" type="submit" name="submit">Update</button>
			</form>
		</div>
	</div>
	<?php
	if (isset($_POST['submit'])) 
	{
		if(mysqli_query($db,"UPDATE admin SET password='$_POST[password]' WHERE username='$_POST[username]'AND email ='$_POST[email]' ;"))
		{
			?>
			<script type="text/javascript">
				alert("The Password Updated Successfully.");
			</script>
			<?php
		}
	}
	?>
	</body>
</html>