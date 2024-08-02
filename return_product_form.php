
<?php  include "header.php" ?>


<!DOCTYPE html>
<html>
<head>
    <title>Return Product</title>
</head>
<body>
    <form action="return_product.php" method="POST">
        <h2>Return Product Information</h2>
        <label>Serial No:</label><br>
        <input type="text" name="serial_no" required><br><br>

        <label>Customer Name:</label><br>
        <input type="text" name="customer_name"><br><br>

        <label>Branch Name:</label><br>
        <input type="text" name="branch_name"><br><br>

        <label>Product Condition:</label><br>
        <select name="product_condition" required>
            <option value="Solved">Solved</option>
            <option value="Replace">Replace</option>
            <option value="Error">Error</option>
            <option value="Error-Free">Error-Free</option>
        </select><br><br>

        <label>Return Date:</label><br>
        <input type="date" name="return_date" required><br><br>

        <input type="submit" value="Return Product">
    </form>
</body>
</html>
