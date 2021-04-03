<?php
	session_start();
	include "Connection_S.php";
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="Style_S.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<?php
	if (isset($_SESSION['login_user'])) 
		{
			$r=mysqli_query($db,"SELECT COUNT(status) as total FROM message where status='No' and username='$_SESSION[login_user]' and sender='Admin';");
			$c=mysqli_fetch_assoc($r);
//----------Timer------
			$b=mysqli_query($db," SELECT * FROM `issue_book`WHERE User_Name ='$_SESSION[login_user]' and Approve='Yes' ORDER BY 'Return_Date' ASC LIMIT 0,1;");
			$var1 =mysqli_num_rows($b);
			$B_ID=mysqli_fetch_assoc($b);
			if(!is_null($B_ID)){
				$t=mysqli_query($db,"SELECT * FROM timer where name='$_SESSION[login_user]' and B_ID='$B_ID[B_ID]';");
				$res=mysqli_fetch_assoc($t);
				if(!is_null($res)){
					echo $res['tm'];
				}
			}
	?>
	<nav class="navbar navbar-inverse" style="background-color: black;">
		<div class="container-fluid">
			<div class="navbar-header">
		    	<a class="navbar-brand active" style="font-size: 20px;color: white;" > Online Library Management System</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="Index_S.php"> Home </a></li>
				<li><a href="Books_S.php"> Books </a></li>
				<li><a href="Feedback_S.php"> Feedback </a></li>
			</ul>
			<?php
			if($var1==1)
			{
			?>
<!-----timer--------->
			<script>
				var countDownDate = new Date("<php <?php echo $res['tm']; ?>").getTime();// Set the date we're counting down to
				var x = setInterval(function()// Update the count down every 1 second	 
				{
				  var now = new Date().getTime();  // Get today's date and time  
				  var distance = countDownDate - now;// Find the distance between now and the count down date  
				  var days = Math.floor(distance / (1000 * 60 * 60 * 24));// Time calculations for days
				  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));//Time calculations for hours
				  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));//Time calculations for minutes 
				  var seconds = Math.floor((distance % (1000 * 60)) / 1000);//Time calculations for seconds  
				  document.getElementById("demo").innerHTML = days + "d " + hours + "h "// Display the result in the element with id="demo"
				  + minutes + "m " + seconds + "s ";  
				  if (distance < 0)// If the count down is finished, write some text 
				  {
				    clearInterval(x);
				    document.getElementById("demo").innerHTML = "EXPIRED";
				  }
				}, 1000);
			</script>
<!-----Timer-------->
		<?php
		}
		?>					
			<ul class="nav navbar-nav">
				<li><a href="Profile_S.php">Profile</a></li>
				<li><a href="Fines_S.php">Fines</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a><p style="color:#ff1503; font-size: 20px;" id="demo"> </p></a></li>
				<li><a href="Message_S.php">
					<span class="glyphicon glyphicon-envelope"></span>
					<span class="badge bg-green"><?php echo $c['total']; ?></span>
				</a></li>
				<li><a href="">
					<div style="color: white;">
						<?php										
							echo "<img class='img-circle profile_img' height=30 width=30 src='Student_Images/".$_SESSION['pic']."'>";echo " ".$_SESSION['login_user'];  
						?>
					</div>
				</a></li>
				<li><a href="Logout_S.php">
					<span class="glyphicon glyphicon-log-out"> Logout</span>
				</a></li>
			</ul>
		</div>
	</nav>
	<?php
		if(isset($_SESSION['login_user']))
		{
			$day=0;
			$exp='<p style="color:yellow;background-color:red;">Expired</P>';
			$res=mysqli_query($db,"SELECT * FROM `issue_book` where User_Name='$_SESSION[login_user]' and Approve='$exp';");
			while($row=mysqli_fetch_assoc($res))
			{
				$d=strtotime($row['Return_Date']);				
				$c=strtotime(date("Y-m-d"));				
				$diff=$c-$d;
				//$diff=-1;
				if($diff>=0)
				{
					$day=$day+floor($diff/(60*60*24));					
				}
			}					
			$_SESSION['fine']=$day*.10;
		}
	}
	else
	{
		?>
		<nav class="navbar navbar-inverse" style="background-color: black;">
		<div class="container-fluid">
			<div class="navbar-header">
		    	<a class="navbar-brand active" style="font-size: 20px;color: white;" > Online Library Management System</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="Index.php"> Home </a></li>
				<li><a href="Books.php"> Books </a></li>
				<li><a href="Feedback.php"> Feedback </a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="../Login.php"><span class="glyphicon glyphicon-log-in"> Login</span></a></li>					
				<li><a href="Registration.php"><span class="glyphicon glyphicon-user"> SingUp</span></a></li>
			</ul>			
		</div>
		</nav>
		<?php	
	}
	?>
</body>
</html> 