<?php
require_once '../includes/auth_check.php';
require_once '../includes/config.php';
require_once '../includes/db_connect.php';

// Handle status updates or deletions if needed
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM volunteers WHERE id = $id");
    header("Location: volunteers.php");
    exit();
}

$volunteers = $conn->query("SELECT * FROM volunteers ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Applications | Compassion Hub</title>
    <link rel="stylesheet" href="assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<div class="admin-container">
    <?php include 'includes/sidebar.php'; ?>
    
    <main class="main-wrapper">
        <header class="page-header">
            <div class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </div>
            <div class="page-title">
                <h1>Volunteer Applications</h1>
                <p>Manage and review the heartbeat of our organization.</p>
            </div>
            <div class="user-profile">
                <i class="fas fa-user-circle" style="color: var(--admin-secondary); font-size: 1.2rem;"></i>
                <span><?php echo $_SESSION['admin_user']; ?></span>
            </div>
        </header>
        
        <div class="table-container">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Contact Detail</th>
                        <th>Interest Area</th>
                        <th>Status</th>
                        <th>Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $volunteers->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <div style="font-weight: 700;"><?php echo $row['full_name']; ?></div>
                            <div style="font-size: 0.8rem; color: var(--admin-text-muted);"><?php echo $row['phone']; ?></div>
                        </td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['interests']; ?></td>
                        <td>
                            <span class="badge badge-info"><?php echo $row['status']; ?></span>
                        </td>
                        <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                <a href="?delete=<?php echo $row['id']; ?>" class="action-btn delete" onclick="return confirm('Remove this application?')">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                                <button class="action-btn" title="View Message" onclick="alert('<?php echo addslashes($row['message']); ?>')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                    <?php if($volunteers->num_rows == 0): ?>
                    <tr><td colspan="6" style="text-align: center; color: var(--admin-text-muted);">No applications found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<script>
    document.getElementById('mobileToggle').addEventListener('click', function() {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>

</body>
</html>
