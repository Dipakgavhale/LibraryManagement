<?php
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Online Library Management System</title>
		<link rel="stylesheet" type="text/css" href="Style_A.css">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

		<style type="text/css">
			nav
			{
			    float: right;
			    word-spacing: 30px;
			    padding: 20px;
			}
			nav li
			{
			    display: inline-block;
			    line-height: 20px;
			}			
		</style>
	</head>
<body>
	<div class="wrapper">
		<header >
			<div class="logo">
				<img src="Admin_Images/Logo_A.png" style="padding-left: 80px;margin-top: 12px;height: 60px;width: 150px;">
	    		<h1 style="color: white;font-size: 15px;margin-top: 0px;">Online Library Management System</h1>
			</div>
				<nav style="margin-top: 20px;">
					<ul>
						<li><a href="Index_A.php">Home</a></li>
						<li><a href="Books_A.php">Books</a></li>
						<li><a href="Logout_A.php">Logout</a></li>
						<li><a href="Feedback_A.php">Feedback</a></li>
					</ul>
				</nav>
		</header>
		<section style="height: 650px; background-image:url(Admin_Images/6.jpg);background-repeat: no-repeat;margin-top: -20px; ">
			<div>
				<div class="w3-content w3-section">
					<img class="myslide w3-animate-left" src="Admin_Images/1.jpg" style="width: 1650px;height: 300px;margin-left: -30%;">
					<img class="myslide w3-animate-left" src="Admin_Images/2.png"style="width: 1650px;height: 300px;margin-left: -30%;">
					<img class="myslide w3-animate-feding" src="Admin_Images/3.jpg"style="width: 1650px;height:300px;margin-left: -30%;">
					<img class="myslide w3-animate-left" src="Admin_Images/4.jpg"style="width: 1650px;height: 300px;margin-left: -30%;">
					<img class="myslide w3-animate-left" src="Admin_Images/5.png"style="width: 1650px;height: 300px;margin-left: -30%;">
					<img class="myslide w3-animate-left" src="Admin_Images/1.jpg"style="width: 2500px;height: 200px;margin-left: -30%;">
				</div>
					<script type="text/javascript">
						var a=0;
						carousel();
						function carousel()
						{
							var i;
							var x= document.getElementsByClassName("myslide");
							/*document.write(x.length);*/
							for (var i=0;i<x.length;i++) 
							{
								x[i].style.display ='none';
							}
							a++;
							if(a > x.length){a = 1}
							x[a-1].style.display = "block";
						setTimeout(carousel, 1000);
						}
					</script><br>   
				<div class="box">
					<br>
					<h1 style="text-align: center;font-size: 35px;">Welcome to library</h1><br>
					<h1 style="text-align: center;font-size: 25px;">Opens at: 09:00</h1>
					<h1 style="text-align: center;font-size: 25px;">Closes at: 15:00</h1>
				</div>
			</div>
		</section>		
	</div>
	<?php
	include "Footer_A.php";
	?>
</body>
</html>