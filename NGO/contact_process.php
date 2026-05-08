<?php
session_start();
require_once 'includes/db_connect.php';

$response = ['status' => 'error', 'message' => 'Something went wrong.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = sanitize_input($_POST['name']);
    $email = sanitize_input($_POST['email']);
    $subject = sanitize_input($_POST['subject']);
    $message = sanitize_input($_POST['message']);
    
    if (!empty($name) && !empty($email) && !empty($message)) {
        $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            $response = ['status' => 'success', 'message' => 'Thank you! Your message has been sent successfully.'];
        } else {
            $response = ['status' => 'error', 'message' => 'Database error: Unable to save message.'];
        }
        $stmt->close();
    } else {
        $response = ['status' => 'error', 'message' => 'Please fill in all required fields.'];
    }
}

echo json_encode($response);
?>
