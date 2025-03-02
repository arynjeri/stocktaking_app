<?php 
include 'db_connection.php';
?>
<!DOCTYPE html>
<html>
 <head>   
 <title>Add Product</title>
<body> <h1>Add New Product</h1>
    <form action="add_product_process.php" method="post">
        <label for="product_name">Product Name:</label><br>
        <input type="text" id="product_name" name="product_name" required><br><br>

        <label for="product_description">Product Description:</label><br>
        <textarea id="product_description" name="product_description"></textarea><br><br>

        <label for="category">Category:</label><br>
        <input type="text" id="category" name="category"><br><br>

        <label for="current_stock">Initial Stock:</label><br>
        <input type="number" id="current_stock" name="current_stock" value="0" required><br><br>

        <input type="submit" value="Add Product">
    </form>
    <br>
    <a href="products.php">Back to Product List</a>
 </body> 
 </html>
<?php $conn->close(); ?>  