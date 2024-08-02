

<?php  include "header.php" ?>

<?php
include 'db.php';



$sql = "SELECT serial_no, customer_name, branch_name, product_condition, return_date, created_at FROM product_returns";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Serial No</th>
                <th>Customer Name</th>
                <th>Branch Name</th>
                <th>Product Condition</th>
                <th>Return Date</th>
                <th>Receive At</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['serial_no']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['branch_name']}</td>
                <td>{$row['product_condition']}</td>
                <td>{$row['return_date']}</td>
                <td>{$row['created_at']}</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No returned products found";
}

$conn->close();
?>
