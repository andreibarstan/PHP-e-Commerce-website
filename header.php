<?php
session_start(); //as header.php file is included in every page, so will the session keeping the user signed in
?>
<!DOCTYPE html>
<html lang="en">

<head>  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>GameStore</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="crossorigin="anonymous">
    </script>
</head>

<body>
    <nav>  <!-- navigation bar including logo, links and search bar -->
        <div class="logo">
            <a href="index.php">
                <img src="images/logo.jpg" alt="game store logo">
            </a>
        </div> 
        <div class="navbar">
            <button type="submit" class="hamburger" id="hamburger">
                <img src="images/menulist.png" alt="menu icon">
            </button>
            <ul class="menuitems" id="menuitems">
                <li><a href="index.php">Home</a></li>
                <li ><a href='games.php'>Games</a></li>
                <?php                     
                    if(isset($_SESSION['useremail'])) { //show nav bar according to privileges(guest, user, admin)
                        if (($_SESSION['admin'])==1) { //if user is admin
                            echo "<li><a href = 'admin.php'>Users</a></li>";
                            echo "<li><a href = 'productsedit.php'>Products</a></li>";
                            echo "<li><a href = 'includes/logout.inc.php'>Logout</a></li>";
                        }else {   //regular logged in user navbar
                            echo "<li><a href = 'account.php'>Account</a></li>";
                            echo "<li><a href = 'includes/logout.inc.php'>Logout</a></li>";
                            
                        }
                        if(!empty($_SESSION['basket'])) {   //display notification icon when a product has been added to the basket
                            echo "<li><a href = 'basket.php' id='basket'><img src='images/basketfull.png' alt='basket' width='50px' height='50px'></a></li>";
                        }
                        else {//if items in the cart
                            echo "<li><a href = 'basket.php' id='basket'><img src='images/basket.png' alt='basket' width='50px' height='50px'></a></li>";
                        }    
                    }
                    else{ //if user not logged in
                        echo "<li><a href = 'login.php'>Login</a></li>";
                        echo "<li><a href = 'userReg.php'>Register</a></li>";
                    }
                ?> 
                <li>
                    <form action="search.php" method="GET" id="searchForm">     
                        <label for="bar"></label>
                        <input type="text" name="q" class="searchbar" id="bar" placeholder="Search" maxlength="30" autocomplete="off" required /><input type="submit" class="searchBtn" value="Go" />
                    </form>    
                </li> 
            </ul>
        </div>
    </nav>
   <script src="includes/navbartoggle.js"></script> <!-- navigation bar hamburger menu toggle -->