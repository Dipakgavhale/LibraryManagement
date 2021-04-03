<?php
include "Connection_A.php";
include "Navbar_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Approve Book Request</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			.srch
			{
				padding-left: 850px;
			}
			.form_control
			{
				width: 300px;
				height: 40px;
				background-color: black;
				color: white;
			}
			body 
			{
			  background-image: url("Images/Approve_Book_Request_B.jpg");
			  background-repeat: no-repeat;
			  font-family: "Lato", sans-serif;
			  transition: background-color .5s;
			}
			.sidenav
			{
			  height: 100%;
			  margin-top: 50px;
			  width: 0;
			  position: fixed;
			  z-index: 1;
			  top: 0;
			  left: 0;
			  background-color: #222;
			  overflow-x: hidden;
			  transition: 0.5s;
			  padding-top: 60px;
			}
			.sidenav a 
			{
			  padding: 8px 8px 8px 32px;
			  text-decoration: none;
			  font-size: 25px;
			  color: #818181;
			  display: block;
			  transition: 0.3s;
			}
			.sidenav a:hover 
			{
			  color: #f1f1f1;
			}
			.sidenav .closebtn 
			{
			  position: absolute;
			  top: 0;
			  right: 25px;
			  font-size: 36px;
			  margin-left: 50px;
			}
			#main 
			{
			 	transition: margin-left .5s;
			 	padding: 16px;
			}
			@media screen and (max-height: 450px) 
			{
				.sidenav {padding-top: 15px;}
			  	.sidenav a {font-size: 18px;}
			}
			.img-circle
			{
				margin-left:20px;
			}
			.h:hover
			{
				color: white;
				width: 300px;
				height: 50px;
				background-color: #00544c;
			}
			.container
			{
				height: 600px;
				background-color: black;
				opacity: .8;
				color: white;
			}
			.Approve
			{
				margin-left: 420px;
			}
		</style>
	</head>
	<body>
<!--- Sidenav------>
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<div style="color: white; margin-left: 60px;font-size: 20;">									
				<?php
					if (isset($_SESSION['login_user'])) 
					{				
						echo "<img class='img-circle profile_img' height=120 width=120 src='Admin_Images/".$_SESSION['pic']."'>";
						echo "<br><br>";
						echo"Welcome ".$_SESSION['login_user'];
					}
				?>
			</div><br><br>
			
			<div class="h"><a href="Book_Request_A.php">Book Request</a></div>
			<div class="h"><a href="Issue_Book_Information.php">Issue Book Information</a></div>
			<div class="h"><a href="Expired_Book_List.php">Expired Book List</a></div>
		</div>
		<div id="main">			
			<span style="font-size:30px;cursor:pointer color:" onclick="openNav()">&#9776; Open</span>		
			<script>
				function openNav() 
				{
				  document.getElementById("mySidenav").style.width = "300px";
				  document.getElementById("main").style.marginLeft = "300px";
				  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
				}

				function closeNav() 
				{
				  document.getElementById("mySidenav").style.width = "0";
				  document.getElementById("main").style.marginLeft= "0";
				  document.body.style.backgroundColor = "white";
				}
			</script>
			<div class="container">
				<br><h3 style="text-align: center;">Approve Book Request</h3><br><br>
				<form class="Approve" action="" method="post">
					<input class="form_control" type="text" name="Approve" placeholder="Yes or No" required=""><br><br>
					<input class="form_control" type="text" name="Issue_Date" placeholder="Issue Date yyyy-mm-dd" required=""><br><br>
					<input class="form_control" type="text" name="Return_Date" placeholder="Return Date yyyy-mm-dd" required=""><br><br>
					<input type="text" name="tm" class="form_control" placeholder="Return Date feb 18, 2021 15:00:00" required=""><br><br>
					<button class="btn btn-default" type="Submit" name="Submit">Approve Book</button>
				</form>
			</div>
		</div>
		<?php
			if (isset($_POST['Submit'])) 
			{
				mysqli_query($db," INSERT INTO timer VALUES ('$_SESSION[name]', '$_SESSION[B_ID]', '$_POST[tm]');");
				mysqli_query($db,"UPDATE `issue_book` SET `Approve` ='$_POST[Approve]',`Issue_Date`='$_POST[Issue_Date]',`Return_Date`='$_POST[Return_Date]'WHERE User_Name='$_SESSION[name]' and B_ID='$_SESSION[B_ID]';");
				mysqli_query($db,"UPDATE books SET Quantity=Quantity-1 where B_ID='$_SESSION[B_ID]' ;");
				mysqli_query($db,"UPDATE books SET Bcount=Bcount+1 where B_ID='$_SESSION[B_ID]' ;");
				$res=mysqli_query($db,"SELECT Quantity from books where B_ID='$_SESSION[B_ID]';");
				while($row=mysqli_fetch_assoc($res))
				{
					if ($row=['Quantity']==0) 
					{
						mysqli_query($db,"UPDATE books SET Status='Not-available' where B_ID='$_SESSION[B_ID]';");
					}
				}
				?>
					<script type="text/javascript">
						alert("Updated Successfully.");
						window.location="Book_Request_A.php";
					</script>
				<?php
			}
		?>
	</body>
	</html>
