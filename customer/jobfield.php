<?php
session_start();
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login/login.php");
    exit();
}

// Disable caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Include the database connection
require_once "../connect.php";

// Get the field ID from the URL safely
$field_id = isset($_GET['field_id']) ? intval($_GET['field_id']) : 0;

// Fetch the field name based on field_id
$field_query = "SELECT field_name FROM field WHERE field_id = $field_id";
$field_result = $con->query($field_query);

$field_name = ($field_result && $field_result->num_rows > 0) ? $field_result->fetch_assoc()['field_name'] : 'Unknown Field';

// Fetch jobs related to the selected field
$jobs_query = "SELECT j.job_id, j.job_role, j.location, j.salary, j.company_name 
               FROM job j
               WHERE j.job_field = $field_id";
$jobs_result = $con->query($jobs_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Field Jobs</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <header class="main-header">
        <div class="header-container">
            <div class="logo-container">
                <a href="customerhome.php" class="brand-logo">
                    <div class="icon">💼</div>
                    <span>JobConnect</span>
                </a>
            </div>
            <nav class="nav-links">
                <a href="customerhome.php" class="nav-link">Home</a>
                <a href="#" class="nav-link active">Browse Jobs</a>
                <a href="#" class="nav-link">My Applications</a>
                <a href="account.php" class="nav-link">Profile</a>
            </nav>
            <div class="user-actions">
                <button class="icon-button notification-badge">
                    <span>🔔</span>
                    <span class="badge">2</span>
                </button>
                <div class="user-profile">
                    <div class="profile-avatar">
                        <?php echo isset($_SESSION['email']) ? substr($_SESSION['email'], 0, 2) : 'G'; ?>
                    </div>
                    <div class="profile-dropdown">
                        <a href="account.php" class="dropdown-item">My Profile</a>
                        <a href="#" class="dropdown-item logout" onclick="confirmLogout()">Logout</a>
                    </div>
                </div>
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
                    <?php if ($jobs_result && $jobs_result->num_rows > 0) { 
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

    <script>
        function confirmLogout() {
            if (confirm("Are you sure you want to log out?")) {
                window.location.href = "../login/logout.php";
            }
        }

        document.querySelector('.user-profile').addEventListener('click', function (e) {
            e.stopPropagation();
            this.querySelector('.profile-dropdown').classList.toggle('active');
        });

        document.addEventListener('click', function () {
            const dropdown = document.querySelector('.profile-dropdown');
            if (dropdown && dropdown.classList.contains('active')) {
                dropdown.classList.remove('active');
            }
        });
    </script>
</body>
</html>

<?php
$con->close();
?>
