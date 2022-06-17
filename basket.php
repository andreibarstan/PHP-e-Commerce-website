<?php
    include_once("header.php");
    require_once("includes/dbcon.inc.php");
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {  // if update basket button is clicked
    foreach ($_POST['Quantity'] as $item_id => $item_qty) {// check the quantity number and update
        $id = (int) $item_id;
        $qty = (int) $item_qty;
        if($qty == 0) {
            unset($_SESSION['basket'][$id]);
        }
        elseif ($qty > 0){
            $_SESSION['basket'][$id]['Quantity'] = $qty;
        }
    }
}
$total=0;
if(!empty($_SESSION['basket'])) {  //query the db for a product having requested ID
    $query = "SELECT * FROM products WHERE ProductID IN (";
    foreach($_SESSION['basket'] as $id => $value) {
        $query .= $id. ','; //loop adding ProductID and a comma to the query
    }
    $query = substr($query, 0, -1).') ORDER BY ProductID ASC'; //substr function removes the final comma to satisfy syntax
    $result = mysqli_query($conn, $query);
?>    
<h2>Items in your basket</h2>
<br>
<form method="POST" action="basket.php?id=<?php echo $row['ProductID'];?>">  
    <div class="products"> 
        <div class="row">
            <table class="cartlayout">
                <tr>
                    <th width="10%"> Image</th>
                    <th width="35%"> Name</th>
                    <th width="5%"> Quantity</th>
                    <th width="10%"> Price</th>
                    <th width="20%"> Subtotal</th>
                </tr>
            <?php
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) //display results in a table
                {       
                    $subtotal = $_SESSION['basket'][$row['ProductID']]['Quantity']* $_SESSION['basket'][$row['ProductID']]['Price'];
                    $total += $subtotal;
            ?>
                <tr>
                    <td> <img src="<?php echo $row['Image'] ?>" alt="product image" class="image basket"></td>
                    <td>  <p class="aboutitem" alt=""><?php echo $row['Title']; ?></p></td>
                    <td>  <?php echo "<p><input type=\"number\" min=\"0\" max=\"9\" size=\"1\" name=\"Quantity[{$row['ProductID']}]\" value=\"{$_SESSION['basket'][$row['ProductID']]['Quantity']}\"></p>"?></td>
                    <td> <p class="price"><?php echo '£'.$row['Price']; ?></p></td>
                    <td> <p class="price">£<?php echo number_format($subtotal, 2);?></p></td>   
                </tr>
            <?php
                } 
            ?>
            <tr>
                <td colspan="4">
                <br><button class="btn" style="width: 40%; margin-bottom: 20px;">Update basket</button><br>
                </td>
                <td colspan="2">
                    <p class="price-total">Total £<?php echo number_format($total, 2);?></p>
                </td>
            </tr>
            </table> 
        </div>
        <br><button class="btn" type="submit" name="total" style="width: 30%; margin-left: 50%;"><a href="checkout.php?total=<?php echo $total?>">Checkout</a></button><br>
    </div>
</form> 
<?php 
    mysqli_close($conn);
    }
    else {
        echo '<h2>Your basket is currently empty</h2><br>';
    }
?>
<?php
    include_once("footer.php");
?>