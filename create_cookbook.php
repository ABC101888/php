<?php
	session_start();

	include 'create_cookbook_action.php';

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
	<link rel="stylesheet" type="text/css" href="upload.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
</head>
<body>
	<div class="header">
		<img src="food-background(top).jpg" style="height:25vh; width:100%">
	</div>
	
	<?php include 'header_login.php'; ?>

	<br>
	
	<form action="" method="post" enctype="multipart/form-data">
	<div class="row">
		<div class="column middle">
			<h2>&nbsp;Create Recipe Book</h2>
			<p style="border-style: dashed; width: 40%" align="center">
				<label for="image">
					<input type="file" name="image" id="image" style="display:none">
					<i class="fas fa-camera-retro" style="font-size:99px; width: 100%"></i>
					Add a Photo
					<br>
					<?php if(isset($image_err['file'])){echo "<font color='red'>".$image_err['file']."</font>";}?>  
					<?php if(isset($image_err['size'])){echo "<font color='red'>".$image_err['size']."</font>";}?> 
				</label>
			</p>
			<div>
				<table style= "width: 50%" align="left" accesskey=""border="0" cellpadding="5" cellspacing="0">
					<tr> 
						<td>
							<label for="name"><b>Cookbook Name<b/></label>
							<br>
							<input type="text" name="name" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>"/>
							<br/> 				
							<?php if(isset($output['name'])){echo "<font color='red'>".$output['name']."</font>";}?>
							<br>
						</td> 
					</tr>
					<tr>
						<td>
							<label for="desc"><b>Cookbook Description</b></label><br/>
							<textarea rows="4" name="desc"><?php echo $_POST['desc']; ?></textarea>
							<br/> 
							<?php if(isset($output['desc'])){echo "<font color='red'>".$output['desc']."</font>";}?>
							<br>
							<br>
						</td> 
					</tr>
					
					<script type="text/javascript" src="autoexpand.js"></script>

					<tr>
						<td>
							<label class="container">Private
								<input type="radio" checked="checked" name="view" value="private">
								<span class="checkmark"></span>
							</label>
							<label class="container">Public
								<input type="radio" name="view" value="public">
								<span class="checkmark"></span>
							</label>   
						</td> 
					</tr>
					
					<tr> 
						<td colspan="2" style="text-align: left;">
							<br>
							<input name="submit" type="submit" value="Submit" style="font-size: 16px"/><br><br>
							<p><span style="font-size: 44px; vertical-align:sub; color:#00bfff;"><b>&#8249;</b></span><a style='font-size: 16px; text-decoration: none; color:#00bfff;' href='user_profile.php'><b style="font-size:18">&ensp;Back to User Profile</b></a></p>
						</td> 
					</tr>
				</table>
			</div>				
		</div>
	</div> 
	</form>

	<?php include 'footer.php'; ?>

</body>
</html>


<button onclick="open()">ADD</button>
						<div class="form-popup" id="myFunction">
							<form action="" method="POST" class="form-container">
								<label><b>Select Cookbook</b></label>
								<br>
								<br>
								<select name="cookbook" style="width: 260px">
								<option <?php if($_POST['cookbook']=="N/A") echo 'selected="selected"'; ?> value="N/A"> </option>
								<?php 
										$userID = $_SESSION['userID'];
										$sql2 = "SELECT * FROM cookbook WHERE pvt_p='%public%' AND cb_userID='$userID'";

										if($result2 = mysqli_query($con, $sql2))
										{
											if(mysqli_num_rows($result2) > 0)
											{
												while($row2 = mysqli_fetch_array($result2))
												{
								?>

								<option value="<?php echo $row2['bookID']; ?>" <?php if($_POST['cookbook'] == $row2['bookID']) echo 'selected="selected"';?>><?php echo $row2['bookName']; ?> </option>

								<?php
												}
											}
										}
								?>
								</select>
								<button class="btn"><a href="delete.php?id='.$row['recipeID'].'" style="text-decoration: none; color: white;">Confirm</a></button>
								<button type="button" class="btn cancel" onclick="close()">Cancel</button>
							</form>
						</div>

						<script>
						function open() {
						  document.getElementById("myFunction").style.display = "block";
						}

						function close() {
						  document.getElementById("myFunction").style.display = "none";
						}
						</script>
