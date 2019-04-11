<?php
    include 'connect.php';
	session_start();
	include 'comment_action.php';
	include 'add_to_cookbook.php';

	if($_SESSION['logged_in'] !== "login")
	{
		header("Location: login.php");  
	}
?>

<html>
<head>
	<title>Recipe Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<link rel="stylesheet" type="text/css" href="recipe.css">
	<style>
		.button {
		  background-color: #00bfff; 
		  border: none;
		  border-radius: 5px;
		  color: white;
		  text-align: center;
		  text-decoration: none;
		  font-size: 16px;
		  cursor: pointer;
		  padding: 2% 10% 2% 10%;
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
		
		/* Position of Button */
		.del-button {
			background-color: #555;
			border: none;
			color: white;
			padding: 8px 16px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			width: 100px;
			cursor: pointer;"
		}

		/* The popup form - hidden by default */
		.form-popup {
		  display: none;
		  position: inherit;
		  bottom: 0;
		  right: 15px;
		  border: 3px solid #f1f1f1;
		  z-index: 9;
		}

		/* Add styles to the form container */
		.form-container {
		  max-width: 200px;
		  padding: 10px;
		  background-color: white;
		}

		/* Set a style for the confirm button */
		.form-container .btn {
		  background-color: #00bfff;
		  color: white;
		  padding: 16px 20px;
		  border: none;
		  cursor: pointer;
		  width: 100%;
		  margin-bottom:10px;
		  opacity: 0.8;
		}

		/* Add a red background color to the cancel button */
		.form-container .cancel {
		  background-color: red;
		}

		/* Add some hover effects to buttons */
		.form-container .btn:hover, .open-button:hover {
		  opacity: 1;
		}
	</style>
</head>
	
<body>
	<div class="header">
		<img src="login_banner.jpg" style="height:33vh; width:100%">
	</div>

	<?php include 'header_login.php'; ?>

	<div class="row">
		<div class="column side">
			<h2>Photos</h2>
			<div class="border">
				<p>
				<?php   
					$rid = $_GET['id'];

					$sql = "SELECT * FROM recipes where recipeID =".$rid;

					$result = mysqli_query($con, $sql);
					$row = mysqli_fetch_array($result);
					$count=mysqli_num_rows($result);

					if($count==1)
					{
						echo '<img src="data:image/jpeg;base64,'.base64_encode($row['image']).'"style =" max-width: 100%; max-height: 100%; padding: 11px"/>';
					}
				?>
				</p>
			</div>

			<form method = "POST" action=" ">
				<p style=" position: absolute;"><a href="#myDialog" type="button" onclick="showDialog()" class="button button1" style=" margin-left:30px">ADD</a></p>
					<dialog id="myDialog" align="center" style="border-radius: 8px; border: none" class="card2">
						<button style="background-color: Transparent; border: none; outline:none; font-size: 16px; float: right" onclick="closeDialog()"> &#x274E;</button>
						<br>
						<br>
						<label for="cookbook" style="font-size: 22px">Select Recipe Book </label>
						<br>
						<br>
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
						
						<br>
						<br>
						<button>sumbit</button>
					</dialog>  
				</form>
				<script src="add_to_cookbook.js" type="text/javascript"></script> 
	  	</div>
  
		<div class="column middle">
			<h2>Recipe</h2>
			
			<?php   
				$rid = $_GET['id'];
				
				$_SESSION['id'] = $rid;
				
				$sql = "SELECT * FROM recipes JOIN users ON recipes.r_userID = users.userID WHERE recipeID =".$rid."";
				
				$result = mysqli_query($con, $sql);
				$row = mysqli_fetch_array($result);
				$count = mysqli_num_rows($result);
				
				if($count==1)
				{
					echo "<i style='font-size: 24px'>".$row['recipeTitle']."</i>";
					echo "<br>";
					echo "<br>";
					echo "<b>Created by: </b><i style='font-size: 16px'>".$row['username']."</i>"."<br><b>Date: </b>".$row['recipeDate'];
					echo "<br>";
					echo "<br>";
					echo "<b>Prep Time: </b>".$row['prepTime']."<br>"."<b>Cook Time: </b>".$row['cookTime']."<br>"."<b>Servings: </b>".$row['servings'];
					echo "<br>";
					echo "<br>";
					echo "<b>Description:</b>";
					echo "<br>";
					echo $row['recipeDesc'];
					echo "<br>";
					echo "<b>Ingredients:</b>";
					echo "<br>";
					echo $row['ingredients'];
					echo "<br>";
					echo "<b>Directions:</b>";
					echo "<br>";
					echo $row['directions'];
										
					if($row['r_userID'] === $_SESSION['userID'])
					{
						echo '<a style ="
						background-color: #00bfff;
						border: none;
						color: white;
						padding: 8px 16px;
						text-align: center;
						text-decoration: none;
						display: inline-block;
						font-size: 16px;
						width: 100px;
						cursor: pointer;" href="edit.php?id='.$row['recipeID'].'">Edit</a>';
						echo '&emsp;<span style="font-size:28px">|</span>&emsp;';
						echo '
						<button class="del-button" onclick="openForm()">Delete</button>
						<div class="form-popup" id="myForm">
							<form action="delete.php" method="POST" class="form-container">
								<span><b>Deletion Confirmation</b></span><br><br>
								<label>Are you sure?</label><br>
								<br>
								<br>
								<button class="btn"><a href="delete.php?id='.$row['recipeID'].'" style="text-decoration: none; color: white;">Confirm</a></button>
								<button type="button" class="btn cancel" onclick="closeForm()">Cancel</button>
							</form>
						</div>

						<script>
						function openForm() {
						  document.getElementById("myForm").style.display = "block";
						}

						function closeForm() {
						  document.getElementById("myForm").style.display = "none";
						}
						</script>';
					}
				}
			?>
						
			<hr style='border: 2px double #00bfff'>
			<h3>Reviews</h3>
				<?php
					$rid = $_GET['id'];
			
					$sql1 = "SELECT * FROM recipes where recipeID =".$rid;
					$result1 = mysqli_query($con, $sql1);
					$row1 = mysqli_fetch_array($result1);
					
					if($row1['r_userID'] !== $_SESSION['userID'])
					{
				?>
				<form method="POST" action=" ">
						<label for='message'><b>Comment&nbsp;&nbsp;</label></b>
						<?php
							date_default_timezone_set("America/New_York");
							$today = date("F d, Y h:i A");
							$_SESSION['date'] = $today;
							echo "<b>".$today."</b>";
						?>
			
						<br>
			
						<textarea name='reply' rows='8' cols='40' style='width: 60%'><?php echo $_POST['reply']; ?></textarea>
						<br>
						<?php
						if(isset($output['reply']))
						{
							echo "<font color='red'>".$output['reply']."</font>";
						}
						?>
						<br>
						<input type='Submit' name='Submit' value='Comment' style ='font-size: 16px'>
						<br>
						<br>
				</form>
				<?php
					}
				?>
				
				<?php
					$rid = $_GET['id'];
				
					$sql2 = "SELECT users.username, reviewComment, reviewDate FROM review 
					JOIN recipes ON review.review_recipeID = recipes.recipeID 
					JOIN users ON review.review_userID = users.userID
					WHERE review.review_recipeID = ".$rid." ORDER BY reviewDate";
									
					$result2 = mysqli_query($con, $sql2);
					$row2 = mysqli_fetch_array($result2);
					$count2 =mysqli_num_rows($result2);
				
					if($count2 > 0)
					{
						if($result2 = mysqli_query($con, $sql2))
						{ 
							if(mysqli_num_rows($result2) > 0)
							{
								while($row2 = mysqli_fetch_array($result2))
								{
									echo '<div style="border-style: double; border-color:#00bfff; border-width: 2px; background-color: white; width:75%"><p>'.$row2['reviewComment'].'
									</p><br>
									<span style="font-size:14px"> Created by: '.$row2['username'].'&emsp;'.$row2['reviewDate'].'</span>
									</div><br>';
								}
							}
						}
					}
				?>
				<span><a href='recipe_gallery_login.php'><b style='font-size: 16px; text-decoration: none'>Back to Recipe Gallery</b></a></span>
		</div>
	</div>
	
	<?php include 'footer.php'; ?>

</body>
</html>