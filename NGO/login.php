<?php
session_start();
require_once 'includes/config.php';

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_id'])) {
    header("Location: admin/dashboard.php");
    exit();
}

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'includes/db_connect.php';
    
    $username = sanitize_input($_POST['username']);
    $password = $_POST['password'];
    
    $sql = "SELECT id, username, password FROM admins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $admin = $result->fetch_assoc();
        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_user'] = $admin['username'];
            header("Location: admin/dashboard.php");
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | Compassion Hub</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .login-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .login-card h2 { margin-bottom: 30px; color: var(--secondary); }
        .form-group { margin-bottom: 20px; text-align: left; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; }
        .error-msg { color: var(--accent); margin-bottom: 20px; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-card" data-aos="zoom-in">
        <a href="index.php" style="display: inline-block; margin-bottom: 20px; color: var(--primary);">
            <i class="fas fa-hand-holding-heart fa-2x"></i>
        </a>
        <h2>Admin Portal</h2>
        
        <?php if ($error): ?>
            <div class="error-msg"><?php echo $error; ?></div>
        <?php endif; ?>
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Login</button>
        </form>
        
        <p style="margin-top: 20px; font-size: 0.85rem; color: var(--text-muted);">
            <a href="index.php">← Back to Website</a>
        </p>
    </div>
</div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
