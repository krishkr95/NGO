<?php
// Get current page name to set active class
$current_page = basename($_SERVER['PHP_SELF']);
?>
<div class="admin-sidebar" id="sidebar">
    <div class="sidebar-brand">
        <i class="fas fa-hand-holding-heart"></i>
        <span>Compassion Hub</span>
    </div>
    <ul class="sidebar-nav">
        <li>
            <a href="dashboard.php" class="<?php echo $current_page == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="fas fa-grid-2"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="volunteers.php" class="<?php echo $current_page == 'volunteers.php' ? 'active' : ''; ?>">
                <i class="fas fa-users"></i> Volunteers
            </a>
        </li>
        <li>
            <a href="donations.php" class="<?php echo $current_page == 'donations.php' ? 'active' : ''; ?>">
                <i class="fas fa-hand-holding-usd"></i> Donations
            </a>
        </li>
        <li>
            <a href="blog.php" class="<?php echo $current_page == 'blog.php' || strpos($current_page, 'blog_') !== false ? 'active' : ''; ?>">
                <i class="fas fa-newspaper"></i> Articles
            </a>
        </li>
        <li>
            <a href="messages.php" class="<?php echo $current_page == 'messages.php' ? 'active' : ''; ?>">
                <i class="fas fa-envelope"></i> Messages
            </a>
        </li>
    </ul>
    <div class="sidebar-footer">
        <ul class="sidebar-nav">
            <li>
                <a href="../logout.php" class="logout-link">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </li>
        </ul>
    </div>
</div>
