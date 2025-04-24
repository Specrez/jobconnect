<?php
require '../connect.php';
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}

// Fetch company name from session
$company_name = $_SESSION['name'] ?? '';

$query = "
    SELECT j.job_id, f.field_name AS job_field, j.job_role, j.post AS posted_date, 
           COUNT(a.application_id) AS application_count, 
           CASE 
               WHEN j.deadline < NOW() THEN 'Closed'
               WHEN j.deadline < DATE_ADD(NOW(), INTERVAL 7 DAY) THEN 'Closing Soon'
               ELSE 'Active'
           END AS status
    FROM job j
    LEFT JOIN job_applications a ON j.job_id = a.job_id
    LEFT JOIN field f ON j.job_field = f.field_id
    WHERE j.company_name = '$company_name'
    GROUP BY j.job_id
    ORDER BY j.post DESC
";

$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

$jobs = [];
while ($row = mysqli_fetch_assoc($result)) {
    $jobs[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Posted Jobs</title>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="employee.css" rel="stylesheet">
    <link href="joblist.css" rel="stylesheet">
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

    <main class="main-content">
        <div class="breadcrumbs">
            <a href="employeehome.php">Dashboard</a>
            <span>/</span>
            <span>Posted Jobs</span>
        </div>

        <div class="page-header">
            <h1 class="page-title">Posted Job Listings</h1>
            <div class="page-actions">
                <button class="btn btn-primary" onclick="location.href='fields.php'">
                    <span class="icon">+</span>
                    Post New Job
                </button>
            </div>
        </div>

        <div class="card">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Job Field</th>
                            <th>Job Role</th>
                            <th>Posted Date</th>
                            <th>Applications</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($jobs) > 0): ?>
                            <?php foreach ($jobs as $job): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($job['job_field']); ?></td>
                                    <td><?php echo htmlspecialchars($job['job_role']); ?></td>
                                    <td><?php echo htmlspecialchars(date('M d, Y', strtotime($job['posted_date']))); ?></td>
                                    <td>
                                        <span class="applications-count">
                                            <?php echo htmlspecialchars($job['application_count']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge <?php echo strtolower($job['status']); ?>">
                                            <?php echo htmlspecialchars($job['status']); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="jobappli.php?job_id=<?php echo urlencode($job['job_id']); ?>" 
                                               class="btn btn-secondary btn-sm">View Applications</a>
                                            <button onclick="confirmDelete(<?php echo $job['job_id']; ?>)" 
                                                    class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-state">No jobs posted yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
    function confirmDelete(jobId) {
        if (confirm('Are you sure you want to delete this job posting?')) {
            window.location.href = 'delete_job.php?job_id=' + jobId;
        }
    }
    </script>
</body>
</html>