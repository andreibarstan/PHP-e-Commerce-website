<?php  
$update = false; // boolean value used to control the dual function of "Insert/Update" button
include('adminconnect.php'); ?>
<br><hr><br>
<h2>Add/Update/Delete Products</h2> <br>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($conn, "SELECT * FROM products WHERE ProductID=$id");
		if (mysqli_num_rows($record) == 1 ) { //if result found
            $n = mysqli_fetch_array($record);//fetch records details to be posted in the form below
            $title = $n['Title'];
            $descrip = $n['Description'];
            $price = $n['Price'];
            $image = $n['Image'];
            $id=$n['ProductID'];
		}
	}
?>
<!DOCTYPE html>
<html>

<body>
<?php //display message if data has been modified
if (isset($_SESSION['message'])) { ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php } ?>
<?php $results = mysqli_query($conn, "SELECT * FROM products"); ?>
<div class="products">
    <div class="row">
        <table class="cartlayout">
            <tr>
                <th width="7%"> Product ID</th>
                <th width="13%"> Title</th>
                <th width="23%"> Description</th>
                <th width="7%"> Price</th>
                <th width="15%"> Image</th>
                <th width="25%"> Action</th>
            </tr>
            <?php while ($row = mysqli_fetch_array($results)) { //display database row ?> 
                <tr>
                    <td> <?php echo $row['ProductID']; ?> </td> 
                    <td> <?php echo $row['Title']; ?> </td> 
                    <td> <?php echo $row['Description']; ?> </td>
                    <td> <?php echo $row['Price']; ?> </td>
                    <td> <?php echo $row['Image']; ?> </td>
                    <td>
                        <button type="submit" class="btn" style="width: 48%;"><a href="productsedit.php?edit=<?php echo $row['ProductID']; ?>">Edit</a></button>
                        <button type="submit" class="btn" style="width: 48%;"><a href="productsedit.php?delprod=<?php echo $row['ProductID']; ?>">Delete</a></button>
                    </td>
                </tr>
            <?php } ?>
            <form method="POST" class="edit" action="productsedit.php">
                <tr class="blankRow"> <td colspan="6">Use the row below to insert or update products!</td> </tr>
                <tr>
                    <td>
                        <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                    </td> 
                    <td>
                        <input type="text" name="title" value="<?php echo  $title; ?>" placeholder="Title" required>
                    </td>
                    <td>
                        <input type="text" name="descrip" value="<?php echo  $descrip; ?>" placeholder="Description"required>
                    </td>
                    <td>
                        <input type="number" min='0' step=".01" name="price" value="<?php echo  $price; ?>" placeholder="Price"required>
                    </td>
                    <td>
                        <input type="text" name="image" value="<?php echo $image; ?>" placeholder="Image path"required>
                    </td>
                    <td> 
                        <?php if ($update == true){ ?>
                            <button class="btn" type="submit" name="updateprod">Update</button>
                        <?php }else {?>
                            <button class="btn" type="submit" name="save" >Insert Product</button>
                        <?php } //new data entered and submited 
                        ?>
                    </td> 
                </tr>
            </form>
        </table>
    </div>
</div>
</body>
</html>