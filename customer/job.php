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

// Get the job ID from the URL and validate it
$job_id = isset($_GET['job_id']) ? intval($_GET['job_id']) : 0;

$sql = "SELECT jf.field_name, j.job_role, j.company_name, j.branch, j.reg_no, j.location, 
               j.phone, j.salary, j.requirements, j.description, j.deadline, j.post 
        FROM job j
        JOIN field jf ON j.job_field = jf.field_id
        WHERE j.job_id = $job_id";
$job_result = $con->query($sql);

$job = ($job_result && $job_result->num_rows > 0) ? $job_result->fetch_assoc() : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Job Details</title>
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

    <div class="container">
        <?php if ($job): ?>
            <div class="sector-banner">
                <h1 class="sector-title">Job Details <span class="status-badge status-active">Active</span></h1>
            </div>
            
            <div class="job-details-container">
                <h2 class="job-details-title">View Job Posting</h2>
                
                <form>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Job Field</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['field_name']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Job Role</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['job_role']); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['company_name']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Branch</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['branch']); ?>" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Company Reg. No.</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['reg_no']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Location 📍</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['location']); ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['phone']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Salary 💰</label>
                            <input type="text" class="form-control" value="LKR <?php echo number_format($job['salary'], 2); ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label>Job Requirements</label>
                        <textarea class="form-control" rows="3" readonly><?php echo htmlspecialchars($job['requirements']); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Job Description</label>
                        <textarea class="form-control" rows="4" readonly><?php echo htmlspecialchars($job['description']); ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label>Deadline Date</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['deadline']); ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Published Date</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($job['post']); ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="action-buttons">
                        <a href="uploadcv.php?jobId=<?php echo $job_id; ?>" class="btn btn-primary">Apply</a>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <div class="error-message">
                <h2>Job Not Found</h2>
                <p>The job you are looking for does not exist.</p>
                <a href="customerhome.php" class="btn btn-secondary">Go Back</a>
            </div>
        <?php endif; ?>
    </div>

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
