<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id']; // order ID
    $approved = 'D';
    $del = 'Y';

    // Prepare and execute the UPDATE statement
    $sql = "UPDATE orders SET approved = ?, del = ? WHERE id = ? ";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("ssi",$approved, $del, $order_id);
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        $sql2 = "UPDATE customers SET approved = ? WHERE order_id = ?";
        $stmt2 = $conn->prepare($sql2);

        
        $stmt2->bind_param("si",$approved, $order_id);
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