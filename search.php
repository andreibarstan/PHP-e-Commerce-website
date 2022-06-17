<?php
    include_once("header.php");
    require_once("includes/dbcon.inc.php");

    $output = ""; 
    if (isset($_GET["q"]) && $_GET["q"] !== " ") //when search attempt is not empty
    {
        $searchq = $_GET["q"];  
        $query = ("SELECT * FROM products WHERE Title LIKE '%$searchq%'"); //search for sequence within item 
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)==0) 
        {
        echo $output = "<h2>" ."No search results for <b>'". $searchq ."'. </b>". "</h2>" ."<br>"; //no results 
        }
        else {
        echo $output = "<h2>" . "Results for <b> '". $searchq ."'</b>" .":" . "</h2>" ."<br>"; // results 
        ?>
        <div class="products">
            <div class="row">
            <?php
            while ($row = mysqli_fetch_array($result)) 
            { //display matching products
            ?>
                 <div class="col3">
                <form method="POST" action="">       
                    <a href="productinfo.php?ID=<?php echo $row['ProductID']; ?>"><!--Product information page??-->
                    <img src="<?php echo $row['Image'] ?>" alt="product image" class="image">
                    <h2 class="aboutitem" alt=""><?php echo $row['Title']; ?></h2></a>
                    <p class="price"><?php echo '£'.$row['Price']; ?></p>
                    <input type="hidden" name="title" value="<?php echo $row['Title']; ?>">
                    <input type="hidden" name="hidden_price" value="<?php echo $row['Price']; ?>">
                    <input type="hidden" name="id" value="<?php echo $row['ProductID']; ?>">
                    <?php
                        if(isset($_SESSION['useremail'])) { //if logged in show button
                    ?>               
                        <input type="submit" name="add" class="btn" value="Add to Basket"> 
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
    }?>
            </div>  
        </div> 
        <script src="includes/jQuery.js"></script> <!-- jQuery animated transition effect when mouse hovers over any product image-->
        <?php
    include_once("footer.php");
?>