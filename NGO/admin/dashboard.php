<?php
require_once '../includes/auth_check.php';
require_once '../includes/config.php';
require_once '../includes/db_connect.php';

// Get counts for dashboard stats
$volunteer_count = $conn->query("SELECT COUNT(*) as total FROM volunteers")->fetch_assoc()['total'];
$donation_total = $conn->query("SELECT SUM(amount) as total FROM donations WHERE payment_status = 'completed'")->fetch_assoc()['total'];
$message_count = $conn->query("SELECT COUNT(*) as total FROM contact_messages WHERE is_read = 0")->fetch_assoc()['total'];
$blog_count = $conn->query("SELECT COUNT(*) as total FROM blog_posts")->fetch_assoc()['total'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Compassion Hub</title>
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
                <h1>Welcome back, Admin!</h1>
                <p>Here's what's happening today at Compassion Hub.</p>
            </div>
            <div class="user-profile">
                <i class="fas fa-user-circle" style="color: var(--admin-secondary); font-size: 1.2rem;"></i>
                <span><?php echo $_SESSION['admin_user']; ?></span>
            </div>
        </header>
        
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(29, 53, 87, 0.1); color: var(--admin-primary);">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-info">
                    <p>Total Revenue</p>
                    <h2>₹ <?php echo number_format($donation_total ?: 0); ?></h2>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(69, 123, 157, 0.1); color: var(--admin-secondary);">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <p>Volunteers</p>
                    <h2><?php echo number_format($volunteer_count ?: 0); ?></h2>
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-icon" style="background: rgba(230, 57, 70, 0.1); color: var(--admin-accent);">
                    <i class="fas fa-comment-alt"></i>
                </div>
                <div class="stat-info">
                    <p>Unread Messages</p>
                    <h2><?php echo number_format($message_count ?: 0); ?></h2>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon" style="background: #e0f2ff; color: #0070c9;">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="stat-info">
                    <p>Blog Articles</p>
                    <h2><?php echo number_format($blog_count ?: 0); ?></h2>
                </div>
            </div>
        </div>
        
        <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 30px;">
            <div class="table-container">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                    <h3 style="font-weight: 700;">System Overview</h3>
                    <a href="donations.php" style="color: var(--admin-secondary); font-weight: 600; text-decoration: none; font-size: 0.9rem;">View All <i class="fas fa-arrow-right"></i></a>
                </div>
                <p style="color: var(--admin-text-muted); line-height: 1.6;">
                    Compassion Hub management system is active. All modules are running optimally. 
                    Monitor collective efforts and manage community engagement from this central dashboard. 
                    Donations are being processed securely, and new volunteer applications appear instantly in the dedicated tab.
                </p>
                
                <div style="margin-top: 30px; display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div style="background: #f8fbff; padding: 20px; border-radius: 12px; border-left: 4px solid var(--admin-primary);">
                        <p style="font-size: 0.8rem; font-weight: 700; color: var(--admin-primary); margin-bottom: 5px;">SERVER STATUS</p>
                        <span class="badge badge-success">Online</span>
                    </div>
                    <div style="background: #f8fbff; padding: 20px; border-radius: 12px; border-left: 4px solid var(--admin-secondary);">
                        <p style="font-size: 0.8rem; font-weight: 700; color: var(--admin-secondary); margin-bottom: 5px;">DB CONNECTIVITY</p>
                        <span class="badge badge-success">Active</span>
                    </div>
                </div>
            </div>
            
            <div class="table-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; gap: 20px; background: var(--admin-primary); color: white;">
                <div style="width: 80px; height: 80px; background: rgba(255,255,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 2rem;">
                    <i class="fas fa-rocket"></i>
                </div>
                <h3>Quick Actions</h3>
                <div style="display: flex; flex-direction: column; gap: 10px; width: 100%;">
                    <a href="blog_add.php" class="btn-admin" style="background: white; color: var(--admin-primary); width: 100%; justify-content: center;">
                        <i class="fas fa-plus"></i> New Article
                    </a>
                    <a href="../index.php" target="_blank" class="btn-admin" style="background: rgba(255,255,255,0.1); color: white; border: 1px solid rgba(255,255,255,0.2); width: 100%; justify-content: center;">
                        <i class="fas fa-external-link-alt"></i> View Site
                    </a>
                </div>
            </div>
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

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>AOS.init();</script>
</body>
</html>
