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
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
</head>
<body>
	<div class="header">
		<img src="login_banner.jpg" style="height:33vh; width:100%">
	</div>

	<div class="topnav">
	  	<a href="index.php">Home</a>
	  	<a href="#contact">Contact</a>
	  	<a href="#about">About Us</a>
		<a href="index.php" style="float:right">Log Off</a>
		<a href="user_profile.php" style="float:right"><?php echo $_SESSION['username'];?></a>
	</div>

	<div class="row" id="home">
		<div class="leftcolumn">
			<div class="card">
			<h2>Recipe Gallery</h2>
				<h5> </h5>
			  <div class="fakeimg" style="height:200px;">Image</div>
			  <p> </p>
				<p>
				<?php   
					$sql = "SELECT * FROM recipes";
					if($result = mysqli_query($con, $sql))
					{
						if(mysqli_num_rows($result) > 0)
						{
							while($row = mysqli_fetch_array($result))
							{
								$rID = $row['recipeID'];
								echo '<a href="recipe.php?id='.$rID.'"><img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"style ="height: 200px; width:200px; margin-bottom: 22px; padding: 11px; border: 1px solid" hspace="10"/></a>';
							}
						} 
					} 
				?>
				</p>
				<a href="upload_recipe.php">Add Recipe</a>
			</div>
			<div class="card">
			<h2>User Recipe Books</h2>
			<h5> </h5>
			<div class="fakeimg" style="height:200px;">Image</div>
			<p> </p>
			<p> </p>
			</div>
		</div>
	  <div class="rightcolumn">
		<div class="card">
		  <h3>Recent Post</h3>
		  <div class="fakeimg"><p>Image</p></div>
		  <div class="fakeimg"><p>Image</p></div>
		  <div class="fakeimg"><p>Image</p></div>
		</div>
		<div class="card">
		  <h2 id="about">About Us</h2>
		  <div>iEAT!™</div>
		  <p>A recipe sharing web application. The app offers the ability for registered users to submit recipes, to create customizable & personal recipe books from various submitted recipes, and a comment/review section for each recipe. </p>
		</div>
		<div class="card">
		  <h3>Follow Us</h3>
			<a href="#" class="facebook"><i class='fab fa-facebook' style='font-size:48px;color:#3b5998'></i></a>
			<a href="#" class="instagram"><i class='fab fa-instagram' style='font-size:48px;color:#c32aa3'></i></a>
			<a href="#" class="pinterest"><i class='fab fa-pinterest' style='font-size:48px;color:#c8232c'></i></a>
			<a href="#" class="twitter"><i class='fab fa-twitter' style='font-size:48px;color:#1da1f2'></i></a>
			<a href="#" class="google"><i class='fab fa-google-plus' style='font-size:48px;color:#DD4B39'></i></a>
			<a href="#" class="youtube"><i class='fab fa-youtube' style='font-size:48px;color:red'></i></a>
			<a href="#" class="snapchat"><i class='fab fa-snapchat' style='font-size:48px;color:#eaea00'></i></a>
			<a href="#" class="reddit"><i class='fab fa-reddit' style='font-size:48px;color:#ff4500'></i></a>
		</div>
	  </div>
	</div>

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