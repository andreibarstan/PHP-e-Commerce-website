<?php
    include_once("header.php");    
    //login form
?>
<h2>Login </h2><br>
<form method="POST" class="form-container" action="includes/login.inc.php" >
    <table style="width: 100%;">
        <tr>
            <td><input type="text" name="email" placeholder="Email address" /></td>
        </tr> 
        <tr>
            <td ><input type="password" name="password" placeholder="Password" /></td>
        </tr>
    </table>
    <a href="resetpassword.php">Forgot password?</a><br><br>
    <input type="submit" class="btn" name="submit" value="Login" />
    <a href = "userReg.php">Not a member yet? Sign Up</a>
</form>
<?php
    //validate attempt and display errors if neccesarry
 if(isset($_GET['error'])) {
    if($_GET['error'] == "emptyinput"){
        echo "<br><p class='error'>Enter all fields!</p><br>";
    }
    else if($_GET['error'] == "invalidemail/password"){
        echo "<br><p class='error'>Incorrect email/password!</p><br>";
    }
    else if($_GET['error'] == "passwordsdontmatch"){
        echo "<br><p class='error'>Passwords do not match!</p><br>";
    }
    else if($_GET['error'] == "none"){
        echo "<br><p class='error'>Registration successful! You can now login!</p><br>";
    }
}
    include_once("footer.php");
?>