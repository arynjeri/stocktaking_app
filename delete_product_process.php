<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);

    $sql = "DELETE FROM products WHERE product_name = '$product_name'";
    if ($conn->query($sql) === TRUE) {
        echo "product deleted successfully. <a href='products.php'>View Products</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>