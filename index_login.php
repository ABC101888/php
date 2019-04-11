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

	<?php include 'header_login.php'; ?>

	<div class="row" id="home">
		<div class="leftcolumn">
			<div class="card">
			<h2>Recipe Gallery</h2>
				<div>
					<p>
					<?php    
						$sql = "SELECT * FROM recipes WHERE view LIKE '%public%' ORDER BY RAND() LIMIT 12";						
						if($result = mysqli_query($con, $sql))
						{
							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_array($result))
								{
									$rID = $row['recipeID'];
									echo '<div style ="display:inline-block; height: 250px; width:180px; margin-bottom: 22px; border-radius: 8px; background-color: #DCDCDC; margin-left: 1em"/><a href="recipe_login.php?id='.$rID.'"><img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"style ="height: 160px; width:150px; border-radius: 8px; transform: translate(10%, 8%)"/></a>
									<br>
									<br>
									<br>
									<span style="margin-left: 15px;"><b>'.$row['recipeTitle'].'</b><span>
									</div>';
								}
							} 
						} 
					?>
					</p>
				</div>
				<a href="recipe_gallery_login.php" style="text-decoration: none; color:#00bfff">To Recipe Gallery</a>
				<a href="upload_recipe.php" style="float:right; text-decoration: none; color:#00bfff">Add Recipe</a>
			</div>
			
			<div class="card">
			<h2>User Recipe Books</h2>
				<div>
					<p>
					<?php    
						$sql = "SELECT * FROM cookbook WHERE pvt_p LIKE '%public%' ORDER BY RAND() LIMIT 12";						
						if($result = mysqli_query($con, $sql))
						{
							if(mysqli_num_rows($result) > 0)
							{
								while($row = mysqli_fetch_array($result))
								{
									$BID = $row['bookID'];
									echo '<div style ="display:inline-block; height: 250px; width:180px; border-radius: 8px; background-color: #DCDCDC; margin-left: 1em"/><a href="cookbook.php?id='.$BID.'"><img src="data:image/jpeg;base64,'.base64_encode($row['bookCover']).'"style ="height: 160px; width:150px; border-radius: 8px; transform: translate(10%, 8%)"/>
									</a>
									<br>
									<br>
									<br>
									<span style="margin-left: 15px;"><b>'.$row['bookName'].'</b><span>
									</div>';
								}
							} 
						} 
					?>
					</p>
				</div>
				<div>
					<a href="cookbook_gallery_login.php" style="text-decoration: none; color:#00bfff">To Cookbook Gallery</a>
				</div>
			</div>
		</div>
	  	
		<div class="rightcolumn">
		<div class="card">
			<h3>Recent Post</h3>
			<br>
			<?php
			$sql = "SELECT * FROM recipes WHERE view LIKE '%public%' ORDER BY recipeDate LIMIT 10";						
			if($result = mysqli_query($con, $sql))
			{
				if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_array($result))
					{
						$rID = $row['recipeID'];
						echo '<div><a style="text-decoration: none; color:#00bfff" href="recipe_login.php?id='.$rID.'"><b><span>'.$row['recipeTitle'].'&emsp;'.$row['recipeDate'].'</span></b></a></div><br>';
					}
				} 
			} 
			?>
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
			<a href="#" class="youtube"><i class='fab fa-youtube' style='font-size:48px;color:red'></i></a>
			<a href="#" class="reddit"><i class='fab fa-reddit' style='font-size:48px;color:#ff4500'></i></a>
		</div>
	  </div>
	</div>

	<?php include 'footer.php'; ?>

</body>
</html>