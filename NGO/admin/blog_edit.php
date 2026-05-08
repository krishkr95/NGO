<?php
require_once '../includes/auth_check.php';
require_once '../includes/config.php';
require_once '../includes/db_connect.php';

$error = "";
$success = "";

if (!isset($_GET['id'])) {
    header("Location: blog.php");
    exit();
}

$id = intval($_GET['id']);
$post = $conn->query("SELECT * FROM blog_posts WHERE id = $id")->fetch_assoc();

if (!$post) {
    header("Location: blog.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST['title']);
    $category = sanitize_input($_POST['category']);
    $content = $_POST['content'];
    $image_url = sanitize_input($_POST['image_url']);
    
    if (!empty($title) && !empty($content)) {
        $sql = "UPDATE blog_posts SET title = ?, content = ?, image_url = ?, category = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $title, $content, $image_url, $category, $id);
        
        if ($stmt->execute()) {
            $success = "Post updated successfully!";
            $post = $conn->query("SELECT * FROM blog_posts WHERE id = $id")->fetch_assoc();
        } else {
            $error = "Error updating post: " . $conn->error;
        }
    } else {
        $error = "Please fill in all fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post | Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-layout { display: flex; min-height: 100vh; }
        .main-content { flex: 1; padding: 40px; background: #f0f2f5; }
        .form-card { background: white; padding: 40px; border-radius: 20px; box-shadow: var(--shadow); max-width: 800px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; }
        .form-group input, .form-group select, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px; font-family: inherit; }
        .msg { padding: 15px; border-radius: 8px; margin-bottom: 20px; }
        .error { background: #f8d7da; color: #721c24; }
        .success { background: #d4edda; color: #155724; }
    </style>
</head>
<body>

<div class="admin-layout">
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <header style="margin-bottom: 40px;">
            <a href="blog.php" style="color: var(--primary);"><i class="fas fa-arrow-left"></i> Back to List</a>
            <h2 style="margin-top: 15px;">Edit Blog Post</h2>
        </header>
        
        <div class="form-card">
            <?php if($error): ?><div class="msg error"><?php echo $error; ?></div><?php endif; ?>
            <?php if($success): ?><div class="msg success"><?php echo $success; ?></div><?php endif; ?>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label>Post Title</label>
                    <input type="text" name="title" required value="<?php echo htmlspecialchars($post['title']); ?>">
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category">
                            <option value="News" <?php echo $post['category'] == 'News' ? 'selected' : ''; ?>>News</option>
                            <option value="Success Story" <?php echo $post['category'] == 'Success Story' ? 'selected' : ''; ?>>Success Story</option>
                            <option value="Awareness" <?php echo $post['category'] == 'Awareness' ? 'selected' : ''; ?>>Awareness</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image URL</label>
                        <input type="text" name="image_url" value="<?php echo htmlspecialchars($post['image_url']); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" rows="10" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                </div>
                
                <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Update Post</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
