<?php
	include "Connection_A.php";
	include "Navbar_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Message</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">	
		<style type="text/css">
			.left_box
			{
				height: 689px;
				width: 500px;
				float: left;
				background-color: #8ecdd2;
				margin-top: -20px;
			}
			.left_box2
			{
				height: 689px;
				width: 300px;
				background-color: #537890;
				border-radius: 20px;
				float: right;
				margin-right: 30px;			
			}
			.left_box input
			{
				width: 150px;
				height: 50px;
				background-color: #537890;
				padding: 10px;
				margin: 10px;
				border-radius: 10px;
			}
			.list
			{
				height: 500px;
				width: 300px;
				background-color: #537890;
				float: right;
				color: white;
				padding: 10px;
				overflow-y:scroll;
				overflow-x: hidden;
			}
			.right_box
			{
				height: 689px;
				width: 1000px;
				background-color: #8ecdd2;
				margin-left: 380px;
				margin-top: -20px;
				padding: 10px;
			}
			.right_box2
			{
				height: 689px;
				width: 850px;
				margin-top: -20px;
				padding: 20px;
				border-radius: 20px;
				background-color: #537890;
				float: left;
				color: white;			
			}
			tr:hover
			{
				background-color: #1e3f54;
				cursor: pointer;
			}
			.form-control
			{
				height: 47px;
				width: 78%;
			}				
			.msg
			{
				height: 530px;
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
				width: 700px;
				padding: 13px 10px;
				background-color: #821b69;
				color: white;
				border-radius: 10px;			
			}
			.admin .chatbox
			{
				height: 50px;
				width: 700px;
				padding: 13px 10px;
				background-color: #423471;
				color: white;
				border-radius: 10px;
				order: -1;		
			}
		</style>
	</head>
	<body style=" height: 595px;">
		<?php
			$sql1=mysqli_query($db,"SELECT registration.pic,message.username FROM registration INNER JOIN message on registration.username = message.username group by username ORDER BY 'status'; ");
		?>
<!------Left box------->
		<div class="left_box">
			<div class="left_box2">
				<div style="color: #fff;">
					<form method="post" enctype="multipart/form-data">
						<input type="text" name="username" id="uname">
						<button class="btn btn-default" type="submit" name="submit">Show </button>
					</form>
				</div>
				<div class="list">
					<?php
						echo "<table id='table' class='table'>";
							while ($res1=mysqli_fetch_assoc($sql1)) 
							{					
								echo "<tr>";
									echo "<td width=65>"; echo "<img class='img-circle profile_img' height=60 width=60 src='Images/".$res1['pic']."'>"; echo "</td>";
									echo "<td style='padding-top:30px;'>";  echo $res1['username']; echo "</td>";
								echo "</tr>";
							}
						echo "</table>";
					?>			 
				</div>		
			</div>	
		</div>
<!------Right box------->
		<div class="right_box">
			<div class="right_box2">		
				<?php
/*--------------if submit is pressed-------------*/
					if(isset($_POST['submit']))
					{
						$res=mysqli_query($db,"SELECT * FROM message where username='$_POST[username]' ;");
						mysqli_query($db,"UPDATE message SET status='Yes' where sender='Student' and username='$_POST[username]' ;");
						if($_POST['username']!='')
						{
							$_SESSION['username']=$_POST['username'];
						}
						?>
						<div style="height: 70px; width: 100%;text-align:center;color: white;">
							<h3 style="margin-top:-5px;padding-top:10px;"><?php echo $_SESSION['username']?></h3>
						</div>
<!---------------------show message---------------->
						<div class="msg">
							<?php
								while ($row=mysqli_fetch_assoc($res)) 
								{
									if ($row['sender']='Student') 
									{
									?>
	<!------------------------------- Student --------->
										<br><div class="chat user">
											<div style="float: left;padding-top: 5px;">&nbsp												
												<?php										
													echo "<img class='img-circle profile_img' height=40 width=40 src='Images/".$_SESSION['pic']."'>";  
												?>&nbsp																
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
	<!--------------------- ----------Admin--------->
										<br><div class="chat admin">
										<div style="float: left;padding-top: 5px;">&nbsp											
											<img style="height: 40px;width: 40px;border-radius: 50%;"  src="Admin_Images/Admin_Profile.png">&nbsp			
										</div>
										<div style="float: left;" class="chatbox">
											<?php
												echo $row['message'];
											?>						
										</div>
										</div>
									<?php
									}
								}
							?>			
						</div>
						<div style="height: 50px;padding-top: 10px;">
							<form action="" method="post">
								<input type="text" name="message" class="form-control" required="" placeholder="Write Message..." style="float: left;">&nbsp&nbsp
								<button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
							</form>			
						</div>
						<!--</div>-->					
				<?php
				}
/*-----------------if submit is Not pressed-------------*/
				else
				{
					if($_SESSION['username']=='')
					{
						?>
							<img style="margin: 100px 80px; border-radius: 50%;" src="Images/Tenor.gif" alt="animated">
						<?php
					}
					else
					{
						if(isset($_POST['submit1']))
						{
							mysqli_query($db,"INSERT INTO `library`.`message` VALUES ('','$_SESSION[username]','$_POST[message]','No','Admin');");
							$res=mysqli_query($db,"SELECT * FROM message where username='$_SESSION[username]' ;");
						}
						else
						{
							$res=mysqli_query($db,"SELECT * FROM message where username='$_SESSION[username]' ;");
						}
						?>
						<div style="height: 70px; width: 100%;text-align:center;color: white;">
							<h3 style="margin-top:-5px;padding-top:10px;"><?php echo $_SESSION['username']?></h3>
						</div>
						<div class="msg">
						<?php
						while ($row=mysqli_fetch_assoc($res)) 
						{
							if ($row['sender']='Student') 
							{
						?>
<!------------------------------- Student --------->
								<br><div class="chat user">
									<div style="float: left;padding-top: 5px;">&nbsp												
										<?php										
											echo "<img class='img-circle profile_img' height=40 width=40 src='Images/".$_SESSION['pic']."'>";  
										?>&nbsp																
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
<!--------------------- ----------Admin--------->
							<br><div class="chat admin">
								<div style="float: left;padding-top: 5px;">&nbsp											
									<img style="height: 40px;width: 40px;border-radius: 50%;"  src="Admin_Images/Admin_Profile.png">&nbsp			
								</div>
								<div style="float: left;" class="chatbox">
									<?php
										echo $row['message'];
									?>						
								</div>
							</div>
							<?php
							}
						}
							?>			
						</div>
						</div>
						<div style="height: 50px;padding-top: 10px;">
							<form action="" method="post">
								<input type="text" name="message" class="form-control" required="" placeholder="Write Message..." style="float: left;">&nbsp&nbsp
								<button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
							</form>			
						</div>
						<?php
					}	
				}
				?>
			</div>	
		</div>
		<script>
			var table=document.getElementById('table'),eIndex;
			for(var i=0; i<table.rows.length; i++)
			{
				table.rows[i].onclick =function()
				{
					rIndex=this.rowIndex;
					document.getElementById("uname").value =this.cells[1].innerHTML;
				}		
			}
		</script>
	</body>
</html>