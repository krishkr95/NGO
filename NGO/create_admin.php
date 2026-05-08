<?php
require_once 'includes/db_connect.php';

// Default credentials
$username = 'admin';
$password = 'admin123'; // Change this after first login
$email = 'admin@compassionhub.org';

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if admin already exists
$check = $conn->query("SELECT id FROM admins WHERE username = '$username'");

if ($check->num_rows == 0) {
    $sql = "INSERT INTO admins (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $hashed_password, $email);
    
    if ($stmt->execute()) {
        echo "Admin user created successfully!<br>";
        echo "Username: <strong>$username</strong><br>";
        echo "Password: <strong>$password</strong><br>";
        echo "<br><em>Please delete this file (create_admin.php) after running it for security.</em>";
    } else {
        echo "Error creating admin: " . $conn->error;
    }
} else {
    echo "Admin user already exists.";
}
?>
