<?php
    // validating empty input when registering  
    function emptyInputSignup($firstname, $lastname, $postcode, $houseno, $username, $password, $rpassword) 
    {
        if(empty($firstname) || empty($lastname) || empty($postcode) || empty($houseno) || empty($username) || empty($password) || empty($rpassword)) 
        {
            $result = true;
        }
        else {
            $result = false; // no empty fields
        }
        return $result;
    }

    //validating email syntax
    function invalidEmail($username) {
        if (!filter_var($username, FILTER_VALIDATE_EMAIL)){ //filter to check if input has email structure
        //if(preg_match("/^[a-zA-Z0-9]*$/", $username)) { //filter to allow only standard letters and numbers
            $result = true; //not a valid email address 
        }
        else {
            $result = false; 
        }
        return $result;
    }
    //matching passwords check
    function passMatch($password, $rpassword) { 
        if($password !== $rpassword) {
            $result = true;
        }
        else {
            $result = false; 
        }
        return $result;
    }
    ///check if email exist in db
    function emailExist($conn, $username) {
       $sql = ("SELECT * FROM users WHERE Email = ?;"); // '?' is a placeholder associated with $stmt to prevent sql injections 
       $stmt = mysqli_stmt_init($conn); //initialise prepared statement to prevent sql injections
       if(!mysqli_stmt_prepare($stmt, $sql)) { //check for errors found in the sql statement
            header("location: ../userReg.php?error=statementfailed");
            exit();
       }

       mysqli_stmt_bind_param($stmt, "s", $username); //submitting one string 's'
       mysqli_stmt_execute($stmt); //execute prepared statement

       $resultData = mysqli_stmt_get_result($stmt); //get data from database

       if($row = mysqli_fetch_assoc($resultData)) { //if data found in the db (condition used in both user signup and login)
            return $row;
       }else {
           $result = false;
           return $result;
       }
       mysqli_stmt_close($stmt);
    }
    ///upload user registration details to db
    function createUser($conn, $firstname, $lastname, $postcode, $houseno, $username, $password) {
        $sql = ("INSERT INTO users (FirstName, LastName, PostCode, HouseNo, Email, Password) VALUES(?,?,?,?,?,?)"); //check if email exist in db. '?' is a placeholder associated with $stmt to prevent sql injections 
        $stmt = mysqli_stmt_init($conn); //initialise prepared statement to prevent sql injections
        if(!mysqli_stmt_prepare($stmt, $sql)) { //if errors found in the sql statement
             header("location: ../userReg.php?error=statementfailed");
             exit();
        }
 
        $passHashed = password_hash($password, PASSWORD_DEFAULT); //password_hash is automatically updated
        mysqli_stmt_bind_param($stmt, "ssssss", $firstname, $lastname, $postcode, $houseno, $username, $passHashed);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("location: ../login.php?error=none");
        exit();
     }
     // validating empty input when logging in 
     function emptyInputLogin($username, $password) //check for empty fields
     {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($username) || empty($password)) 
            {
                $result = true; 
            }
            else {
                $result = false; // no empty fields
            }
            return $result;
        }
     }
     //login validation
     function loginUser($conn, $username, $password) { 
         $emailExist = emailExist($conn, $username); //re-use 'emailExist' function to compare db data with input

         if($emailExist === FALSE) { //if input doesn't exist in db redirect
             header("location: ../login.php?error=invalidemail/password");
             exit();
         }

         $passHashed = $emailExist['Password']; // grab 'Password' column from database to be compared to the input    
         $passCheck = password_verify($password, $passHashed); //if they match, var passCheck=true

         if ($passCheck === FALSE) {
            header("location: ../login.php?error=invalidemail/password");
            exit();
         }
         elseif ($passCheck === TRUE) {
             session_start(); // if login successful start session
             $_SESSION['name'] = $emailExist['FirstName'];
             $_SESSION['useremail'] = $emailExist['Email']; 
             $_SESSION['admin'] = $emailExist['Admin']; //if field admin=1 login as admin 
             $_SESSION['userid'] = $emailExist['UserID']; 
             header("location: ../index.php");
            exit();
         }
     }

     function test_input($data) {
        //Strip whitespace (or other characters) from the beginning and end of a string
        $data = trim($data);
        //Un-quotes a quoted string
        $data = stripslashes($data);
        //Convert special characters to HTML entities
        $data = htmlspecialchars($data);
        return $data;
        }       