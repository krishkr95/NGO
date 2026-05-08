<?php
require_once '../includes/auth_check.php';
require_once '../includes/config.php';
require_once '../includes/db_connect.php';

$donations = $conn->query("SELECT * FROM donations ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Records | Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .main-content { flex: 1; padding: 40px; background: #f0f2f5; }
        .data-table { width: 100%; border-collapse: collapse; background: white; border-radius: 15px; overflow: hidden; box-shadow: var(--shadow); }
        .data-table th, .data-table td { padding: 15px 20px; text-align: left; border-bottom: 1px solid #eee; }
        .data-table th { background: #f8f9fa; font-weight: 600; color: var(--secondary); }
        .status-badge { padding: 5px 12px; border-radius: 50px; font-size: 0.8rem; font-weight: 600; text-transform: uppercase; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-pending { background: #fff3cd; color: #856404; }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h2>Donation Records</h2>
        </header>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>Donor Name</th>
                    <th>Email</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $donations->fetch_assoc()): ?>
                <tr>
                    <td><strong><?php echo $row['donor_name']; ?></strong></td>
                    <td><?php echo $row['donor_email']; ?></td>
                    <td>₹ <?php echo number_format($row['amount']); ?></td>
                    <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                    <td>
                        <span class="status-badge status-<?php echo strtolower($row['payment_status']); ?>">
                            <?php echo $row['payment_status']; ?>
                        </span>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if($donations->num_rows == 0): ?>
                <tr><td colspan="5" style="text-align: center; color: #999;">No donation records found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
