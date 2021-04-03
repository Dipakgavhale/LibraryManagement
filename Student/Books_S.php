<?php
include "Connection_S.php";
include"Navbar_S.php";
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Books</title>
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
		</style>
	</head>
	<body>
		<?php
		$b=mysqli_query($db,"SELECT * FROM `books` ORDER BY Bcount DESC LIMIT 0,3;");
		
		?>
		<div style=" width: 100%;height: 50px;margin-top: -20px;">
			<div style="background-color: #f44336;padding: 10px;width: 10%;height: 50px;float: left;">
				<h3 style="color: white;margin-top:0px;">Trending: </h3>
			</div>
			<div style="background-color: #ffcccc;width: 90%; height: 50px;float: left;padding: 10px;">
				<table>
				<?php
					while ($b2=mysqli_fetch_assoc($b)) 
					{
						echo "<tr style='color: black;width: 400px;margin-top: 0px;float: left;'>";
							echo "<td >"; echo "[".$b2['B_ID']."] &nbsp&nbsp";echo "</td>";
							echo "<td>"; echo $b2['Name'];echo "</td>";
						echo "</tr>";
					}
				?>
				<tr style="color: black;width: 400px;margin-top: 0px;float: left;">
				</tr>
				</table>
			</div>
		</div>
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
		<div class="srch">
			<form class="navbar-form" method="post" name="form1">
				<label for="Department">Choose a Department:</label>
				<select name="Department">
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
				</select><br>				
					<input class="form-control" type="text" name="search" placeholder="search books.." required="">
					<button style="background-color:#c3cb6a;" type="submit" name="submit" class="btn btn-default">
						<span class="glyphicon glyphicon-search"> </span>
					</button>				
			</form>
		</div>
<!----- Request books-------->
		<div class="srch">
			<form class="navbar-form" method="post" name="form1">				
					<input class="form-control" type="text" name="B_ID" placeholder="Enter Book Id.." required="">
					<button style="background-color:#c3cb6a;" type="submit" name="submit1" class="btn btn-default">
						Request
					</button>				
			</form>
		</div>
		<h2>List of books</h2>
		<?php
			if (isset($_POST['submit'])) 
			{
				$q=mysqli_query($db,"SELECT * FROM books where name like '%$_POST[search]%' and Department_Name='$_POST[Department]'");
				if (mysqli_num_rows($q)==0)
				{
					echo "Sorry! No book found. Try searching again.";
				}
				else
				{
					echo "<table class='table table-bordered table-hover'>";		
					echo "<tr style='background-color: #c3cb6a;'>";
					//table header
						echo "<th>"; echo "Book ID"; 			echo "</th>";
						echo "<th>"; echo "Book Name"; 		echo "</th>";
						echo "<th>"; echo "Author Name";	echo "</th>";
						echo "<th>"; echo "Edition"; 		echo "</th>";
						echo "<th>"; echo "Status"; 		echo "</th>";
						echo "<th>"; echo "Quantity"; 		echo "</th>";
						echo "<th>"; echo "Department Name";echo "</th>";
					echo "</tr>"; 
					while($row=mysqli_fetch_assoc($q))
					{
						echo "<tr>";
							echo "<td>"; echo $row['B_ID']; 			echo "</td>";
							echo "<td>"; echo $row['Name']; 			echo "</td>";
							echo "<td>"; echo $row['Authors']; 			echo "</td>";
							echo "<td>"; echo $row['Edition']; 			echo "</td>";
							echo "<td>"; echo $row['Status']; 			echo "</td>";
							echo "<td>"; echo $row['Quantity']; 		echo "</td>";
							echo "<td>"; echo $row['Department_Name']; 	echo "</td>";
						echo "</tr>";
					}						
					echo "</table>";
				}
			}
/* if button is not pressed*/
			else
			{
				$res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`Name` ASC;");
				echo "<table class='table table-bordered table-hover'>";		
				echo "<tr style='background-color: #c3cb6a;'>";
				//table header
				echo "<th>"; echo "Book ID"; 		echo "</th>";
				echo "<th>"; echo "Book Name"; 		echo "</th>";
				echo "<th>"; echo "Author Name";	echo "</th>";
				echo "<th>"; echo "Edition"; 		echo "</th>";
				echo "<th>"; echo "Status"; 		echo "</th>";
				echo "<th>"; echo "Quantity"; 		echo "</th>";
				echo "<th>"; echo "Department Name";echo "</th>";
				echo "</tr>"; 
				while($row=mysqli_fetch_assoc($res))
				{
					echo "<tr>";
					echo "<td>"; echo $row['B_ID']; 			echo "</td>";
					echo "<td>"; echo $row['Name']; 			echo "</td>";
					echo "<td>"; echo $row['Authors']; 			echo "</td>";
					echo "<td>"; echo $row['Edition']; 			echo "</td>";
					echo "<td>"; echo $row['Status']; 			echo "</td>";
					echo "<td>"; echo $row['Quantity']; 		echo "</td>";
					echo "<td>"; echo $row['Department_Name']; 	echo "</td>";
					echo "</tr>";
				}			
				echo "</table>";
			}

			if (isset($_POST['submit1']))
			{
				if (isset($_SESSION['login_user'])) 
				{
					$sql1=mysqli_query($db," SELECT * FROM `books` where B_ID ='$_POST[B_ID]';");
					$row1=mysqli_fetch_assoc($sql1);
					$count1=mysqli_num_rows($sql1);
					if($count1!=0)
					{
						mysqli_query($db,"INSERT INTO issue_book values ('$_SESSION[login_user]','$_POST[B_ID]','','',''    );");
						?>
							<script type="text/javascript">
								window.location="Book_Request_S.php"
							</script>
						<?php
					}
					else
					{
						?>
							<script type="text/javascript">
								alert("The book is not available in library.");
							</script>
						<?php
					}
				}
				else
				{
					?>
					<script type="text/javascript">
						alert("You must login to request a book.");
					</script>
					<?php
				}
			}			
		?>
	</body>
</html>