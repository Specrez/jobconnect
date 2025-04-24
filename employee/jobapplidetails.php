<?php
require '../connect.php';
session_start();

// Validate session and role
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'company') {
    header("Location: ../login/login.php");
    exit();
}

// Get the application_id from the query string
$application_id = isset($_GET['application_id']) ? intval($_GET['application_id']) : 0;

if ($application_id === 0) {
    die("Invalid application ID.");
}

// Fetch application details
$query = "
    SELECT a.*, j.job_role, 
           COALESCE(a.phone, 'Not Provided') AS phone
    FROM job_applications a
    INNER JOIN job j ON a.job_id = j.job_id
    WHERE a.application_id = $application_id
";

$result = mysqli_query($con, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    die("Application not found.");
}

$application = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Application Details</title>
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="employee.css" rel="stylesheet">
    <link href="details.css" rel="stylesheet">
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
            <a href="joblist.php">Posted Jobs</a>
            <span>/</span>
            <span>Application Details</span>
        </div>

        <div class="application-details">
            <h2><?php echo htmlspecialchars($application['first_name'] . ' ' . $application['last_name']); ?></h2>
            
            <div class="detail-section">
                <h3>Basic Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Job Role</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['job_role']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Email</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['email']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Phone</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['phone']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Address</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['address']); ?></span>
                </div>
            </div>

            <div class="detail-section">
                <h3>Professional Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Current Company</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['current_company']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Current Position</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['current_position']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Experience</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['experience']); ?> years</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Expected Salary</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['expected_salary']); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Skills</span>
                    <span class="detail-value"><?php echo htmlspecialchars($application['skills']); ?></span>
                </div>
            </div>

            <div class="detail-section">
                <h3>Additional Information</h3>
                <div class="detail-row">
                    <span class="detail-label">Why Applying</span>
                    <span class="detail-value"><?php echo nl2br(htmlspecialchars($application['why_applying'])); ?></span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Additional Info</span>
                    <span class="detail-value"><?php echo nl2br(htmlspecialchars($application['additional_info'])); ?></span>
                </div>
            </div>

            <div class="detail-section">
                <h3>Documents</h3>
                <div class="detail-row">
                    <span class="detail-label">Resume</span>
                    <span class="detail-value">
                        <?php if (!empty($application['resume_path'])): ?>
                            <a href="download.php?type=resume&application_id=<?php echo $application_id; ?>" class="document-link">
                                Download Resume
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Resume not available</span>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Cover Letter</span>
                    <span class="detail-value">
                        <?php if (!empty($application['cover_letter_path'])): ?>
                            <a href="download.php?type=cover_letter&application_id=<?php echo $application_id; ?>" class="document-link">
                                Download Cover Letter
                            </a>
                        <?php else: ?>
                            <span class="text-muted">Cover letter not available</span>
                        <?php endif; ?>
                    </span>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn btn-secondary" onclick="window.history.back()">Back to Applications</button>
            </div>
        </div>
    </main>
</body>
</html>