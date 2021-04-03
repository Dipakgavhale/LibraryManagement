</<?php 
include "Connection_S.php";
include "Navbar_S.php";
 ?>
<!DOCTYPE html>
<html>
	<head>
		<title>Message</title>
	</head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		body
		{
			background-image: url("Student_Images/.png");
			background-repeat: no-repeat;
		}
		.wrapper
		{
			height: 600px;
			width: 500px;
			background-color: black;
			opacity: .8;
			color: white;
			margin: -20px auto;
			padding: 10px;
		}
		.form-control
		{
			height: 47px;
			width: 76%;
		}
		.msg
		{
			height: 450px;
			overflow-y: scroll;
		}
		.btn-info
		{
			background-color: #02c5b6;
		}
		.chat
		{
			display: flex;
			flex-flow: row wrap;
		}
		.user .chatbox
		{
			height: 50px;
			width: 400px;
			padding: 13px 10px;
			background-color: #821b69;
			color: white;
			border-radius: 10px;
			order: -1;
		}
		.admin .chatbox
		{
			height: 50px;
			width: 400px;
			padding: 13px 10px;
			background-color: #423471;
			color: white;
			border-radius: 10px;		
		}
	</style>
	<body>
		<?php
			if(isset($_POST['submit1']))
			{
				mysqli_query($db,"INSERT INTO `library`.`message` VALUES ('','$_SESSION[login_user]','$_POST[message]','No','Student');");
				$res=mysqli_query($db,"SELECT * FROM `message` WHERE username='$_SESSION[login_user]';");
			}
			else
			{
				$res=mysqli_query($db,"SELECT * FROM `message` WHERE username='$_SESSION[login_user]';");
			}
			mysqli_query($db,"UPDATE message set status='Yes' where sender='Admin' and username='$_SESSION[login_user]' ;");
		?>
		<div class="wrapper">
			<div style="height: 70px; width: 100%;background-color: #2eac8b; text-align: center;color: white;">
				<h3 style="margin-top: 5px;padding-top: 10px;">Admin</h3>
			</div>
			<div class="msg">
				<?php
					while ($row=mysqli_fetch_assoc($res)) 
					{
						if ($row['sender']=='Student') 
						{
				?>
							<!---- Student --------->
							<br><div class="chat user">
								<div style="float: left;padding-top: 5px;">
									&nbsp
									<?php										
										echo "<img class='img-circle profile_img' height=40 width=40 src='Student_Images/".$_SESSION['pic']."'>";  
									?>
									&nbsp	
								</div>
								<div style="float: left;" class="chatbox">
									<?php
									echo $row['message'];
									?>											
								</div>
							</div>				
							
						<?php
						}
						else
						{
						?>	
		 				<!---- Admin--------->
						<br><div class="chat admin">
							<div style="float: left;padding-top: 5px;">
								&nbsp
								<img style="height: 40px;width: 40px;border-radius: 50%;"  src="Images/abc.png">
								&nbsp	
							</div>
							<div style="float: left;" class="chatbox">
								<?php
									echo $row['message'];
									?>						
							</div>
						</div>
					<?php
					}}
					?>			
			</div>
			<div style="height: 100px;padding-top: 10px;">
				<form action="" method="post">
					<input type="text" name="message" class="form-control" required="" placeholder="Write Message..." style="float: left;">&nbsp
					<button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
				</form>
			</div>
		</div>
		
	</body>
</html>