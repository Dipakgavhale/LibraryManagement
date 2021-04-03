<?php
	session_start();
	include "Connection_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="Style_A.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<?php
			$r=mysqli_query($db,"SELECT COUNT(status) as total FROM message where status='No' and sender='Student';");
			$c=mysqli_fetch_assoc($r);
			$sql_app=mysqli_query($db," SELECT COUNT(status) as total FROM admin where Status='';");
			$a=mysqli_fetch_assoc($sql_app);
		?>
		<nav class="navbar navbar-inverse" style="background-color: black;">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand active" style="font-size: 20px;color: white;" > Online Library Management System</a>
				</div>
				<ul class="nav navbar-nav">
					<li><a href="Index_A.php"> Home </a></li>
					<li><a href="Books_A.php"> Books </a></li>
					<li><a href="Feedback_A.php"> Feedback </a></li>
				</ul>
				<?php
				if (isset($_SESSION['login_user'])) 
				{
				?>					
					<ul class="nav navbar-nav">
						<li><a href="Profile_A.php">Profile</a></li>
						<li><a href="student_Information.php">STUDENT-INFORMATION</a></li>
						<li><a href="Fines_A.php">Fines</a></li>				
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="Approve_Admin_Request.php"><span class="glyphicon glyphicon-user"></span>
							<span class="badge bg-green"><?php echo $a['total']; ?></span></a></li>

						<li><a href="Admin_Message.php">
							<span class="glyphicon glyphicon-envelope"></span>
							<span class="badge bg-green"><?php echo $c['total']; ?></span>
						</a></li>
						<li><a href="Profile_A.php">
						<div style="color: white;">				
							<?php
								echo "<img class='img-circle profile_img' height=30 width=30 src='Admin_Images/".$_SESSION['pic']."'>";
								echo"  ".$_SESSION['login_user'];
							?>
						</div>
						</a></li>
						<li><a href="Logout_A.php"><span class="glyphicon glyphicon-log-out"> Logout</span></a></li>					
					</ul>
				<?php
				}
				else
				{
				?>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="../Login.php"><span class="glyphicon glyphicon-log-in"> Login</span></a></li>					
						<li><a href="Registration_A.php"><span class="glyphicon glyphicon-user"> SingUp</span></a></li>
					</ul>
				<?php
				}
				?>					
		</div>
	</nav>	
</body>
</html>