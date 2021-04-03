<?php
include "Connection_A.php";
include"Navbar_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Add Books</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			.srch
			{
				padding-left: 1000px; 
			}
			body 
			{
			  background-color: #024629;
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
			.book
			{
				width: 400px;
				margin: 0px auto;
			}
			.form-control
			{
				background-color: #080707;
				color: white;
				height:40px;
			}
		</style>
	</head>
	<body>
<!------sidenav    ---->
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
			<div class="h"><a href="Add_Book.php">Add Books</a></div>			
			<div class="h"><a href="Book_Request_A.php">Book Request</a></div>
			<div class="h"><a href="Issue_Book_Information.php">Issue Book Information</a></div>
			<div class="h"><a href="Expired_Book_List.php">Expired Book List</a></div>
		</div>
		<div id="main">			
			<span style="font-size:30px;cursor:pointer; color:black;"onclick="openNav()">&#9776; Open</span>
			<div class="container"  style="text-align: center;">
				<h2 style="color:black;font-family:Lucida Console;text-align:center;"><b>Add New Books</b></h2><br>
				<form class="book" action="" method="post">
					<input type="text" name="B ID" class="form-control" placeholder="Books ID"required=""><br>
					<input type="text" name="Name" class="form-control" placeholder="Books Name" required=""><br>
					<input type="text" name="Authors" class="form-control" placeholder="Authors Name" required=""><br>
					<input type="text" name="Edition" class="form-control" placeholder="Edition" required=""><br>
					<input type="text" name="Status" class="form-control" placeholder="Books Status" required=""><br>
					<input type="text" name="Quantity" class="form-control" placeholder="Books Quantity" required=""><br>
					<input type="text" name="Department Name" class="form-control" placeholder="Department Name" required=""><br>
					<button class="btn btn-default" type="submit" name="submit">Add Book</button><br>

				<div class="form-control"> 	
					<select id="Department Name">
						<option>Select a Department</option>
						<optgroup label="Educational">
							<option>ECE</option>
							<option>EEE</option>
							<option>EME</option>
							<option>CSE</option>
						</optgroup>
						<optgroup label="Entertainment">
							<option>Action</option>
							<option>Comedy</option>
							<option>Story</option>				
						</optgroup>
					</select><br></div>	

				</form>
			</div>
			<?php
				if (isset($_POST['submit'])) 
				{
					if (isset($_SESSION['login_user'])) 
					{
						/*mysqli_query($db,"INSERT INTO books VALUES('$_POST[B ID]','$_POST[Name]','$_POST[Authors]','$_POST[Edition]','$_POST[Status]','$_POST[Quantity]','$_POST[Department Name]');");*/
						mysqli_query($db,"INSERT INTO `books` VALUES('$_POST[B_ID]','$_POST[Name]','$_POST[Authors]','$_POST[Edition]','$_POST[Status]','$_POST[Quantity]','$_POST[Department_Name]','0');");
						?>
							<script type="text/javascript">
								alert("Book Added Successfully.");
							</script>
						<?php
					}
					else
					{
						?>
							<script type="text/javascript">
								alert("You need to login first.");
							</script>
						<?php
					}
				}
			?>
		</div>
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
			  document.body.style.backgroundColor = "#024629";
			}
		</script>	
</body>
