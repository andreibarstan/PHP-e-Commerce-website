<?php
    include_once("header.php");
    require_once("includes/dbcon.inc.php");
?>
    <br><h2>All Products</h2>
    <br>
    <?php 
    //'Add to basket' button functionality and validation
    if (isset($_POST['id'])) { //if the form's submit button is clicked
        $id = $_POST['id']; 
        $query = ("SELECT * FROM products WHERE ProductID = $id");
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (isset($_SESSION['basket'][$id])) {   //add another item to basket
                $_SESSION['basket'][$id]['Quantity']++;
                echo '<p class="price">Another "'.$row['Title'].'" has been added to your basket</p><br>'; 
            }
            else {
                $_SESSION['basket'][$id] = array ('Quantity' => 1, 'Price' => $row['Price']); //if first entry of that ID in the basket
                echo '<p class="price">"'.$row['Title'].'" has been added to your basket</p><br>';
            }
        }
    }
        $query = ("SELECT * FROM products");
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0) 
        {
    ?>
<div class="loginbtn">
    <form method="GET" action="login.php">
        <?php
            if(!isset($_SESSION['useremail'])) { //allow to purchase only if logged in
        ?>               
            <input type="submit" name="login" class="btn" value="Please login to purchase"> 
        <?php
        }
        else { 
            //remove "Please login to purchase" button if logged in
        }
        ?>
    </form>
</div><br>
    <div class="products">
        <div class="row">
        <?php
            // fetch and display products contained in the database
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
            {       
        ?>
            <div class="col3">
                <form method="POST" action="games.php">       
                    <a href="productinfo.php?ID=<?php echo $row['ProductID']; ?>"><!--Product information page??-->
                    <img src="<?php echo $row['Image'] ?>" alt="product image" class="image">
                    <h2 class="aboutitem"><?php echo $row['Title']; ?></h2></a>
                    <p class="price"><?php echo '£'.$row['Price']; ?></p>
                    <input type="hidden" name="title" value="<?php echo $row['Title']; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row['Price']; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['ProductID']; ?>">
                    <?php
                        if(isset($_SESSION['useremail'])) { //if logged in show "Add to Basket" button
                    ?>               
                        <input type="submit" name="add" class="btn" value="Add to Basket">
                        <input type='hidden' name='product_id' value="<?php echo $row['ProductID']; ?>">
                    <?php
                    }
                    else { 
                        //redirect to login.php
                    }
                    ?>
                </form>
            </div>       
        <?php
            }
    }
        ?>
        </div>  
    </div> 
    <script src="includes/jQuery.js"></script> <!-- jQuery animated transition effect when mouse hovers over any product image-->
<?php
    include_once("footer.php");
?>