<?php
$output=NULL;

if(isset($_POST['submit'])){ //if submit button is clicked
    require_once "dbcon.inc.php";
    require_once "functions.inc.php";    
    
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $postcode = mysqli_real_escape_string($conn, $_POST['postcode']);
    $houseno = mysqli_real_escape_string($conn, $_POST['houseno']);
    $username = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rpassword = mysqli_real_escape_string($conn, $_POST['rpassword']);


    //validation and error output
    if (emptyInputSignup($firstname, $lastname, $postcode, $houseno, $username, $password, $rpassword) !== FALSE) {
            header("location: ../userReg.php?error=emptyinput");
            exit();
    }
    if (invalidEmail($username) !== FALSE) {
        header("location: ../userReg.php?error=invalidemail");
        exit();
    }
    if (passMatch($password, $rpassword) !== FALSE) {
        header("location: ../userReg.php?error=passwordsdontmatch");
        exit();
    }
    if (emailExist($conn, $username) !== FALSE) {
        header("location: ../userReg.php?error=emailtaken");
        exit();
    }
    //if no error register user
    createUser($conn, $firstname, $lastname, $postcode, $houseno, $username, $password);
}
else{
        header("location: ../userReg.php");
        exit();
}