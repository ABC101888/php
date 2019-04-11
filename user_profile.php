<?php
	include 'connect.php';
	include 'search.php';

	session_start();

	if($_SESSION['logged_in'] !== "login")
	{
		header("Location: login.php");  
	}
?>

<html>
<head>
	<title>Profile Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<link rel="stylesheet" type="text/css" href="profile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
	<style>
		.card1{
			display:inline-block; 
			height: 250px; 
			width:200px; 
			margin-bottom: 22px; 
			border-radius: 8px; 
			background-color: white; 
			margin-left: 1em; 
			box-shadow: 0 4px 8px 0 grey;
			float:left;
		}

		.card1:hover {
			box-shadow: 0 8px 16px 0 #00bfff;
		}		

		.button {
		  background-color: #00bfff; /* Green */
		  border: none;
		  border-radius: 5px;
		  color: white;
		  text-align: center;
		  text-decoration: none;
		  font-size: 16px;
		  cursor: pointer;
		}

		.button1 {
		  background-color: #008CBA; 
		  color: white; 
		  border: 2px solid #008CBA;
		}

		.button1:hover {
		  background-color: white;
		  color: #00bfff;
		}
	</style>
	
</head>
<body>
	<div class="header">
		<img src="food-background(top).jpg" style="height:25vh; width:100%">
	</div>
	
	<?php include 'header_login.php'; ?>
	
	<br>
	<form class="search" action=" " align="center" style="margin:auto;">
  		<input type="text" name="search" placeholder="Search..">
		<button type="submit" name="submit">
        	<i class="fa fa-search"></i>
     	</button>
		<?php if(isset($output['search'])){echo "<font color='red'>".$output['search']."</font>";}?>  
	</form>
	
	<div class="row">
		<div class="column side">
			<h2>&nbsp;&nbsp;Recipe Books</h2>
			<?php    
				$userID = $_SESSION['userID'];

				$sql = "SELECT * FROM cookbook WHERE cb_userID ='$userID'";
				if($result = mysqli_query($con, $sql))
				{
					if(mysqli_num_rows($result) > 0)
					{
						while($row = mysqli_fetch_array($result))
						{
							$BID = $row['bookID'];
								
							echo '<br><a href="cookbook.php?id='.$BID.'" style="text-decoration: none">
							<span style="color: black; text-decoration: none"><b>&nbsp;&nbsp;&nbsp;'.$row['bookName'].'</b></span>
							</a><br>';
						}
					} 
				} 
			?>
			<div>
				<br>
				<a href="create_cookbook.php" style="text-decoration: none; color: #2196F3">&nbsp;&nbsp;&nbsp;<span style="font-size: 22px">&#8853;</span>Create Recipe Book</a>
			</div>
	  	</div>
  
								<select name="cookbook" style="width: 260px">
							<option <?php if($_POST['cookbook']=="N/A") echo 'selected="selected"'; ?> value="N/A"> </option>
							<?php 
									$userID = $_SESSION['userID'];
									$sql = "SELECT * FROM cookbook WHERE cb_userID='$userID'";

									if($result = mysqli_query($con, $sql))
									{
										if(mysqli_num_rows($result) > 0)
										{
											while($row2 = mysqli_fetch_array($result))
											{
							?>
							
							<option value="<?php echo $row['bookID']; ?>" <?php if($_POST['cookbook'] == $row['bookID']) echo 'selected="selected"';?>><?php echo $row['bookName']; ?> </option>
							
							<?php
											}
										}
									}
							?>
						</select>
		
		
		<div class="column middle">
			<h2>&nbsp;&nbsp;My Recipes</h2>
			<div class="add">
				&nbsp;&nbsp;<label for="image">
						<a href="upload_recipe.php" style="text-decoration: none; color: #2196F3">
						<i class='fas fa-utensils' style="font-size:99px; padding: 22px; border-style: dashed">
						<br>
						<b style="font-size: 18px; text-align:center">Add a Recipe</b>
						</i>
						</a>
				</label>
				<br>
				<br>
				<?php    
					$sql = "SELECT * FROM recipes WHERE r_userID =".$_SESSION['userID'];
					if($result = mysqli_query($con, $sql))
					{
						if(mysqli_num_rows($result) > 0)
						{
							while($row = mysqli_fetch_array($result))
							{
								$rID = $row['recipeID'];
								
								echo '
								<div class="card1">
									<a href="recipe_profile.php?id='.$rID.'" style="text-decoration: none">
									<img src="data:image/jpeg;base64,'.base64_encode( $row['image']).'"style="height:150px; width: 140px; transform: translate(15%, 15%); border-radius: 4px; border: 2px double #00bfff" align="center" hspace="10"/>
									<br>
									<br>
									<br>
									<span style="color: black; text-decoration: none; margin-left:30px"><b>'.$row['recipeTitle'].'</b></span>
									<br>
									</a>
									<form method = "POST" action=" ">
									<p><button type="submit" name="add" class="button button1" style=" margin-left:30px">ADD</button></p>
									</form>
								</div>';
							}
						} 
					} 
				?>
			</div> 
		</div>
	</div> 

	<?php include 'footer.php'; ?>
		
</body>
</html>