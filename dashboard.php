<?php
require "config.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome <?= htmlspecialchars($_SESSION["username"]) ?></h1>
    <p>You are logged in.</p>

    <?php if ($_SESSION["role"] === "admin"): ?>
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="manage_users.php">Manage Users</a></li>
            <li><a href="members.php">Manage Members</a></li>
            <li><a href="events.php">Manage Events</a></li>
        </ul>
    <?php else: ?>
        <h2>Member Area</h2>
        <ul>
            <li><a href="profile.php">My Profile</a></li>
            <li><a href="events_list.php">Register for Events</a></li>
        </ul>
    <?php endif; ?>

    <a href="logout.php">Logout</a>
</body>
</html>