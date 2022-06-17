<?php
    include_once("header.php");
    require_once("includes/dbcon.inc.php");
    date_default_timezone_set('Europe/London');
    if(!isset($_SESSION['userid'])) { //if illegal attempt to access checkout.php redirect to home page
        require ('login.php');
        header('Location: login.php');
    }
    if (isset($_GET['total']) &&(!empty($_SESSION['basket']))) {
        $uid = $_SESSION['userid'];
        $total =$_GET['total'];
        $timestamp = date("Y-m-d H:i:s");
        $query = "INSERT INTO orders (UserID, Total, OrderDate) VALUES (?,?,?)";
        $stmt= $conn->prepare($query);
        $stmt->bind_param("sss", $uid, $total, $timestamp);
        $stmt->execute();
        
        $result = mysqli_query($conn, $query); 

        $orderID = mysqli_insert_id($conn);
        $query = "SELECT * FROM products WHERE ProductID IN(";
        foreach ($_SESSION['basket'] as $id => $value) {
            $query .= $id. ','; //loop adding ProductID and a comma to the query
        }
        $query = substr($query, 0, -1).') ORDER BY ProductID ASC'; //substr function removes the final comma to satisfy syntax
        $result = mysqli_query($conn, $query);
        
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
    {//display results
        $query2 = "INSERT INTO invoice (OrderID, ProductID, Quantity) VALUES ($orderID, ".$row['ProductID'].",". $_SESSION['basket'][$row['ProductID']]['Quantity'].")";
        $result2 = mysqli_query($conn, $query2);
    } 
    echo "<h2>Thank you for your order!<br>" . "Your order number is #$orderID </h2>";
        $_SESSION['basket'] = NULL;
    mysqli_close($conn);

    } else header('Location: index.php'); //if illegal attempt to access checkout.php redirect to home page
   
    include_once("footer.php");
?>