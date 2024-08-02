
<?php  include "header.php" ?>


<!DOCTYPE html>
<html>
<head>
    <title>Add Product and Service Details</title>
</head>
<body>
    <form action="" method="POST">
        <h2>Product Information</h2>
        <label>Serial No:</label><br>
        <input type="text" name="serial_no" required><br><br>

        <label>Product Name:</label><br>
        <input type="text" name="product_name" required><br><br>

        <label>Model No:</label><br>
        <input type="text" name="model_no" required><br><br>

        <label>Warranty:</label><br>
        <select name="warranty" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select><br><br>

        <label>Condition:</label><br>
        <select name="product_condition" required>
            <option value="Error-Free">Error-Free</option>
            <option value="Error">Error</option>
        </select><br><br>

        <h2>Service Information</h2>
        <label>Customer Name:</label><br>
        <input type="text" name="customer_name"><br><br>

        <label>Branch Name:</label><br>
        <input type="text" name="branch_name"><br><br>

        <label>Service Date:</label><br>
        <input type="date" name="service_date" required><br><br>

        <label>Error Description:</label><br>
        <textarea name="error_description" required></textarea><br><br>

        <label>Bill No:</label><br>
        <input type="text" name="bill_no" required><br><br>

        <input type="submit" value="Add Product and Service Details">
    </form>
</body>
</html>

<?php
include 'db.php';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Product Information
    $serial_no = $_POST['serial_no'];
    $product_name = $_POST['product_name'];
    $model_no = $_POST['model_no'];
    $warranty = $_POST['warranty'];
    $product_condition = $_POST['product_condition'];

    // Service Information
    $customer_name = $_POST['customer_name'];
    $branch_name = $_POST['branch_name'];
    $service_date = $_POST['service_date'];
    $error_description = $_POST['error_description'];
    $bill_no = $_POST['bill_no'];

    // Insert into product_stock
    $stmt1 = $conn->prepare("INSERT INTO product_stock (serial_no, product_name, model_no, warranty, product_condition) VALUES (?, ?, ?, ?, ?)");
    $stmt1->bind_param("sssis", $serial_no, $product_name, $model_no, $warranty, $product_condition);
    
    if ($stmt1->execute()) {
        // Insert into product_service only if product_stock insert is successful
        $stmt2 = $conn->prepare("INSERT INTO product_service (serial_no, customer_name, branch_name, service_date, error_description, bill_no) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt2->bind_param("ssssss", $serial_no, $customer_name, $branch_name, $service_date, $error_description, $bill_no);
        
        if ($stmt2->execute()) {
            echo "New product and service details added successfully";
            header("location:view_product_service.php");
        } else {
            echo "Error adding service details: " . $stmt2->error;
        }
        
        $stmt2->close();
    } else {
        echo "Error adding product: " . $stmt1->error;
    }

    $stmt1->close();
    $conn->close();
}
?>
