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

// Include database connection
require_once "../connect.php";

// Fetch all job fields
$fields_query = "SELECT field_id, field_name FROM field ORDER BY field_name";
$fields_result = $con->query($fields_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobConnect | Home</title>
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
                <a href="customerhome.php" class="nav-link active">Home</a>
                <a href="jobfield.php" class="nav-link">Browse Jobs</a>
                <a href="applications.php" class="nav-link">My Applications</a>
                <a href="account.php" class="nav-link">Profile</a>
            </nav>
            <div class="user-actions">
                <button class="icon-button notification-badge">
                    <span>🔔</span>
                    <span class="badge">3</span>
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
        <div class="container">
            <div class="page-header-content">
                <h1 class="page-title">Welcome to JobConnect</h1>
                <p>Browse Jobs by Field</p>
            </div>
            <div class="job-grid-container">
                <div class="job-grid">
                    <?php if ($fields_result && $fields_result->num_rows > 0) {
                        while ($field = $fields_result->fetch_assoc()) { 
                            // Get job count for each field
                            $job_count_query = "SELECT COUNT(*) as count FROM job WHERE job_field = " . $field['field_id'];
                            $count_result = $con->query($job_count_query);
                            $job_count = $count_result->fetch_assoc()['count'];
                    ?>
                        <a href="jobfield.php?field_id=<?php echo $field['field_id']; ?>" class="job-card-link">
                            <div class="job-card">
                                <div class="job-card-content">
                                    <h3 class="field-name"><?php echo htmlspecialchars($field['field_name']); ?></h3>
                                    <p class="job-count"><?php echo $job_count; ?> Jobs Available</p>
                                    <div class="field-icon">
                                        <?php
                                        // Add icons based on field name
                                        $icons = [
                                            'Software Development' => '💻',
                                            'Marketing' => '📈',
                                            'Finance' => '💰',
                                            'Health' => '⚕️',
                                            'Engineering' => '⚙️',
                                            'Creative & Design' => '🎨',
                                            'Construction' => '🏗️',
                                            'default' => '📋'
                                        ];
                                        echo $icons[$field['field_name']] ?? $icons['default'];
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php }
                    } else { ?>
                        <div class="error-message">
                            <p>No job fields available at the moment.</p>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="action-buttons">
                <a href="account.php" class="btn btn-primary">View Profile</a>
            </div>
        </div>
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