<?php
$username = $password = "";
if(isset($_POST['submit'])) { //check if form is submitted
    require_once("dbcon.inc.php"); //include database connection and functions files
    require_once("functions.inc.php");

    $username = test_input($_POST["email"]); // test_input will validate the form input data (the function can be found in functions.inc.php)
    $password = test_input($_POST["password"]);

    if(emptyInputLogin($username, $password) !== FALSE) { //error handler checking if all fields contain data
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    loginUser($conn, $username, $password); //function to login user included in functions.inc.php
}
else{ //if illegal attempt to access login.inc.php file, redirect to login.php
    header("location: ../login.php");
    exit();
}