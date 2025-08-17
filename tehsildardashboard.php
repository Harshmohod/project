<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'tehsildar') {
    header('Location: tehlogin.html');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tehsildar Dashboard - Land Registration System</title>
    <link rel="stylesheet" href="tehsildar.css">
</head>
<body>
    <nav class="navbar">
        <div class="logo">Land Registration and Evidence Management System</div>
        <ul class="nav-links">
            <li><a href="#dashboard">Dashboard</a></li>
            <li><a href="#verifications">Verifications</a></li>
            <li><a href="#reports">Reports</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <div class="container">
        <h1>Tehsildar Dashboard</h1>
        <div class="welcome-section">
            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
            <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>
            <p>Role: Tehsildar Officer</p>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card">
                <h3>Land Verifications</h3>
                <p>Review and verify land registration applications</p>
                <button onclick="location.href='#verifications'">View Applications</button>
            </div>

            <div class="dashboard-card">
                <h3>Document Verification</h3>
                <p>Verify land documents and evidence</p>
                <button onclick="location.href='#documents'">Verify Documents</button>
            </div>

            <div class="dashboard-card">
                <h3>Field Inspections</h3>
                <p>Schedule and manage field inspections</p>
                <button onclick="location.href='#inspections'">Manage Inspections</button>
            </div>

            <div class="dashboard-card">
                <h3>Reports & Analytics</h3>
                <p>Generate reports and view analytics</p>
                <button onclick="location.href='#reports'">View Reports</button>
            </div>
        </div>

        <div class="quick-stats">
            <h3>Quick Statistics</h3>
            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Pending Verifications</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Completed Today</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Scheduled Inspections</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">0</span>
                    <span class="stat-label">Total Applications</span>
                </div>
            </div>
        </div>
    </div>

    <footer>
        &copy; 2025 Land Evidence Verification System. All rights reserved.
    </footer>
</body>
</html>
