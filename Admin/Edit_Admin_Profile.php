<?php
include "Navbar_A.php";
include "Connection_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Edit Admin Profile</title>
		<style type="text/css">
			.form-control
			{
				width: 250px;
				height: 35px;
			}
			.form1
			{
				margin: 0 650px;
			}
			label
			{
				color: white;
				padding-right: 80px;				
			}
		</style>
	</head>
	<body style="background-color:#004528;">
		<h2 style="text-align: center;color: #fff;">Edit Admin Information</h2>
		<?php
			$sql="SELECT * FROM admin WHERE username='$_SESSION[login_user]'";
			$result=mysqli_query($db,$sql) or die (mysqli_error());
			while ($row = mysqli_fetch_assoc($result)) 
			{
				$first=$row['first'];
				$last=$row['last'];
				$email=$row['email'];
				$mobile=$row['mobile'];
				$username=$row['username'];
				$password=$row['password'];
			}
		?>
		<div class="profile_info" style="text-align: center;">
			<span style="color: white;">Welcome,</span>
			<h4 style="color: white;"><?php echo $_SESSION['login_user']; ?></h4>
			<div class="form1">
			<form action="" method="post" enctype="multipart/form-data">
				<input class="form-control" type="file" name="file">
				<label><h4><b>First Name</b></h4></label>
				<input class="form-control" type="text" name="first"    value="<?php echo $first; ?>"	>
				<label><h4><b>Last Name</b></h4></label>
				<input class="form-control" type="text" name="last"     value="<?php echo $last; ?>"	>
				<label><h4><b>Email ID</b></h4></label>
				<input class="form-control" type="text" name="email"    value="<?php echo $email; ?>"	>
				<label><h4><b>Mobile Number</b></h4></label>
				<input class="form-control" type="text" name="mobile"   value="<?php echo $mobile; ?>"	>
				<label><h4><b>Username</b></h4></label>
				<input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
				<label><h4><b>Password</b></h4></label>
				<input class="form-control" type="text" name="password" value="<?php echo $password; ?>"><br>
				<div style="padding-right:650px;">
					<button class="btn btn-default" type="submit" name="submit">Save</button>
				</div>
				<?php
				if (isset($_POST['submit'])) 
				{
					move_uploaded_file($_FILES['file']['tmp_name'], "Admin_Images/".$_FILES['file']['name']);
					$first=$_POST['first'];
					$last=$_POST['last'];
					$email=$_POST['email'];
					$mobile=$_POST['mobile'];
					$username=$_POST['username'];
					$password=$_POST['password'];
					$pic=$_FILES['file']['name'];
					$sqli="UPDATE admin SET pic='$pic',first='$first',last='$last',email='$email',mobile='$mobile',username='$username',password='$password' where username='".$_SESSION['login_user']."';";
					if (mysqli_query($db,$sqli)) 
					{
						?>
							<script type="text/javascript">
								alert("Saved Successfully.")
								window.location="Profile_A.php";
							</script>
						<?php
					}
				}
				?>			
			</form>
		</div>
	</body>
</html>