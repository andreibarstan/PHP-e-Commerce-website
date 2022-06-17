<?php
    include_once("header.php");
    //registration form
?>

<h2>Registration</h2><br>
<form action="includes/userReg.inc.php" method="POST" class="form-container" >
    <table>
        <tr>
            <td>
                <input type="text" name="firstname" placeholder="First name" />
            </td> 
            <td>
                <input type="text" name="lastname" placeholder="Last name" />
            </td>
        </tr>
        <tr>
            <td>
                <input type="text" name="postcode" placeholder="Postcode" />
            </td>
            <td>
                <input type="text" name="houseno" placeholder="House number"  />
            </td>
        </tr>
        <tr>
            <td  colspan="2">
                <input type="text" name="email" placeholder="Email address"  />
            </td>
        </tr> 
        <tr>
            <td> 
                <input type="Password" name="password" placeholder="Password" minlength="6"/>
            </td>
            <td>
                <input type="Password" name="rpassword" placeholder="Repeat password" minlength="6"/>
        </tr>
    </table><br>
    <input type="submit" class="btn" name="submit" value="Register" />
    <p> <a href = "login.php">Already a member? Sign In</a></p>
</form>

<?php 
    // validation errors 
    if(isset($_GET['error'])) {
        if($_GET['error'] == "emptyinput"){
            echo "<br><p class='error'>Enter all fields!</p><br>";
        }
        else if($_GET['error'] == "invalidemail"){
            echo "<br><p class='error'>Invalid Email Address!</p><br>";
        }
        else if($_GET['error'] == "passwordsdontmatch"){
            echo "<br><p class='error'>Passwords do not match!</p><br>";
        }
        else if($_GET['error'] == "emailtaken"){
            echo "<br><p class='error'>Email address already in use!</p><br>";
        }
        else if($_GET['error'] == "statementfailed"){
            echo "<br><p class='error'>Something went wrong, try again!</p><br>";
        }
    }
    include_once("footer.php");
?>