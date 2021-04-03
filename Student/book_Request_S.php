<?php
include "Connection_S.php";
include"Navbar_S.php";
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
			body 
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
			th,td,input
			{
				width: 100px;
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
			<div class="h"><a href="Issue_Book_Information_S.php">Issue Book Information</a></div>
			<div class="h"><a href="">Expired List</a></div>
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
			<?php
			
				$q=mysqli_query($db,"SELECT * FROM issue_book where User_name='$_SESSION[login_user]'and Approve='';");
				if (mysqli_num_rows($q)==0)
				{
					echo "<h2><b>There's no pending request.</b></h2>";
				}
				else
				{
					?>
						<form method="post">						
					<?php
					echo "<table class='table table-bordered table-hover'>";		
					echo "<tr style='background-color: #6db6b9e6;'>";
					//table header
					echo "<th>"; echo "Select"; 	echo "</th>";
					echo "<th>"; echo "Book ID"; 	echo "</th>";
					echo "<th>"; echo "Approve"; 	echo "</th>";
					echo "<th>"; echo "Issue Date"; echo "</th>";
					echo "<th>"; echo "Return Date"; echo "</th>";					
					echo "</tr>"; 
					while($row=mysqli_fetch_assoc($q))
					{
						echo "<tr>";
						?>
						<td><input type="checkbox" name="check[]" value="<?php echo $row["B_ID"] ?>"></td>
						<?php 
						echo "<td>"; echo $row['B_ID']; 		echo "</td>";
						echo "<td>"; echo $row['Approve']; 		echo "</td>";
						echo "<td>"; echo $row['Issue_Date']; 	echo "</td>";
						echo "<td>"; echo $row['Return_Date'];	echo "</td>";						
						echo "</tr>";
					}						
					echo "</table>";
					?>					
					<p align="center"><button type="submit" name="delete" class="btn btn-success" onclick="location.reload()">Delete</button></p>
				</form>					
					<?php
				}			
			?>
		</div>
		<?php
			if(isset($_POST['delete']))
			{
				if(isset($_POST['check']))
				{
					foreach ($_POST['check'] as $delete_id) 
					{
						mysqli_query($db,"DELETE from `issue_book` WHERE B_ID='$delete_id' and User_Name ='$_SESSION[login_user]' ORDER BY B_ID ASC LIMIT 1;");
					}
				}
			}
		?>
	</body>
</html>