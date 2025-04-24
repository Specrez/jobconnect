<?php
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Employer Dashboard</title>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="employee.css" rel="stylesheet">
    <link href="calendar.css" rel="stylesheet">
    <script src="calendar.js" defer></script>
    <style>
       
    </style>
</head>
<body>
    <!-- Main Header -->
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="#" class="brand-logo">
                    <span class="icon">💼</span>
                    <span>JobConnect</span>
                </a>
            </div>
            
            <nav class="nav-links">
                <a href="employeehome.php" class="nav-link active">Dashboard</a>
                <a href="joblist.php" class="nav-link">Posted Jobs</a>
            </nav>
            
            <div class="user-actions">
                
                <div class="user-profile">
                    <a link href="acc.php" class="profile-link" title="My Account">
                    <div class="profile-avatar">
                        <span style="font-size:1.1rem;">
                            <?php echo strtoupper(substr($_SESSION['name'] ?? 'G', 0, 1)); ?>
                        </span>
                    </div>
                    </a>
                    <div style="font-weight:600;">
                        <?php echo htmlspecialchars($_SESSION['name'] ?? 'Guest'); ?>
                    </div>
                </div>
                <a href="../login/logout.php" class="nav-link" style="color: #ff4444; margin-left: 1rem;">
                    Logout
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-header">
            <div>
                <h1 class="page-title">Welcome to Your Employer Dashboard</h1>
                <p class="page-subtitle">Manage your job postings and find the perfect candidates</p>
            </div>
        </div>

        <!-- Quick Actions -->
        <section>
            <div class="job-grid-container">
                <div class="job-grid">
                    <a href="fields.php">
                        <div class="job-card action-card">
                            <div class="card-icon" style="background:linear-gradient(135deg,#4f8cff,#4169e1);">
                                ➕
                            </div>
                            <h2>Post New Job</h2>
                            <p>Create a new job listing to find qualified candidates</p>
                        </div>
                    </a>
                    <a href="joblist.php">
                        <div class="job-card action-card">
                            <div class="card-icon" style="background:linear-gradient(135deg,#4f8cff,#4169e1);">
                                📋
                            </div>
                            <h2>Manage Jobs</h2>
                            <p>View and manage your active job postings</p>
                        </div>
                    </a>
                </div>
                <div class="calendar">
                    <div class="calendar-header">
                        <button id="prevMonth">&lt;</button>
                        <h2 id="monthDisplay"></h2>
                        <button id="nextMonth">&gt;</button>
                    </div>
                    <div class="weekdays">
                        <div>Sun</div>
                        <div>Mon</div>
                        <div>Tue</div>
                        <div>Wed</div>
                        <div>Thu</div>
                        <div>Fri</div>
                        <div>Sat</div>
                    </div>
                    <div id="calendar"></div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
</body>
</html>