<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer_id = $_POST['customer_id'];

    // Select query with condition
    $sql = "SELECT * FROM customers WHERE customer_id = $customer_id and payment = 'Y' and approved = 'Y'";

    $result = $conn->query($sql);

    $data = array();

    if ($result && $result->num_rows > 0) {
       // Fetch data from each row and store it in an array
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        // Send the retrieved data as JSON response
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {
        echo "notfound";
    }
}

$conn->close();
?>
