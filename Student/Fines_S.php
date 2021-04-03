<?php
include "Connection_S.php";
include"Navbar_S.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Fine Calculations</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			.srch
			{
				padding-left: 850px; 

			}body 
			{
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
				height: 800px;
				background-color: black;
				opacity: .6;
				color: white;
			}
		</style>
	</head>
	<body>
<!-------sidenav    ---->
		<div id="mySidenav" class="sidenav">
			<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
			<div style="color: white; margin-left: 60px;font-size: 20;">									
				<?php
					if (isset($_SESSION['login_user']))						
					{
						echo "<img class='img-circle profile_img' height=120 width=120 src='Student_Images/".$_SESSION['pic']."'>";
						echo "<br><br>";
						echo"Welcome ".$_SESSION['login_user'];
					}
				?>
			</div>
			<div class="h"><a href="Book_Request_S.php">Book Request</a></div>
			<div class="h"><a href="Issue_Book_Information_S.php">Issue Book Information</a></div>
			
		</div>
		<div id="main">			
			<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Open</span>		
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
			<!--    search bar-->
			<div class="container">
				<h2>List of Students</h2>
				<?php
					$res=mysqli_query($db,"SELECT * FROM `fines` where username='$_SESSION[login_user]';");
					echo "<table class='table table-bordered table-hover'>";		
						echo "<tr style='background-color: #c3cb6a;'>";
						//table header
							echo "<th>"; echo "Username"; 		echo "</th>";
							echo "<th>"; echo "Book ID"; 		echo "</th>";
							echo "<th>"; echo "Rrturned Date";	echo "</th>";
							echo "<th>"; echo "Days"; 			echo "</th>";
							echo "<th>"; echo "Fines"; 			echo "</th>";
							echo "<th>"; echo "Status";			echo "</th>";
						echo "</tr>"; 
						while($row=mysqli_fetch_assoc($res))
						{
							echo "<tr>";
								echo "<td>"; echo $row['username']; echo "</td>";
								echo "<td>"; echo $row['B_ID']; 	echo "</td>";
								echo "<td>"; echo $row['returned'];	echo "</td>";
								echo "<td>"; echo $row['day']; 		echo "</td>";
								echo "<td>"; echo $row['Fines']; 	echo "</td>";
								echo "<td>"; echo $row['Status']; 	echo "</td>";				
							echo "</tr>";
						}			
					echo "</table>";		
				?>
			</div>
		</div>
	</body>
</html>