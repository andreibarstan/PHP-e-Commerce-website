<?php //user details page
    include_once("header.php");    
    
    if (isset($_SESSION['name'])) { 
        echo "<h2> Welcome " . ($_SESSION['name']) . "</h2><br>";//display message if logged in
        echo "<h2>User details...</h2>";    
    }  
    include_once("footer.php");
?>