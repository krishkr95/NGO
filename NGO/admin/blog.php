<?php
require_once '../includes/auth_check.php';
require_once '../includes/config.php';
require_once '../includes/db_connect.php';

// Handle deletion
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM blog_posts WHERE id = $id");
    header("Location: blog.php");
    exit();
}

$posts = $conn->query("SELECT b.*, a.username as author_name FROM blog_posts b LEFT JOIN admins a ON b.author_id = a.id ORDER BY b.created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Blog | Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .main-content { flex: 1; padding: 40px; background: #f0f2f5; }
        .data-table { width: 100%; border-collapse: collapse; background: white; border-radius: 15px; overflow: hidden; box-shadow: var(--shadow); }
        .data-table th, .data-table td { padding: 15px 20px; text-align: left; border-bottom: 1px solid #eee; }
        .data-table th { background: #f8f9fa; font-weight: 600; color: var(--secondary); }
        .post-img { width: 50px; height: 50px; border-radius: 8px; object-fit: cover; }
        .btn-add { background: var(--primary); color: white; padding: 10px 20px; border-radius: 8px; font-weight: 600; }
        .actions-btn { display: flex; gap: 10px; }
        .edit-btn { color: var(--primary); }
        .delete-btn { color: var(--accent); }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px;">
            <h2>Blog Management</h2>
            <a href="blog_add.php" class="btn-add"><i class="fas fa-plus"></i> Add New Post</a>
        </header>
        
        <table class="data-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $posts->fetch_assoc()): ?>
                <tr>
                    <td><img src="<?php echo $row['image_url'] ?: 'https://via.placeholder.com/150'; ?>" class="post-img"></td>
                    <td>
                        <strong><?php echo $row['title']; ?></strong><br>
                        <small>By <?php echo $row['author_name']; ?></small>
                    </td>
                    <td><?php echo $row['category']; ?></td>
                    <td><?php echo date('M d, Y', strtotime($row['created_at'])); ?></td>
                    <td>
                        <div class="actions-btn">
                            <a href="blog_edit.php?id=<?php echo $row['id']; ?>" class="edit-btn"><i class="fas fa-edit"></i></a>
                            <a href="?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if($posts->num_rows == 0): ?>
                <tr><td colspan="5" style="text-align: center; color: #999;">No posts found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
