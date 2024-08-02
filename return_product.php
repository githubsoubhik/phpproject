<?php
include 'db.php';

include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $serial_no = $_POST['serial_no'];
    $customer_name = $_POST['customer_name'];
    $branch_name = $_POST['branch_name'];
    $product_condition = $_POST['product_condition'];
    $return_date = $_POST['return_date'];

    // Start a transaction
    $conn->begin_transaction();

    // Insert into product_returns
    $stmt = $conn->prepare("INSERT INTO product_returns (serial_no, customer_name, branch_name, product_condition, return_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $serial_no, $customer_name, $branch_name, $product_condition, $return_date);
    if ($stmt->execute()) {
        // Update product_stock to mark the product as returned
        $stmt2 = $conn->prepare("UPDATE product_stock SET product_condition = ? WHERE serial_no = ?");
        $returned_condition = 'Returned';
        $stmt2->bind_param("ss", $returned_condition, $serial_no);
        if ($stmt2->execute()) {
            // Commit the transaction
            $conn->commit();

            // Fetch and display the details of the returned product
            $stmt3 = $conn->prepare("SELECT ps.serial_no, ps.product_name, ps.model_no, pr.customer_name, pr.branch_name, pr.product_condition, pr.return_date, ps.created_at 
                                     FROM product_returns pr 
                                     JOIN product_stock ps ON pr.serial_no = ps.serial_no 
                                     WHERE pr.serial_no = ?");
            $stmt3->bind_param("s", $serial_no);
            $stmt3->execute();
            $result = $stmt3->get_result();

            if ($result->num_rows > 0) {
                echo "<h2>Returned Product Details</h2>";
                echo "<table border='1'>
                        <tr>
                            <th>Serial No</th>
                            <th>Product Name</th>
                            <th>Model No</th>
                            <th>Customer Name</th>
                            <th>Branch Name</th>
                            <th>Product Condition</th>
                            <th>Return Date</th>
                            <th>Receive At</th>
                        </tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['serial_no']}</td>
                            <td>{$row['product_name']}</td>
                            <td>{$row['model_no']}</td>
                            <td>{$row['customer_name']}</td>
                            <td>{$row['branch_name']}</td>
                            <td>{$row['product_condition']}</td>
                            <td>{$row['return_date']}</td>
                            <td>{$row['created_at']}</td>
                          </tr>";
                }
                echo "</table>";
                echo "<form action='delete_product.php' method='POST'>
                        <input type='hidden' name='serial_no' value='$serial_no'>
                        <input type='submit' value='Delete from Main Stock'>
                      </form>";
            } else {
                echo "No details found for this product.";
            }

            $stmt3->close();
        } else {
            $conn->rollback();
            echo "Error: Could not update product condition in product_stock";
        }

        $stmt2->close();
    } else {
        $conn->rollback();
        echo "Error: Could not insert product into product_returns";
    }

    $stmt->close();
    $conn->close();
}
?>
