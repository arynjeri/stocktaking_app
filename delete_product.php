<?php
include 'db_connection.php';
?>
<!DOCTYPE html>
<html>
<header>
  <title> Delete  Product</title>
<body> 
  <h1>Delete  Product</h1>
    <form action="delete_product_process.php" method="post">
    <label for="product_name">Product ID to Delete:</label><br>
        <input type="text" id="product_name" name="product_name" required><br><br>


        <input type="submit" value="DELETE Product">
    </form>
    <br>
    <a href="products.php">Back to Product List</a>
 </body> </body>
</html>
<?php $conn->close(); ?>
