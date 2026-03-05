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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_project'])) {
    $projectname = mysqli_real_escape_string($dbConn, $_POST['project_name']);
    $description = mysqli_real_escape_string($dbConn, $_POST['project_description']);
    $user_id = $_SESSION['user_id'];
    
    if (!empty($projectname) && !empty($description)) {
        $sql = "INSERT INTO gardeningprojects (user_id, projectname, description, created_at) VALUES (?, ?, ?, NOW())";
        $stmt = mysqli_prepare($dbConn, $sql);
        mysqli_stmt_bind_param($stmt, "iss", $user_id, $projectname, $description);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Gardening project created successfully!'); window.location.href = window.location.href;</script>";
        } else {
            echo "<script>alert('Error creating project: " . mysqli_error($dbConn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}

$filter = isset($_GET['filter']) ? $_GET['filter'] : 'recent';

$projects = [];
$user_id = $_SESSION['user_id'];

switch($filter) {
    case 'most_joined':
        $sql = "SELECT g.*, u.user_name,
                (SELECT COUNT(*) FROM project_participants WHERE garden_id = g.garden_id) as participants_count
                FROM gardeningprojects g 
                JOIN user u ON g.user_id = u.user_id 
                ORDER BY participants_count DESC, g.created_at DESC";
        $stmt = mysqli_prepare($dbConn, $sql);
        break;
        
    case 'my_projects':
        $sql = "SELECT g.*, u.user_name,
                (SELECT COUNT(*) FROM project_participants WHERE garden_id = g.garden_id) as participants_count
                FROM gardeningprojects g 
                JOIN user u ON g.user_id = u.user_id 
                WHERE g.user_id = ? 
                ORDER BY g.created_at DESC";
        $stmt = mysqli_prepare($dbConn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        break;
        
    case 'my_joined_projects':
        $sql = "SELECT g.*, u.user_name,
                (SELECT COUNT(*) FROM project_participants WHERE garden_id = g.garden_id) as participants_count
                FROM gardeningprojects g 
                JOIN user u ON g.user_id = u.user_id 
                JOIN project_participants pp ON g.garden_id = pp.garden_id 
                WHERE pp.user_id = ? 
                ORDER BY g.created_at DESC";
        $stmt = mysqli_prepare($dbConn, $sql);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        break;
        
    default: 
        $sql = "SELECT g.*, u.user_name,
                (SELECT COUNT(*) FROM project_participants WHERE garden_id = g.garden_id) as participants_count
                FROM gardeningprojects g 
                JOIN user u ON g.user_id = u.user_id 
                ORDER BY g.created_at DESC";
        $stmt = mysqli_prepare($dbConn, $sql);
        break;
}

mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $projects[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gardening Projects</title>
    <link rel="stylesheet" href="gardeningproject.css">
</head>
<body>
    <section class="ProjectSection">
        <h3>Gardening Projects</h3>
        <p class="ProjectDesc">Share and Explore Gardening Projects</p>
        
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-dropdown">
                <button class="filter-button" onclick="toggleFilter()">
                    <?php 
                    $filterLabels = [
                        'recent' => 'Most Recent',
                        'most_joined' => 'Most Joined', 
                        'my_projects' => 'My Projects',
                        'my_joined_projects' => 'My Joined Projects'
                    ];
                    echo $filterLabels[$filter] ?? 'Filter Projects';
                    ?>
                </button>
                <div class="filter-options" id="filterOptions">
                    <a href="?filter=recent" class="filter-option <?php echo $filter === 'recent' ? 'active' : ''; ?>">
                        Most Recent
                    </a>
                    <a href="?filter=most_joined" class="filter-option <?php echo $filter === 'most_joined' ? 'active' : ''; ?>">
                        Most Joined
                    </a>
                    <a href="?filter=my_projects" class="filter-option <?php echo $filter === 'my_projects' ? 'active' : ''; ?>">
                        My Projects
                    </a>
                    <a href="?filter=my_joined_projects" class="filter-option <?php echo $filter === 'my_joined_projects' ? 'active' : ''; ?>">
                        My Joined Projects
                    </a>
                </div>
            </div>
            <div class="project-count">
                <?php echo count($projects); ?> project<?php echo count($projects) !== 1 ? 's' : ''; ?> found
            </div>
        </div>
        
        <!-- Display projects from database -->
        <?php if (!empty($projects)): ?>
            <?php foreach ($projects as $project): ?>
                <article class="Project" onclick="viewProject(<?php echo $project['garden_id']; ?>)">
                    <div>
                        <h4><?php echo htmlspecialchars($project['projectname']); ?></h4>
                        <p><?php echo htmlspecialchars($project['user_name']); ?>. 
                           <?php echo date('j F Y', strtotime($project['created_at'])); ?>
                           <?php if ($filter === 'most_joined'): ?>
                               <span style="color: #4a7c59; margin-left: 10px;">👥 <?php echo $project['participants_count'] ?? 0; ?> joined</span>
                           <?php endif; ?>
                        </p>
                    </div>
                    <button type="button" class="viewButton">View</button>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="empty-state">
                <p>
                    <?php 
                    if ($filter === 'my_projects') {
                        echo "You haven't created any projects yet.";
                    } elseif ($filter === 'my_joined_projects') {
                        echo "You haven't joined any projects yet.";
                    } else {
                        echo "No projects found. Be the first to share!";
                    }
                    ?>
                </p>
            </div>
        <?php endif; ?>

        <!-- New Project Popup Form -->
        <div class="popup-overlay" id="projectPopup">
            <div class="popup-form">
                <h3>Create New Project</h3>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="project_name">Project Name</label>
                        <input type="text" id="project_name" name="project_name" required 
                               placeholder="Enter your project name...">
                    </div>
                    
                    <div class="form-group">
                        <label for="project_description">Project Description</label>
                        <textarea id="project_description" name="project_description" required 
                                  placeholder="Describe your gardening project..."></textarea>
                    </div>
                    
                    <div class="form-buttons">
                        <button type="button" class="cancel-btn" onclick="closeProjectForm()">Cancel</button>
                        <button type="submit" class="submit-btn" name="submit_project">Create Project</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="newproject"> 
            <button type="button" class="newprojectButton" onclick="openProjectForm()">Add New Project</button>
        </div>
    </section>

    <script>
        function viewProject(projectId) {
            window.location.href = 'projectdetail.php?garden_id=' + projectId;
        }

        function openProjectForm() {
            document.getElementById('projectPopup').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeProjectForm() {
            document.getElementById('projectPopup').style.display = 'none';
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

        document.getElementById('projectPopup').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProjectForm();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeProjectForm();
                document.getElementById('filterOptions').classList.remove('show');
            }
        });
    </script>


</body>
</html>

<?php include "../../footer.php"?>