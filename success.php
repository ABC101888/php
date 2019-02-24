<?php
    session_start();
?>
<html>
    <head> 
		<meta name="viewport" content="width=device-width, initial-scale=1">
  		<meta charset="utf-8">
		<meta charset=""/>
		<title>My First Webpage</title>
		<link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
	<ul>
	  <li class="top"><a class="top" href="http://studentprojects.sis.pitt.edu/spring2019/joc101/homework.html">Home</a></li>
	  <li class="top"><a class="top" href="#contact">Contact</a></li>
	</ul>
		
    <h1>Order Summary &emsp; <?php echo $_SESSION['orderID']; ?></h1>
		
    <main class="container1" >
        <!-- Left Column / Tee Image -->
        <div class="left-column">
            <div class="row">
                <div class="col-75">
                    <div>
                        <div class="row">
                            <div class="col-50">
                                <h3>Shipping Address</h3>
                                    <label for="Name"> Full Name</label>
                                    <p class="field"><?php if(isset($_SESSION['Name'])){echo $_SESSION['Name'];}?></p>
                                
                                    <label for="email"> Email</label>
                                    <p class="field"><?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?></p>  
                                
                                    <label for="phone"> Phone Number</label>
                                     <p class="field"><?php if(isset($_SESSION['phone'])){echo $_SESSION['phone'];}?></p> 
                                
                                    <label for="adr"> Address</label>
                                     <p class="field"><?php if(isset($_SESSION['Address'])){echo $_SESSION['Address'];}?></p>

                                <div class="row">
                                    <div class="col-50">
                                        <label for="state">Delivery Method</label>
 										<p class="field"><?php echo $_SESSION['Delivery']; ?></p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-50">
                                <h3>Payment</h3>
                                    <label for="cards">Accepted Cards</label>
                                    <div>
                                      <p>
                                          <b style="color:navy;">Visa</b>
                                          &nbsp;
                                         <b style="color:blue;">Amex</b>
                                          &nbsp;
                                         <b style="color:red;">MasterCard</b>
                                          &nbsp;
                                         <b style="color:orange;">Discover</b>
                                      </p>
                                    </div>
                                
                                	<label for="ccnum">Credit Card Number</label>
                                    <p class="field"><?php if(isset($_SESSION['card'])){echo $_SESSION['card'];}?></p>
                                
                                    <div class="row">
                                        <div class="col-50">
                                            <label for="expyear">Exp Date</label>
                                            <p class="field"><?php if(isset($_SESSION['exp'])){echo $_SESSION['exp'];}?></p>
                                        </div>
                                        
                                        <div class="col-50">
                                            <label for="cvv">CVV</label>
                                            <p class="field"><?php if(isset($_SESSION['cvv'])){echo $_SESSION['cvv'];}?></p>
                                        </div>
                                    </div>
                            	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="right-column">
            <div class="col-75">
                <div class="ordersum">
                    <h4>Cart</h4>
                    <p><?php if(isset($_SESSION['graphic'])){echo $_SESSION['graphic']." "."T-Shirt"." "." ".$_SESSION['Size']." "." ".$_SESSION['Quantity'];}?></p>
                    <hr>
                    <p>Total<span style="color:black"><b>
                      <?php
                                        $first_number = 19.99;
                                        $second_number = $_SESSION['Quantity'];
                                        $sum_total = $second_number * $first_number;
                                        echo $sum_total;
                        ?>     
                      </b></span>
                    </p>
                </div>
            </div>
        </div> 
    </main>
	<br>
	<br>
    <a href="test.php" >Continue Shopping</a>
	<div class="footer">
	   <div style="text-align:center">
			<h3 id="contact" style="font-size: 24px; margin:8px">Contact Me</h3>
		    <p style="font-size: 14px; margin:4px;">University of Pittsburgh</p>
	   		<p style="font-size: 14px; margin:4px;"> Joc101@pitt.edu</p>
	    	<span class="footer_text" style="font-size: 10px;">Copyright © 2018 All Rights Reserved. </span>
	    </div>
	</div>
</body>
</html>

<?php
    session_destroy();
?>