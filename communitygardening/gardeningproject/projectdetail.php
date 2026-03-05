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

$garden_id = isset($_GET['garden_id']) ? intval($_GET['garden_id']) : 0;

$project = null;
if ($garden_id > 0) {
    $sql = "SELECT g.*, u.user_name,
            (SELECT COUNT(*) FROM project_participants WHERE garden_id = g.garden_id) as participants_count
            FROM gardeningprojects g 
            JOIN user u ON g.user_id = u.user_id 
            WHERE g.garden_id = ?";
    $stmt = mysqli_prepare($dbConn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $garden_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $project = mysqli_fetch_assoc($result);
    }
}

if (!$project) {
    header("Location: gardeningprojects.php");
    exit();
}

$is_owner = ($project['user_id'] == $_SESSION['user_id']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['join_project'])) {
    $user_id = $_SESSION['user_id'];
    
    $check_sql = "SELECT * FROM project_participants WHERE garden_id = ? AND user_id = ?";
    $check_stmt = mysqli_prepare($dbConn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "ii", $garden_id, $user_id);
    mysqli_stmt_execute($check_stmt);
    $join_result = mysqli_stmt_get_result($check_stmt);
    
    if (mysqli_num_rows($join_result) == 0) {
        $insert_sql = "INSERT INTO project_participants (garden_id, user_id) VALUES (?, ?)";
        $insert_stmt = mysqli_prepare($dbConn, $insert_sql);
        mysqli_stmt_bind_param($insert_stmt, "ii", $garden_id, $user_id);
        
        if (mysqli_stmt_execute($insert_stmt)) {
            header("Location: projectdetail.php?garden_id=" . $garden_id . "&action=joined");
            exit();
        } else {
            $error_message = 'Error joining project. Please try again.';
        }
    } else {
        $error_message = 'You have already joined this project!';
    }
}

$user_joined = false;
if ($garden_id > 0) {
    $user_id = $_SESSION['user_id'];
    $check_sql = "SELECT * FROM project_participants WHERE garden_id = ? AND user_id = ?";
    $check_stmt = mysqli_prepare($dbConn, $check_sql);
    mysqli_stmt_bind_param($check_stmt, "ii", $garden_id, $user_id);
    mysqli_stmt_execute($check_stmt);
    $join_result = mysqli_stmt_get_result($check_stmt);
    $user_joined = mysqli_num_rows($join_result) > 0;
}

$success_message = '';
$error_message = $error_message ?? '';
if (isset($_GET['action'])) {
    if ($_GET['action'] === 'joined') {
        $success_message = 'You have successfully joined this project!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($project['projectname']); ?> - Gardening Project</title>
    <link rel="stylesheet" href="projectdetail.css">
</head>
<body>
    <section class="ProjectDetailSection">
        <div class="back-button">
            <a href="gardeningproject.php">&larr; Back to Projects</a>
        </div>
        
        <?php if ($success_message): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error_message): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error_message); ?>
            </div>
        <?php endif; ?>
        
        <article class="ProjectDetail">
            <header class="project-header">
                <h1><?php echo htmlspecialchars($project['projectname']); ?></h1>
                <div class="project-meta">
                    <span class="author">By <?php echo htmlspecialchars($project['user_name']); ?></span>
                    <span class="divider">•</span>
                    <span class="date"><?php echo date('j F Y', strtotime($project['created_at'])); ?></span>
                    <span class="divider">•</span>
                    <span class="participants">👥 <?php echo $project['participants_count'] ?? 0; ?> people joined</span>
                </div>
            </header>
            
            <div class="project-content">
                <h3>Project Description</h3>
                <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
            </div>
            
            <footer class="project-actions">
                <?php if (!$is_owner): ?>
                    <?php if (!$user_joined): ?>
                        <form method="POST" action="" class="join-form">
                            <button type="submit" name="join_project" class="join-button join">
                                <span class="button-icon">👥</span>
                                <span class="button-text">Join Project</span>
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="joined-status">
                            <button type="button" class="join-button joined" disabled>
                                <span class="button-icon">✅</span>
                                <span class="button-text">Joined</span>
                            </button>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php if ($is_owner): ?>
                        <div class="owner-actions">
                            <!-- Display list of users who joined this project -->
                            <div class="participants-list">
                                <h4>Users who joined this project:</h4>
                                <?php
                                $participants_sql = "SELECT u.user_name 
                                                    FROM project_participants pp 
                                                    JOIN user u ON pp.user_id = u.user_id 
                                                    WHERE pp.garden_id = ?";
                                $participants_stmt = mysqli_prepare($dbConn, $participants_sql);
                                mysqli_stmt_bind_param($participants_stmt, "i", $garden_id);
                                mysqli_stmt_execute($participants_stmt);
                                $participants_result = mysqli_stmt_get_result($participants_stmt);
                                
                                if ($participants_result && mysqli_num_rows($participants_result) > 0): ?>
                                    <ul class="joined-users">
                                        <?php while ($participant = mysqli_fetch_assoc($participants_result)): ?>
                                            <li><?php echo htmlspecialchars($participant['user_name']); ?></li>
                                        <?php endwhile; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>No users have joined this project yet.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                <?php endif; ?>
            </footer>
        </article>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successMessage = document.querySelector('.success-message');
            const errorMessage = document.querySelector('.error-message');
            
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.opacity = '0';
                    setTimeout(() => {
                        successMessage.remove();
                    }, 300);
                }, 5000);
            }
            
            if (errorMessage) {
                setTimeout(() => {
                    errorMessage.style.opacity = '0';
                    setTimeout(() => {
                        errorMessage.remove();
                    }, 300);
                }, 5000);
            }
        });
    </script>

<?php include "../../footer.php"?>
</body>
</html>