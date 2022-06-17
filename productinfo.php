<?php
    include_once("header.php");
   require_once("includes/dbcon.inc.php");
    if(isset($_GET['ID'])) { 
        $ID = $_GET['ID'];
        $query = "SELECT * FROM products WHERE ProductID = '$ID' ";
        $result = mysqli_query($conn, $query);
    }
    if(mysqli_num_rows($result)>0) 
    {
?>                   
        <div class="loginbtn"> 
            <form method="GET" action="login.php">
            <?php //if guest log in to buy
            if(!isset($_SESSION['useremail'])) {?>               
                <br> <input type="submit" name="add" class="btn" value="Please login to purchase"> <br><br><br><br>
            <?php
            }
            else { 
            //remove button if logged in
            }
               ?>
           </form>
       </div> 
    <div class="products">
        <div class="row">
        <?php
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
            {       //fetching data for ID requested and display
        ?>  
                <form method="POST" action="games.php">   
                    <div class="productinfo"> 
                        <input type="hidden" name="title" value="<?php echo $row['Title']; ?>">
                        <img src="<?php echo $row['Image']; ?>" alt="product image" class="image">
                        <h2 class="aboutitem"><?php echo $row['Title']; ?></h2>
                        <p class="price"><?php echo '£'.$row['Price']; ?></p>
                        <input type="hidden" name="id" value="<?php echo $row['ProductID']; ?>"> <br>
                    </div>
                    <div class="productinfo">
                        <h2 class="description"><?php echo $row['Description']; ?></h2>
                        <?php
                            if(isset($_SESSION['useremail'])) {
                        ?>               
                            <p class="price"><?php echo '£'.$row['Price']; ?></p>
                            <input type="submit" name="add" class="btn" value="Add to Basket">
                        <?php
                        }
                        ?>
                    </div>
                </form>
        <?php
            }
        }
        ?>
        </div>  
    </div> 
<?php
    include_once("footer.php");
?>        