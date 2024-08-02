

<?php  include "header.php" ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
</head>
<body>

<h1> Main Stock Add Product</h1>
    <form action="add_product.php" method="POST">
        <label>Serial No:</label><br>
        <input type="text" name="serial_no" required><br><br>

        <label>Product Name:</label><br>
        <input type="text" name="product_name" required><br><br>

        <label>Model No:</label><br>
        <input type="text" name="model_no" required><br><br>

        
        
        <label>Warranty:</label><br>
        <select name="warranty" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select><br><br><br>

        <label>Condition:</label><br>
        <select name="condition" required>
            <option value="Error-Free">Error-Free</option>
            <option value="Error">Error</option>
        </select><br><br>

        <input type="submit" value="Add Product">
    </form>


    

</body>
</html>
