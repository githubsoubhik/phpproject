<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serial_no = $_POST['serial_no'];

    // Start a transaction
    $conn->begin_transaction();

    // Delete from product_service
    $stmt1 = $conn->prepare("DELETE FROM product_service WHERE serial_no = ?");
    $stmt1->bind_param("s", $serial_no);
    if ($stmt1->execute()) {
        // Delete from product_returns
        $stmt2 = $conn->prepare("DELETE FROM product_returns WHERE serial_no = ?");
        $stmt2->bind_param("s", $serial_no);
        if ($stmt2->execute()) {
            // Delete from product_stock
            $stmt3 = $conn->prepare("DELETE FROM product_stock WHERE serial_no = ?");
            $stmt3->bind_param("s", $serial_no);
            if ($stmt3->execute()) {
                // Commit the transaction
                $conn->commit();
                echo "Product successfully deleted from all records.";
                header("location:view_products.php");
            } else {
                $conn->rollback();
                echo "Error: Could not delete from product_stock";
            }
            $stmt3->close();
        } else {
            $conn->rollback();
            echo "Error: Could not delete from product_returns";
        }
        $stmt2->close();
    } else {
        $conn->rollback();
        echo "Error: Could not delete from product_service";
    }

    $stmt1->close();
    $conn->close();
}
?>
