<?php  
$update = false; // boolean value used to control the dual function of "Insert/Update" button
include('adminconnect.php');
 ?>
<br><hr><br>
<h2>Add/Update/Delete User</h2> <br>
<?php 
	if (isset($_GET['edit'])) { //if edit button in clicked
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM users WHERE UserID=$id");
		if (mysqli_num_rows($record) == 1 ) {
            $n = mysqli_fetch_array($record);//fetch records details to be posted in the form 
            $fname = $n['FirstName'];
            $lname = $n['LastName'];
            $pcode = $n['PostCode'];
            $houseno = $n['HouseNo'];
            $email = $n['Email'];
            $admin = $n['Admin'];
		}
	}
?>
<!DOCTYPE html>
<html>

<body>
<?php if (isset($_SESSION['message'])){ ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php } ?>
<?php $results = mysqli_query($conn, "SELECT * FROM users"); ?> <!-- display table containing all user database -->
<div class="products">
    <div class="row">
        <table class="cartlayout">
            <tr>
                <th width="4%"> User ID</th>
                <th width="13%"> First Name</th>
                <th width="13%"> Last Name</th>
                <th width="7%"> Postcode</th>
                <th width="5%"> House number</th>
                <th width="25%"> Email address</th>
                <th width="10%"> Admin?</th>
                <th width="25%"> Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($results)) { ?> 
                <tr>
                    <td> <?php echo $row['UserID']; ?> </td> 
                    <td> <?php echo $row['FirstName']; ?> </td>
                    <td> <?php echo $row['LastName']; ?> </td>
                    <td> <?php echo $row['PostCode']; ?> </td>
                    <td> <?php echo $row['HouseNo']; ?> </td>
                    <td> <?php echo $row['Email']; ?> </td>
                    <td> <?php echo $row['Admin']; ?> </td>
                    <td>
                        <button type="submit" class="btn" style="width: 48%;"><a href="admin.php?edit=<?php echo $row['UserID']; ?>">Edit</a></button>
                        <button type="submit" class="btn" style="width: 48%;"><a href="admin.php?del=<?php echo $row['UserID']; ?>">Delete</a></button>
                    </td>
                </tr>
            <?php } ?>
            <form method="POST" class="edit" action="admin.php">
                <tr class="blankRow"> <td colspan="8">Use the row below to insert or update users!</td> </tr>
                <tr>
                    <td>
                        <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                    </td> 
                    <td>
                        <input type="text" name="fname" value="<?php echo  $fname; ?>" placeholder="First name" required>
                    </td>
                    <td>
                        <input type="text" name="lname" value="<?php echo  $lname; ?>" placeholder="Last name" required>
                    </td>
                    <td>
                        <input type="text" name="pcode" value="<?php echo  $pcode; ?>" placeholder="Postcode" required>
                    </td>
                    <td>
                        <input type="text" name="houseno" value="<?php echo $houseno; ?>" placeholder="HouseNo" required>
                    </td>
                    <td> 
                        <input type="email" name="email" value="<?php echo $email;?>" placeholder="Email" required>
                    </td>
                    <td> 
                        <input type="number" min=0 max=1 name="admin" value="<?php echo $admin;?>" required>
                    </td>
                    <td> 
                        <?php if ($update == true){ ?>
                            <button class="btn" type="submit" name="update">Update</button>
                        <?php }else {?>
                            <button class="btn" type="submit" name="saveuser">Insert User</button>
                        <?php } ?>
                    </td> 
                </tr>
            </form>
        </table>
    </div>
</div>
</body>
</html>