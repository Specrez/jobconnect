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
    <title>Job Portal - Posted Jobs</title>
    <link rel="stylesheet" href="view.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Company Job Portal</h1>
            <div class="user-info">
                <span><?php echo htmlspecialchars($company_name); ?></span>
                <img src="/api/placeholder/40/40" alt="User Avatar">
            </div>
        </div>
    </header>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Posted Job Listings</h2>
                <button onclick="location.href='fields.php'">Post New Job</button>
            </div>
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
                                <td><?php echo htmlspecialchars($job['application_count']); ?></td>
                                <td>
                                    <span class="badge badge-<?php echo $job['status'] === 'Active' ? 'success' : ($job['status'] === 'Closing Soon' ? 'warning' : 'danger'); ?>">
                                        <?php echo htmlspecialchars($job['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="jobappli.php?job_id=<?php echo urlencode($job['job_id']); ?>">View Applications</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">No jobs posted yet.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>