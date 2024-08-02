

<?php  include "header.php" ?>

<?php
include 'db.php';

// Assuming the column is named `product_condition`
$sql = "SELECT product_name, model_no, COUNT(*) AS quantity
        FROM product_stock 
        GROUP BY product_name, model_no, warranty, product_condition";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Product Name</th>
                <th>Model No</th>
               
                <th>Quantity</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['product_name']}</td>
                <td>{$row['model_no']}</td>
               
                <td>{$row['quantity']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No products found";
}

$conn->close();
?>


<h2> Detail View </h2>

<?php
include 'db.php';

// Query to select all columns from the product_stock table
$sql = "SELECT serial_no, product_name, model_no, warranty, product_condition 
        FROM product_stock";

$result = $conn->query($sql);

if ($result->num_rows > 0) {


    echo "<table border='1'>
            <tr>
                <th>Serial No</th>
                <th>Product Name</th>
                <th>Model No</th>
                <th>Warranty</th>
                <th>Condition</th>
            </tr>";
    while($row = $result->fetch_assoc()) {

        $warranty_status = ($row['warranty'] > 0) ? 'Yes' : 'No';
        echo "<tr>
                <td>{$row['serial_no']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['model_no']}</td>

                <td>{$warranty_status}</td>
                <td>{$row['product_condition']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No products found";
}

$conn->close();
?>
<h1><a href ="view_product_service.php">Product list for service details</a></h1>
