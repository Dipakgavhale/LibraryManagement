<?php
include "Connection_S.php";
include "Navbar_S.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Student Profile</title>
	<style type="text/css">
		.wrapper
		{
			width: 300px;
			margin: 0 auto;
			color: white;			
		}
	</style>
</head>
<body style="background-color: #004528;">
<div class="container">
	<form action="" method="post">
		<button class="btn btn-default" style="float:right;width: 70px;" name="Submit1">
			Edit
		</button>
	</form>
	<div class="wrapper">
		<?php
		if (isset($_POST['Submit1'])) 
		{
			?>
				<script type="text/javascript">
					window.location="Edit_Student_Profile.php"
				</script>
			<?php
		}
		$q=mysqli_query($db,"SELECT * FROM registration where username='$_SESSION[login_user]' ;");
		?>
		<h2 style="text-align:center;">My Profile</h2>
		<?php
		$row=mysqli_fetch_assoc($q);
		echo "<div style='text-align:center'>
				<img class='img-circle profile-img' height=110 width=120 src='Student_Images/".$_SESSION['pic']."'>   
			  </div>";

		?>
		<div style="text-align: center;">
			<b>Welcome</b>
			<h4>
				<?php echo $_SESSION['login_user']; ?>
			</h4>
		</div>
		<?php
			echo "<b>";
			echo "<table class='table table-bordered'>";echo "<br>";
				echo "<tr>"; echo "<td>"; echo "<b> First Name: </b>"; echo "</td>"; echo "<td>"; echo $row['first']; echo "</td>"; echo "</tr>";echo "<br>";
				echo "<tr>"; echo "<td>"; echo "<b> Last Name: </b>"; echo "</td>"; echo "<td>"; echo $row['last']; echo "</td>"; echo "</tr>";echo "<br>";
				echo "<tr>"; echo "<td>"; echo "<b> Email ID: </b>"; echo "</td>"; echo "<td>"; echo $row['email']; echo "</td>"; echo "</tr>";echo "<br>";
				echo "<tr>"; echo "<td>"; echo "<b> Mobile No: </b>"; echo "</td>"; echo "<td>"; echo $row['mobile']; echo "</td>"; echo "</tr>";echo "<br>";
				echo "<tr>"; echo "<td>"; echo "<b> Username: </b>"; echo "</td>"; echo "<td>"; echo $row['username']; echo "</td>"; echo "</tr>";echo "<br>";
				echo "<tr>"; echo "<td>"; echo "<b> Password: </b>"; echo "</td>"; echo "<td>"; echo $row['password']; echo "</td>"; echo "</tr>";echo "<br>";				 
			echo "</table>";
			echo "</b>";
		?>
	</div>
</div>
</body>
</html>