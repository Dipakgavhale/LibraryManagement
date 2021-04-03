<?php
include "Connection_S.php";
include"Navbar_S.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title> Issue Book Information</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		.srch
		{
			padding-left: 70%;
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
		  background-image: url("Student_Images/Issue_Book_Info_B.jpg");
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
		 	padding-left: -10px;
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
			width: 85%;
			background-color: black;
			opacity: .6;
			color: white;
			margin-top: -65px;
		}
		.scroll
		{
			width: 100%;
			height: 400px;
			overflow: auto;
		}
		th,td
		{
			width: 10%;
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
						echo "<img class='img-circle profile_img' height=120 width=120 src='Student_Images/".$_SESSION['pic']."'>";
						echo "<br><br>";
						echo"Welcome ".$_SESSION['login_user'];
					}
				?>
			</div><br><br>
			<div class="h"><a href="Books_S.php">Books</a></div>			
			<div class="h"><a href="Book_Request_S.php">Book Request</a></div>
			<div class="h"><a href="Issue_Book_Information_S.php">Issue Information</a></div>
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
				<?php
				if (isset($_SESSION['login_user'])) 
				{
					?>
						<div style="float: left; padding: 25px;">
							<form method="post" action="">
								<button name="submit2" type="submit" class="btn btn-default" style="background-color: #06861a; color: yellow;" >Returned</button>&nbsp &nbsp
								<button name="submit3" type="submit" class="btn btn-default" style="background-color: red; color:yellow;">Expired</button>
							</form>
						</div>
						<div style="float: right;padding-top:10px;">
							<?php 
								$var=0;
								$result=mysqli_query($db,"SELECT * FROM `fines` WHERE username='$_SESSION[login_user]' and Status='Not paid';");
								while($r=mysqli_fetch_assoc($result))
									{
										$var=$var+$r['Fines'];
									}
								$var2=$var+$_SESSION['Fines'];
							 ?>
							<h3>Your fine is:
								<?php
								echo"$".$var2;
								?>
							</h3>
						</div>
					<?php				
						$ret='<p style="color:yellow;background-color:green;">Returned</P>';
						$exp='<p style="color:yellow;background-color:red;">Expired</P>';
						if(isset($_POST['submit2']))
						{
							$sql="SELECT registration.roll,username,books.B_ID,Name,Authors,Edition,Approve, Issue_Date,issue_book.Return_Date FROM registration inner join issue_book ON registration.username=issue_book.User_Name inner join books ON issue_book.B_ID=books.B_ID WHERE issue_book.Approve='$ret' ORDER BY `issue_book`.`Return_Date`DESC";
							$res=mysqli_query($db,$sql);
						}
						elseif (isset($_POST['submit3'])) 
						{
							$sql="SELECT registration.roll,username,books.B_ID,Name,Authors,Edition,Approve, Issue_Date,issue_book.Return_Date FROM registration inner join issue_book ON registration.username=issue_book.User_Name inner join books ON issue_book.B_ID=books.B_ID WHERE issue_book.Approve='$exp' ORDER BY `issue_book`.`Return_Date`DESC";
							$res=mysqli_query($db,$sql);
						}
						else
						{
							$sql="SELECT registration.roll,username,books.B_ID,Name,Authors,Edition,Approve, Issue_Date,issue_book.Return_Date FROM registration inner join issue_book ON registration.username=issue_book.User_Name inner join books ON issue_book.B_ID=books.B_ID WHERE issue_book.Approve!='' and issue_book.Approve!='Yes'  ORDER BY `issue_book`.`Return_Date`DESC";
							$res=mysqli_query($db,$sql);
						}							
						echo "<table class='table table-bordered'style='width:98%;'>";		
							echo "<tr style='background-color: #6db6b9e6;'>";
					//table header							
								echo "<th>"; echo "Roll No"; 			echo "</th>";
								echo "<th>"; echo "Student Username"; 	echo "</th>";
								echo "<th>"; echo "Book ID"; 			echo "</th>";
								echo "<th>"; echo "Book Name"; 			echo "</th>";
								echo "<th>"; echo "Authors Name"; 		echo "</th>";
								echo "<th>"; echo "Edition"; 			echo "</th>";
								echo "<th>"; echo "Approve"; 			echo "</th>";
								echo "<th>"; echo "Issue Date"; 		echo "</th>";
								echo "<th>"; echo "Return Date"; 		echo "</th>";					
							echo "</tr>"; 
						echo "</table>";
						echo "<div class='scroll'>";
							echo "<table class='table table-bordered'>";
								while($row=mysqli_fetch_assoc($res))
								{								
									echo "<tr>";
										echo "<td>"; echo $row['roll'];			echo "</td>";
										echo "<td>"; echo $row['username']; 	echo "</td>";
										echo "<td>"; echo $row['B_ID']; 		echo "</td>";
										echo "<td>"; echo $row['Name']; 		echo "</td>";
										echo "<td>"; echo $row['Authors']; 		echo "</td>";
										echo "<td>"; echo $row['Edition']; 		echo "</td>";
										echo "<td>"; echo $row['Approve']; 		echo "</td>";
										echo "<td>"; echo $row['Issue_Date']; 	echo "</td>";
										echo "<td>"; echo $row['Return_Date']; 	echo "</td>";						
									echo "</tr>";
								}													
							echo "</table>";
						echo "</div>";
				}
				else
				{
					?>
	 					<h3 style="text-align: center;">Login to see information of borrowed books</h3>
					<?php	
				}
				?>
			</div>
		</div>
	</body>
	</html>