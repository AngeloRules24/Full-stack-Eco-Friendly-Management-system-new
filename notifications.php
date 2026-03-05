<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// For now, pretend user is logged in
$isLoggedIn = true;

// Hardcoded notifications — add as many as you want
$notifications = [
    [
        "notification_id" => 1,
        "message" => "Welcome to EcoNest! Thanks for joining our sustainable community 🌿",
        "status" => "unread",
        "created_at" => "2025-01-10 14:05:00"
    ],
];

// If marking notifications as "read" (simulated)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isLoggedIn) {
    echo "success";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>EcoNest - Notifications</title>
<link rel="stylesheet" href="1. Main Style.css">
<style>
:root {
  --green-dark: #009d27;
  --green-deep: #094a0a;
}
body {
  font-family: "Segoe UI", Arial, sans-serif;
  background: #f2f2f2;
  margin: 0; padding: 0;
}
.notifications {
  padding: 2rem;
  max-width: 800px;
  margin: 3rem auto;
  background: #fff;
  border-radius: 12px;
  box-shadow: 0 4 10 rgba(0,0,0,0.1);
}
.notif-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-bottom: 2px solid #d8f3dc;
  padding-bottom: 0.5rem;
  margin-bottom: 1rem;
}
.notif-header button {
  background: var(--green-dark);
  color: white;
  border: none;
  padding: 0.5rem 1rem;
  border-radius: 6px;
  cursor: pointer;
  font-weight: bold;
}
#notifList { display: flex; flex-direction: column; gap: 1rem; }
.notification {
  background: #ffffff;
  border-left: 5px solid var(--green-dark);
  padding: 1rem;
  border-radius: 8px;
  transition: 0.3s;
}
.notification.unread { background: #eaffea; }
.notification:hover { background: #f0fff0; cursor: pointer; }
small { color: #666; font-size: 0.8rem; }
</style>
</head>
<body>

<?php include "header.php"; ?>

<main class="notifications">
  <section class="notif-header">
    <h1>Notifications</h1>
    <?php if ($isLoggedIn && !empty($notifications)): ?>
      <button id="markAllRead">Mark all as read</button>
    <?php endif; ?>
  </section>

  <section id="notifList">
    <?php if (!$isLoggedIn): ?>
      <p class="guest-message">Please log in to view notifications.</p>
    <?php else: ?>
      <?php foreach ($notifications as $n): ?>
        <div class="notification <?php echo ($n['status'] === 'unread') ? 'unread' : ''; ?>"
             data-id="<?php echo $n['notification_id']; ?>">
          <h3>Notification</h3>
          <p><?php echo htmlspecialchars($n['message']); ?></p>
          <small><?php echo date('M d, Y h:i A', strtotime($n['created_at'])); ?></small>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </section>
</main>

<script>
document.addEventListener("DOMContentLoaded", () => {

  document.querySelectorAll(".notification").forEach(n => {
    n.addEventListener("click", () => {
      n.classList.remove("unread");
    });
  });

  const markAllBtn = document.getElementById("markAllRead");
  if (markAllBtn) {
    markAllBtn.addEventListener("click", () => {
      document.querySelectorAll(".notification").forEach(n => n.classList.remove("unread"));
    });
  }

});
</script>

<?php include "footer.php"; ?>
</body>
</html>
