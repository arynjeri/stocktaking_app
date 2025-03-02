<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['counted_stock']) && is_array($_POST['counted_stock'])) {
        $counted_stock = $_POST['counted_stock'];

        foreach ($counted_stock as $product_id => $counted_value) {
            // Sanitize the input
            $product_id = mysqli_real_escape_string($conn, $product_id);
            $counted_value = mysqli_real_escape_string($conn, $counted_value);

            // Basic validation: ensure counted_value is a number
            if (!is_numeric($counted_value)) {
                echo "Invalid stock count for product ID: " . htmlspecialchars($product_id) . ". Stock count must be a number.<br>";
                continue; // Skip to the next product
            }

            // Update the database
            $sql = "UPDATE products SET current_stock = ? WHERE product_id = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("ii", $counted_value, $product_id); // "ii" for integer, integer

                if ($stmt->execute()) {
                    // Stock updated successfully
                    // Optional: Log stock history here
                    // ... inside the foreach loop, after successful update ...

// Get the old stock value
$old_stock_sql = "SELECT current_stock FROM products WHERE product_id = ?";
$old_stock_stmt = $conn->prepare($old_stock_sql);
$old_stock_stmt->bind_param("i", $product_id);
$old_stock_stmt->execute();
$old_stock_result = $old_stock_stmt->get_result();
if ($old_stock_result->num_rows > 0) {
    $old_stock_row = $old_stock_result->fetch_assoc();
    $old_stock = $old_stock_row['current_stock'];

    // Insert into stock_history table
    $history_sql = "INSERT INTO stock_history (product_id, old_stock, new_stock, stocktake_date) VALUES (?, ?, ?, NOW())";
    $history_stmt = $conn->prepare($history_sql);
    $history_stmt->bind_param("iii", $product_id, $old_stock, $counted_value);
    $history_stmt->execute();
    $history_stmt->close();
}
$old_stock_stmt->close();
                } else {
                    echo "Error updating stock for product ID: " . htmlspecialchars($product_id) . ": " . $stmt->error . "<br>";
                }
                $stmt->close();
            } else {
                echo "Prepare statement error: " . $conn->error;
            }

        }
        echo "Stocktake completed.";
        echo "<br><a href='products.php'>View Products</a>";
    } else {
        echo "No stock counts submitted.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
?>