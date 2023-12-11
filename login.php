<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Select query with condition
    $sql = "SELECT * FROM users WHERE email = '$email'";

    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Output data of each row
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
                // Passwords match, allow login
                // Access row data
                echo json_encode($row);
            } else {
                // Passwords don't match
                echo "notcorrect";
            }
    } else {
        echo "notfound";
    }
}

$conn->close();
?>
