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
    <title>Application Details</title>
    <link rel="stylesheet" href="aaa.css">
</head>
<body>
    <header>
        <div class="container">
            <h1>Application Details</h1>
        </div>
    </header>

    <div class="container">
        <div class="application-details">
            <h2><?php echo htmlspecialchars($application['first_name'] . ' ' . $application['last_name']); ?></h2>
            <p><strong>Job Role:</strong> <?php echo htmlspecialchars($application['job_role']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($application['email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($application['phone']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($application['address']); ?></p>
            <p><strong>Current Company:</strong> <?php echo htmlspecialchars($application['current_company']); ?></p>
            <p><strong>Current Position:</strong> <?php echo htmlspecialchars($application['current_position']); ?></p>
            <p><strong>Experience:</strong> <?php echo htmlspecialchars($application['experience']); ?> years</p>
            <p><strong>Expected Salary:</strong> <?php echo htmlspecialchars($application['expected_salary']); ?></p>
            <p><strong>Skills:</strong> <?php echo htmlspecialchars($application['skills']); ?></p>
            <p><strong>Why Applying:</strong> <?php echo htmlspecialchars($application['why_applying']); ?></p>
            <p><strong>Additional Info:</strong> <?php echo htmlspecialchars($application['additional_info']); ?></p>
            <p><strong>Resume:</strong> <a href="<?php echo htmlspecialchars($application['resume_path']); ?>" target="_blank">Download</a></p>
            <?php if (!empty($application['cover_letter_path'])): ?>
                <p><strong>Cover Letter:</strong> <a href="<?php echo htmlspecialchars($application['cover_letter_path']); ?>" target="_blank">Download</a></p>
            <?php endif; ?>
            <p><strong>Submitted At:</strong> <?php echo htmlspecialchars($application['submitted_at']); ?></p>
        </div>
        <button onclick="window.history.back()">Back</button>
    </div>
</body>
</html>