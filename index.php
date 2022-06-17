<?php
    include_once("header.php");//navigation bar and logo included as displayed on every page
    require("includes/dbcon.inc.php");
    if (isset($_SESSION['name'])) { //display message when logged in
        echo "<h2> Welcome " . ($_SESSION['name']) . "</h2>";
        if (($_SESSION['admin'])==1) { //display message when logged in
            echo "<h2>The website is now in admin mode! </h2>";
        }
    }
   
?>
<!--Image slideshow-->
<section class="home">
     <div class="slider">
        <div class="slide active" style="background-image: url('images/img1.jpg')">
            <div class="container">
                <div class="caption">
				<h2>Ghost of Tsushima <br> £19.95</h2>
                    <a href="games.php" class="btn">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="slide" style="background-image: url('images/img2.jpg')">
            <div class="container">
                <div class="caption">
                    <h2>Cyberpunk 2077 <br> £19.95</h2>
                    <a href="games.php" class="btn">Shop Now</a>
                </div>
            </div>
		</div>
		<div class="slide" style="background-image: url('images/img3.jpg')">
            <div class="container">
                <div class="caption">
                    <h2>Mafia 3 Definitive <br> £19.95</h2>
                    <a href="games.php" class="btn">Shop Now</a>
                </div>
            </div>
        </div>
        <div class="slide" style="background-image: url('images/img4.jpg')">
            <div class="container">
                <div class="caption">
                    <h2>Assasin's Creed Valhalla <br> £19.95</h2>
                    <a href="games.php" class="btn">Shop Now</a>
                </div>
            </div>
        </div>
     </div>
   
    <!-- controls  -->
    <div class="controls">
            <div class="prev">&lt;</div>
            <div class="next">&gt;</div>
        </div>

    <!-- indicators -->
    <div class="indicator">
    </div>
    <script src="includes/script.js"></script>
</section>

<br>
<br>
<h2> New arrivals!</h2>
<br>
<div class="loginbtn">
    <form method="GET" action="login.php">
        <?php
            if(!isset($_SESSION['useremail'])) {?>               
                <input type="submit" name="add" class="btn" value="Please login to purchase"> 
            <?php
            }
            else { 
                //remove button if logged in
            }
        ?>
    </form>
</div><br>
<?php
    $query = ("SELECT * FROM products ORDER BY ProductID DESC LIMIT 3"); //always display the latest 3 entries from db
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)>0) 
    {
?>
    <div class="products">
        <div class="row">
        <?php
        while ($row = mysqli_fetch_array($result)) 
        {
        ?>
            <div class="col3">
                <form method="POST" action="index.php">           
                    <a href="productinfo.php?ID=<?php echo $row['ProductID']; ?>"><!--Product information page??-->
                    <img src="<?php echo $row['Image'] ?>" alt="product image" class="image">
                    <h2 class="aboutitem"><?php echo $row['Title']; ?></h2></a>
                    <p class="price"><?php echo '£'.$row['Price']; ?></p>
                    <input type="hidden" name="title" value="<?php echo $row['Title']; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row['Price']; ?>">                    
                </form>
            </div>       
        <?php
            }
        }?>
        </div>  
    </div> 
    <script src="includes/jQuery.js"></script> <!-- jQuery animated transition effect when mouse hovers over any product image-->
<?php
    include_once("footer.php");
?>