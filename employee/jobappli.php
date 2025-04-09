<?php
require '../connect.php';
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}

// Get the job_id from the query string
$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

if ($job_id === 0) {
    die("Invalid job ID.");
}

// Fetch job details
$job_query = "
    SELECT j.job_role, f.field_name AS job_field, j.post AS posted_date, j.deadline,
           COUNT(a.application_id) AS application_count
    FROM job j
    LEFT JOIN job_applications a ON j.job_id = a.job_id
    LEFT JOIN field f ON j.job_field = f.field_id
    WHERE j.job_id = $job_id
    GROUP BY j.job_id
";

$job_result = mysqli_query($con, $job_query);

if (!$job_result || mysqli_num_rows($job_result) === 0) {
    die("Job not found.");
}

$job = mysqli_fetch_assoc($job_result);

// Fetch applicants for the job
$applicants_query = "
    SELECT 
        COALESCE(u.full_name, CONCAT(a.first_name, ' ', a.last_name)) AS full_name, 
        a.email AS email, 
        COALESCE(u.phone_number, a.phone) AS phone_number, 
        a.experience, a.current_company, a.current_position, a.submitted_at, a.application_id
    FROM job_applications a
    LEFT JOIN user u ON a.email = u.email
    WHERE a.job_id = $job_id
    ORDER BY a.submitted_at DESC
";

$applicants_result = mysqli_query($con, $applicants_query);

if (!$applicants_result) {
    die("Failed to fetch applicants: " . mysqli_error($con));
}

$applicants = [];
while ($row = mysqli_fetch_assoc($applicants_result)) {
    $applicants[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal - Applications</title>
    <link href="../assets/css/main.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1>Company Job Portal</h1>
            <div class="user-info">
                <span>Admin User</span>
                <img src="/api/placeholder/40/40" alt="User Avatar">
            </div>
        </div>
    </header>

    <div class="container">
        <div class="breadcrumbs">
            <a href="jobs.html">Jobs</a>
            <span>></span>
            <a href="#"><?php echo htmlspecialchars($job['job_role']); ?></a>
        </div>
        
        <div class="job-info">
            <h3><?php echo htmlspecialchars($job['job_role']); ?></h3>
            <p><strong>Field:</strong> <?php echo htmlspecialchars($job['job_field']); ?></p>
            <p><strong>Status:</strong> <span class="badge badge-success">Active</span></p>
            <p><strong>Posted:</strong> <?php echo htmlspecialchars($job['posted_date']); ?></p>
            <p><strong>Applications:</strong> <?php echo htmlspecialchars($job['application_count']); ?> total</p>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">Applications</h2>
                <div>
                    <button class="secondary" onclick="window.location.href='joblist.php'">Back to Jobs</button>
                </div>
            </div>
            
            <div class="app-cards">
                <?php foreach ($applicants as $applicant): ?>
                <div class="app-card" onclick="location.href='jobapplidetails.php?application_id=<?php echo urlencode($applicant['application_id']); ?>'">
                    <h3><?php echo htmlspecialchars($applicant['full_name']); ?></h3>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($applicant['email']); ?></p>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($applicant['phone_number']); ?></p>
                    <p><strong>Experience:</strong> <?php echo htmlspecialchars($applicant['experience']); ?> years</p>
                    <p><strong>Current Company:</strong> <?php echo htmlspecialchars($applicant['current_company']); ?></p>
                    <p><strong>Current Position:</strong> <?php echo htmlspecialchars($applicant['current_position']); ?></p>
                    <div class="meta">
                        <span class="date">Applied: <?php echo htmlspecialchars($applicant['submitted_at']); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>