<?php
include "Connection_A.php";
include"Navbar_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
	<title>Book Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
		<style type="text/css">
			.srch
			{
				padding-left: 850px;
			}
			.form-control
			{
				width: 300px;
				height:40px;
				background-color:black;
				color: white;
			}
			body 
			{
			 background-image: url("Admin_Images/Book_Request_B.jpg");
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
				opacity: .6;
				color: white;

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
			<div class="container">
				<div class="srch">
					<form method="post" accept="" name="form1"><br>
						<input type="text" name="username" class="form-control" placeholder="Username" required="" ><br>
						<input type="text" name="B_ID" class="form-control" placeholder="Book ID" required=""><br>
						<button class="btn btn-default" name="submit" type="submit" >Submit</button><br>
					</form>
				</div>
				<h3 style="text-align: center;">List of Book Request</h3>
				<?php
				if (isset($_SESSION['login_user'])) 
				{
					$sql="SELECT registration.roll,username,books.B_ID,Name,Authors,Edition,books.Status FROM registration inner join issue_book ON registration.username=issue_book.User_Name inner join books ON books.B_ID=issue_book.B_ID WHERE issue_book.Approve=''";
					$res=mysqli_query($db,$sql);
					if (mysqli_num_rows($res)==0)
						{
							echo "<h2><b>";
							echo "There's no pending request.";
							echo "</b></h2>";
						}
					else
					{
						echo "<table class='table table-bordered '>";		
							echo "<tr style='background-color: #c3cb6a;'>";
							//table header
								echo "<th>"; echo "Roll No."; 		echo "</th>";
								echo "<th>"; echo "Username"; 		echo "</th>";
								echo "<th>"; echo "Book ID"; 		echo "</th>";
								echo "<th>"; echo "Book name"; 		echo "</th>";
								echo "<th>"; echo "Authors name";	echo "</th>";
								echo "<th>"; echo "Edition"; 		echo "</th>";
								echo "<th>"; echo "Status"; 		echo "</th>";
							echo "</tr>"; 
							while($row=mysqli_fetch_assoc($res))
							{
								echo "<tr>";
									echo "<td>"; echo $row['roll']; 	echo "</td>";
									echo "<td>"; echo $row['username']; echo "</td>";
									echo "<td>"; echo $row['B_ID']; 	echo "</td>";
									echo "<td>"; echo $row['Name']; 	echo "</td>";
									echo "<td>"; echo $row['Authors']; 	echo "</td>";
									echo "<td>"; echo $row['Edition']; 	echo "</td>";
									echo "<td>"; echo $row['Status'];	echo "</td>";						
								echo "</tr>";
							}						
						echo "</table>";
					}
				}
				else
				{
					?><br>				
						<h4 style="text-align: center; color: yellow">You need to login to see the request.</h4>
					<?php
				}
				if(isset($_POST['submit']))
				{
					$_SESSION['name']=$_POST['username'];
					$_SESSION['B_ID']=$_POST['B_ID'];
					?>
						<script type="text/javascript">
							window.location="Approve_Book_Request.php";
						</script>
					<?php
				}/*SELECT registration.roll,username,books.B_ID,Name,Authors,Edition,Status FROM registration inner join issue_book ON registration.username=issue_book.User_Name inner join books ON issue_book.B_ID=books.B_ID WHERE issue_book.Approve='';*/
				?>
			</div>
		</div>
	</body>
</html>