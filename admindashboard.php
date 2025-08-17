<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: adminlogin.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Land Registration System</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Land Registration and Evidence Management System</div>
        <ul class="nav-links">
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#users">Manage Users</a></li>
            <li><a href="#reports">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Admin Dashboard</h1>
        <div class="welcome-section">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p>Role: Administrator</p>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>User Management</h3>
                <p>Manage all users, tehsildars, and administrators</p>
                <button onclick="location.href='#users'">Manage Users</button>
            </div>

            <div class="dashboard-card">
                <h3>System Reports</h3>
                <p>View system statistics and reports</p>
                <button onclick="location.href='#reports'">View Reports</button>
            </div>

            <div class="dashboard-card">
                <h3>Land Records</h3>
                <p>Manage land registration records</p>
                <button onclick="location.href='#records'">Manage Records</button>
            </div>

            <div class="dashboard-card">
                <h3>System Settings</h3>
                <p>Configure system settings and preferences</p>
                <button onclick="location.href='#settings'">Settings</button>
            </div>
        </div>

        <div class="quick-stats">
            <h3>Quick Statistics</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Total Users</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Tehsildars</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Land Records</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Pending Approvals</span>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Land Evidence Verification System. All rights reserved.
    </footer>
</body>
</html>
