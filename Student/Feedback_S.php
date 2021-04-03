<?php
include "Connection_S.php";
include"Navbar_S.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Feedback</title>
			<link rel="stylesheet" type="text/css" href="Style_S.css">
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<style type="text/css">
			body
			{
				    background-image: url("Student_Images/Feedback_B.jpg");
			}
			.wrapper
			{
				padding: 10px;
				margin: -20px auto;
				width: 900px;
				height: 600px;
				background-color: black;
				opacity: .8;
				color: white;
			}
			.form-control
			{
				width: 60%;
				height:70px;
			}
			.scroll
			{
				height: 350px;
				width: 100%;
				overflow: auto;
			}
		</style>
	</head>
	<body>
		<div class="wrapper">
			<h4>If you have any suggesions or questions please comment below.</h4>
			<form style="" action="" method="post">
				<input class="form-control" type="text" name="Comments" placeholder="Write Something..."required=""><br>
				<input class="btn btn-default" type="submit" name="submit" value="Comment" style="width: 100px; height: 35px;">
			</form>			
		<br><br>
		<div class="scroll">
			<?php
				if (isset($_POST['submit'])) 
				{
					$sql="INSERT INTO `feedback` VALUES('','$_SESSION[login_user]','$_POST[Comments]');";
					if(mysqli_query($db,$sql))
					{
						$q="SELECT * FROM `feedback` ORDER BY `feedback`.`id` DESC";
						$res=mysqli_query($db,$q);
						echo "<table class='table table-bordered'>";
						while($row=mysqli_fetch_assoc($res)) 
						{
							echo "<tr>";
								echo "<td>"; echo $row['User_Name']; echo "</td>";
								echo "<td>"; echo $row['Comments']; echo "</td>";
							echo "</tr>";
						}
					}
				}
				else
				{
					$q="SELECT * FROM `feedback` ORDER BY `feedback`.`id` DESC";
						$res=mysqli_query($db,$q);
						echo "<table class='table table-bordered'>";
						while($row=mysqli_fetch_assoc($res)) 
						{
							echo "<tr>";
								echo "<td>"; echo $row['User_Name']; echo "</td>";
								echo "<td>"; echo $row['Comments']; echo "</td>";
							echo "</tr>";
						}
					}
			?>
		</div>	</div>
	</body>
</html>