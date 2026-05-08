<?php
require_once '../includes/auth_check.php';
require_once '../includes/config.php';
require_once '../includes/db_connect.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = sanitize_input($_POST['title']);
    $category = sanitize_input($_POST['category']);
    $content = $_POST['content']; // Allowed for admin content
    $image_url = sanitize_input($_POST['image_url']);
    $author_id = $_SESSION['admin_id'];
    
    // Simple slug generation
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    
    if (!empty($title) && !empty($content)) {
        $sql = "INSERT INTO blog_posts (title, slug, content, image_url, category, author_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $title, $slug, $content, $image_url, $category, $author_id);
        
        if ($stmt->execute()) {
            $success = "Post added successfully!";
            header("refresh:2;url=blog.php");
        } else {
            $error = "Error adding post: " . $conn->error;
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
    <title>Add New Post | Admin</title>
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
            <h2 style="margin-top: 15px;">Add New Blog Post</h2>
        </header>
        
        <div class="form-card">
            <?php if($error): ?><div class="msg error"><?php echo $error; ?></div><?php endif; ?>
            <?php if($success): ?><div class="msg success"><?php echo $success; ?></div><?php endif; ?>
            
            <form action="" method="POST">
                <div class="form-group">
                    <label>Post Title</label>
                    <input type="text" name="title" required placeholder="Enter post title">
                </div>
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label>Category</label>
                        <select name="category">
                            <option value="News">News</option>
                            <option value="Success Story">Success Story</option>
                            <option value="Awareness">Awareness</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Image URL</label>
                        <input type="text" name="image_url" placeholder="Paste image link">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Content</label>
                    <textarea name="content" rows="10" required placeholder="Write your post content here..."></textarea>
                </div>
                
                <button type="submit" class="btn-primary" style="width: 100%; border: none; cursor: pointer;">Publish Post</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>
