<?php
session_start();
require_once 'includes/db_connect.php';

$response = ['status' => 'error', 'message' => 'Something went wrong.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = sanitize_input($_POST['full_name']);
    $email = sanitize_input($_POST['email']);
    $phone = sanitize_input($_POST['phone']);
    $interests = sanitize_input($_POST['interests']);
    $message = sanitize_input($_POST['message']);
    
    if (!empty($full_name) && !empty($email) && !empty($phone)) {
        $sql = "INSERT INTO volunteers (full_name, email, phone, interests, message) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $full_name, $email, $phone, $interests, $message);
        
        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Registration successful! We will contact you soon.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Database error: Unable to register.'];
        }
        $stmt->close();
    } else {
        $response = ['status' => 'error', 'message' => 'Please fill in all required fields.'];
    }
}

echo json_encode($response);
?>
