<?php
require_once '../includes/auth_check.php';
require_once '../includes/config.php';
require_once '../includes/db_connect.php';

// Handle unread status or deletion
if(isset($_GET['read'])) {
    $id = intval($_GET['read']);
    $conn->query("UPDATE contact_messages SET is_read = 1 WHERE id = $id");
    header("Location: messages.php");
    exit();
}

if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contact_messages WHERE id = $id");
    header("Location: messages.php");
    exit();
}

$messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages | Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: var(--secondary); color: white; padding: 30px 20px; }
        .main-content { flex: 1; padding: 40px; background: #f0f2f5; }
        .sidebar-logo { font-size: 1.5rem; font-weight: 800; margin-bottom: 50px; display: flex; align-items: center; gap: 10px; }
        .nav-menu { list-style: none; }
        .nav-menu li { margin-bottom: 15px; }
        .nav-menu a { display: flex; align-items: center; gap: 10px; padding: 12px 15px; border-radius: 10px; opacity: 0.8; }
        .nav-menu a:hover, .nav-menu a.active { background: rgba(255,255,255,0.1); opacity: 1; }
        .message-card { background: white; padding: 25px; border-radius: 15px; margin-bottom: 20px; box-shadow: var(--shadow); border-left: 5px solid #ddd; }
        .message-card.unread { border-left-color: var(--primary); }
        .msg-header { display: flex; justify-content: space-between; margin-bottom: 15px; }
        .msg-body { color: #555; line-height: 1.6; }
        .msg-actions { margin-top: 20px; display: flex; gap: 15px; }
        .read-btn { color: var(--primary); font-weight: 600; cursor: pointer; }
        .delete-btn { color: var(--accent); cursor: pointer; }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <div>
                <h1 style="font-size: 1.8rem; color: var(--secondary);">Inquiry Messages</h1>
                <p style="color: var(--text-muted);">Respond to community queries.</p>
            </div>
            <div style="background: white; padding: 10px 25px; border-radius: 50px; font-weight: 600; box-shadow: var(--shadow); display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-user-circle" style="color: var(--primary);"></i>
                <span><?php echo $_SESSION['admin_user']; ?></span>
            </div>
        </header>
        
        <?php while($row = $messages->fetch_assoc()): ?>
        <div class="message-card <?php echo $row['is_read'] ? '' : 'unread'; ?>">
            <div class="msg-header">
                <div>
                    <strong><?php echo $row['name']; ?></strong> 
                    <span style="color: #999; margin: 0 10px;">•</span>
                    <span style="color: var(--text-muted);"><?php echo $row['email']; ?></span>
                </div>
                <div style="color: #999; font-size: 0.85rem;">
                    <?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?>
                </div>
            </div>
            <div style="font-weight: 700; margin-bottom: 10px; color: var(--secondary);">Subject: <?php echo $row['subject']; ?></div>
            <div class="msg-body">
                <?php echo nl2br($row['message']); ?>
            </div>
            <div class="msg-actions">
                <?php if(!$row['is_read']): ?>
                    <a href="?read=<?php echo $row['id']; ?>" class="read-btn"><i class="fas fa-check"></i> Mark as Read</a>
                <?php endif; ?>
                <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i> Delete</a>
            </div>
        </div>
        <?php endwhile; ?>
        
        <?php if($messages->num_rows == 0): ?>
            <div style="text-align: center; padding: 50px; color: #999;">No messages yet.</div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
