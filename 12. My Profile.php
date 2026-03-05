<?php
include "header.php";
include "conn.php";
include "basepath.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


// Get user data
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($dbConn, $sql);
$user_data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard | EcoNest</title>
<link rel="stylesheet" href="reset.css">
<link rel="stylesheet" href="1. Main Style.css">

<style>
:root {
    --green-dark: #009d27;
    --green-deep: #0b4a0b;
    --green-light: #dfffe0;
    --gray-light: #f8f9fa;
}

body {
    font-family: "Segoe UI", Arial, sans-serif;
    background: var(--gray-light);
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

main.dashboardcontainer {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem;
}

.dashboard-box {
    width: 100%;
    max-width: 800px;
    background: white;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.08);
    margin-bottom: 2rem;
}

.welcome {
    text-align: center;
    margin-bottom: 1.5rem;
}

.welcome h1 {
    color: var(--green-deep);
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.welcome p {
    font-size: 1.1rem;
    color: #333;
}

.menu {
    text-align: center;
    margin: 1.5rem 0;
}

.menu a {
    margin: 0 10px;
    text-decoration: none;
    padding: 12px 25px;
    background: var(--green-dark);
    color: #fff;
    border-radius: 6px;
    display: inline-block;
    font-weight: bold;
    transition: background 0.2s ease;
}

.menu a:hover {
    background: var(--green-deep);
}

.profile-card {
    background: var(--green-light);
    padding: 2rem;
    border-radius: 12px;
}

.profile-card h3 {
    margin-bottom: 1rem;
    color: var(--green-deep);
}

.profile-info p {
    margin: 8px 0;
    font-size: 1rem;
}

.profile-info strong {
    color: var(--green-deep);
}

/* CTA section (optional, same style as login/register) */
.cta {
    background: linear-gradient(90deg, #009d27, #0b4a0b);
    color: #fff;
    text-align: center;
    padding: 4rem 2rem;
    margin-top: 2rem;
}

.cta h2 {
    font-size: 2.3rem;
    margin-bottom: 1rem;
}

.cta p {
    max-width: 700px;
    margin: 0 auto 2rem;
    font-size: 1.1rem;
}

.cta-btn {
    display: inline-block;
    background: #8cff28;
    color: #1b4332;
    padding: 18px 30px;
    border-radius: 25px;
    font-weight: bold;
    text-decoration: none;
    transition: all 0.3s ease;
}

.cta-btn:hover {
    background: #fff;
    color: #237955;
    transform: scale(1.05);
}

/* Footer */
footer {
    text-align: center;
    padding: 1.5rem;
    background: #081c15;
    color: #d8f3dc;
    font-size: 0.9rem;
}
</style>
</head>
<body>

<main class="dashboardcontainer">
    <div class="dashboard-box">
        <div class="welcome">
            <h1>Welcome to EcoNest, <?php echo $user_data['user_name']; ?>! 🌿</h1>
            <p>Manage your profile and explore our features</p>
        </div>

        <div class="menu">
            <a href="UpdateProfile.php">✏️ Update Profile</a>
            <a href="logout.php">🚪 Logout</a>
        </div>

        <div class="profile-card">
            <h3>Your Profile Information:</h3>
            <div class="profile-info">
                <p><strong>Username:</strong> <?php echo $user_data['user_name']; ?></p>
                <p><strong>Email:</strong> <?php echo $user_data['user_email']; ?></p>
                <p><strong>Phone:</strong> <?php echo $user_data['user_phone']; ?></p>
                <p><strong>First Name:</strong> <?php echo !empty($user_data['first_name']) ? $user_data['first_name'] : 'Not set'; ?></p>
                <p><strong>Last Name:</strong> <?php echo !empty($user_data['last_name']) ? $user_data['last_name'] : 'Not set'; ?></p>
            </div>
        </div>

        <div style="text-align: center; margin-top: 1.5rem; color: #7f8c8d;">
            <p>Need to update your information? Click "Update Profile" above!</p>
        </div>
    </div>
</main>

<section class="cta">
    <h2>Stay Engaged with EcoNest</h2>
    <p>Check out our latest tips and programs to live sustainably and make a difference in your community.</p>
    <a href="logout.php" class="cta-btn">Logout</a>
</section>

<footer>
    <p>&copy; 2025 EcoNest Community | Sustainable Living Project</p>
</footer>

</body>
</html>
