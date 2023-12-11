<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id']; // order ID
    // Prepare and execute the DELETE statement
    $sql = "DELETE FROM customers WHERE order_id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters and execute the statement
    $stmt->bind_param("i", $order_id); // Assuming ID is an integer (change "i" if it's another type)
    $stmt->execute();

    // Check if the update was successful
    if ($stmt->affected_rows > 0) {
        echo "success";
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