<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_id"])) {
    $product_id = $_POST["product_id"];

    // Fetch product data from the database
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    if($stmt){
        $stmt->bind_param("i", $product_id);
      // Bind the product_id
        if ($stmt->execute()) {
            $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) { // Check if $result is valid and has rows
            $product = $result->fetch_assoc();

    echo "<pre>";
    print_r($product); // Debugging: Print the array
    echo "</pre>";
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Edit Product</title>
        </head>
        <body>
            <h1>Edit Product</h1>
            <form action="update_product_process.php" method="post">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">

                <label for="product_name">Product Name:</label><br>
                <input type="text" id="product_name" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required><br><br>

                <label for="product_description">Product Description:</label><br>
                <textarea id="product_description" name="product_description"><?php echo htmlspecialchars($product['product_description']); ?></textarea><br><br>

                <label for="category">Category:</label><br>
                <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>"><br><br>

                <label for="current_stock">Current Stock:</label><br>
                <input type="number" id="current_stock" name="current_stock" value="<?php echo htmlspecialchars($product['current_stock']); ?>" required><br><br>

                <input type="submit" value="Update Product">
            </form>
            <br>
            <a href="edit_product.php">Back to Product Selection</a>
        </body>
        </html>
        <?php
     } else {
        echo "Product not found.";
    }

    $result->free_result();
} else {
    echo "Error executing statement: " . $stmt->error;
}
$stmt->close();
} else {
echo "Error preparing statement: " . $conn->error;
}

$conn->close();
} else {
echo "Invalid request.";
$conn->close();
}
?>

