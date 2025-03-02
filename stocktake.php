<?php
include 'db_connection.php';

// Fetch product data from the database
$sql = "SELECT product_id, product_name, current_stock FROM products";
echo "SQL Query: " . $sql . "<br>";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Stocktaking</title>
    </head>
    <body>
        <h1>Stocktaking</h1>
        <form action="stocktake_process.php" method="post">
            <table border="1">
                <tr>
                    <th>Product Name</th>
                    <th>Current Stock (Database)</th>
                    <th>Counted Stock</th>
                </tr>
                <?php
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['current_stock']); ?></td>
                        <td><input type="number" name="counted_stock[<?php echo $row['product_id']; ?>]" required></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <br>
            <input type="submit" value="Submit Stocktake">
        </form>
    </body>
    </html>
    <?php
} else {
    echo "No products found.";
}

$conn->close();
?>