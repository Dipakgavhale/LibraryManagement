<?php
include "Connection_A.php";
include"navbar_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Student Information</title>
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
			.abc:hover 
			{
			  background-color: #00544c;
			}
		</style>
	</head>
	<body>
<!---------sidenav    ---->
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
			</div>
			<div class="h"><a href="Add_Book.php">Add Books</a></div>			
			<div class="h"><a href="Book_Request_A.php">Book Request</a></div>
			<div class="h"><a href="Issue_Book_Information.php">Issue Book Information</a></div>
			<div class="h"><a href="Expired_Book_List.php">Expired Book List</a></div>
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
<!----------search bar-->
			<div class="container">
				<div class="srch">
					<form class="navbar-form" method="post" name="form1">				
							<input class="form-control" type="text" name="search" placeholder="Student Username.." required="">
							<button style="background-color:#c3cb6a;" type="submit" name="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-search"> </span>
							</button>				
					</form>
				</div>
				<h2>List of Students</h2>
				<?php
					if (isset($_POST['submit'])) 
					{
						$q=mysqli_query($db,"SELECT first,last,email,mobile,roll,username FROM `registration`where username like '%$_POST[search]%' ");
						if (mysqli_num_rows($q)==0)
						{
							echo "Sorry! No student found with the username. Try searching again.";
						}
						else
						{
							echo "<table class='table table-bordered '>";		
								echo "<tr style='background-color: #c3cb6a;'>";
								//table header
									echo "<th>"; echo "First Name"; 	echo "</th>";
									echo "<th>"; echo "Last Name"; 		echo "</th>";
									echo "<th>"; echo "Email Address";	echo "</th>";
									echo "<th>"; echo "Mobile No"; 		echo "</th>";
									echo "<th>"; echo "Roll No"; 		echo "</th>";
									echo "<th>"; echo "Username";		echo "</th>";
								echo "</tr>"; 
								while($row=mysqli_fetch_assoc($q))
								{
									echo "<tr class='abc'>";
										echo "<td>"; echo $row['first']; 			echo "</td>";
										echo "<td>"; echo $row['last']; 			echo "</td>";
										echo "<td>"; echo $row['email']; 			echo "</td>";
										echo "<td>"; echo $row['mobile']; 			echo "</td>";
										echo "<td>"; echo $row['roll']; 			echo "</td>";
										echo "<td>"; echo $row['username']; 		echo "</td>";
									echo "</tr>";
								}			
							echo "</table>";
						}
					}
					/* if button is not pressed*/
					else
					{
						$res=mysqli_query($db,"SELECT first,last,email,mobile,roll,username FROM `registration`;");
						echo "<table class='table table-bordered '>";		
							echo "<tr style='background-color: #c3cb6a;'>";
							//table header
								echo "<th>"; echo "First Name"; 	echo "</th>";
								echo "<th>"; echo "Last Name"; 		echo "</th>";
								echo "<th>"; echo "Email Address";	echo "</th>";
								echo "<th>"; echo "Mobile No"; 		echo "</th>";
								echo "<th>"; echo "Roll No"; 		echo "</th>";
								echo "<th>"; echo "Username";		echo "</th>";
							echo "</tr>"; 
							while($row=mysqli_fetch_assoc($res))
							{
								echo "<tr class='abc'>";
									echo "<td>"; echo $row['first']; 	echo "</td>";
									echo "<td>"; echo $row['last']; 	echo "</td>";
									echo "<td>"; echo $row['email']; 	echo "</td>";
									echo "<td>"; echo $row['mobile']; 	echo "</td>";
									echo "<td>"; echo $row['roll']; 	echo "</td>";
									echo "<td>"; echo $row['username']; echo "</td>";				
								echo "</tr>";
							}			
						echo "</table>";
					}			
				?>
			</div>
		</div>
	</body>
</html>