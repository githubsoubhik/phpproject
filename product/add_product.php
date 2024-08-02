<?php
 include "header.php";
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serial_no = $_POST['serial_no'];
    $product_name = $_POST['product_name'];
    $model_no = $_POST['model_no'];
    $warranty = $_POST['warranty'];
    $condition = $_POST['condition'];

    $stmt = $conn->prepare("INSERT INTO product_stock (serial_no, product_name, model_no, warranty, product_condition	) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $serial_no, $product_name, $model_no, $warranty, $condition);

    if ($stmt->execute()) {
        echo "New product added successfully";
        header("location:view_products.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();


}

?>
