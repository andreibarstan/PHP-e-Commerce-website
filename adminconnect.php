<?php 
    include('header.php');
    require_once("includes/dbcon.inc.php");	
    // initialize variables
    $fname = "";
    $lname = "";
    $pcode = "";
    $houseno = "";
    $email = "";
    $descrip="";
    $title="";
    $image="";
    $admin=0;
    $id = 0;
    $update = false;

    if (isset($_SESSION['useremail']) && ($_SESSION['admin'])==1) {
    //Products 
 //'Update' button is clicked and entered form is to be replaced with db content
    if (isset($_POST['save'])) {
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $descrip=mysqli_real_escape_string($conn,$_POST['descrip']);
        $price=mysqli_real_escape_string($conn,$_POST['price']);
        $image=mysqli_real_escape_string($conn,$_POST['image']);
        //insert data into db
        $query = mysqli_query($conn, "INSERT INTO products (Title, Description, Price, Image) VALUES ('$title', '$descrip', '$price', '$image')");
        mysqli_query($conn, $query);
        $_SESSION['message'] = "Product inserted!"; 
        header('location: productsedit.php');
    }
     //'Update' button is clicked and entered form is to be replaced with db content
    if (isset($_POST['updateprod'])) {
        $title=mysqli_real_escape_string($conn,$_POST['title']);
        $descrip=mysqli_real_escape_string($conn,$_POST['descrip']);
        $price=mysqli_real_escape_string($conn,$_POST['price']);
        $image=mysqli_real_escape_string($conn,$_POST['image']);
        $id=mysqli_real_escape_string($conn,$_POST['id']);
        //update db data
        mysqli_query($conn, "UPDATE products SET Title='$title', Description='$descrip', Price='$price', Image='$image' WHERE ProductID=$id");
        $_SESSION['message'] = "Product updated!"; 
        header('location: productsedit.php');
    }
    //delete db data
    if (isset($_GET['delprod'])) {
        $id = $_GET['delprod'];
        mysqli_query($conn, "DELETE FROM products WHERE ProductID=$id");
        $_SESSION['message'] = "Product deleted!"; 
        header('location: productsedit.php');
    }


    //Users

    if (isset($_POST['saveuser'])) { //'Update' button is clicked and entered form is to be replaced with db content
        $fname=mysqli_real_escape_string($conn,$_POST['fname']);
        $lname=mysqli_real_escape_string($conn,$_POST['lname']);
        $pcode=mysqli_real_escape_string($conn,$_POST['pcode']);
        $houseno=mysqli_real_escape_string($conn,$_POST['houseno']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $admin=mysqli_real_escape_string($conn,$_POST['admin']);
        //insert data into db
        $query = mysqli_query($conn, "INSERT INTO users (FirstName, LastName, PostCode, HouseNo, Email, Admin) VALUES ('$fname', '$lname', '$pcode', '$houseno', '$email', '$admin')");
        mysqli_query($conn, $query);
        $_SESSION['message'] = "User inserted!"; 
        header('location: admin.php');
    }
    //update db data
    if (isset($_POST['update'])) { //'Update' button is clicked and entered form is to be replaced with db content
        $fname=mysqli_real_escape_string($conn,$_POST['fname']);
        $lname=mysqli_real_escape_string($conn,$_POST['lname']);
        $pcode=mysqli_real_escape_string($conn,$_POST['pcode']);
        $houseno=mysqli_real_escape_string($conn,$_POST['houseno']);
        $email=mysqli_real_escape_string($conn,$_POST['email']);
        $admin=mysqli_real_escape_string($conn,$_POST['admin']);
        $id=mysqli_real_escape_string($conn,$_POST['id']);
        mysqli_query($conn, "UPDATE users SET FirstName='$fname', LastName='$lname', PostCode='$pcode', HouseNo='$houseno', Email='$email', Admin='$admin' WHERE UserID=$id");
        $_SESSION['message'] = "User data updated!"; 
        header('location: admin.php');
    }
    //delete db data
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($conn, "DELETE FROM users WHERE UserID=$id");
        $_SESSION['message'] = "User data deleted!"; 
        header('location: admin.php');
    }
} else { // if illegal attempt to access data
    header('location: login.php');
    exit();
}