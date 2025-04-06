<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = new mysqli("localhost", "root", "", "jobconnect");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the field ID from the URL safely
$field_id = isset($_GET['field_id']) ? intval($_GET['field_id']) : 0;

// Fetch the field name based on field_id
$field_query = "SELECT field_name FROM field WHERE field_id = ?";
$stmt = $conn->prepare($field_query);
$stmt->bind_param("i", $field_id);
$stmt->execute();
$field_result = $stmt->get_result();

$field_name = ($field_result->num_rows > 0) ? $field_result->fetch_assoc()['field_name'] : 'Unknown Field';

// Fetch jobs related to the selected field
$jobs_query = "SELECT j.job_id, j.job_role, j.location, j.salary, j.company_name 
               FROM job j
               WHERE j.job_field = ?";
$stmt = $conn->prepare($jobs_query);
$stmt->bind_param("i", $field_id);
$stmt->execute();
$jobs_result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Job Listings</title>
    <link href="customerhome.css" rel="stylesheet">
</head>
<body>

    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="customerhome.php" class="brand-logo">
                    <span class="icon">💼</span>
                    <span>JobConnect</span>
                </a>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="page-header-content">
            <h1 class="page-title"><?php echo htmlspecialchars($field_name); ?></h1>
        </div>

        <section>
            <div class="job-grid-container">
                <div class="job-grid">
                    <?php if ($jobs_result->num_rows > 0) { 
                        while ($job = $jobs_result->fetch_assoc()) { ?>
                            <a href="job.php?job_id=<?php echo $job['job_id']; ?>" class="job-card-link">
                                <div class="job-card">
                                    <div class="job-card-content">
                                        <p><strong>Company:</strong> <?php echo htmlspecialchars($job['company_name']); ?></p>
                                        <p><strong>Position:</strong> <?php echo htmlspecialchars($job['job_role']); ?></p>
                                        <p><strong>Location:</strong> 📍 <?php echo htmlspecialchars($job['location']); ?></p>
                                        <p><strong>Salary:</strong> 💰 LKR <?php echo number_format($job['salary'], 2); ?>/month</p>
                                    </div>
                                </div>
                            </a>
                        <?php } 
                    } else { ?>
                        <div class="job-card">
                            <div class="job-card-placeholder">
                                <span>No jobs available for this field.</span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </main>

</body>
</html>

<?php
// Close the connection
$stmt->close();
$conn->close();
?>
