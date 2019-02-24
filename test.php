<?php
    session_start();
?>

<!DOCTYPE html>
<html>

<head>
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta charset="utf-8">
	<meta charset=""/>
	<title>My First Webpage</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    
    <style>
        * {
            box-sizing: border-box
        }
        
        body 
        {
            font-family: Verdana, sans-serif; margin:0
        }
        
        .mySlides 
        {
            display: none
        }
        
        img 
        {
            vertical-align: middle;
        }

        /* Slideshow container */
        .slideshow-container 
        {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        /* Next & previous buttons */
        .prev, .next 
        {
            cursor: pointer;
            position: absolute;
            top: 50%;
            width: auto;
            padding: 16px;
            margin-top: -22px;
            color: white;
            font-weight: bold;
            font-size: 18px;
            transition: 0.6s ease;
            border-radius: 0 3px 3px 0;
            user-select: none;
        }

        /* Position the "next button" to the right */
        .next 
        {
            right: 0;
            border-radius: 3px 0 0 3px;
        }

        /* On hover, add a black background color with a little bit see-through */
        .prev:hover, .next:hover 
        {
            background-color: rgba(0,0,0,0.8);
        }

        /* Caption text */
        .text 
        {
            color: #f2f2f2;
            font-size: 15px;
            padding: 8px 12px;
            position: absolute;
            bottom: 8px;
            width: 100%;
            text-align: center;
        }

        /* The dots/bullets/indicators */
        .dot 
        {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active, .dot:hover 
        {
            background-color: #717171;
        }

        /* Fading animation */
        .fade 
        {
            -webkit-animation-name: fade;
            -webkit-animation-duration: 1.5s;
            animation-name: fade;
            animation-duration: 1.5s;
        }

        @-webkit-keyframes fade 
        {
            from {opacity: .4} 
            to {opacity: 1}
        }

        @keyframes fade 
        {
            from {opacity: .4} 
            to {opacity: 1}
        }

        /* On smaller screens, decrease text size */
        @media only screen and (max-width: 300px) 
        {
            .prev, .next,.text {font-size: 11px}
        }
        
        .overlay 
        {
            height: 100%;
            width: 100%;
            display: none;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0, 0.9);
        }
        
        /* Overlay CSS Style */
        .overlay-content 
        {
            position: relative;
            top: 5%;
            width: 100%;
            text-align: center;
            margin-top: 30px;
        }
        
        .overlay a 
        {
            padding: 8px;
            text-decoration: none;
            font-size: 36px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .overlay a:hover, .overlay a:focus 
        {
            color: #f1f1f1;
        }
        
        .overlay .closebtn 
        {
            position: absolute;
            top: 20px;
            right: 45px;
            font-size: 60px;
        }
        
        @media screen and (max-height: 450px) 
        {
            .overlay a {font-size: 20px}
            .overlay .closebtn 
            {
                font-size: 40px;
                top: 15px;
                right: 35px;
            }
        }
    </style>
</head>

<body>
	<ul>
	  <li class="top"><a class="top" href="http://studentprojects.sis.pitt.edu/spring2019/joc101/homework.html">Home</a></li>
	  <li class="top"><a class="top" href="#contact">Contact</a></li>
	</ul>
    
    <h1 align="center" style="margin:44px; font-weight: lighter; font-size:56px"> Pokémon Graphic Clothing, LLC. </h1>
    
    <?php
        /*Create a variable for an array that holds validation outputs that will be displayed*/
        $output = array();

        /*Validation for sucessfully submission of job application & valid inputs*/
        if(isset($_POST['Checkout']))
        {
            validate_input();

            if(count($output) == 0)
            {
					$con = mysqli_connect("localhost","root","","hw6");
					if(mysqli_connect_errno())
					{
						die("Database connection failed: ".mysqli_connect_error()." (" .mysqli_connect_errno(). ")");
					}
					else
					{
						$orderID = session_id();
						$_SESSION['orderID'] = $orderID;
						$name = filter_var($_POST['Name'], FILTER_SANITIZE_STRING);
						$phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
						$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
						$address = filter_var($_POST['Address'], FILTER_SANITIZE_STRING);
						$shipping = filter_var($_POST['Delivery'], FILTER_DEFAULT);
						$ccnum = filter_var($_POST['card'], FILTER_SANITIZE_NUMBER_INT);
						$exp = filter_var($_POST['exp'], FILTER_DEFAULT);
						$cvv = filter_var($_POST['cvv'],FILTER_SANITIZE_NUMBER_INT);
						$graphic = filter_var($_POST['graphic'], FILTER_DEFAULT);
						$size = filter_var($_POST['Size'], FILTER_DEFAULT);
						$qty = filter_var($_POST['Quantity'], FILTER_DEFAULT);
						
						$name1 = mysqli_real_escape_string($con, $name);
						$phone1 = mysqli_real_escape_string($con, $phone);
						$email1 = mysqli_real_escape_string($con, $email);
						$address1 = mysqli_real_escape_string($con, $address);
						$shipping1 = mysqli_real_escape_string($con, $shipping);
						$ccnum1 = mysqli_real_escape_string($con, $ccnum);
						$exp1 = mysqli_real_escape_string($con, $exp);
						$cvv1 = mysqli_real_escape_string($con, $cvv);
						$graphic1 = mysqli_real_escape_string($con, $graphic);
						$size1 = mysqli_real_escape_string($con, $size);
						$qty1 = mysqli_real_escape_string($con, $qty);
						
						$sql = "INSERT INTO orderList (orderID, fullName, phoneNum, email, address, shipping, creditCardNum, cardExp, cvv, shirtGraphic, shirtSize, quantity) VALUES ('$orderID', '$name1', '$phone1', '$email1', '$address1', '$shipping1', '$ccnum1', '$exp1', '$cvv1', '$graphic1', '$size1', '$qty1')";
						
						if(mysqli_query($con, $sql))
						{
							echo "Order Confirmed!";
							header("refresh:2;url=success.php");
						} 
						else
						{
							echo "Order not confirmed $sql. " . mysqli_error($con);
						}
					}
					mysqli_close($con);
            }
            else
            {
                display_form();
            }
        }
        else
        {
            display_form();
        }

        /*Validation for application form fields */
        function validate_input(){
            global $output;

            /*Validation for Quantity field */
            if($_POST['Quantity'] == "N/A") 
            { 
                $output['Quantity'] = "Please selected a size!";
            }

            /*Validation for graphic question field */
            if ($_POST['graphic'] == "N/A")
            { 
                $output['graphic'] = "Please select a graphic!";
            }

            /*Validation for size question field */
            if (is_null($_POST['Size']))
            { 
                $output['Size'] = "Please select a graphic!";
            }
			         
            /*Validation for  name field */
			$name = $_POST['Name'];
            if (isset($_POST['Name']) && !preg_match('/^(([a-zA-Z\s\']+)([\sa-zA-Z\']+))$/', $name)) {
                $output['Name'] = 'The name you entered is invalid.';
            }

            /*Validation for phone number field */
            $phone = $_POST['phone'];
            if ((is_null($_POST['phone'])) || (!preg_match('/^(([0-9]{3})[\-]([0-9]{3})[\-]([0-9]{4}))$/', $phone))) 
            {
                $output['phone'] = 'Please enter a valid phone number!';
            }

            /*Validation for e-mail field */
            $email = $_POST['email'];
            if (isset($_POST['email']) && !preg_match('/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix', $email)) 
            {
                $output['email'] = 'The email you entered is invalid.';
            }

            /*Validation for address field */
            /*street, city, state zip country*/
            $address = $_POST['Address'];
            if (is_null($_POST['Address']) || !preg_match('/^(([a-zA-Z0-9\s|\.]+)[,]([a-zA-Z\s]+)[,](\s[A-Z]{2})(\s\d{5})(\s[A-Z]{2}))$/', $address)) 
            {
                $output['Address'] = 'The address you entered is invalid.';
            }
			
			/*Validation for delivery option */
            if($_POST['Delivery'] == "N/A")
            { 
                $output['Delivery'] = "Please select Shipping!";
            }
			
			/*Validation for ccnum field */
			$ccnum = $_POST['card'];
            if (is_null($_POST['card']) || !preg_match('/^(([0-9]{4})[\-]([0-9]{4})[\-]([0-9]{4})[\-]([0-9]{4}))$/', $ccnum))
			{
                $output['card'] = 'Invalid Credit Number!';
            }

            /*Validation for exp exp field */
            $exp = $_POST['exp'];
            if ((is_null($_POST['exp'])) || (!preg_match('/^((0[1-9]|10|11|12)[\/](20[0-9]{2}))$/', $exp))) 
            {
                $output['exp'] = 'Invalid Expiration!';
            }

			/*Validation for e-mail field */
            $cvv = $_POST['cvv'];
            if (isset($_POST['cvv']) && !preg_match('/^([0-9]{3})$/', $cvv)) 
            {
                $output['cvv'] = 'Invalid CVV!';
            }
        }
        
         /*Displaying validation message for fields */
        function display_form(){
            global $output;
    ?>
    
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <main class="container1" >
        <!-- Left Column / Tee Image -->
        <div class="left-column">
       
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="images/Bulbasaur.jpg"/>
                    <div class="text" style="color: black">Bulbasaur</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Charmander.jpg" alt="">
                    <div class="text">Charmanader</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Pikachu.jpeg" alt="">
                    <div class="text">Pikachu</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Jigglypuff.png" alt="">
                    <div class="text">Jigglypuff</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Snorlax.png" alt="">
                    <div class="text" style="color: white">SNORLAX</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Mew.jpg" alt="">
                    <div class="text" style="color: black">MEW</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Pokeball.jpg" alt="">
                    <div class="text" style="color: black">Pokéball</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Torchic.jpg" alt="">
                    <div class="text" style="color: black">Torchic</div>
                </div>  

                <div class="mySlides fade">
                    <img src="images/Mudkip.jpg" alt="">
                    <div class="text" style="color: black">Mudkip</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Treecko.jpg" alt="">
                    <div class="text" style="color: black">Treecko</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/Teamrocket.png" alt="">
                    <div class="text">Team Rocket</div>
                </div>

                <div class="mySlides fade">
                    <img src="images/pushemon.png" alt="">
                    <div class="text" style="color: black">Pushemon</div>
                </div>  

                <div class="mySlides fade">
                    <img src="images/Eeveelution.jpg" alt="">
                    <div class="text" style="color: #001630">Eeveelution</div>
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>

            <br>
            <div style="text-align:center">
              <span class="dot" onclick="currentSlide(1)"></span> 
              <span class="dot" onclick="currentSlide(2)"></span> 
              <span class="dot" onclick="currentSlide(3)"></span> 
              <span class="dot" onclick="currentSlide(4)"></span> 
              <span class="dot" onclick="currentSlide(5)"></span> 
              <span class="dot" onclick="currentSlide(6)"></span> 
              <span class="dot" onclick="currentSlide(7)"></span> 
              <span class="dot" onclick="currentSlide(8)"></span> 
              <span class="dot" onclick="currentSlide(9)"></span>
              <span class="dot" onclick="currentSlide(10)"></span> 
              <span class="dot" onclick="currentSlide(11)"></span> 
              <span class="dot" onclick="currentSlide(12)"></span>
              <span class="dot" onclick="currentSlide(13)"></span>
            </div>
            
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>

            <div class="row">
                <div class="col-75">
                    <div>
                        <div class="row">
                            <div class="col-50">
                                <h3>Shipping Address</h3>
                                    <label for="Name"> Full Name</label>
                                    <input type="text" name="Name" placeholder="John M. Doe" value="<?php if(isset($_POST['Name'])){echo $_POST['Name'];}?>">
                                    <?php if(isset($output['Name'])){echo "<font 
                                    color='red'>".$output['Name']."</font>";}?><br/>
                                
                                    <label for="email"> Email</label>
                                    <input type="text" id="email" name="email" placeholder="john@example.com" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>"/>
                                    <?php if(isset($output['email'])){echo "<font color='red'>".$output['email']."</font>";} ?><br/>  
                                
                                    <label for="phone"> Phone Number</label>
                                    <input type="text" name="phone" placeholder="XXX-XXX-XXXX" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];}?>">
                                    <?php if(isset($output['phone'])){echo "<font color='red'>".$output['phone']."</font>";} ?><br/> 
                                
                                    <label for="adr"> Address</label>
                                    <input type="text" name="Address" placeholder="542 W. 15th Street, New York City, NY 10001 US" value="<?php if(isset($_POST['Address'])){echo $_POST['Address'];}?>"/>
                                    <?php if(isset($output['Address'])){echo "<font color='red'>".$output['Address']."</font>";}?><br/>

                                <div class="row">
                                    <div class="col-50">
                                        <label for="state">Delivery Method</label>
                                        <select name="Delivery">
                                            <option value="N/A" <?php if($_POST['Delivery']=="N/A")  echo 'selected="selected"'; ?> > </option>
                                            <option value="Standard" <?php if($_POST['Delivery']=="Standard")  echo 'selected="selected"'; ?>>Standard Shipping (3-5 days)</option>
                                            <option value="Priority" <?php if($_POST['Delivery']=="Priority")  echo 'selected="selected"'; ?>>Priority (2-3 days)</option>
                                            <option value="Two" <?php if($_POST['Delivery']=="Two")  echo 'selected="selected"'; ?>>Two-Day</option>
                                            <option value="One" <?php if($_POST['Delivery']=="One")  echo 'selected="selected"'; ?>>One-Day</option>
                                        </select>
										<?php if(isset($output['Delivery'])){ echo "<br>"; echo "<font color='red'>".$output['Delivery']."</font>";}?><br/>

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
                                    <input type="text" id="ccnum" name="card" placeholder="1111-2222-3333-4444" value="<?php if(isset($_POST['card'])){echo $_POST['card'];}?>">
                                    <?php if(isset($output['card'])){echo "<font color='red'>".$output['card']."</font>";}?><br/>
                                
                                    <div class="row">
                                        <div class="col-50">
                                            <label for="expyear">Exp Date</label>
                                            <input type="text" id="exp" name="exp" placeholder="09/2018" value="<?php if(isset($_POST['exp'])){echo $_POST['exp'];}?>">
                                            <?php if(isset($output['exp'])){echo "<font color='red'>".$output['exp']."</font>";} ?><br/>
                                        </div>
                                        
                                        <div class="col-50">
                                            <label for="cvv">CVV</label>
                                            <input type="text" id="cvv" name="cvv" placeholder="352" value="<?php if(isset($_POST['cvv'])){echo $_POST['cvv'];}?>">
                                            <?php if(isset($output['cvv'])){echo "<font color='red'>".$output['cvv']."</font>";} ?><br/>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        <input type="submit" name="Checkout" value="Checkout" class="btn">
                    </div>
                </div>
            </div>
        </div>
        
        <div class="right-column">
            
            <!-- Product Description -->
            <div class="product-description">
                    <span>T-Shirts</span>
                    <h1>Pokémon Graphic Tees</h1>
                    <p>For all Pokémon fans out there, our selection offers various graphics to choose from. Unique, colorful, playful and quailty.</p>
                </div>

            <!-- Product Configuration -->
            <div class="product-configuration">

              <!-- Product Graphic -->
              <div class="product-graphic">
                  <span>Graphic (Choose a Graphic)</span>

                  <div class="graphic-choose">
                    <select name="graphic" style="width: 120px">
                         <option value="N/A" <?php if($_POST['graphic']=="N/A")  echo 'selected="selected"';?>> </option>
                         <option value="Bulbasaur" <?php if($_POST['graphic']=="Bulbasaur")  echo 'selected="selected"'; ?>>Bulbasaur</option>
                         <option value="Charmander" <?php if($_POST['graphic']=="Charmander")  echo 'selected="selected"'; ?>>Charmander</option>
                         <option value="Squirtle" <?php if($_POST['graphic']=="Squirtle")  echo 'selected="selected"'; ?>>Squirtle</option>
                         <option value="Pikachu" <?php if($_POST['graphic']=="Pikachu")  echo 'selected="selected"'; ?>>Pikachu</option>
                         <option value="Jigglypuff" <?php if($_POST['graphic']=="Jigglypuff")  echo 'selected="selected"'; ?>>Jigglypuff</option>
                         <option value="Snorlax" <?php if($_POST['graphic']=="Snorlax")  echo 'selected="selected"'; ?>>Snorlax</option>
                         <option value="Mew" <?php if($_POST['graphic']=="Mew")  echo 'selected="selected"'; ?>>Mew</option>
                         <option value="Teamrocket" <?php if($_POST['graphic']=="Teamrocket")  echo 'selected="selected"'; ?>>Teamrocket</option>
                         <option value="Eeveelution" <?php if($_POST['graphic']=="Eeveelution")  echo 'selected="selected"'; ?>>Eeveelution</option>
                         <option value="Pokeball" <?php if($_POST['graphic']=="Pokeball")  echo 'selected="selected"'; ?>>Pokeball</option>
                         <option value="Torchic" <?php if($_POST['graphic']=="Torchic")  echo 'selected="selected"'; ?>>Torchic</option>
                         <option value="Treecko" <?php if($_POST['graphic']=="Treecko")  echo 'selected="selected"'; ?>>Treecko</option>
                         <option value="Mudkip" <?php if($_POST['graphic']=="Mudkip")  echo 'selected="selected"'; ?>>Mudkip</option>
                    </select>
                    <?php if(isset($output['graphic'])){echo "<font color='red'>".$output['graphic']."</font>";}?><br/>         
                  </div>
                </div>
              </div>
            
            <!-- Size -->
            <div id="overlay" onclick="off()"></div>
            <div class="size">
                <span>SIZE | </span>
                
                <div class="size-choose">
                    <input type="radio" name="Size" value="XS"<?php if (isset($_POST['Size']) && $_POST['Size'] == "XS") echo 'checked="checked"';?>>XS &nbsp;
                    <input type="radio" name="Size" value="SM"<?php if (isset($_POST['Size']) && $_POST['Size'] == "SM") echo 'checked="checked"';?>>SM
                    &nbsp;
                    <input type="radio" name="Size" value="M"<?php if (isset($_POST['Size']) && $_POST['Size'] == "M") echo 'checked="checked"';?>>M
                    &nbsp;
                    <input type="radio" name="Size" value="L"<?php if (isset($_POST['Size']) && $_POST['Size'] == "L") echo 'checked="checked"';?>>L &nbsp;
                    <input type="radio" name="Size" value="XL"<?php if (isset($_POST['Size']) && $_POST['Size'] == "XL") echo 'checked="checked"';?>>XL &nbsp;
                    <br/><?php if(isset($output['Size'])){echo "<font color='red'>".$output['Size']."</font>";}?><br/>
                </div>
                
                <p style="cursor:pointer" onclick="openNav()"><u>SIZE FIT & GUIDE</u></p>
                
                <div id="myNav" class="overlay">
                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                    <div class="overlay-content">
                        <img src="images/SizingChart.jpg">
                    </div>
                </div>
                
                <script src="js_main.js"></script>
                
                <div>
                    <span>Quantity </span>
                    <select name="Quantity" style="width: 50px">
                         <option value="N/A" <?php if($_POST['Quantity']=="N/A")  echo 'selected="selected"';?>> </option>
                         <option value="1" <?php if($_POST['Quantity']=="1")  echo 'selected="selected"'; ?>>1</option>
                         <option value="2" <?php if($_POST['Quantity']=="2")  echo 'selected="selected"'; ?>>2</option>
                         <option value="3" <?php if($_POST['Quantity']=="3")  echo 'selected="selected"'; ?>>3</option>
                         <option value="4" <?php if($_POST['Quantity']=="4")  echo 'selected="selected"'; ?>>4</option>
                         <option value="5" <?php if($_POST['Quantity']=="5")  echo 'selected="selected"'; ?>>5</option>
                         <option value="6" <?php if($_POST['Quantity']=="6")  echo 'selected="selected"'; ?>>6</option>
                         <option value="7" <?php if($_POST['Quantity']=="7")  echo 'selected="selected"'; ?>>7</option>
                         <option value="8" <?php if($_POST['Quantity']=="8")  echo 'selected="selected"'; ?>>8</option>
                         <option value="9" <?php if($_POST['Quantity']=="9")  echo 'selected="selected"'; ?>>9</option>
                         <option value="10" <?php if($_POST['Quantity']=="10")  echo 'selected="selected"'; ?>>10</option>
                    </select>
                    <?php if(isset($output['Quantity'])){echo "<font color='red'>".$output['Quantity']."</font>";}?><br/>
                </div><br/>
            </div>              
            
            <!-- Product Pricing -->
            <div class="product-price">
                <span>$19.99</span>
            </div>
            
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            <br/>
            
            <!--<div class="col-75">
                <div class="ordersum">
                    <h4>Cart</h4>
                    <p><?php /* if(isset($output['graphic'])){echo $output['graphic']." "."T-Shirt"." "." ".$output['Size']." "." ".$output['Quantity'];} */ ?></p>
                    <hr>
                    <p>Total<span style="color:black"><b>
                      <?php /* if(isset($output['Quantity']))
                                    {
                                        $first_number = 19.99;
                                        $second_number = $output['Quantity'];
                                        $sum_total = $second_number * $first_number;
                                        echo $sum_total;
                                    }
                        */ ?>     
                      </b></span>
                    </p>
                </div>
            </div>-->
        </div> 
    </main>
    </form>
    
    <?php
        }
    ?>
    
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