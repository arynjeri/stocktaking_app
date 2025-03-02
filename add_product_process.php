<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
    $product_description = mysqli_real_escape_string($conn, $_POST["product_description"]);
    $category = mysqli_real_escape_string($conn, $_POST["category"]);
    $current_stock = (int)$_POST["current_stock"];

    $sql = "INSERT INTO products (product_name, product_description, category, current_stock) VALUES ('$product_name', '$product_description', '$category', $current_stock)";

    if ($conn->query($sql) === TRUE) {
        echo "New product added successfully. <a href='products.php'>View Products</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>