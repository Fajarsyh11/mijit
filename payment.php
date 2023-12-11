<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id']) && isset($_POST['customer_id'])) {
    $order_id = $_POST['order_id']; // order ID
    $customer_id = $_POST['customer_id']; // customer ID
    $payment = 'Y';

    // Prepare and execute the UPDATE statement
    $sql = "UPDATE customers SET payment = ? WHERE order_id = ? and customer_id = ? ";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("sii",$payment, $order_id, $customer_id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        // Prepare and execute the UPDATE statement
        $sql2 = "UPDATE orders SET payment = ? WHERE id = ? and customer_id = ? ";
        $stmt2 = $conn->prepare($sql2);

        // Bind parameters and execute the statement
        $stmt2->bind_param("sii",$payment, $order_id, $customer_id);
        $stmt2->execute();

        // Check if the update was successful
        if ($stmt2->affected_rows > 0) {
            echo "success";
        } else {
            echo "norecord";
        }
    } else {
        echo "norecord";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "error";
}

// Close the database connection
$conn->close();
?>