<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $category = $_POST['category'];
    $current_stock = $_POST['current_stock'];

    $sql = "UPDATE products SET product_name = ?, product_description = ?, category = ?, current_stock = ? WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    if($stmt){
        $stmt->bind_param("sssii", $product_name, $product_description, $category, $current_stock, $product_id);
        if($stmt->execute()){
            echo "product updated.";
            echo "<br><a href='edit_product.php'>Back to Edit Products</a>";
        } else {
            echo "Error updating product: " . $stmt->error;
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