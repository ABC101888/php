<?php
    include 'connect.php';

	session_start();
	

	if($_SESSION['logged_in'] !== "login")
	{
		header("Location: login.php");  
	}
?>

<html>
<head>
	<title>Login Index Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<link rel="stylesheet" type="text/css" href="gallery.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<style>
		form.search input[type=text] {
		  padding: 10px;
		  border-radius: 4px;
		  font-size: 16px;
		  border: 2px solid #00B4CC;
		  width: 50%;
		  background: #f1f1f1;
		}

		form.search button {
		  width: 10%;
		  padding: 10px;
		  background: #2196F3;
		  color: white;
		  font-size: 17px;
		  border: 1px solid #00B4CC;
		  cursor: pointer;
		  border-radius: 4px;
		}

		form.search button:hover {
		  background: #0b7dda;
		}

		form.search::after {
		  content: "";
		  clear: both;
		  display: table;
		}
		
		.card1{
			display:inline-block; 
			height: 250px; 
			width:200px; 
			margin-bottom: 22px; 
			border-radius: 8px; 
			background-color: white; 
			margin-left: 1em; 
			box-shadow: 0 4px 8px 0 grey;"
		}
		
		.card1:hover {
  		 box-shadow: 0 8px 16px 0 #00bfff;
		}
		
		.card2{
			box-shadow: 0 4px 8px 0 grey;
			z-index:9;
			top: 75%;
		}
		
	</style>
	
</head>
<body>
	<div class="header">
		<img src="login_banner.jpg" style="height:33vh; width:100%">
	</div>

	<div class="topnav">
	  	<a href="index_login.php">Home</a>
	  	<a href="#contact">Contact</a>
	  	<a href="index_login.php#about">About Us</a>
		<a href="index.php" style="float:right">Log Off</a>
		<a href="user_profile.php" style="float:right"><?php echo $_SESSION['username'];?></a>
	</div>

	<div class="row">
		<div class="card">
			<h2>Recipe Gallery</h2>
				<h5>
					<?php 
						date_default_timezone_set("America/New_York");
						$today = date("F d, Y");
						echo "<b style='font-size:16px'>".$today."</b>";
					?>
				</h5>
			
			<form class="search" action=" " align="center" style="margin:auto;">
				<input type="text" name="search" placeholder="Search..">
				<button type="submit" name="submit">
					<i class="fa fa-search"></i>
				</button>
			</form>
			
			<br>

			<p>
				<?php   
					$sql = "SELECT * FROM recipes WHERE view LIKE '%public%'";

					if($result = mysqli_query($con, $sql))
					{
						if(mysqli_num_rows($result) > 0)
						{
							while($row = mysqli_fetch_array($result))
							{
								$_SESSION['recipeID'] = $row['recipeID'];
								echo '<div class="card1">
									<a href="recipe_login.php?id='.$_SESSION['recipeID'].'" style="text-decoration: none">
									<img src="data:image/jpeg;base64,'.base64_encode( $row['image']).'"style="height:150px; width: 140px; transform: translate(15%, 15%); border-radius: 4px; border: 2px double #00bfff" align="center" hspace="10"/>
									<br>
									<br>
									<br>
									<br>
									<span style="color: black; text-decoration: none; margin-left:30px"><b>'.$row['recipeTitle'].'</b></span>
									</a>';
							}
						} 
					} 
				?>
			</p>
		</div>
	</div>
	
	<br>
	<a href="index_login.php" style="text-decoration: none; position:relative; color:#00bfff">To Homepage</a>
	<a href="upload_recipe.php" style="float:right; text-decoration: none; color:#00bfff">Add Recipe</a>
	<br>
	
	<div class="footer">
		<div style="text-align:center">
			<h3 id="contact" style="font-size: 24px; margin:8px">Contact Me</h3>
			<p style="font-size: 14px; margin:4px;">University of Pittsburgh</p>
			<p style="font-size: 14px; margin:4px;"> Joc101@pitt.edu</p>
			<span class="footer_text" style="font-size: 10px;">Copyright © 2019 All Rights Reserved. </span>
		</div>
	</div>
</body>
</html>