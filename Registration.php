<?php
include "Connection.php";
include "Navbar.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="Style.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<style type="text/css">
			section 
			{ 
				margin-top: -20px;
				height: 705px;
				width: 1520px;
				background-image: url("Images/Registration_B.png");
				background-repeat: no-repeat; 
			}
			.box
			{
				height: 400px;
				width: 450px;
				background-color: black;
				margin: 0px auto;
				opacity: .8;
				color: white;
				padding: 20px;
				padding-top: 150px;
			}
			label
			{
				font-weight: 600;
				font-size: 18px;
			}
		</style>
	</head>
	<body>
		<section><br><br><br><br><br><br><br>
			<div class="box">
				<form name="Signup" action="" method="post">
					<b><p style="padding-left: 50px;font-size: 15px;font-weight: 700;">Sign Up as:</p></b>
					<input style="margin-left: 50px;width: 18px;" type="radio" name="user" id="Admin" value="Admin">
					<label for="Admin">Admin</label>
					<input style="margin-left: 50px;width: 18px;" type="radio" name="user" id="Student" value="Student" checked="">
					<label for="Student">Student</label>&nbsp&nbsp&nbsp&nbsp
					<button class="btn btn-default" type="submit" name="submit1" style="color: black;font-weight: 700;width: 70px;height: 30px;">Ok</button>
				</form>
			</div>
			<?php
				if (isset($_POST['submit1'])) 
				{
					if ($_POST['user']=='Admin') 
					{
						?>
							<script type="text/javascript">
								window.location="Admin/Registration_A.php";
							</script>
						<?php
					}
					else
					{
						?>
							<script type="text/javascript">
								window.location="Student/Registration_S.php";
							</script>
						<?php
					}
				}
			?>	
		</section>
	</body>
</html>
