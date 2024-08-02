

<?php  include "header.php" ?>
<?php
include 'db.php';

$sql = "SELECT * FROM product_service";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Serial No</th>
                <th>Customer Name</th>
                <th>Branch Name</th>
                <th>Service Date</th>
                <th>Error Description</th>
                <th>Bill No</th>
             
            </tr>";
    while($row = $result->fetch_assoc()) {
       
        echo "<tr>
                <td>{$row['serial_no']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['branch_name']}</td>
                <td>{$row['service_date']}</td>
                <td>{$row['error_description']}</td>
                <td>{$row['bill_no']}</td>
              
              </tr>";
    }
    echo "</table>";
} else {
    echo "No service records found";
}

$conn->close();
?>


<a href="view_products.php">View Main Stock</a>