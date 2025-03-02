<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'db_connection.php';

// Fetch all products to populate the selection dropdown
$sql = "SELECT * FROM products ";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Product to Edit</title>
</head>
<body>
    <h1>Select Product to Edit</h1>
    <form action="edit_product_process.php" method="post">
        <label for="product_id">Choose a product:</label>
        <select name="product_id" id="product_id" required>
            <option value="">-- Select a Product --</option>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . htmlspecialchars($row['product_id']) . "'>" . htmlspecialchars($row['product_name']) . "</option>";
             } 
            ?>
        </select>
        <br><br>
        <input type="submit" value="Edit Product">
    </form>
</body>
</html>

<?php
$conn->close();
?>

