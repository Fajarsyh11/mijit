<?php
include "connection.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $sex = $_POST['sex'];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password, sex, name) VALUES ('$email', '$hashed_password', '$sex', '$name')";

    if ($conn->query($sql) === TRUE) {
        // Retrieve the auto-generated ID of the inserted row
        $lastInsertedId = $conn->insert_id;
        echo $lastInsertedId;
    } else {
        echo "error";
    }
}

$conn->close();
?>