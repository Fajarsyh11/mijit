<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['cust_id'];
    $order_date = $_POST['order_date'];
    $price = $_POST['price'];
    $order_type = $_POST['order_type'];
    $order_time = $_POST['order_time'];
    $payment = 'N';
    $approved = 'N';
    $del = 'N';

    $sql = "INSERT INTO orders (customer_id, order_date, order_time, price, order_type, payment, approved, del) VALUES ($customer_id, '$order_date', '$order_time', '$price', '$order_type', '$payment', '$approved', '$del')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the auto-generated ID of the inserted row
        $lastInsertedId = $conn->insert_id;
        $sql2 = "INSERT INTO customers (customer_id, order_id, order_date, order_time, price, order_type, payment, approved) VALUES ($customer_id, $lastInsertedId, '$order_date', '$order_time', '$price', '$order_type', '$payment', '$approved')";
        if($conn->query($sql2) === TRUE){

        } else {
            echo "error";
        }
    } else {
        echo "error";
    }
}

$conn->close();
?>