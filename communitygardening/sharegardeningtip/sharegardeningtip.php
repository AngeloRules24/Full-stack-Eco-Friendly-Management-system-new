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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_post'])) {
    $title = mysqli_real_escape_string($dbConn, $_POST['post_title']);
    $content = mysqli_real_escape_string($dbConn, $_POST['post_content']);
    $user_id = $_SESSION['user_id'];
    
    if (!empty($title) && !empty($content)) {
        $sql = "INSERT INTO gardeningtips (user_id, title, content, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = mysqli_prepare($dbConn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $title, $content);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Gardening tip created successfully!'); window.location.href = window.location.href;</script>";
        } else {
            echo "<script>alert('Error creating tip: " . mysqli_error($dbConn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'recent';

$posts = [];
$sql = "SELECT g.*, u.user_name,
        (SELECT COUNT(*) FROM post_likes WHERE tip_id = g.tip_id) as like_count
        FROM gardeningtips g 
        JOIN user u ON g.user_id = u.user_id ";

switch($filter) {
    case 'top_liked':
        $sql .= " ORDER BY like_count DESC, g.created_at DESC";
        break;
    case 'my_posts':
        $sql .= " WHERE g.user_id = ? ORDER BY g.created_at DESC";
        break;
    default: 
        $sql .= " ORDER BY g.created_at DESC";
        break;
}

$stmt = mysqli_prepare($dbConn, $sql);

if ($filter === 'my_posts') {
    $user_id = $_SESSION['user_id'];
    mysqli_stmt_bind_param($stmt, "i", $user_id);
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardening Forum</title>
    <link rel="stylesheet" href="sharegardeningtip.css">
</head>
<body>
    <section class="ForumSection">
        <h3>Gardening Forum</h3>
        <p class="ForumDesc">Community Discussions and Tips</p>
        
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-dropdown">
                <button class="filter-button" onclick="toggleFilter()">
                    <?php 
                    $filterLabels = [
                        'recent' => 'Most Recent',
                        'top_liked' => 'Top Liked', 
                        'my_posts' => 'My Posts'
                    ];
                    echo $filterLabels[$filter] ?? 'Filter Posts';
                    ?>
                </button>
                <div class="filter-options" id="filterOptions">
                    <a href="?filter=recent" class="filter-option <?php echo $filter === 'recent' ? 'active' : ''; ?>">
                        Most Recent
                    </a>
                    <a href="?filter=top_liked" class="filter-option <?php echo $filter === 'top_liked' ? 'active' : ''; ?>">
                        Top Liked
                    </a>
                    <a href="?filter=my_posts" class="filter-option <?php echo $filter === 'my_posts' ? 'active' : ''; ?>">
                        My Posts
                    </a>
                </div>
            </div>
            <div class="post-count">
                <?php echo count($posts); ?> post<?php echo count($posts) !== 1 ? 's' : ''; ?> found
            </div>
        </div>
        
        <!-- Display posts from database -->
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <article class="Post" onclick="viewPost(<?php echo $post['tip_id']; ?>)">
                    <div>
                        <h4><?php echo htmlspecialchars($post['title']); ?></h4>
                        <p><?php echo htmlspecialchars($post['user_name']); ?>. 
                           <?php echo date('j F Y', strtotime($post['created_at'])); ?>
                           <?php if ($filter === 'top_liked'): ?>
                               <span style="color: #4a7c59; margin-left: 10px;">👍 <?php echo $post['like_count'] ?? 0; ?> likes</span>
                           <?php endif; ?>
                        </p>
                    </div>
                    <button type="button" class="viewButton">View</button>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="text-align: center; padding: 40px; color: #666;">
                <p>
                    <?php if ($filter === 'my_posts'): ?>
                        You haven't created any posts yet.
                    <?php else: ?>
                        No posts found. Be the first to share!
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- New Post Popup Form -->
        <div class="popup-overlay" id="postPopup">
            <div class="popup-form">
                <h3>Create New Post</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="post_title">Post Title</label>
                        <input type="text" id="post_title" name="post_title" required 
                               placeholder="Enter your post title...">
                    </div>
                    
                    <div class="form-group">
                        <label for="post_content">Post Content</label>
                        <textarea id="post_content" name="post_content" required 
                                  placeholder="Share your gardening thoughts, questions, or tips..."></textarea>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="cancel-btn" onclick="closePostForm()">Cancel</button>
                        <button type="submit" class="submit-btn" name="submit_post">Create Post</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="newpost"> 
            <button type="button" class="newpostButton" onclick="openPostForm()">Add New Post</button>
        </div>
    </section>

    <script>
        function viewPost(postId) {
            window.location.href = 'postdetail.php?tip_id=' + postId;
        }

        function openPostForm() {
            document.getElementById('postPopup').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closePostForm() {
            document.getElementById('postPopup').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function toggleFilter() {
            document.getElementById('filterOptions').classList.toggle('show');
        }

        document.addEventListener('click', function(e) {
            const filterDropdown = document.querySelector('.filter-dropdown');
            if (!filterDropdown.contains(e.target)) {
                document.getElementById('filterOptions').classList.remove('show');
            }
        });

        document.getElementById('postPopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closePostForm();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closePostForm();
                document.getElementById('filterOptions').classList.remove('show');
            }
        });
    </script>

<?php include "../../footer.php"?>
</body>
</html>