<?php
ob_start();
$base_path = '/rwdd/RWDD group assignment/'; 
include "../../header.php";
include "../../conn.php";

if (!isset($_SESSION['user_id'])) {
    header("Location:" . $base_path . "signinsignup/login.php");
    ob_end_flush();
    exit();
}

$tip_id = isset($_GET['tip_id']) ? intval($_GET['tip_id']) : 0;

if ($tip_id <= 0) {
    header("Location: sharegardeningtip.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_comment'])) {
    $comment_text = mysqli_real_escape_string($dbConn, $_POST['comment_text']);
    $user_id = $_SESSION['user_id'];
    
    if (!empty($comment_text)) {
        $sql = "INSERT INTO post_comments (tip_id, user_id, comment_text, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = mysqli_prepare($dbConn, $sql);
        mysqli_stmt_bind_param($stmt, "iis", $tip_id, $user_id, $comment_text);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Comment added successfully!'); window.location.href = window.location.href;</script>";
        } else {
            echo "<script>alert('Error adding comment: " . mysqli_error($dbConn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please enter a comment');</script>";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_like'])) {
    $user_id = $_SESSION['user_id'];
    
    $check_sql = "SELECT * FROM post_likes WHERE tip_id = ? AND user_id = ?";
    $check_stmt = mysqli_prepare($dbConn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "ii", $tip_id, $user_id);
    mysqli_stmt_execute($check_stmt);
    $check_result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($check_result) > 0) {
        echo "<script>alert('You have already liked this post!');</script>";
    } else {
        $like_sql = "INSERT INTO post_likes (tip_id, user_id, created_at) VALUES (?, ?, NOW())";
        $like_stmt = mysqli_prepare($dbConn, $like_sql);
        mysqli_stmt_bind_param($like_stmt, "ii", $tip_id, $user_id);
        
        if (mysqli_stmt_execute($like_stmt)) {
            echo "<script>alert('Post liked!'); window.location.href = window.location.href;</script>";
        } else {
            echo "<script>alert('Error liking post: " . mysqli_error($dbConn) . "');</script>";
        }
    }
}

$sql = "SELECT g.*, u.user_name,
        (SELECT COUNT(*) FROM post_likes WHERE tip_id = g.tip_id) as like_count,
        (SELECT COUNT(*) FROM post_likes WHERE tip_id = g.tip_id AND user_id = ?) as user_liked
        FROM gardeningtips g 
        JOIN user u ON g.user_id = u.user_id 
        WHERE g.tip_id = ?";
$stmt = mysqli_prepare($dbConn, $sql);
$user_id = $_SESSION['user_id'];
mysqli_stmt_bind_param($stmt, "ii", $user_id, $tip_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    echo "<script>alert('Post not found!'); window.location.href = 'sharegardeningtip.php';</script>";
    exit();
}

$user_has_liked = ($post['user_liked'] > 0);

$comments = [];
$sql_comments = "SELECT c.*, u.user_name 
                 FROM post_comments c 
                 JOIN user u ON c.user_id = u.user_id 
                 WHERE c.tip_id = ? 
                 ORDER BY c.created_at ASC";
$stmt_comments = mysqli_prepare($dbConn, $sql_comments);
mysqli_stmt_bind_param($stmt_comments, "i", $tip_id);
mysqli_stmt_execute($stmt_comments);
$result_comments = mysqli_stmt_get_result($stmt_comments);

if ($result_comments && mysqli_num_rows($result_comments) > 0) {
    while ($row = mysqli_fetch_assoc($result_comments)) {
        $comments[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> | Gardening Forum</title>
    <link rel="stylesheet" href="postdetail.css">
</head>
<body>
    <div class="post-detail-container">
        <header class="post-header">
            <h1><?php echo htmlspecialchars($post['title']); ?></h1>
            <div class="post-meta">
                <div class="author-info">
                    <div class="author-avatar">
                        <?php echo strtoupper(substr($post['user_name'], 0, 1)); ?>
                    </div>
                    <span>By <?php echo htmlspecialchars($post['user_name']); ?></span>
                </div>
                <div class="post-date">
                    Posted on <?php echo date('j F Y \a\t g:i A', strtotime($post['created_at'])); ?>
                </div>
            </div>
            <div class="post-content">
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
        </div>
        </header>

        

        <!-- Post Stats -->
        <div class="post-stats">
            <div class="stat-item">
                <span class="stat-icon">👍</span>
                <span class="stat-count"><?php echo $post['like_count'] ?? 0; ?> likes</span>
            </div>
            <div class="stat-item">
                <span class="stat-icon">💬</span>
                <span class="stat-count"><?php echo count($comments); ?> comments</span>
            </div>
        </div>

        <!-- Comments Section -->
        <section class="comments-section">
            <h2>Comments (<?php echo count($comments); ?>)</h2>
            
            <!-- Comments List -->
            <div class="comments-list">
                <?php if (!empty($comments)): ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <div class="comment-header">
                                <div class="comment-avatar">
                                    <?php echo strtoupper(substr($comment['user_name'], 0, 1)); ?>
                                </div>
                                <div>
                                    <div class="comment-author"><?php echo htmlspecialchars($comment['user_name']); ?></div>
                                    <div class="comment-date">
                                        <?php echo date('j M Y \a\t g:i A', strtotime($comment['created_at'])); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="comment-text">
                                <?php echo nl2br(htmlspecialchars($comment['comment_text'])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="no-comments">
                        <p>No comments yet. Be the first to comment!</p>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Comment Form -->
            <div class="comment-form">
                <h3>Add a Comment</h3>
                <form method="POST" action="">
                    <textarea name="comment_text" placeholder="Share your thoughts, ask questions, or provide additional tips..." required></textarea>
                    <button type="submit" name="submit_comment" class="submit-comment">Post Comment</button>
                </form>
            </div>
        </section>

        <footer class="action-buttons">
            <a href="sharegardeningtip.php" class="back-button">← Back to Forum</a>
            <div class="like-section">
                <?php if ($user_has_liked): ?>
                    <button class="like-button liked" disabled>👍 Liked</button>
                <?php else: ?>
                    <form method="POST" action="" style="display: inline;">
                        <input type="hidden" name="submit_like" value="1">
                        <button type="submit" class="like-button">👍 Like</button>
                    </form>
                <?php endif; ?>
            </div>
        </footer>
    </div>

<?php include "../../footer.php"?>
</body>
</html>