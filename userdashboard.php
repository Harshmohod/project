<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: userlogin.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>


