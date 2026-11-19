<?php
require "config.php";

// Only logged-in admins may use this page
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    http_response_code(403);
    die("Access denied. Admins only.");
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userId = (int)($_POST["user_id"] ?? 0);
    $role   = $_POST["role"] ?? "";

    if (!in_array($role, ["admin", "member"], true)) {
        $message = "Invalid role.";
    } elseif ($userId === (int)$_SESSION["user_id"]) {
        $message = "You can't change your own role.";
    } else {
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE user_id = ?");
        $stmt->execute([$role, $userId]);
        $message = "Role updated.";
    }
}

$users = $pdo->query(
    "SELECT user_id, username, role, created_at FROM users ORDER BY username"
)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <h1 class="h3 mb-3">Manage Users</h1>
    <a href="dashboard.php" class="btn btn-secondary btn-sm mb-3">Back to dashboard</a>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <div class="table-responsive">
    <table class="table table-striped bg-white">
        <thead>
            <tr><th>Username</th><th>Role</th><th>Created</th><th>Action</th></tr>
        </thead>
        <tbody>
        <?php foreach ($users as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u["username"]) ?></td>
                <td><?= htmlspecialchars($u["role"]) ?></td>
                <td><?= htmlspecialchars($u["created_at"]) ?></td>
                <td>
                    <?php if ((int)$u["user_id"] !== (int)$_SESSION["user_id"]): ?>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="user_id" value="<?= (int)$u["user_id"] ?>">
                            <?php if ($u["role"] === "member"): ?>
                                <input type="hidden" name="role" value="admin">
                                <button class="btn btn-sm btn-primary">Make admin</button>
                            <?php else: ?>
                                <input type="hidden" name="role" value="member">
                                <button class="btn btn-sm btn-warning">Make member</button>
                            <?php endif; ?>
                        </form>
                    <?php else: ?>
                        <span class="text-muted">(you)</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
</body>
</html>