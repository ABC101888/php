<?php
session_start();
?>

<html>
    <head>
    <title>Page 2</title>
    </head>
    <body>
        <h1>Confirmation</h1>
        <form method="POST" action="page3.php">
 		<main class="container1" >
			<div class="left-column">
				<?PHP
					echo "Name:"."".$_SESSION['Name'];
					echo "<br>";
					echo "Phone Number:"."".$_SESSION['phone'];
					echo "<br>";
					echo "Email:"."".$_SESSION['email'];
					echo "<br>";
					echo "Address:"."".$_SESSION['Address'];
					echo "<br>";
					echo "Shipping:"."".$_SESSION['Delivery']; 
					echo "<br>";
					echo "Credit Card:"." ".$_SESSION['card']." "." "."Exp:"." ".$_SESSION['exp']." "." ".$_SESSION['cvv'];
					echo "<br>";
					echo "T-Shirt:"." ".$_SESSION['graphic']."".$_SESSION['size']." ".$_SESSION['Quantity'];
				 ?>
			</div>
			
			<div class="right-column">
				<div class="col-75">
					<div class="ordersum">
						<h4>Cart</h4>
						<p><?php if(isset($output['graphic'])){echo $_SESSION['graphic']." "."T-Shirt"." "." ".$_SESSION['Size']." "." ".$_SESSION['Quantity'];}?></p>
						<hr>
						<p>Total<span style="color:black">
							<b>
							  <?php if(isset($_SESSION['Quantity']))
											{
												$first_number = 19.99;
												$second_number = $_SESSION['Quantity'];
												$sum_total = $second_number * $first_number;
												echo $sum_total;
											}
								?>     
							</b></span>
						</p>
					</div>
				</div>
			</div>
    	</main>
        <input type="submit" value="Accept">
      </form>
</body>
</html>

<?php
session_destroy();
?>




	mysqli_close($connect);
?>