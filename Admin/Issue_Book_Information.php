<?php
include "Connection_A.php";
include"Navbar_A.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title> Issue Book Information</title>
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
			  background-image: url("Admin_Images/Issue_Book_Info_B.jpg");
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
			.scroll
			{
				width: 100%;
				height: 500px;
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
			<span style="font-size:30px;color: white; cursor:pointer color:" onclick="openNav()">&#9776; Open</span>		
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
				<form style="padding-top: 20px;" method="post">
					<button class="btn btn-default" style="float: left;" name="submit_m" type="submit">Send Email</button>
				</form>
				<h3 style="text-align: center;">Information of Issue Books</h3><br>
				<?php
					$c=0;
					$sql="SELECT registration.roll,username,books.B_ID,Name,Authors,Edition, Issue_Date,issue_book.Return_Date FROM registration inner join issue_book ON registration.username=issue_book.User_Name inner join books ON issue_book.B_ID=books.B_ID WHERE issue_book.Approve='Yes' ORDER BY `issue_book`.`Return_Date`ASC";
					$res=mysqli_query($db,$sql);
					echo "<table class='table table-bordered'style='width:98%;'>";		
						echo "<tr style='background-color: #6db6b9e6;'>";
					//table header							
							echo "<th>"; echo "Roll No"; 			echo "</th>";
							echo "<th>"; echo "Student Username"; 	echo "</th>";
							echo "<th>"; echo "Book ID"; 			echo "</th>";
							echo "<th>"; echo "Book Name"; 			echo "</th>";
							echo "<th>"; echo "Authors Name"; 		echo "</th>";
							echo "<th>"; echo "Edition"; 			echo "</th>";
							echo "<th>"; echo "Issue Date"; 		echo "</th>";
							echo "<th>"; echo "Return Date"; 		echo "</th>";					
						echo"</tr>"; 
					echo "</table>";
					echo "<div class='scroll'>";
						echo "<table class='table table-bordered'>";
							while($row=mysqli_fetch_assoc($res))
							{
								$d=date("Y-m-d");
								if ($d > $row['Return_Date']) 
								{
									$c=$c+1;
									$var='<p style="color:yellow;background-color:red;">Expired</P>';
									mysqli_query($db,"UPDATE issue_book SET Approve='$var' where Return_Date='$row[Return_Date]' and Approve ='Yes' limit $c; ");	
									echo $d."</br>";							
								}
								echo "<tr>";
									echo "<td>"; echo $row['roll'];			echo "</td>";
									echo "<td>"; echo $row['username']; 	echo "</td>";
									echo "<td>"; echo $row['B_ID']; 		echo "</td>";
									echo "<td>"; echo $row['Name']; 		echo "</td>";
									echo "<td>"; echo $row['Authors']; 		echo "</td>";
									echo "<td>"; echo $row['Edition']; 		echo "</td>";
									echo "<td>"; echo $row['Issue_Date']; 	echo "</td>";
									echo "<td>"; echo $row['Return_Date']; 	echo "</td>";						
								echo "</tr>";
							}													
						echo "</table>";
					echo "</div>";
					if(isset($_POST['submit_m']))
					{
						$t=mysqli_query($db,"SELECT * FROM `issue_book` WHERE 	Approve='Yes';");
						$date1=date_create(date("Y-m-d"));
						while ($row=mysqli_fetch_assoc($t)) 
						{
							$date2=date_create($row['Return_Date']);
							$diff=date_diff($date1,$date2);
							$day=$diff->format("%a");
							if($day==2)
							{
								$name_m=$row['User_Name'];
								$bid_m=$row['B_ID'];
								$sql_m=mysqli_query($db,"SELECT * FROM `registration` WHERE username='$row[User_Name]' ;");
								$to=mysqli_fetch_assoc($sql_m);
								$subject="Regarding book return date";
								$msg="Hello!
									  This is send to notify that you need to return the book (Id: ".$bid_m.")in tow days.";
								$from="From:dipakgavhale95@gmail.com";
								if (mail($to['email'],$subject,$msg,$from))
								{
									?>
										<script type="text/javascript">
											alert("Email sent successfully.")
										</script>
									<?php	
								}
								else
								{
									?>
										<script type="text/javascript">
											alert("Email not sent.")
										</script>
									<?php
								}
							}
						}
					}
				?>
			</div>
		</div>
	</body>
</html>