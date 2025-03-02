<?php
include 'db_connection.php';

// Check if the form has been submitted
if (isset($_GET['category'])) {
    // Category filter logic
    $category_filter = $_GET['category'];

    $sql = "SELECT * FROM products";
    if (!empty($category_filter)) {
        $sql .= " WHERE category = '" . $conn->real_escape_string($category_filter) . "'";
    }

    $result = $conn->query($sql);

    // HTML output
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Stock Report</title>
    </head>
    <body>
        <h1>Stock Report</h1>
        <form action="reports.php" method="get">
            <label for="category">Filter by Category:</label>
            <select name="category" id="category">
                <option value="">All Categories</option>
                <?php
                $categories_sql = "SELECT DISTINCT category FROM products WHERE category IS NOT NULL AND category != ''";
                $categories_result = $conn->query($categories_sql);
                if ($categories_result && $categories_result->num_rows > 0) {
                    while ($category_row = $categories_result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($category_row['category']) . '">' . htmlspecialchars($category_row['category']) . '</option>';
                    }
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Generate Report">
        </form>
        <br>
        <?php
        if ($result && $result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>product_id</th><th>product_name</th><th>Category</th><th>current_stock</th></tr>';
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($row['product_id']) . '</td>';
                echo '<td>' . htmlspecialchars($row['product_name']) . '</td>';
                echo '<td>' . htmlspecialchars($row['category']) . '</td>';
                echo '<td>' . htmlspecialchars($row['current_stock']) . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'No products found.';
        }
        $conn->close();
        ?>
        <br>
        <a href="products.php">Back to Product List</a>
    </body>
    </html>
    <?php
} else {
    // Display the form only if it hasn't been submitted
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Stock Report</title>
    </head>
    <body>
        <h1>Stock Report</h1>
        <form action="reports.php" method="get">
            <label for="category">Filter by Category:</label>
            <select name="category" id="category">
                <option value="">All Categories</option>
                <?php
                $categories_sql = "SELECT DISTINCT category FROM products WHERE category IS NOT NULL AND category != ''";
                $categories_result = $conn->query($categories_sql);
                if ($categories_result && $categories_result->num_rows > 0) {
                    while ($category_row = $categories_result->fetch_assoc()) {
                        echo '<option value="' . htmlspecialchars($category_row['category']) . '">' . htmlspecialchars($category_row['category']) . '</option>';
                    }
                }
                ?>
            </select>
            <br><br>
            <input type="submit" value="Generate Report">
        </form>
        <br>
        <a href="products.php">Back to Product List</a>
    </body>
    </html>
    <?php
}
?>